<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'status', 
        'id_list',
        'firstName',
        'lastName',
        'address',
        'address2',
        'email',
        'zipcode',
        'product_name'
    ];
}
