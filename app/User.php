<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /* 路由模型绑定 默认是主键id字段, 这里修改为name
    即:http://laratwitter.test/users/学院君 访问个人主页
    具体查看文档https://xueyuanjun.com/post/8731.html#bkmrk-路由模型绑定
    */
    public function getRouteKeyName()
    {
        return 'name';
    }
}
