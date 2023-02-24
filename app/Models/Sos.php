<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sos extends Model
{
    use HasFactory;
    protected $fillable = [
        'sender', 'location', 'longitude', 'latitude', 'status'
    ];
}
