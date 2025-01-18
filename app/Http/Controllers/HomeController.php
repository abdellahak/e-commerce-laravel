<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {   
        return view('home');
    }

    public function getProducts(){
        $products = Product::where('id','>',0)->orderBy('id', 'desc')->get();
        return response()->json([
            'products' => $products
        ]);
    }
}
