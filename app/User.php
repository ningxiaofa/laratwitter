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

    /* 用户主页链接 */
    protected $appends = ['profileLink'];

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

    public function getProfileLinkAttribute()
    {
        return route('user.show', $this); //$this是User的实例 ? TBD
    }

    /**
     * 用户与关注者的关联关系（多对多）
     * 方式一如下:
     * 方式二: 通过中间表user_follow_pivot code 暂省
     */
    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    /**
     * 约束条件如下
     */
    // 不能关注自己
    public function isNotMyself($user)
    {
        return $this->id !== $user->id; //不知道还能这么用 TBD
    }

    // 是否已经关注某用户
    public function isFollowing($user)
    {
        //这里的following不能添加(), id默认为follower_id,否则造成链表查询的id模棱两可 或者使用$this->following()->where('follower_id', $user->id) 详细暂未 看明白 TBD
        return (bool) $this->following->where('id', $user->id)->count();
    }

    // 是否能够关注某用户
    public function canFollow($user)
    {
        if(!$this->isNot($user)) {
            return false;
        }
        return !$this->isFollowing($user);
    }
}
