<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'title',
        'price',
        'quantity',
        'image',
        'category_id',      
        'is_published',

    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function uploadImage($file, $category_id)
    {
        if($file == null) return false;

        $fileName = $file->getClientOriginalName();       
        $path = 'category_'. $category_id.'/product_'. $this->id . '/';
        $file->storeAs($path, $fileName, 'uploads');

        $this->image = $path . $fileName;
        $this->save();

    }

    public function getImage()
    {
        $image = $this->image;

        return $image ? asset('uploads/'. $image) : asset('assets/img/noimage.png');
    }

    public function deleteImage($category_id)
    {
        if($this->image)
        {
            $image = $this->image;
            Storage::disk('uploads')->delete($image);
            File::deleteDirectory(public_path('category_'. $category_id.'/product_'. $this->id));

            $this->image = null;
            $this->save();

        }
    }



    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}
