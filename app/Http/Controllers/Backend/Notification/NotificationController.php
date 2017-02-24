<?php

namespace App\Http\Controllers\Backend\Notifications;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Notifications\NotificationStoreRequest;
use App\Models\Notification;
use App\Repositories\Backend\Notifications\NotificationRepository;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class NotificationController extends Controller
{
    protected $notification;

    public function __construct(NotificationRepository $notification)
    {
        $this->notification = $notification;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.notifications.index');
    }

    /**
     * 通知列表
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        return Datatables::of($this->notification->getForDataTable())
            ->filter(function ($query) use ($request) {
                Notification::notificationFilter($query, $request);
            })
            ->addColumn('ids', function ($notification) {
                return $notification->checkbox_button;
            })
            ->addColumn('actions', function ($notification) {
                return $notification->action_button;
            })
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.notifications.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NotificationStoreRequest $request)
    {
        $this->notification->create($request);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.notifications.index')->withFlashSuccess('通知添加成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        $this->notification->destroy($notification);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.notifications.index')->withFlashSuccess('通知删除成功');
    }
}
