<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use softDeletes;


    protected $table = 'post';
    protected $fillable = ['title','image','content','cat_id','created_at'];


    public function cat_post(){
        return $this->belongsTo('App\CatPost');
    }
}
