<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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
            'position_id' => 'required|exists:position,id',
            'full_name' => 'required|string|max:200',
            'code' => 'required|string|max:30|unique:employees,code',
            'birth_date' => 'nullable|date',
            'sex' => 'required|string|in:M,F',
            'phone' => 'required|string|max:30',
            'email' => 'required|email|max:100|unique:employees,email',
            'address' => 'nullable|string|max:50',
            'city' => 'nullable|string|max:100',
            'mobilization' => 'nullable|date',
            'demobilization' => 'nullable|date',
            'status' => 'required|in:1,0',
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
                $img = Image::make($image->getRealPath());
                $img->orientate(); // Fix image orientation
                $img->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $img->save(public_path('/statics/img/').$unique_name);                
                $employee->photo         = $unique_name;            
            } 
            $employee->save();

            
        return redirect()->route('employee.index')->with('success', 'New Employee created successfully.');                         
    }


    public function edit($id){
        $data = ['title'=>'Employee','subtitle'=>'Edit Employee','positions'=>Position::all(),'employee'=>Employee::findOrFail($id)];
        return view('database.employee.edit',compact('data'));
    }
    public function update(Request $request,$id){
        $validated = $request->validate([
            'position_id' => 'required|exists:position,id',
            'code' => 'required|string|max:30|exists:employees,code',
            'full_name' => 'required|string|max:200',
            'birth_date' => 'nullable|date',
            'sex' => 'required|string|in:M,F',
            'phone' => 'required|string|max:30',
            'email' => 'required|email|max:100|unique:employees,email,'.$id,
            'address' => 'nullable|string|max:50',
            'city' => 'nullable|string|max:100',
            'mobilization' => 'nullable|date',
            'demobilization' => 'nullable|date',
            'status' => 'required|in:1,0',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ]);           
            $employee = Employee::findOrFail($id);
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
                if ($employee->photo || file_exists(public_path('statics/img/') . $employee->photo)) {
                    unlink(public_path('statics/img/') . $employee->photo);
                }
                $image          = $request->file('photo');
                $unique_name    = uniqid().'-'.time().'.'.$image->getClientOriginalExtension();
                $img = Image::make($image->getRealPath());
                $img->orientate();
                $img->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $img->save(public_path('/statics/img/').$unique_name);                
                $employee->photo         = $unique_name;            
            }
            $employee->update();
        return redirect()->route('employee.index')->with('success', 'Employee updated successfully.');  
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
