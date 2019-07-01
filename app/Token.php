<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    //
    protected $fillable = array('token', 'type');


    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}
