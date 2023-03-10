<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends Model
{
    use SoftDeletes ;
    protected $guarded = [];

    public function status(){
        return $this->status == 1 ?"answered":'No response';
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
