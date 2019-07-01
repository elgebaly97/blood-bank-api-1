<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientGovernment extends Model 
{

    protected $table = 'client_government';
    public $timestamps = true;
    protected $fillable = array('client_id', 'government_id');

}