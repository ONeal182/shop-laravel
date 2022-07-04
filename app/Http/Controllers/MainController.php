<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;
use App\Http\Requests\ProductsFilterRequest;

class MainController extends Controller
{
    public function index(ProductsFilterRequest $request)
    {

        // \Debugbar::info($request);

        $productsQuery = Product::with('category')->orderByPrice();
        if($request->filled('price_from')){
            $productsQuery->where('price', '>=', $request->price_from);
        }
        if($request->filled('price_to')){
            $productsQuery->where('price', '<=', $request->price_to);
        }
        foreach(['hit','new','recomend'] as $field){
            // dd($field);
            if($request->has($field)){
                $productsQuery->$field();
    
            }
        }
        
        $products = $productsQuery->paginate(6)->withPath("?".$request->getQueryString());
        return view('index', ['prudcts' => $products]);
    }
    public function categories()
    {
        $categories = Category::get();
        return view('categories', ['categories' => $categories]);
    }
    public function product($category, $product = null)
    {
        $product = Product::withTrashed()->where('code', $product)->get()->firstOrFail();
        return view('product', ['product' => $product]);
    }
    public function category($code = null)
    {
        $categoryObj = Category::where('code', $code)->firstOrFail();
        return view('category', ['category' => $categoryObj]);
    }

}
