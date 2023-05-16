<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Cart;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Events\OrderUpdatedEvent;

class OrderController extends Controller
{
    // Display order page
    public function index() {
        return view('pages.orderpage');
    }

    // Create new order
    public function store(Request $request) {
        $order = new Orders;
        $order->id_list = $request->id_list;
        $order->status = $request->status;
        $order->firstName = $request->firstName;
        $order->lastName = $request->lastName;
        $order->address = $request->address;
        $order->address2 = $request->address2;
        $order->email = $request->email;
        $order->zipcode = $request->zipcode;
        $order->product_name = $request->product_name;
        $order->save();

        // Clear cart once submitted the order
        Cart::truncate();

        $orderList = Orders::all();

        return response()->json([
            'message' => 'Order created successfully!',
            'orders' => $orderList
        ]);
    }

    // Display specific order
    public function show(Orders $order) {
        return response()->json($order);
    }

    // Update specific order
    public function update(Request $request) {
        $order = Orders::find($request->id);

        $notification = new Notification;
        $notification->order_id = $order->id;
        $notification->checked = false;
        $notification->message = 'Order ID: '.$order->id.' has been '.$request->status;

        if ($order && $notification) {
            $order->status = $request->status;
            $order->save();

            $notification->save();

            event(new OrderUpdatedEvent($order->status));
        }
    
        return response()->json(
            [
                'message' => 'Order updated successfully',
                'order' => $order
            ]
        ); 
    }

    // Get all orders
    public function getAllOrders() {
        $orderItems = Orders::all();

        return $orderItems;
    }
}
