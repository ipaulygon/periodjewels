<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jewelry extends Model
{
    protected $table = 'jewelry';
    public $timestamps = false;
    protected $fillable = [
    	'name',
    	'description',
        'isActive'
    ];

    public function product(){
        return $this->hasMany('App\Product','jewelryId');
    }
}
