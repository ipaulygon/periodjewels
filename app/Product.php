<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    public $timestamps = false;
    protected $fillable = [
    	'jewelryId',
    	'carat',
        'color',
        'clarity',
        'cut',
        'origin',
        'description',
        'certificate',
        'price',
        'isActive'
    ];

    public function jewelry(){
        return $this->belongsTo('App\Jewelry','jewelryId');
    }

    public function price(){
        return $this->hasMany('App\ProductPrice','productId')->orderBy('created_at','desc');
    }

    public function image(){
        return $this->hasMany('App\ProductImage','productId');
    }
}
