<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

    public function index()
    {
        
        return view('admin.category.list-categories', [
            'categories' => Category::all()->sortBy('category'),
        ]);
    }

   public function store()
   {
        $categories = File::json('C:\OpenServer\domains\cable.loc\public\assets\json\categories.json');
        
        foreach($categories as $item)
        {
            foreach($item as $key=>$value)
            {
                Category::create([
                    $key => $value,
                ]);
            }           
           
        };

        return redirect()->intended('/');
    }

    public function create()
    {
       return view('admin.category.create-category');
    }

    public function storeForm(Request $request)
    {
        $request->validate([
            'category' => 'required|min:5|unique:categories',
            
        ]);

        $category = Category::create([
            'category' => $request->category,            
        ]);

        $category->uploadsImage($request->file('image'));

        return redirect()->route('categories.list');
    }

    public function edit($categoryId)
    {
        return view('admin.category.edit-categories',[
            'category' => Category::find($categoryId),            
            'products'=> Product::where('category_id', '=', $categoryId),


        ]);
    }

    public function update(Request $request, $categoryId)
    {
        $request->validate([
            'category' => 'required|min:5',
            
        ]);

        $category = Category::find($categoryId);
        $category->update($request->all());
        $category->uploadsImage($request->file('image'));

        return redirect()->route('categories.list');
    }

    public function delete($categoryId)
    {
        $category = Category::find($categoryId);        
        $category->delete();
        
        return back();
    }

    public function removeImage($categoryId)
    {
        Category::find($categoryId)->deleteImage();
        return back();
    }
        
}
