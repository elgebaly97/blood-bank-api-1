<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('name', 'age', 'blood_type_id', 'num_quantity', 'hospital', 'address', 'mobile', 'details', 'latitude', 'longitude', 'client_id', 'city_id');

    public function notification()
    {
        return $this->hasOne('App\Notification');
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function blood_type()
    {
        return $this->belongsTo('App\BloodType');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

}