<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = ['title'=>'Packages','subtitle'=>'List of Package','packages'=>Package::all()];
        return view('database.package.index',compact('data'));
    }

    public function create(){
        $data = ['title'=>'Packages','subtitle'=>'Create New Package'];
        return view('database.package.create',compact('data'));
    }
    public function store(Request $request){

        $validatedData = $request->validate([
            'package_name' => 'required|string|max:100',
            'short_name' => 'required|string|max:4',
            'description' => 'nullable|string|max:1000',
            'status' => 'required|string|max:1|in:1,0'
        ]);
        Package::create([
            'package_name' => $validatedData['package_name'],
            'short_name' => $validatedData['short_name'],
            'description' => $validatedData['description'],
            'is_show' => '1',
            'status' => $validatedData['status']
        ]);

        return redirect()->route('package.index')->with('success', 'New Package created successfully.');                         
    }
    public function edit($id){
        $data = ['title'=>'Packages','subtitle'=>'Edit Package','package'=>Package::findOrFail($id)];
        return view('database.package.edit',compact('data'));
    }
    public function update(Request $request,$id){
        $validatedData = $request->validate([
            'package_name' => 'required|string|max:255',
            'short_name' => 'required|string|max:4',
            'description' => 'nullable|string|max:1000',
            'status' => 'required|string|max:1|in:1,0'
        ]);

        $category = Package::findOrFail($id);
        $category->update([
            'package_name' => $validatedData['package_name'] ?? $category->package_name,
            'short_name' => $validatedData['short_name'] ?? $category->short_name,
            'description' => $validatedData['description'] ?? $category->description,
            'status' => isset($validatedData['status']) ? $validatedData['status'] : $category->status,
        ]);
        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }
    public function destroy($id){
        try {
            $category = Package::findOrFail($id);
            $result = $category->delete();
            if($result) {
                $response = ['success'=>true,'message'=>'Package has been deleted..!'];
            } else {
                $response = ['success'=>false,'message'=>'Package failed to delete'];
            }
            return response()->json($response);
        } catch (\Throwable $th) {
            throw $th;
        }
        // return redirect()->route('category.index')->with('success', 'Category has been deleted.');
    }

    public function change_is_show($id){
        $is_show = request()->query('show');
        $package = Package::findOrFail($id);
        $package->is_show = $is_show;
        $package->update();
        return redirect()->route('package.index')->with('success','Status is show has been changed to '.$is_show);
    }
}
