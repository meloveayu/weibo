<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function create()
    {
        return view('users.create');
    }

    public function index()
    {

    }

    public function store(Request $request)
    {
        //这个地方主要是为了字段的验证规则，这个步骤是在储存前做的
        $this->validate($request,[
            'name' => 'required|unique:users|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        //这个地方就是把的收到的数据保存数据库
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
        //保存之后重定向到
        return redirect()->route('users.show', [$user]);
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function update()
    {

    }

    public function destroy()
    {

    }

    public function edit()
    {

    }
}
