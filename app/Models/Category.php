<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        "category",
        'image',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function uploadsImage($file)
    {
        if($file == null) return false;

        $fileName = $file->getClientOriginalName();       
        $path = 'categories/category_'. $this->id . '/';
        $file->storeAs($path, $fileName, 'uploads');

        $this->image = $path . $fileName;
        $this->save();

    }

    public function getImage()
    {
        $image = $this->image;

        return $image ? asset('uploads/'. $image) : asset('assets/img/noimage.png');
    }

    public function deleteImage()
    {
        if($this->image)
        {
            $image = $this->image;
            Storage::disk('uploads')->delete($image);
            File::deleteDirectory(public_path('categories/category_'. $this->id));

            $this->image = null;
            $this->save();

        }
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('category')
            ->saveSlugsTo('slug');
    }

    
}
