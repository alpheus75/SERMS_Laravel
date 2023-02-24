<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $primaryKey = 'reg_no';
    public $incrementing = false;
    protected $fillable = [
        'reg_no','name', 'email', 'telephone', 'program'
    ];
}
