<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'voen',
        'fin_code',
        'company_name',
        'domen_names',
        'director',
        'customer_phone',
        'responsible_persons',
        'customer_type',
        'customer_source_id',
        'requisite_id',
        'status',
    ];

    public function media() {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function requisite()
    {
        return $this->belongsTo(Requisite::class);
    }

    public function customerSource(){
        return $this->belongsTo(CustomerSource::class);
    }
}
