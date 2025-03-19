<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = ['title'=>'Categories','subtitle'=>'List of Categories','categories'=>Category::all()];
        return view('database.category.index',compact('data'));
    }

    public function create(){
        $data = ['title'=>'Categories','subtitle'=>'Create Category'];
        return view('database.category.create',compact('data'));
    }
    public function store(Request $request){

        $validatedData = $request->validate([
            'category_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|max:1|in:1,0'
        ]);
        Category::create([
            'category_name' => $validatedData['category_name'],
            'description' => $validatedData['description'],
            'status' => $validatedData['status']
        ]);

        return redirect()->route('category.index')->with('success', 'Category created successfully.');
                         
    }
    public function edit($id){
        $data = ['title'=>'Categories','subtitle'=>'Edit Category','category'=>Category::findOrFail($id)];
        return view('database.category.edit',compact('data'));
    }
    public function update(Request $request,$id){
        $validatedData = $request->validate([
            'category_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|max:1|in:1,0'
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'category_name' => $validatedData['category_name'] ?? $category->category_name,
            'description' => $validatedData['description'] ?? $category->description,
            'status' => isset($validatedData['status']) ? $validatedData['status'] : $category->status,
        ]);
        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }
    public function destroy($id){
        try {
            $category = Category::findOrFail($id);
            $result = $category->delete();
            if($result) {
                $response = ['success'=>true,'message'=>'Category has been deleted..!'];
            } else {
                $response = ['success'=>false,'message'=>'Category failed to delete'];
            }
            return response()->json($response);
        } catch (\Throwable $th) {
            throw $th;
        }
        // return redirect()->route('category.index')->with('success', 'Category has been deleted.');
    }
}
