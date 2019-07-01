<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model 
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('logo', 'title', 'mobile', 'email', 'facebook', 'twitter', 'gmail', 'instagram', 'youtube', 'whatsapp', 'about', 'app_url', 'android_url');

}