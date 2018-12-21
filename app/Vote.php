<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'votes';

    protected $fillable = [
        'fruit_id', 
    ];

    public function user(){
        return $this->hasOne('App\User');
    }

    public function fruit(){
        return $this->belongsTo('App\Fruit');
    }
}
