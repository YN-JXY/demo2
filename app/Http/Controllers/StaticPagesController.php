<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//静态页面控制器
class StaticPagesController extends Controller
{
    //渲染首页视图
    public function home()
    {
        return view('static_pages/home');
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
