<?php

namespace App\Http\Controllers\Backend\Banners;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Banners\ImageStoreRequest;
use App\Http\Requests\Backend\Banners\ImageUpdateRequest;
use App\Models\Banner;
use App\Models\Image;
use App\Repositories\Backend\Banners\ImageRepository;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ImageController extends Controller
{
    protected $images;

    public function __construct(ImageRepository $images)
    {
        $this->images = $images;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::select('id', 'title')->get();
        return view('backend.banners.images.index', compact('banners'));
    }

    /**
     * 轮播图
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        return Datatables::of($this->images->getForDataTable())
            ->filter(function ($query) use ($request) {
                Image::imageFilter($query, $request);
            })
            ->addColumn('ids', function ($images) {
                return $images->checkbox_button;
            })
            ->addColumn('image_url', function ($images) {
                return $images->image_src;
            })
            ->addColumn('actions', function ($images) {
                return $images->action_buttons;
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
        $banners = Banner::orderBy('id')->pluck('title', 'id');
        $order = $this->images->getCount()+1;
        return view('backend.banners.images.create', compact('banners', 'order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImageStoreRequest $request)
    {
        $this->images->create($request);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.banners.image.index')->withFlashSuccess('广告添加成功');
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
    public function edit(Image $image)
    {
        $banners = Banner::orderBy('id')->pluck('title', 'id');
        return view('backend.banners.images.edit', compact('image', 'banners'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ImageUpdateRequest $request, Image $image)
    {
        $this->images->update($image, $request->all());
        return redirect()->route(env('APP_BACKEND_PREFIX').'.banners.image.index')->withFlashSuccess('广告更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        $this->images->destroy($image);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.banners.image.index')->withFlashSuccess('广告删除成功');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Image $image)
    {
        $this->images->restore($image);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.banners.image.index')->withFlashSuccess('广告恢复成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Image $image)
    {
        $this->images->delete($image);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.banners.image.index')->withFlashSuccess('广告删除成功');
    }
}
