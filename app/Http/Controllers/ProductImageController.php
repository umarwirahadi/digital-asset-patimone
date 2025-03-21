<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductImageController extends Controller
{
    protected $product_id;
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index(){        
        $product_code = request()->query('code');
        request()->session()->put('code',$product_code);
        $product = Product::with('images')->where('code',$product_code)->first();

        $data = ['title'=>'Assets','subtitle'=>'Photo of '.$product->name,'product'=>$product];        
         return view('assets.photoproduct.index',compact('data'));
    }

    public function create(){
        $product_code = request()->query('code');
        $data = ['title'=>'Assets','subtitle'=>'Add new Photo Product','product'=>Product::where('code',$product_code)->first()];
        return view('assets.photoproduct.create',compact('data'));
    }
    
    public function store(Request $request){
        try {
            $validatedData = $request->validate([
                'product_id' => 'required|exists:products,id',
                'file_path'=>'required|image|mimes:jpg,jpeg,png|max:10240',
                'description'=>'nullable|string|max:1000'
            ],['file_path.required'=>'Please Upload Photo first..!','file_path.max'=>'the maximum upload file exeeded to 10MB']);
            if($request->hasFile('file_path')){
                $image          = $request->file('file_path');
                $unique_name    = uniqid().'-'.time().'.'.$image->getClientOriginalExtension();
                $img = Image::make($image->getRealPath());
                $img->resize(800,600);
                $img->save(public_path('/statics/img/').$unique_name);
                // $image->move(public_path('/statics/img/'),$unique_name); without resize photo
            }  
            $image = new ProductImage();
            $image->product_id = $validatedData['product_id'];
            $image->product_url = $unique_name;
            $image->description = $validatedData['description'];
            $image->save();       
            return redirect()->route('product.photo.index',['code'=>session('code')])->with('success', 'Photo created successfully.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit(){
        $product_code = request()->query('code');
        $image_id = request()->query('image_id');
        $image = ProductImage::with('product')->findOrFail($image_id);
        $data = ['title'=>'Assets','subtitle'=>'Edit Photo Product','image'=>$image];
        return view('assets.photoproduct.edit',compact('data'));
    }

    public function update(Request $request,$id){
        try {
            $validatedData = $request->validate([
                'product_id' => 'required|exists:products,id',
                'file_path'=>'nullable|image|mimes:jpg,jpeg,png|max:10240',
                'description'=>'nullable|string|max:1000'
            ],['file_path.required'=>'Please Upload Photo first..!','file_path.max'=>'the maximum upload file exeeded to 10MB']);         
            $imageProduct = ProductImage::findOrFail($id);
            if($request->hasFile('file_path')){
                $image          = $request->file('file_path');
                $unique_name    = uniqid().'-'.time().'.'.$image->getClientOriginalExtension();
                $img = Image::make($image->getRealPath());
                $img->resize(800,600);
                $img->save(public_path('/statics/img/').$unique_name);
                if ($imageProduct->product_url || file_exists(public_path('statics/img/') . $imageProduct->product_url)) {
                    unlink(public_path('statics/img/') . $imageProduct->product_url);
                }
                $imageProduct->product_url = $unique_name;
            } 
            $imageProduct->description = $validatedData['description'];
            $imageProduct->update();       
            return redirect()->route('product.photo.index',['code'=>session('code')])->with('success', 'Photo has been updated!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy($id){
        try {
            $productImage = ProductImage::findOrFail($id);            
            if ($productImage->product_url || file_exists(public_path('statics/img/') . $productImage->product_url)) {
                unlink(public_path('statics/img/') . $productImage->product_url);
            }
            $result = $productImage->delete();
            if($result) {
                $response = ['success'=>true,'message'=>'Photo product has been deleted..!'];
            } else {
                $response = ['success'=>false,'message'=>'Photo product failed to delete'];
            }
            return response()->json($response);
        } catch (\Throwable $th) {
            throw $th;
        }
    }



}
