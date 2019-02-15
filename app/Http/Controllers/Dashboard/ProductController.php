<?php

namespace App\Http\Controllers\Dashboard;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $products = Product::when($request->search, function($q) use($request){
            return $q->where( 'name', 'like', '%' . $request->search . '%' );
        })->latest()->paginate(5);
        return view('dashboard.products.index', ['products' => $products]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.create', ['categories'  =>  $categories]);
    }


    public function store(Request $request)
    {
        $rules = [
            'category_id'   =>  'required',
        ];
        foreach(config('translatable.locales') as $locale)
        {
            $rules += [$locale . '.name'           =>  'required|unique:product_translations,name'];
            $rules += [$locale . '.description'    =>  'required'];
        }
        $rules += [
            'purchase_price' =>  'required|numeric',
            'sell_price'     =>  'required|numeric',
            'stock'          =>  'required|numeric',
        ];
        $request->validate($rules);
        $request_data = $request->all();

        if($request->image){
            \Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/product_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        }


        Product::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.products.index');

    }


    public function edit(Product $product)
    {

    }

    public function update(Request $request, Product $product)
    {

    }


    public function destroy(Product $product)
    {

    }
}
