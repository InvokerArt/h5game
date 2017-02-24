<?php

namespace App\Http\Controllers\Backend\Faqs;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Faq;
use App\Repositories\Backend\Faqs\FaqRepository;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class FaqController extends Controller
{
    protected $faqs;

    public function __construct(FaqRepository $faqs)
    {
        $this->faqs = $faqs;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.faqs.index');
    }

    public function get()
    {
        return Datatables::of($this->faqs->getForDataTable())
            ->addColumn('ids', function ($faqs) {
                return $faqs->checkbox_button;
            })
            ->addColumn('actions', function ($faqs) {
                return $faqs->action_buttons;
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
        return view('backend.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->faqs->create($request);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.faqs.index')->withFlashSuccess('常见问题添加成功');
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
    public function edit(Faq $faq)
    {
        return view('backend.faqs.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Faq $faq, Request $request)
    {
        $this->faqs->update($faq, $request->all());
        return redirect()->route(env('APP_BACKEND_PREFIX').'.faqs.index')->withFlashSuccess('常见问题更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $this->faqs->destroy($faq);
        return redirect()->route(env('APP_BACKEND_PREFIX').'.faqs.index')->withFlashSuccess('常见问题删除成功');
    }
}
