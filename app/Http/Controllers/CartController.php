<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    public function index() {
        return view('pages.checkout');
    }

    public function store(Request $request) {
        $cart = new Cart;
        $cart->product_id = $request->product_id;
        $cart->product_name = $request->product_name;
        $cart->quantity = 1;
        $cart->total = 0;
        $cart->save();

        $cartItems = Cart::all();

        return response()->json([
            'message' => 'Item added to cart!',
            'item' => $cartItems
        ]);
    }

    public function getCartItemCheckout() {
        $cartItems = Cart::all();

        if (isset($cartItems)) {
            $idList = '';
            $nameList = '';
            foreach ($cartItems as $cartItem) {
                $id = (string)$cartItem->product_id;
                $name = $cartItem->product_name;
                $idList = $idList.$id.'#';
                $nameList = $nameList.$name.'#';
            }
        }

        return response()->json([
            'message' => 'Item added to cart!',
            'item' => $cartItems,
            'ids' => $idList,
            'productNames' => $nameList,
        ]);
    }
}
