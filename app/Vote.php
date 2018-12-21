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
        'fruid_id', 
    ];

    public function users(){
        return $this->belongsTo('App\User');
    }

    public function fruits(){
        return $this->belongsTo('App\Fruit');
    }
}
