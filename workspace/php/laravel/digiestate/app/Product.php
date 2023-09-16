<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = "tbl_product";
    protected $fillable = [
        'sale_count','name','short_des','long_des','author','selling_price','purchase_price','publisher','createdby','IsActive','sale_count'];

    public function image(){
        return $this->hasMany('App\ProductDetail','product_id');
    }

    public function defaultImage(){
        return $this->belongsTo('App\ProductDetail','id','product_id');
    }

    
}
