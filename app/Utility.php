<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utility extends Model
{
    protected $table = 'utility';
    public $timestamps = false;
    protected $fillable = [
    	'name',
        'address',
        'logo'
    ];
}
