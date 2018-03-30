<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    public $timestamps = false;
    protected $fillable = [
    	'gemId',
    	'jewelryId',
    	'carat',
        'color',
        'clarity',
        'cut',
        'origin',
        'description',
        'price',
        'isSold',
        'isActive'
    ];

    public function gem(){
        return $this->belongsTo('App\Gem','gemId');
    }
    
    public function jewelry(){
        return $this->belongsTo('App\Jewelry','jewelryId');
    }

    public function price(){
        return $this->hasMany('App\ProductPrice','productId')->orderBy('created_at','desc');
    }

    public function image(){
        return $this->hasMany('App\ProductImage','productId');
    }

    public function imageMain(){
        return $this->hasMany('App\ProductImage','productId')->where('isMain',1);
    }

    public function certificate(){
        return $this->hasMany('App\ProductCertificate','productId');
    }
}
