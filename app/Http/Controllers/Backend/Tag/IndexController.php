<?php

namespace App\Http\Controllers\Backend\Tags;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Tags\TagsRequest;
use App\Http\Requests\Backend\Tags\TagsStoreOrUpdateRequest;
use App\Models\Tag;
use App\Repositories\Backend\Tags\TagsRepository;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class IndexController extends Controller
{
    protected $tags;

    public function __construct(TagsRepository $tags)
    {
        $this->tags = $tags;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.tags.index');
    }

    /**
     * 新闻列表
     *
     * @return \Illuminate\Http\Response
     */
    public function get(TagsRequest $request)
    {
        return Datatables::of($this->tags->getForDataTable())
            ->filter(function ($query) use ($request) {
                Tag::tagFilter($query, $request);
            })
            ->addColumn('ids', function ($tags) {
                return $tags->checkbox_button;
            })
            ->addColumn('actions', function ($tags) {
                return $tags->action_buttons;
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
    public function store(TagsStoreOrUpdateRequest $request)
    {
        $this->tags->create($request->all());
        return redirect()->route(env('APP_BACKEND_PREFIX').'.tags.index')->withFlashSuccess('标签添加成功');
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
    public function edit(Tag $tag)
    {
        return view('backend.tags.edit')
        ->withTag($tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Tag $tag, Request $request)
    {
        $this->tags->update($tag, $request->all());
        return redirect()->route(env('APP_BACKEND_PREFIX').'.tags.index')->withFlashSuccess('标签更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $this->tags->destroy($tag);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.tags.index')->withFlashSuccess('标签删除成功');
    }

    public function popular()
    {
        $popularTags = $this->tags->getPopularTags();
        $popularTags = $popularTags->map(function ($tags) {
            return ['id' => $tags->id, 'name' => $tags->name, 'news_count' => $tags->news_count];
        });
        return $popularTags;
    }
}
