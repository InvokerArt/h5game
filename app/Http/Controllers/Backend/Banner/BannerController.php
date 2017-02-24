<?php

namespace App\Http\Controllers\Backend\Banners;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Banners\BannerStoreRequest;
use App\Http\Requests\Backend\Banners\BannerUpdateRequest;
use App\Models\Banner;
use App\Repositories\Backend\Banners\BannerRepository;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class BannerController extends Controller
{
    protected $banners;

    public function __construct(BannerRepository $banners)
    {
        $this->banners = $banners;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.banners.index');
    }

    /**
     * 广告位
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        return Datatables::of($this->banners->getForDataTable())
            ->filter(function ($query) use ($request) {
                Banner::bannerFilter($query, $request);
            })
            ->addColumn('ids', function ($banners) {
                return $banners->checkbox_button;
            })
            ->addColumn('actions', function ($banners) {
                return $banners->action_buttons;
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
        return view('backend.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerStoreRequest $request)
    {
        $this->banners->create($request);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.banners.index')->withFlashSuccess('广告位添加成功');
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
    public function edit(Banner $banner)
    {
        return view('backend.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Banner $banner, BannerUpdateRequest $request)
    {
        $this->banners->update($banner, $request->all());
        return redirect()->route(env('APP_BACKEND_PREFIX').'.banners.index')->withFlashSuccess('广告位更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $this->banners->destroy($banner);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.banners.index')->withFlashSuccess('广告位删除成功');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Banner $banner)
    {
        $this->banners->restore($banner);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.banners.index')->withFlashSuccess('广告位恢复成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Banner $banner)
    {
        $this->banners->delete($banner);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.banners.index')->withFlashSuccess('广告位删除成功');
    }
}
