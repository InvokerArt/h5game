<?php

namespace App\Http\Controllers\Backend\Access;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Access\Permission\PermissionRequest;
use App\Http\Requests\Backend\Access\Permission\PermissionStoreOrUpdateRequest;
use App\Models\Permission;
use App\Repositories\Backend\Access\Permission\PermissionRepository;
use App\Repositories\Backend\Access\Role\RoleRepository;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class PermissionController extends Controller
{
    protected $permissions;
    protected $roles;

    public function __construct(PermissionRepository $permissions, RoleRepository $roles)
    {
        $this->permissions = $permissions;
        $this->roles = $roles;
    }

    /**
     * 权限列表页
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.access.permission.index');
    }

    /**
     * 获取Datatables数据
     *
     * @param  PermissionRequest $request
     * @return array
     */
    public function get(PermissionRequest $request)
    {
        return Datatables::of($this->permissions->getForDataTable())
            ->addColumn('actions', function ($permission) {
                return $permission->action_buttons;
            })
            ->make(true);
    }

    /**
     * 创建权限表单页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.access.permission.create');
    }

    /**
     * 创建权限
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionStoreOrUpdateRequest $request)
    {
        $this->permissions->create($request->all());
        return redirect()->route(env('APP_BACKEND_PREFIX').'.access.permission.index')->withFlashSuccess('权限创建成功');
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
    public function edit(Permission $permission)
    {
        return view('backend.access.permission.edit')
            ->withPermission($permission);
    }

    /**
     * 更新数据
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Permission $permission, PermissionStoreOrUpdateRequest $request)
    {
        $this->permissions->update($permission, $request->all());
        return redirect()->route(env('APP_BACKEND_PREFIX').'.access.permission.index')->withFlashSuccess('更新成功');
    }

    /**
     * 删除数据
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $this->permissions->destroy($permission);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.access.permission.index')->withFlashSuccess('删除成功');
    }
}
