<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function basket()
    {
        $orderId = session('orderId');
        if(is_null($orderId)){
            $order = Order::findOrFail($orderId);
            dd($order);
        }else{
            $order =  Order::find($orderId);
        }
        
        return view('basket', ['order'=>$order]);
    }

    public function basketPlace()
    {
        return view('order');
    }

    public function basketAdd(Request $request, $productId)
    {
        $orderId = session('orderId');

        if (is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        } else {

            $order =  Order::find($orderId);
        }

        $order->products()->attach($productId);

        return view('basket', ['order'=>$order]);
    }
}
