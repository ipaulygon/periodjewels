<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_image';
    public $timestamps = false;
    protected $fillable = [
    	'productId',
        'image',
        'isMain'
    ];

    public function product(){
        return $this->belongsTo('App\Product','productId');
    }
}
