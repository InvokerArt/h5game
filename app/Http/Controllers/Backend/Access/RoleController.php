<?php

namespace App\Http\Controllers\Backend\Access;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Http\Requests\Backend\Access\Role\RoleRequest;
use App\Http\Requests\Backend\Access\Role\RoleStoreOrUpdateRequest;
use App\Repositories\Backend\Access\Role\RoleRepository;
use App\Repositories\Backend\Access\Permission\PermissionRepository;

class RoleController extends Controller
{
    protected $roles;
    protected $permissions;

    public function __construct(RoleRepository $roles, PermissionRepository $permissions)
    {
        $this->roles = $roles;
        $this->permissions = $permissions;
    }



    /**
     * 角色列表页
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.access.role.index');
    }

    /**
     * 获取Datatables数据
     *
     * @param ManageUserRequest $request
     * @return mixed
     */
    public function get(RoleRequest $request)
    {
        return Datatables::of($this->roles->getForDataTable())
            ->addColumn('permissions', function($role) {
                $permissions = [];

                if ($role->all)
                    return '<span class="label lable-sm bg-blue">全部</span>';

                if (count($role->permissions) > 0) {
                    foreach ($role->permissions as $permission) {
                        array_push($permissions, $permission->display_name);
                    }

                    return implode("<br/>", $permissions);
                } else {
                    return '<span class="label lable-sm bg-red">暂无</span>';
                }
            })
            ->addColumn('users', function($role) {
                return $role->users()->count();
            })
            ->addColumn('actions', function($role) {
                return $role->action_buttons;
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
        return view('backend.access.role.create')
            ->withPermissions($this->permissions->getAllPermissions())
            ->withRoleCount($this->roles->getCount());
    }

    /**
     * 创建角色
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleStoreOrUpdateRequest $request)
    {
        $this->roles->create($request->all());
        return redirect()->route(env('APP_BACKEND_PREFIX').'.access.role.index')->withFlashSuccess('权限创建成功');
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
    public function edit(Role $role)
    {
        return view('backend.access.role.edit')
            ->withRole($role)
            ->withRolePermissions($role->permissions->pluck('id')->all())
            ->withPermissions($this->permissions->getAllPermissions());
    }

    /**
     * 更新数据
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Role $role, RoleStoreOrUpdateRequest $request)
    {
        $this->roles->update($role, $request->all());
        return redirect()->route(env('APP_BACKEND_PREFIX').'.access.role.index')->withFlashSuccess('更新成功');
    }

    /**
     * 删除数据
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->roles->destroy($role);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.access.role.index')->withFlashSuccess('删除成功');
    }
}
