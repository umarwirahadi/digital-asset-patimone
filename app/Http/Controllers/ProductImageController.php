<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    protected $product_id;
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index($product_id){
        // $this->product_id = $product_id;
        $data = ['title'=>'Assets','subtitle'=>'List Photo of Product','productimages'=>ProductImage::with('product')->where('product_id',$this->product_id)->get()];
        return view('assets.products.photo',compact('data'));
    }

    public function create(){
        $data = ['title'=>'Assets','subtitle'=>'Add new Photo Product','product'=>Product::findOrFail($this->product_id)];
        return view('assets.products.createphoto',compact('data'));
    }
    
    public function store(Request $request){

    }


}
