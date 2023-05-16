<?php

namespace App\Http\Helpers;

class Cart 
{
    public static function getCartItemsCount(): int {
        $request = \request();
        $cartItems = self::getCookieCartItems();
        return array_reduce(
            $cartItems,
            fn($carry, $item) => $carry + $item['quantity'],
            0
        );
    }

    public static function getCartItems() {
        $request = \request();
        return self::getCookieCartItems();
    }

    public static function getCookieCartItems() {
        $request = \request();
        return json_decode($request->cookie('cart_items', '[]'), true);
    }

    public static function getCountFromItems($cartItems) {
        return array_reduce(
            $cartItems,
            fn($carry, $item) => $carry + $item['quantity'],
            0
        );
    }

    public static function moveCartItemsIntoDb() {
        $request = \request();
        $cartItems = self::getCookieCartItems();
        
    }
}