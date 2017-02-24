<?php

namespace App\Http\Controllers\Backend\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Users\UserUpdateRequest;
use App\Http\Requests\Backend\Users\UserStoreRequest;
use App\Models\Company;
use App\Models\User;
use App\Repositories\Backend\Users\UserRepository;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class UserController extends Controller
{
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }
    /**
     * 所有用户列表页
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.users.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        return Datatables::of($this->users->getForDataTable())
            ->filter(function ($query) use ($request) {
                User::userFilter($query, $request);
            })
            ->addColumn('ids', function ($user) {
                return $user->checkbox_button;
            })
            ->addColumn('actions', function ($user) {
                return $user->action_buttons;
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
        return view('backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $this->users->create($request);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.users.index')->withFlashSuccess('会员添加成功');
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
    public function edit(User $user)
    {
        $company = Company::select('id')->where('user_id', $user->id)->first();
        return view('backend.users.edit', compact(['user','company']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, UserUpdateRequest $request)
    {
        $this->users->update($user, $request->all());
        return redirect()->route(env('APP_BACKEND_PREFIX').'.users.index')->withFlashSuccess('会员更新成功');
    }

    /**
     * 回收站
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->users->destroy($user);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.users.index')->withFlashSuccess('会员删除成功');
    }

    /**
     * 恢复
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function restore(User $user)
    {
        $this->users->restore($user);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.users.index')->withFlashSuccess('会员恢复成功');
    }

    /**
     * 彻底删除
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function delete(User $user)
    {
        $this->users->delete($user);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.users.index')->withFlashSuccess('会员删除成功');
    }

    public function info(Request $request)
    {
        $users = User::select('id', 'username', 'name', 'mobile', 'email', 'avatar', 'created_at')->where('username', 'like', "%$request->q%")->orWhere('name', 'like', "%$request->q%")->orWhere('mobile', 'like', "%$request->q%")->paginate();
        return response()->json($users);
    }

    public function avatar(Request $request)
    {
        $result = $this->users->avatar($request);
        return response($result);
    }
}
