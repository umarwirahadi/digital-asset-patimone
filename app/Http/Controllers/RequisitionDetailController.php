<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDetailRequest;
use App\Http\Requests\UpdateDetailRequest;
use App\Models\Requisition;
use App\Models\RequisitionDetail;
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
        $requisition = Requisition::with('details')->find($request_id);
        $request_type = DB::table('items')->where('item_category', 'req. type')->get();
        return view('consumable.detailrequest.index', compact('data',  'requisition', 'request_type'));
    }



    public function create()
    {        
        try {
            $request_id = request()->query('_request_id');
            $requisition = Requisition::find($request_id);
            if (!$requisition) {
                return response()->json(['error' => 'Requisition not found.'], 404);
            }
            $data = ['title' => 'Requisition Detail', 'subtitle' => 'Create Requisition Detail'];
            $form = ['url' => route('detailreq.store',['_request_id'=>$request_id]), 'method' => 'POST', 'files' => true];
            $units = DB::table('items')->whereIn('item_category',['unit','category of request'])->where('status','=','1')->orderBy('item_category')->get();
            $html = view('consumable.detailrequest.create', compact('data', 'form', 'units', 'requisition'))->render();
            return response()->json($html);
        } catch (\Throwable $th) {
            throw $th;
            return response()->json(['error' => 'Failed to load requisition detail.'], 500);
        }
    }

    public function store(StoreDetailRequest $request)
    {
        try {            
            $req_detail = new RequisitionDetail();
            $req_detail->requisition_id = $request->request_id;
            $req_detail->description_item = $request->description_item;
            $req_detail->preferred_brand = $request->preferred_brand;
            $req_detail->unit = $request->unit;
            $req_detail->quantity = $request->quantity;
            $req_detail->category = $request->category;
            $req_detail->request_date = $request->request_date;
            $req_detail->request_status = '0';
            if ($request->hasFile('photos')) {
                $files = $request->file('photos');
                $filenames = [];
                foreach ($files as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    if (!file_exists(public_path('requisition_attachments'))) {
                        mkdir(public_path('requisition_attachments'), 0755, true);
                    }
                    $file->move(public_path('requisition_attachments'), $filename);
                    $filenames[] = $filename;
                }
                $req_detail->photo = json_encode($filenames);
            }
            $req_detail->save();
            return response()->json(['success'=>true,'message' => 'Requisition Detail created successfully.']);           
        } catch (\Throwable $th) {
            // Log the error message
            throw $th;
        }
    }

    public function edit($id)
    {
        $data               = ['title' => 'Requisition Detail', 'subtitle' => 'Edit Requisition Detail'];
        $form               = ['url' => route('detailreq.update', $id), 'method' => 'PUT', 'files' => true];
        $units              = DB::table('items')->whereIn('item_category',['unit','category of request'])->where('status','=','1')->orderBy('item_category')->get();
        $requisition_detail = RequisitionDetail::findOrFail($id);
        $html = view('consumable.detailrequest.edit', compact('data', 'form', 'units', 'requisition_detail'))->render();
        return response()->json($html);
    }

 
    public function update(UpdateDetailRequest $request, $id)
    {
        try {
            $req_detail                     = RequisitionDetail::findOrFail($id);
            $req_detail->description_item   = $request->description_item;
            $req_detail->preferred_brand    = $request->preferred_brand;
            $req_detail->unit               = $request->unit;
            $req_detail->quantity           = $request->quantity;
            $req_detail->category           = $request->category;
            $req_detail->request_date       = $request->request_date;
            if ($request->hasFile('photos')) {
                $files = $request->file('photos');
                $filenames = [];
                foreach ($files as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    if (!file_exists(public_path('requisition_attachments'))) {
                        mkdir(public_path('requisition_attachments'), 0755, true);
                    }
                    // Check if the file already exists in the directory then remove it
                    if (file_exists(public_path('requisition_attachments/' . $filename))) {
                        unlink(public_path('requisition_attachments/' . $filename));
                    }
                    
                    $file->move(public_path('requisition_attachments'), $filename);
                    $filenames[] = $filename;
                }
                // Decode the existing photo JSON and merge with new filenames
                if ($req_detail->photo) {
                    $existing_photos = json_decode($req_detail->photo, true);
                    if (is_array($existing_photos)) {
                        $filenames = array_merge($existing_photos, $filenames);
                    }
                }
                // Encode the merged array back to JSON
                $req_detail->photo = json_encode($filenames);
            }
            $req_detail->save();
            return response()->json(['success'=>true,'message' => 'Requisition Detail updated successfully.']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy($id)
    {
        try {
            $req_detail = RequisitionDetail::findOrFail($id);
            $result = $req_detail->delete();
            //catch (\Throwable $th) and parse to json
            


            if (!$result) {
                return response()->json(['success'=>false,'message' => 'Failed to delete requisition detail.'], 200);
            }




            return response()->json(['success'=>true,'message' => 'Requisition Detail deleted successfully.']);
        } catch (\Throwable $th) {

            return response()->json(['success'=>false,'message' => 'Failed to delete requisition detail. '.$th->getMessage()], 200);
        }
    }

    public function remove_image($id,$image)
    {
        try {
            if (file_exists(public_path('requisition_attachments/' . $image))) {
                $req_detail = RequisitionDetail::findOrFail($id);
                $photos = json_decode($req_detail->photo, true);
                if (($key = array_search($image, $photos)) !== false) {
                    unset($photos[$key]);
                }
                unlink(public_path('requisition_attachments/' . $image));
            }
            // If no photos left, set photo to null
            if (empty($photos)) {
                $req_detail->photo = null;
            } else {
                $req_detail->photo = json_encode(array_values($photos));
            }            
            $req_detail->save();
            return response()->json(['success'=>true,'message' => 'Image removed successfully.']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }





}
