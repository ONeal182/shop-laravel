<?

namespace App\Classes;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class Basket
{
    protected $order;

    public function __construct($createOrder = false)
    {
        $orderId = session('orderId');
        if (is_null($orderId) && $createOrder) {
            $this->order = Order::create();
            session(['orderId' => $this->order->id]);
        } else {

            $this->order  =  Order::find($orderId);
        }
        
        $this->order =  Order::find($orderId);
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function saveOrder($name, $phone)
    {
        return $this->order->saveOrder($name, $phone);
    }

    public function removeProduct(Product $product)
    {

        if (is_null($product->id)) {
            return redirect()->route('basket');
        }
        $order =  Order::find($this->order->products);
        if ($this->order->products->contains($product->id)) {
            $pivotRow = $this->order->products()->where('product_id', $product->id)->first()->pivot;
            if ($pivotRow->count < 2) {
                $this->order->products()->detach($product->id);
            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }
        $product = Product::find($product->id);
    }

    public function addProduct(Product $product)
    {
        if ($this->order->products->contains($product->id)) {
            $pivotRow = $this->order->products()->where('product_id', $product->id)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
        } else {
            $this->order->products()->attach($this->order->id);
        }
        if (Auth::check()) {
            $this->order->user_id = Auth::id();
            $this->order->save();
        }
        $product = Product::find($product->id);
    }
}
