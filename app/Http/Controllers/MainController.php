<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        return view('index');
    }
    public function categories(){
        $categories = Category::get();
        return view('categories',['categories'=>$categories]);
    }
    public function product($category, $product = null) {
        return view('product', ['product' => $product]);
    }
    public function category($code = null){
        $categoryObj = Category::where('code', $code)->first();
        return view('category',['category'=>$categoryObj]);
        
    }
    public function basket() {
        return view('basket');
    }
    
    public function basketPlace() {
        return view('order');
    }
    
}
