<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
