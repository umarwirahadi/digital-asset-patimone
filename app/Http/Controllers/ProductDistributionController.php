<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductDistributionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = ['title'=>'Assets','subtitle'=>'List of Products','products'=>Product::all()];
        return view('assets.products.index',compact('data'));
    }

    public function create(){
        $data = ['title'=>'Assets','subtitle'=>'Create New Product','packages'=>Package::isShow()->get(),'categories'=>Category::all()];
        return view('assets.products.create',compact('data'));
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'package_id' => 'required|exists:packages,id',
            'code' => 'required|string|max:30|unique:products,code',
            'name' => 'required|string|max:200',
            'quantity' => 'required|integer',
            'unit' => 'required|string|max:50',
            'description' => 'nullable|string|max:1000',
            'brand' => 'nullable|string|max:100',
            'model' => 'nullable|string|max:100',
            'delivery_date' => 'required|date',
            'delivery_no' => 'required|string|max:100',
            'is_warranty' => 'required|string|in:yes,no',
            'warranty_start_date' => 'nullable|date',
            'warranty_end_date' => 'nullable|date',
            'file_path' => 'nullable|mimes:pdf,xlsx,xls',
        ]);
           
            $product = new Product();
            $product->category_id       = $validatedData['category_id'];
            $product->package_id        = $validatedData['package_id'];
            $product->code              = $validatedData['code'];
            $product->name              = $validatedData['name'];
            $product->quantity          = $validatedData['quantity'];
            $product->unit              = $validatedData['unit'];
            $product->description       = $validatedData['description'];
            $product->brand             = $validatedData['brand'];
            $product->model             = $validatedData['model'];
            $product->delivery_date     = $validatedData['delivery_date'];
            $product->delivery_no       = $validatedData['delivery_no'];
            $product->delivery_from     = $request->delivery_from;
            $product->tags              = $request->tags ?? '';
            if($request->hasFile('file_path')){
                $image          = $request->file('file_path');
                $unique_name    = uniqid().'-'.time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('/statics/files/'),$unique_name);
                $product->file_path         = $unique_name;            
            } 
            $product->is_warranty       = $validatedData['is_warranty'];
            $product->warranty_start_date = $validatedData['warranty_start_date'];
            $product->warranty_end_date = $validatedData['warranty_end_date'];
            $product->status            = '1';
            $product->save();
        return redirect()->route('product.index')->with('success', 'New Product created successfully.');                         
    }


    public function edit($id){
        $data = ['title'=>'Products','subtitle'=>'Edit Product','packages'=>Package::IsShow()->get(),'categories'=>Category::all(),'product'=>Product::findOrFail($id)];
        // return $data;
        return view('assets.products.edit',compact('data'));
    }
    public function update(Request $request,$id){
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'package_id' => 'required|exists:packages,id',
            'code' => 'required|string|max:30|unique:products,code,'.$id,
            'name' => 'required|string|max:200',
            'quantity' => 'required|integer',
            'unit' => 'required|string|max:50',
            'description' => 'nullable|string|max:1000',
            'brand' => 'nullable|string|max:100',
            'model' => 'nullable|string|max:100',
            'delivery_date' => 'required|date',
            'delivery_no' => 'required|string|max:100',
            'is_warranty' => 'required|string|in:yes,no',
            'warranty_start_date' => 'nullable|date',
            'warranty_end_date' => 'nullable|date',
            'status' => 'required|in:1,0',
        ]);        
        $product= Product::findOrFail($id);        
        $product->category_id = $validatedData['category_id'];
        $product->package_id = $validatedData['package_id'];
        $product->code = $validatedData['code'];
        $product->name = $validatedData['name'];
        $product->quantity = $validatedData['quantity'];
        $product->unit = $validatedData['unit'];
        $product->description = $validatedData['description'];
        $product->brand = $validatedData['brand'];
        $product->model = $validatedData['model'];
        $product->delivery_date = $validatedData['delivery_date'];
        $product->delivery_no = $validatedData['delivery_no'];
        $product->delivery_from = $request->delivery_from;
        $product->tags = $request->tags ?? '';
        $product->is_warranty = $validatedData['is_warranty'];
        $product->warranty_start_date = $validatedData['warranty_start_date'];
        $product->warranty_end_date = $validatedData['warranty_end_date'];
        $product->status = $validatedData['status'];
        $product->update();
        return redirect()->route('product.index')->with('success', 'Product has been updated!.');   
    }
    public function destroy($id){
        try {
            $product = Product::findOrFail($id);            
            $result = $product->delete();
            if($result) {
                $response = ['success'=>true,'message'=>'Product has been deleted..!'];
            } else {
                $response = ['success'=>false,'message'=>'Product failed to delete'];
            }
            return response()->json($response);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
