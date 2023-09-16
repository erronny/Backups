<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Share extends Model
{
    use SoftDeletes;

    protected $table = "tbl_share";
    protected $fillable = ['user_id','document_id','IsActive','createdby'];

    // public function image(){
    //     return $this->hasMany('App\DocumentDetail','document_id');
    // }

public function image(){
        return $this->belongsTo('App\DocumentDetail','document_id');
    }
    public function user_name(){
        return $this->belongsTo('App\User','createdby');
    }
     public function received(){
        return $this->belongsTo('App\User','createdby');
    }

     public function send_by(){
        return $this->belongsTo('App\User','user_id');
    }

    
}
