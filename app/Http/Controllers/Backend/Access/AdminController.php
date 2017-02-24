<?php

namespace App\Http\Controllers\Backend\Access;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Backend\Access\User\UserRequest;
use App\Http\Requests\Backend\Access\User\UserStoreOrUpdateRequest;
use App\Models\Admin as User;
use App\Repositories\Backend\Access\Permission\PermissionRepository;
use App\Repositories\Backend\Access\Role\RoleRepository;
use App\Repositories\Backend\Access\User\UserRepository;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class AdminController extends Controller
{
    private $users;
    private $roles;

    public function __construct(UserRepository $users, RoleRepository $roles)
    {
        $this->users = $users;
        $this->roles = $roles;
    }

    /**
     * 管理员列表页
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.access.user.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get(UserRequest $request)
    {
        return Datatables::of($this->users->getForDataTable())
            ->addColumn('role', function ($user) {
                $roles = [];

                if ($user->roles()->count() > 0) {
                    foreach ($user->roles as $role) {
                        array_push($roles, $role->name);
                    }

                    return implode("<br/>", $roles);
                } else {
                    return '暂无';
                }
            })
            ->addColumn('actions', function ($user) {
                return $user->admin_action_buttons;
            })
        ->make(true);
    }

    /**
     * 创建管理员表单页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.access.user.create')
            ->withRoles($this->roles->getAll());
    }

    /**
     * 创建管理员
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreOrUpdateRequest $request)
    {
        $this->users->create($request->all());
        return redirect()->route(env('APP_BACKEND_PREFIX').'.access.admin.index')->withFlashSuccess('管理员创建成功');
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
     * 编辑页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Request $request)
    {
        return view('backend.access.user.edit')
            ->withUser($user)
            ->withRoles($this->roles->getAll())
            ->withRoleUser($user->roles->pluck('id')->all());
    }

    /**
     * 更新数据
     *
     * @param  User                     $user
     * @param  UserStoreOrUpdateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, UserStoreOrUpdateRequest $request)
    {
        $this->users->update($user, $request->all());
        return redirect()->route(env('APP_BACKEND_PREFIX').'.access.admin.index')->withFlashSuccess('更新成功');
    }

    /**
     * 删除管理员
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->users->destroy($user);
        return redirect()->back()->withFlashSuccess('删除成功');
    }
}
