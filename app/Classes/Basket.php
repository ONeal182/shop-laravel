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

    protected function getPivot($product)
    {
        return  $this->order->products()->where('product_id', $product)->first()->pivot;
    }

    public function getOrder()
    {
        return $this->order;
    }
    public function countAvilable(){
        foreach($this->order->products as $orderProduct){
            if($this->getPivot($orderProduct)->count > $orderProduct->count){
                return false;
            }
            
        }
        return true;
    }
    public function saveOrder($name, $phone)
    {
        if(!$this->countAvilable()){
            session()->flash('warning', 'Упас, что то пошло не так!');

            return false;
        }
        return $this->order->saveOrder($name, $phone);
    }

    public function removeProduct(Product $product)
    {

        if (is_null($product->id)) {
            return redirect()->route('basket');
        }
        $order =  Order::find($this->order->products);
        if ($this->order->products->contains($product->id)) {
            $pivotRow = $this->getPivot($product->id);
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
        
        if($this->order->products->contains($product->id)) {
            $pivotRow = $this->getPivot($product->id);
            $pivotRow->count++;
            if ($pivotRow->count > $product->count) {
                return false;
            }
            $pivotRow->update();
        } else {
            if ($product->count == 0) {
                return false;
            }
            $this->order->products()->attach($product->id);
        }
        // Order::changeFullSum($product->price);

        return true;
    }
}
