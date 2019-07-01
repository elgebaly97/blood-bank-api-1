<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'birthday', 'blood_type_id', 'last_donate', 'city_id', 'mobile', 'password', 'banned', 'pin');

    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }

    public function blood_type()
    {
        return $this->belongsTo('App\BloodType');
    }

    public function blood_types()
    {
        return $this->belongsToMany('App\BloodType');
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Notification');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function governments()
    {
        return $this->belongsToMany('App\Government');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function tokens()
    {
        return $this->hasMany('App\Token');
    }

    protected $hidden =[
        'password',
        'api_token'
    ];

}