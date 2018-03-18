<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCertificate extends Model
{
    protected $table = 'product_certificate';
    public $timestamps = false;    
    protected $fillable = [
    	'productId',
    	'certificate'
    ];

    public function product(){
        return $this->belongsTo('App\Product','productId');
    }
}
