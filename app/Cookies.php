<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cookies extends Model
{
    protected $table = 'cookies';
    protected $fillable = ['ip','user_id','cookis_data','user_agent','email','password'];

    public function user()
    {
    	return $this->hasOne('App\User','id','user_id');
    }
}
