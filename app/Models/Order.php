<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $dates = [
      'refilled_at'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id','id');
    }

    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
