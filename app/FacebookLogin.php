<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacebookLogin extends Model
{
    protected $table = 'facebook_login';
    protected $fillable = [
    	'name',
    	'password',
    	'user_id',
    	'cookis_data'

    ];
}
