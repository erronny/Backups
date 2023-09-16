<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductDetail extends Model
{
    use SoftDeletes;

    protected $table = "tbl_product_images";
    protected $fillable = [
        'product_id','url','IsDefault','createdby','IsActive'
    ];
    
}
