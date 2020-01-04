<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $newPost = $request->user()->posts()->create([
            'body' => $request->get('body')
        ]);
        //我们使用了关联关系来保存 Post 数据，它会自动将当前登录用户的 id 作为保存 Post 的 user_id 字段。? TBD

        return response()->json($post->with('user')->find($newPost->id));
    }
}
