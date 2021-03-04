<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Unique;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'except' => ['create','store']
        ]);
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    //渲染用户注册界面
    public function create()
    {
        return view('users.create');
    }

    //显示所用用户列表
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index',compact('users'));
    }

    //显示用户个人信息页面
    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }

    //创建用户
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:users|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);

        session()->flash('success','欢迎，您将在这里开启一段新的旅程~');

        return redirect()->route('users.show',[$user]);
    }

    //渲染更新用户个人资料的页面
    public function edit(User $user)
    {
        $this->authorize('AccessControl',$user);
        return view('users.edit',compact('user'));
    }

    //更新用户
    public function update(User $user,Request $request)
    {
        $this->authorize('AccessControl',$user);
        $this->validate($request,[
            'name' => 'required|max:50',
            'password' => 'nullable|confirmed|min:6'
        ]);

        $data = [];
        $data['name'] = $request->name;
        if($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update([$data]);

        session()->flash('success','个人资料更新成功！');
        return redirect()->route('users.show',$user->id);
    }

    //删除用户
    public function destroy()
    {

    }
}
