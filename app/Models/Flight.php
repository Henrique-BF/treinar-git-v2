<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = ['departure_at', 'destination', 'from'];

    protected $dates = ['created_at', 'updated_at', 'departure_at'];
    
    // protected function serializeDate(DateTimeInterface $date)
    // {
    //     return $date->format('Y-m-d H:i:s');
    // }

    // protected $casts = [
    //     'departure_at' => 'datetime',
    // ];
    // protected $casts = [
    //     'departure_at' => 'datetime:Y-m-d H:i:s',
    // ];
}
