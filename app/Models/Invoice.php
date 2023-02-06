<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;
    protected $guarded  = [];

    public function status(){
        return $this->status == 1 ?"paid":'unpaid';
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id')->withTrashed();


    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class)->withTrashed();
    }
  
}
