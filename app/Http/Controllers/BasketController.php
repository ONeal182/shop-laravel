<?php

namespace App\Http\Controllers;

use App\Classes\Basket;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function basket(Basket $basket)
    {
        $order = $basket->getOrder();

        return view('basket', ['order' => $order]);
    }

    public function basketPlace(Basket $basket)
    {
        $order = $basket->getOrder();
        if($basket->countAvilable){
            
        }
        return view('order', ['order' => $order]);
    }

    public function basketAdd(Product $product)
    {

        $result = new Basket(true);
        $orderId = $result->getOrder();
        if($result){
            session()->flash('success', 'Добавлен товар ' . $product->name);
        }else{
            session()->flash('error', 'Товар не доступен ' . $product->name);

        }
        $result->addProduct($product);
        
        return redirect()->route('basket');
    }

    public function basketRemove(Product $product, Basket $basket)
    {
        $orderId = $basket->getOrder($product->id);
        $basket->removeProduct($product);

        session()->flash('warning', 'Удалён товар ' . $product->name);
        return redirect()->route('basket');
    }
    public function basketConfirm(Request $request, Basket $basket)
    {

        $success = $basket->saveOrder($request->name, $request->phone);

        if ($success) {
            session()->flash('success', 'Ваш заказ принят в обработку');
        } else {
            session()->flash('warning', 'Упас, что то пошло не так!');
        }
        return redirect()->route('index');
    }
}
