<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentOptions extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'agop_id',
        'rent_id'
    ];
}
