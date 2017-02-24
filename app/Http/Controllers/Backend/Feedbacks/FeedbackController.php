<?php

namespace App\Http\Controllers\Backend\Feedbacks;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Feedback;
use App\Repositories\Backend\Feedbacks\FeedbackRepository;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class FeedbackController extends Controller
{
    protected $feedbacks;

    public function __construct(FeedbackRepository $feedbacks)
    {
        $this->feedbacks = $feedbacks;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.feedbacks.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        return Datatables::of($this->feedbacks->getForDataTable())
            ->addColumn('ids', function ($feedbacks) {
                return $feedbacks->checkbox_button;
            })
            ->addColumn('actions', function ($feedbacks) {
                return $feedbacks->action_buttons;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        $this->feedbacks->destroy($feedback);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.feedbacks.index')->withFlashSuccess('反馈删除成功');
    }
}
