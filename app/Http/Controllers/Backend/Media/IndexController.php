<?php

namespace App\Http\Controllers\Backend\Media;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('backend.media.index');
    }
}
