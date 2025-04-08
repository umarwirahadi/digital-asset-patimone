<?php

namespace App\Http\Controllers;
use App\Models\Requisition;
use DB;

class RequisitionDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $request_id = request()->query('_request_id');  
        $data       = ['title' => 'Requisition Detail', 'subtitle' => 'List of Requisition Detail'];
        // $form       = ['url' => route('detailreq.create'), 'method' => 'GET', 'back' => route('requisitions.index')];
        $requisiton = Requisition::find($request_id);
        $request_type = DB::table('items')->where('item_category', 'req. type')->get();
        return view('consumable.detailrequest.index', compact('data',  'requisiton', 'request_type'));
    }



    public function create()
    {        
        try {
            $request_id = request()->query('_request_id');
            dd($request_id);
            $requisition = Requisition::find($request_id);
            if (!$requisition) {
                return response()->json(['error' => 'Requisition not found.'], 404);
            }
            $data = ['title' => 'Requisition Detail', 'subtitle' => 'Create Requisition Detail'];
            $form = ['url' => route('requisition_detail.store'), 'method' => 'POST', 'files' => true];
            $units = DB::table('items')->where('item_category', 'unit')->get();
            $html = view('consumable.detailrequest.create', compact('data', 'form', 'units', 'requisition'))->render();
            return response()->json($html);
        } catch (\Throwable $th) {
            throw $th;
            return response()->json(['error' => 'Failed to load requisition detail.'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'description_item' => 'required',
                'category' => 'required',
                'preferred_brand' => 'required',
                'unit' => 'required',
                'quantity' => 'required|numeric',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $data = $request->all();
            if ($request->hasFile('photo')) {
                $data['photo'] = $request->file('photo')->store('requisition_photos', 'public');
            }
            RequisitionDetail::create($data);
            return redirect()->route('requisition_detail.index', ['id' => $request->requisition_id])->with('success', 'Requisition Detail created successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to create Requisition Detail.')->withInput();
        }
    }

 

}
