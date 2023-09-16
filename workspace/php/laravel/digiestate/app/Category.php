<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = "tbl_category";
    protected $fillable = ['name','logo','createdby','IsActive'];

    // public function image(){
    //     return $this->hasMany('App\DocumentDetail','document_id');
    // }

    // public function defaultImage(){
    //     return $this->belongsTo('App\DocumentDetail','id','document_id');
    // }

    
}
