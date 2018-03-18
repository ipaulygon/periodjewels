<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gem extends Model
{
    protected $table = 'gem';
    public $timestamps = false;
    protected $fillable = [
    	'name',
    	'description',
        'isActive'
    ];

    public function product(){
        return $this->hasMany('App\Product','gemId');
    }
}
