<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\CustomerResetPasswordNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
class Customer extends Authenticatable implements MustVerifyEmail,JWTSubject
{    use Notifiable;

    use SoftDeletes;
    protected $guarded  = [];

    public function status(){
        return $this->status == 1 ?"active":'Disable';
    }

    public function reservation()
    {
        return $this->hasMany(Reservation::class,'customer_id','id');

//        return $this->belongsTo('App\Models\Reservation','customer_id','id');
    }

    // public function paymentwallet()
    // {
    //     return $this->hasOne(PaymentWallet::class);
    // }
//chat
  public function chat()
    {
        return $this->hasMany(Chat::class,'customer_id','id');
    }
//Notfiy
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomerResetPasswordNotification($token));
    }
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }
     protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
