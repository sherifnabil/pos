<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use \Dimsav\Translatable\Translatable;

    protected $guarded = [];

    public $translatedAttributes = ['name', 'description'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        return asset('uploads/product_images/' . $this->image);
    }

}
