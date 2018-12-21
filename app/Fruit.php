<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fruit extends Model
{

	protected $fillable = [
        'name'
    ];

    public function votes(){
        return $this->hasMany('App\Vote');
    }
}
