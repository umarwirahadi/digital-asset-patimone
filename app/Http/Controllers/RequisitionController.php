<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequitionRequest;
use App\Models\Requisition;
use DB;
use Illuminate\Http\Request;

class RequisitionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = ['title'=>'Consumable','subtitle'=>'Requisiton list'];
        $form = ['url'=>route('requisitions.create'),'method'=>'GET','back'=>route('requisitions.index')];
        $requisitions = Requisition::all();
        return view('consumable.requisitions.index',compact('data','form','requisitions'));
    }

    public function create()
    {
        $data = ['title'=>'Consumable','subtitle'=>'Create New Requisition'];
        $form = ['url'=>route('requisitions.store'),'method'=>'POST','files'=>true,'back'=>route('requisitions.index')];
        $req_types = DB::table('items')->where('item_category','req. type')->get();
        return view('consumable.requisitions.create',compact('data','form','req_types'));
    }

    public function store(StoreRequitionRequest $request)
    {

        $requisition = new Requisition();
        $requisition->requisition_no        = $request->requisition_no;
        $requisition->requisition_type      = $request->requisition_type;
        $requisition->requisition_priority  = '1';
        $requisition->requisition_month      = $request->requisition_month;
        $requisition->requisition_year       = $request->requisition_year;
        $requisition->requisition_description = $request->requisition_description;
        $requisition->requisition_date      = $request->requisition_date;
        if ($request->hasFile('requisition_file')) {
            $file = $request->file('requisition_file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/requisitions/', $filename);
            $requisition->requisition_file = $filename;
        }
        $requisition->status = '0';
        $requisition->save();
        return redirect()->route('requisitions.index')->with('success', 'Requisition created successfully.');
    }

    public function edit($id)
    {
        $requisition    = Requisition::findOrFail($id);
        $data           = ['title'=>'Consumable','subtitle'=>'Edit Requisiton'];
        $form           = ['url'=>route('requisitions.update',$requisition->id),'method'=>'PUT','back'=>route('requisitions.index'),'files'=>true];
        $status_label   = [
            '0' => 'Draft',
            '1' => 'Sent',
            '2' => 'Approved',
            '3' => 'Rejected',
            '4' => 'Completed',
            '5' => 'Cancelled',
            '6' => 'In Progress',
            '7' => 'Pending',
        ];
        return view('consumable.requisitions.edit', compact('requisition','data','form','status_label'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'requisition_no' => 'required|string|max:50',
            'requisition_type' => 'required|string',
            'requisition_description' => 'required|string',
            'requisition_file' => 'nullable|string|max:200',
            'requisition_date' => 'required|date',
            'requisition_time' => 'nullable|time',
            'requisition_location' => 'nullable|string',
            'requisition_remark' => 'nullable|string',
            'date_supplied_by_contractor' => 'nullable|date',
            'remark_by_contractor' => 'nullable|string|max:200',
            'date_received_by_engineer' => 'nullable|date',
            'remark_by_engineer' => 'nullable|string|max:200',
            'status' => 'required|string|max:1',
        ]);

        $requisition = Requisition::findOrFail($id);
        $requisition->update($validatedData);
        return redirect()->route('requisitions.index')->with('success', 'Requisition updated successfully.');
    }

    public function destroy($id)
    {
    if (request()->ajax()) {
        $requisition = Requisition::findOrFail($id);
        dd($requisition);
        /* try {
            $result = $requisition->delete();
            if($result) {
                $response = ['success'=>true,'message'=>'Requisition has been deleted successfully.'];
            } else {
                $response = ['success'=>false,'message'=>'Requisition failed to delete. '];
            }
            return response()->json($response);       
        } catch (\Throwable $th) {
            $response = ['success'=>false,'message'=>'Failed to delete requisition. '.$th->getMessage()];
        }  */      
    }
        return redirect()->route('requisitions.index')->with('error', 'Unable to delete requisition.');
    }


}
