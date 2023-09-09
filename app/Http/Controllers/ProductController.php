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
        $products = File::json('C:\OpenServer\domains\cable.loc\public\assets\json\provod_ustanovochniy.json');

        foreach ($products as $item) {
            
            Product::create([
              'title' => $item['title'],
              'price' => $item['price'],
              'quantity' => $item['quantity'],
              'image' => $item['image'],
              'category_id' => $item['category_id'],
            ]);
        };

        return redirect()->intended('/');
    }

   
}
