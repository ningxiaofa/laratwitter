<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function show(User $user)
    {
        return view('user', compact('user'));
    }

    public function follow(Request $request, User $user)
    {
        if ($request->user()->canFollow($user)) {
            $request->user()->following()->attach($user); //多对多关联 attach[添加关联] detach[删除关联] sync[添加/删除关联]
        }
        return redirect()->back();
    }
}
