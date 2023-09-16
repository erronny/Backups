<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Courier extends Model
{
    use SoftDeletes;

    protected $table = "tbl_couriers";
    protected $fillable = [
        'name','logo','createdby','IsActive'
    ];

    // public function image(){
    //     return $this->hasMany('App\ProductDetail','product_id');
    // }

    public function orderPlaced(){
        return $this->belongsTo('App\User','createdby');
    }
    
}
