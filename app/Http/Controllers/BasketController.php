<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function basket()
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            $order = Order::findOrFail($orderId);
            dd($order);
        } else {
            $order =  Order::find($orderId);
        }

        return view('basket', ['order' => $order]);
    }

    public function basketPlace()
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route(('index'));
        } else {
            $order =  Order::find($orderId);
        }
        return view('order', ['order' => $order]);
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
        if ($order->products->contains($productId)) {
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
        } else {
            $order->products()->attach($productId);
        }


        return redirect()->route('basket');
    }

    public function basketRemove($productId)
    {
        $orderId = session('orderId');

        if (is_null($orderId)) {
            return redirect()->route('basket');
        }
        $order =  Order::find($orderId);
        if ($order->products->contains($productId)) {
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            if ($pivotRow->count < 2) {
                $order->products()->detach($productId);
            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }

        return redirect()->route('basket');
    }
    public function basketConfirm(Request $request)
    {

        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->order('index');
        }
        $order = Order::find($orderId);
        $reusult =  $order->saveOrder($request->name, $request->phone);


        return redirect()->route('index');
    }
}
