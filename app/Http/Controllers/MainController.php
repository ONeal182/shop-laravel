<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Category;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Requests\ProductsFilterRequest;

class MainController extends Controller
{
    public function index(ProductsFilterRequest $request)
    {

        // \Debugbar::info($request);

        $productsQuery = Product::with('category')->orderByPrice();
        if ($request->filled('price_from')) {
            $productsQuery->where('price', '>=', $request->price_from);
        }
        if ($request->filled('price_to')) {
            $productsQuery->where('price', '<=', $request->price_to);
        }
        foreach (['hit', 'new', 'recomend'] as $field) {
            // dd($field);
            if ($request->has($field)) {
                $productsQuery->$field();
            }
        }

        $products = $productsQuery->paginate(6)->withPath("?" . $request->getQueryString());
        return view('index', ['prudcts' => $products]);
    }
    public function categories()
    {
        $categories = Category::get();
        return view('categories', ['categories' => $categories]);
    }
    public function product($category, $product = null)
    {
        $product = Product::withTrashed()->where('code', $product)->get()->first();
        return view('product', ['product' => $product]);
    }
    public function category($code = null)
    {
        $categoryObj = Category::where('code', $code)->firstOrFail();
        return view('category', ['category' => $categoryObj]);
    }

    public function subscribe(Request $request, Product $product)
    {
        Subscription::create(
            [
                'email' => $request->email,
                'product_id' => $product->id
            ]
        );
        return redirect()->back()->with('success', 'Спасибо мы с вами свяжемся');
    }

    public function changeLocale($locale)
    {
        session(['locale'=> $locale]);
        App::setLocale($locale);
        $currentLocale = App::getLocale();
        return redirect()->back();
    }
}
