<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Government extends Model 
{

    protected $table = 'governments';
    public $timestamps = true;
    protected $fillable = array('name');

    public function cities()
    {
        return $this->hasMany('App\City');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Client');
    }

}