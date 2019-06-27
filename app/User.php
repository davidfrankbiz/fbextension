<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'register_user';
    protected $fillable = [
        'name', 'email', 'password' ,'password_confirmation' , 'paypal_email' , 'phone','last_login','live','status','is_admin','refer_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

        /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    public function cookies()
    {
     
        return $this->hasOne('App\Cookies','user_id','id');
    }


     public function fblog()
    {
     
        return $this->hasMany('App\FacebookLogin','user_id','id');
    }


     public function payment()
    {
     
        return $this->hasMany('App\Payment','user_id','id')->orderBy('id','desc');
    }


    public function payments()
    {
        return $this->hasMany('App\Payment','user_id','id')->where('status', '=', '0');
    }


    public function paid()
    {
     
        return $this->hasOne('App\Payment','user_id','id')->where('status', '=', '1')->orderBy('id','desc');
    }
}
