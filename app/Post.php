<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id', 'body'];
    protected $appends = ['createdDate']; //追加一个属性来获取时间

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 用法TBD
    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
