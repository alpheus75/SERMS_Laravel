<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use HasFactory;
    protected $primaryKey = 'work_id';
    public $incrementing = false;
    protected $fillable = [
        'work_id','name', 'email', 'telephone', 'status', 'rating'
    ];
}
