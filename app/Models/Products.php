<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'status',
        'catalog_visibility',
        'description',
        'regular_price',
        'sale_price',
        'stock_quantity',
        'in_stock',
        'images'
    ];
}
