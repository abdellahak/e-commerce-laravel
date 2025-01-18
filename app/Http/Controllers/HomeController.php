<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }
    
    public function getProducts(){
        $products = Product::where('id','>',0)->get();
        return response()->json($products);
    }
}
