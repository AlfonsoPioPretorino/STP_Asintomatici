<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class calendarilab extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'calendarilab';
    protected $casts = [
        'giorniSett'=>'array',
        'tipologiaTamp'=>'array'
    ];
}
