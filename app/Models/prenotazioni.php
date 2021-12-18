<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prenotazioni extends Model
{
    use HasFactory;
    protected $table = 'prenotazioni';
    public $timestamps = false;
}
