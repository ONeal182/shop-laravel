<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $products = Product::get();
        return view('index', ['prudcts' => $products]);
    }
    public function categories()
    {
        $categories = Category::get();
        return view('categories', ['categories' => $categories]);
    }
    public function product($category, $product = null)
    {
        $product = Product::where('code', $product)->get()->first();
        return view('product', ['product' => $product]);
    }
    public function category($code = null)
    {
        $categoryObj = Category::where('code', $code)->first();
        return view('category', ['category' => $categoryObj]);
    }

}
