<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function store()
    {
        $products = File::json('C:\OpenServer\domains\cable.loc\public\assets\json\avvg_ng_ng_ls_avbshv_kabel_silovoy_plastmassovoy_izolyatsiey_alyuminieviy.json');

        foreach ($products as $item) {
            
            Product::create([
              'title' => $item['title'],
              'price' => preg_replace("/[^0-9]/", '', $item['price']),
              'quantity' => preg_replace("/[^0-9]/", '', $item['quantity']),
              'image' => $item['image'],
              'category_id' => $item['category_id'],
            ]);
        };

        return redirect()->intended('/');
    }

    public function edit($productId)
    {
        return view('admin.product.edit-product', [
            'product' => Product::find($productId),
            'categories' => Category::all()->sortBy('category'),
        ]);
    }

    public function update(Request $request, $productId)
    {
        $request->validate([
            'title' => 'required|min:5',
            'price' => 'required',
            'quantity' => 'required',

        ]);

        $product = Product::find($productId);
        $product->update($request->all());
        if($request->file('image'))
        {
            $product->uploadImage($request->file('image'), $product->category_id);
        }         
        return redirect()->route('edit.category', $product->category_id);
    }

    public function removeImage($productId)
    {
        $product = Product::find($productId);
        $product->deleteImage($product->category_id);
        return back();
    }

    public function delete($productId)
    {
        $product = Product::find($productId);
        $product->deleteImage($product->category_id);
        $product->delete();
        return back();

    }

    public function index()
    {
        return view('admin.product.list-product', [
            'products' => Product::paginate(100),
        ]);
    }

   
}
