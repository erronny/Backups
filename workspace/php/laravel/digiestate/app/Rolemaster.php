<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rolemaster extends Model
{
	use SoftDeletes;
     protected $fillable = [
        'RoleName','CreatedBy','UpdatedBy',
    ];


    public function childRole(){
    	return $this->belongsTo('App\Rolemaster', 'parent_id', 'id')->select('Rolemaster.RoleName');
    }
}
