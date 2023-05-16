<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductController extends Controller
{
    /*public function getData(){
        $products = Products::paginate(10);
        return view('home', compact('products'));
    }*/

    // Paginate Local Products 
    public function pagiData() {
        $products = Products::paginate(5);
        return view('product', compact('products'));
    }

    // Get all products
    public function index(){
        $products = Products::all();
        //return response()->json($products);
        //dd($products);

        return view('product', compact('products'));
    }

    // Display specific product
    public function show(Products $product) {
        return response()->json($product);
    }
}
