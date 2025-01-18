<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request, $id){
        $product = Product::find($id);  
        $request->session()->put('cart', []);
    }
}
