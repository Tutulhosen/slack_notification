<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalatTime extends Model
{
    use HasFactory;
    protected $fillable = [
        'salat_name', 
        'ajan_time', 
        'namaz_time'
    ];
}
