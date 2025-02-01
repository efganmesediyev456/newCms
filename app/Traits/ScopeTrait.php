<?php

namespace App\Traits;
trait ScopeTrait{


    public function scopeStatus($query){
        return $query->where('status', 1);
    }
}
