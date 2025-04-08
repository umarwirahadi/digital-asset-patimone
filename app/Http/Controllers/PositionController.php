<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Position;
use DB;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = ['title'=>'Position','subtitle'=>'List of Position','positions'=>Position::all()];
        return view('database.position.index',compact('data'));
    }

    public function create(){
        $data = ['title'=>'Position','subtitle'=>'Create New Position'];
        $form = ['url'=>route('position.store'),'method'=>'POST','back'=>route('position.index')];
        $categories = DB::table('items')->select('item_code','item_name')->where('item_category','Type of Employer')->distinct()->get();
        return view('database.position.create',compact('data','form','categories'));
    }
    public function store(Request $request){

        $validatedData = $request->validate([
            'code' => 'required|string|max:20',
            'position_name' => 'required|string|max:50',
            'category' => 'required|string|max:50',
        ]);
        Position::create([
            'code' => $validatedData['code'],
            'position_name' => $validatedData['position_name'],
            'category' => $validatedData['category']
        ]);
        return redirect()->route('position.index')->with('success', 'New Position created successfully.');                         
    }
    public function edit($id){
        $data = ['title'=>'Packages','subtitle'=>'Edit Position','position'=>Position::findOrFail($id)];
        return view('database.position.edit',compact('data'));
    }
    public function update(Request $request,$id){
        $validatedData = $request->validate([
            'code' => 'required|string|max:20',
            'position_name' => 'required|string|max:50',
            'category' => 'required|string|max:50',
        ]);

        $position = Position::findOrFail($id);
        $position->update([
            'code' => $validatedData['code'],
            'position_name' => $validatedData['position_name'],
            'category' => $validatedData['category'],
        ]);
        return redirect()->route('position.index')->with('success', 'Position updated successfully.');
    }
    public function destroy($id){
        try {
            $position = Position::findOrFail($id);
            $result = $position->delete();
            if($result) {
                $response = ['success'=>true,'message'=>'Position has been deleted..!'];
            } else {
                $response = ['success'=>false,'message'=>'Position failed to delete'];
            }
            return response()->json($response);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function change_is_show($id){
        $is_show = request()->query('show');
        $package = Package::findOrFail($id);
        $package->is_show = $is_show;
        $package->update();
        return redirect()->route('package.index')->with('success','Status is show has been changed to '.$is_show);
    }
}
