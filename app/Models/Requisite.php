<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requisite extends Model
{
    protected $fillable = [
        'voen', 'legal_address', 'actual_address', 'bank', 'bank_voen',
        'code', 'settlement_account', 'correspondent_account', 'swift', 'director'
    ];

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }
}

