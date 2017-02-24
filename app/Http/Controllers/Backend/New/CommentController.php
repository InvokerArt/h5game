<?php

namespace App\Http\Controllers\Backend\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Comments\CommentStoreOrUpdateRequest;
use App\Models\Comments\Comment;
use App\Repositories\Backend\Comments\CommentRepository;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CommentController extends Controller
{
    protected $comments;

    public function __construct(CommentRepository $comments)
    {
        $this->comments = $comments;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.news.comments.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        return Datatables::of($this->comments->getForDataTable())
            ->filter(function ($query) use ($request) {
                Comment::commentFilter($query, $request);
            })
            ->addColumn('ids', function ($comment) {
                return $comment->checkbox_button;
            })
            ->editColumn('title', function ($comment) {
                return $comment->news_url;
            })
            ->editColumn('content', function ($comment) {
                return $comment->parent_content;
            })
            ->editColumn('is_blocked', function ($comment) {
                if ($comment->is_blocked === 'yes') {
                    return '<span class="label lable-sm bg-green">是</span>';
                } else {
                    return '<span class="label lable-sm bg-red">否</span>';
                }
            })
            ->addColumn('actions', function ($comment) {
                return $comment->action_buttons;
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
        return view('backend.news.comments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentStoreOrUpdateRequest $request)
    {
        $this->comments->create($request);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.news.comments.index')->withFlashSuccess('评论添加成功');
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
    public function edit(Comment $comment)
    {
        $user = $comment->user()->select('username')->first();
        $news = $comment->commentable()->select('title')->first();
        $comment->username = $user->username;
        $comment->title = $news->title;
        return view('backend.news.comments.edit', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function commentto(Comment $comment)
    {
        $news = $comment->commentable()->select('title')->first();
        $comment->title = $news->title;
        return view('backend.news.comments.commentto', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Comment $comment, CommentStoreOrUpdateRequest $request)
    {
        $this->comments->update($comment, $request);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.news.comments.index')->withFlashSuccess('评论更新成功');
    }

    /**
     * 回收站
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->comments->destroy($id);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.news.comments.index')->withFlashSuccess('评论删除成功');
    }

    /**
     * 还原
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $this->comments->restore($id);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.news.comments.index')->withFlashSuccess('评论还原成功');
    }

    /**
     * 彻底删除
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $this->comments->delete($id);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.news.comments.index')->withFlashSuccess('评论删除成功');
    }
}
