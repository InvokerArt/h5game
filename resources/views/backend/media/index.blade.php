@extends('backend.layouts.app')
<style type="text/css">
    .filemanager {width: 100%;  border: 0;  min-height: 600px;}
</style>
@section('content')
<div class="portlet">
    <div class="note note-danger no-margin margin-bottom-10">上传图片不能包含中文或非法字符！双击文件夹进入文件夹</div>
    <iframe src="{!! URL::to('/filemanager/dialog.php') !!}" class="filemanager"></iframe>
</div>
@stop

@section('js')
@stop