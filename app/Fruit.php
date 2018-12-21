<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fruit extends Model
{

	protected $fillable = [
        'name'
    ];

    public function vote(){
        return $this->hasMany('App\Vote');
    }
}
