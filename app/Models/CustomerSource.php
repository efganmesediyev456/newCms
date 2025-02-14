<?php

namespace App\Models;

use App\Traits\ScopeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerSource extends Model
{
    use HasFactory;
    use SoftDeletes;
    use ScopeTrait;

    protected $fillable = [
        "title",
        "status"
    ];
}
