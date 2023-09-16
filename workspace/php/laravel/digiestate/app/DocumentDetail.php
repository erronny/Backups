<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentDetail extends Model
{
    use SoftDeletes;

    protected $table = "tbl_document_images";
    protected $fillable = [
        'id','document_id','url','IsDefault','createdby','file_size','IsActive'];

   
    
}
