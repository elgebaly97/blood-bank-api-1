<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloodType extends Model 
{

    protected $table = 'blood_types';
    public $timestamps = true;
    protected $fillable = array('type');

    public function clients()
    {
        return $this->hasMany('App\Client');
    }

    public function client()
    {
        return $this->belongsToMany('App\Client');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

}