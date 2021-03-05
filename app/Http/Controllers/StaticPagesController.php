<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//静态页面控制器
class StaticPagesController extends Controller
{
    //渲染首页视图
    public function home()
    {
        $feed_items = [];
        if(Auth::check()){
            $feed_items = Auth::user()->feed()->paginate(30);
        }
        return view('static_pages/home',compact('feed_items'));
    }

    //渲染帮助页视图
    public function help()
    {
        return view('static_pages/help');
    }

    //渲染关于我们页面
    public function about()
    {
        return view('static_pages/about');
    }
}
