<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index(Request $request) {
        $search = $request->input('query');
        $query = Product::where('user_id', Auth::id());
        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        }
        $products = $query->get();
        return view('products.index', ['products' => $products]);
    }

    public function create() {
        return view('products.create-product');
    }

    public function save(Request $request) {
        $validated = $request->validate([
            'title' => 'required',
            'price' => 'required|decimal:0,3',
            'qty' => 'required|numeric',
            'desc' => 'nullable',
            'img_path' => 'image|mimes:jpeg,jpg,png|max:2048'
        ]);
        if ($request->hasFile('img_path')) {
            $imgName = time().$request->file('img_path')->getClientOriginalName();
            $request->file('img_path')->move(public_path('imgs'), $imgName);
            $validated['img_path'] = $imgName;
        }
        $user = Auth::user();
        $product = $user->products()->create($validated);
        return redirect()->route('product.index');
    }

    public function edit($id) {
        $product = Product::find($id);
        return view('products.edit-product', compact('product'));
    }
    
    public function update(Request $request, $id) {
        $product = Product::find($id);
        $data = $request->validate([
            'title' => 'required',
            'price' => 'required|decimal:0,3',
            'qty' => 'required|numeric',
            'desc' => 'nullable',
            'img_path' => 'image|mimes:jpeg,jpg,png|max:2048'
        ]);
        if ($request->hasFile('img_path')) {
            if ($product->img_path && File::exists(public_path('imgs/'.$product->img_path))) {
                File::delete(public_path('imgs/'.$product->img_path));
            }
            $imgName = time().$request->file('img_path')->getClientOriginalName();
            $request->file('img_path')->move(public_path('imgs'), $imgName);
            $data['img_path'] = $imgName;
        }
        $product->update($data);
        return redirect()->route('product.index')->with('success', 'product updated successfully');
    }

    public function delete($id) {
        $product = Product::find($id);
        File::delete(public_path('imgs/'.$product->img_path));
        $product->delete();
        return redirect()->route('product.index')->with('success', 'product deleted successfully');
    }
}
