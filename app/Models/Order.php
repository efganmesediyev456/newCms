<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_date',
        'customer_name',
        'phone',
        'source_id',
        'call_status_id',
        'order_status_id',
        'call_date',
        'request',
        'price_offer',
        'note',
        'status',
    ];

    public function source()
    {
        return $this->belongsTo(Source::class);
    }
    public function callStatus()
    {
        return $this->belongsTo(CallStatus::class);
    }
    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }
}
