<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    protected $table = 'orders';

    protected $fillable = [
        'id',
        'pointA',
        'pointB',
        'price',
    ];

    protected $visible = [
        'id',
        'pointA',
        'pointB',
        'price',
    ];
}
