<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

    public function edit($categoryId)
    {
        return [];
    }

    public function delete($categoryId)
    {
        $category = Category::find($categoryId);
        $category->delete();
        
        return back();
    }
        
}
