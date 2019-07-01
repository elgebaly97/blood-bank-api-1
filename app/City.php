<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model 
{

    protected $table = 'cities';
    public $timestamps = true;
    protected $fillable = array('government_id', 'name');

    public function government()
    {
        return $this->belongsTo('App\Government');
    }

    public function clients()
    {
        return $this->hasMany('App\Client');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

}