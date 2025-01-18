<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request){
        $cart = $request->session()->get('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();
        $total = $this->calculateTotal();
        if($request->ajax()){
            return response()->json(['products' => $products, 'cart' => $cart, 'total' => $total]);
        }
        return view('cart', compact('products', 'cart', 'total'));
    }

    public function count(Request $request){
        $cart = $request->session()->get('cart', []);
        $quantity = array_sum($cart);
        return response()->json(['quantity' => $quantity]);
    }

    public function calculateTotal(){
        $cart = session()->get('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();
        $total = 0;
        foreach($products as $product){
            $total += $product->price * $cart[$product->id];
        }
        return number_format($total, 2);
    }

    public function add(Request $request, $id){
        $product = Product::find($id);  
        if (!$product) { return response()->json(['message' => 'Product not found'], 404); }
        $request->session()->get('cart', []);
        $cart = $request->session()->get('cart', []);

        if(isset($cart[$id])){
            $cart[$id]++;
        }else{
            $cart[$id] = 1;
        }
        $request->session()->put('cart', $cart);
        return response()->json(['cart' => $cart]);
    }


    function increment(Request $request, $id){
        $cart = $request->session()->get('cart', []);
        $product = Product::find($id);
        if(isset($cart[$id])){
            if($cart[$id]< $product->stock){
                $cart[$id]++;
            }
        }
        $total = $this->calculateTotal();
        $request->session()->put('cart', $cart);
        return response()->json(['cart' => $cart, 'total' => $total]);
    }

    function decrement(Request $request, $id){
        $cart = $request->session()->get('cart', []);
        if(isset($cart[$id])){
            if($cart[$id]>1){
                $cart[$id]--;
            }else{
                unset($cart[$id]);
            }
        }
        $total = $this->calculateTotal();
        $request->session()->put('cart', $cart);
        return response()->json(['cart' => $cart, 'total' => $total]);
    }

    public function removeProduct(Request $request, $id){
        $cart = $request->session()->get('cart', []);
        if(isset($cart[$id])){
            unset($cart[$id]);
        }
        $total = $this->calculateTotal();
        $request->session()->put('cart', $cart);
        return response()->json(['cart' => $cart, 'total' => $total]);
    }
}
