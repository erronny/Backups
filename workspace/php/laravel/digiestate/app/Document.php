<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;

    protected $table = "tbl_document";
    protected $fillable = [
        'name','category_id','short_des','long_des','createdby','IsActive','bookMark'];

    public function image(){
        return $this->hasMany('App\DocumentDetail','document_id');
    }

    public function defaultImage(){
        return $this->belongsTo('App\DocumentDetail','id','document_id');
    }

     public function category(){
        return $this->belongsTo('App\Category','category_id');
    }

    public function user_name(){
        return $this->belongsTo('App\User','createdby');
    }
    
}
