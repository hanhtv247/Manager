<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatPost extends Model
{
    //
    protected $table = 'cat_post';
    protected $fillable = ['name','status','create_at'];

    public function post(){
        return $this->hasMany('App\Post');
    }
}
