<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_detail extends Model
{
    protected $table = 'product_detail';
    protected $fillable = ['product_id','color_id','capacity_id'];
}
