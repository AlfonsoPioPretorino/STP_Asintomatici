<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medici extends Model
{
    use HasFactory;
    protected $table = 'medici';
    public $timestamps = false;
}
