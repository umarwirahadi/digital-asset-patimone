<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = ['title'=>'Database','subtitle'=>'List of employees','employees'=>Employee::all()];
        return view('database.employee.index',compact('data'));
    }

    public function create(){
        $data = ['title'=>'Employee','subtitle'=>'Create New Employee','positions'=>Position::all()];
        return view('database.employee.create',compact('data'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'position_id' => 'required|exists:categories,id',
            'full_name' => 'required|exists:packages,id',
            'birth_date' => 'nullable|date',
            'sex' => 'required|string|in:M,F',
            'phone' => 'required|string|max:200',
            'email' => 'required|integer',
            'address' => 'nullable|string|max:50',
            'city' => 'nullable|string|max:100',
            'mobilization' => 'nullable|date',
            'demobilization' => 'nullable|date',
            'status' => 'required|string|in:active,no',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ]);
           
            $employee = new Employee();
            $employee->position_id=$validated['position_id'];
            $employee->code=$validated['code'];
            $employee->full_name=$validated['full_name'];
            $employee->birth_date=$validated['birth_date'];
            $employee->sex=$validated['sex'];
            $employee->phone=$validated['phone'];
            $employee->email=$validated['email'];
            $employee->address=$validated['address'];
            $employee->city=$validated['city'];
            $employee->mobilization=$validated['mobilization'];
            $employee->demobilization=$validated['demobilization'];
            $employee->status=$validated['status'];
            if($request->hasFile('photo')){
                $image          = $request->file('photo');
                $unique_name    = uniqid().'-'.time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('/statics/files/'),$unique_name);
                $employee->photo         = $unique_name;            
            } 
            $employee->save();

            
        return redirect()->route('employee.index')->with('success', 'New Employee created successfully.');                         
    }


    public function edit($id){
        $data = ['title'=>'Products','subtitle'=>'Edit Product','packages'=>Package::IsShow()->get(),'categories'=>Category::all(),'product'=>Product::findOrFail($id)];
        // return $data;
        return view('database.employee.edit',compact('data'));
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
