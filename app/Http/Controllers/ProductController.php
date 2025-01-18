<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $products = Product::with('category')->orderBy('id','desc')->get();
        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "name"=> "required|unique:products",
            "price" => "required|numeric|min:0",
            "stock" => "required|integer|min:0",
            "description" => "nullable",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "category_id" => "required|exists:categories,id"
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename =  time() . '_' . $image->getClientOriginalName();
            $path = "storage/products/images/";
            $request->file('image')->move($path, $filename);
            $validatedData['image'] = $path.$filename;
        }
        Product::create($validatedData);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            "name"=> "required|unique:products,name,".$id,
            "price" => "required|numeric|min:0",
            "stock" => "required|integer|min:0",
            "description" => "nullable",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "category_id" => "required|exists:categories,id"
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename =  time() . '_' . $image->getClientOriginalName();
            $path = "storage/products/images/";
            $request->file('image')->move($path, $filename);
            $validatedData['image'] = $path.$filename;
        }
        $product = Product::find($id);
        $product->update($validatedData);
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if($product){
            $product->delete();
            return response()->json(['success' => true, 'message' => 'Item deleted successfully.']);
        }
        return response()->json(['success' => false, 'message' => 'Item not found.']);
    }

    public function filterByCategory(Request $request){
        $categories = Category::all();
        if($request->category_id == "-1"){
            $products = Product::all();
        }else{
            $products = Product::where('category_id', $request->category_id)->get();
        }
        return view('products.index', compact('products', 'categories'));
    }
}
