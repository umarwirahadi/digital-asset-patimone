<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDistributionRequest;
use App\Models\Category;
use App\Models\Employee;
use App\Models\Package;
use App\Models\Product;
use App\Models\ProductDistribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\Facades\DataTables;

class ProductDistributionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $cacheKey       = 'product_distributions_' . md5(json_encode($request->all()));
            $distributions  = Cache::remember($cacheKey, 60, function () use($request){

                $query = ProductDistribution::with(['product.category','employee'])
                    ->select('product_distribution.*')
                    ->orderBy('id', 'desc');

                    if($request->has('search') && $request->search['value'] != '') {
                        $serachValue = $request->search['value'];
                        $query->where(function ($q) use ($serachValue) {
                            $q->whereHas('product',function($sq) use ($serachValue){
                                $sq->where('code', 'like', "%{$serachValue}%")
                                    ->orWhere('name', 'like', "%{$serachValue}%")
                                    ->orWhere('brand', 'like', "%{$serachValue}%")
                                    ->orWhere('model', 'like', "%{$serachValue}%")
                                    ->orWhere('delivery_no', 'like', "%{$serachValue}%")
                                    ->orWhere('delivery_from', 'like', "%{$serachValue}%");
                            })->orWhere('product_label', 'like', "%{$serachValue}%")
                                ->orWhere('product_label', 'like', "%{$serachValue}%")
                                ->orWhere('received_by', 'like', "%{$serachValue}%")
                                ->orWhere('handed_over_by', 'like', "%{$serachValue}%")
                                ->orWhere('location', 'like', "%{$serachValue}%")
                                ->orWhere('remark', 'like', "%{$serachValue}%")
                                ->orWhere('distribute_date', 'like', "%{$serachValue}%");
                        });
                    }
                    return $query->get();
            });

            return DataTables::of($distributions)
            ->addIndexColumn()
            ->addColumn('option', function ($row) {
                $destroy = route('asset.distribution.destroy', $row->id);
                $html = '<button class="btn btn-sm btn-primary m-1"><i class="bi bi-pencil-square"></i> Edit</button>';
                $html .= '<button class="btn btn-sm btn-danger btn-destroy" data-url="'.$destroy.'"><i class="bi bi-trash"></i> Delete</button>';
                return $html;
            })->rawColumns(['option'])->make(true);
        }

        $product_code = request()->query('code');
        request()->session()->put('code', $product_code);
        // $product = Product::with('distributions')->where('code', $product_code)->first();
        $data = ['title'=>'Assets','subtitle'=>'Distribution of assets'];
        return view('assets.distribution.index',compact('data'));
    }

    public function create(){
        $data       = ['title'=>'Assets','subtitle'=>'Create Asset Distribution','action'=>route('asset.distribution.store')];
        $products    = Product::all();
        $employees   = Employee::all();
        return view('assets.distribution.create',compact('data','products','employees'));
    }

    public function store(StoreDistributionRequest $request){
            $distribution = new ProductDistribution();
            $distribution->product_id = $request->product_id;
            $distribution->product_number = $request->product_number;
            $distribution->product_label = $request->product_label;
            $distribution->employee_id = $request->employee_id;
            $distribution->distribute_date = $request->distribute_date;
            $distribution->distribute_time = $request->distribute_time;
            $distribution->serial_number = $request->serial_number;
            $distribution->location = $request->location;
            $distribution->condition = $request->condition;
            $distribution->status = $request->status;
            $distribution->handed_over_by = $request->handed_over_by;
            $distribution->received_by = $request->received_by;
            $distribution->remark = $request->remark;
            $distribution->created_by = auth()->user()->id;
            $distribution->updated_by = auth()->user()->id;
            if($request->hasFile('files')){
                $files      = $request->file('files');
                $fileNames  = [];
                foreach ($files as $file) {
                    $unique_name = uniqid().'-'.time().'.'.$file->getClientOriginalExtension();
                    $file->move(public_path('/statics/img/'),$unique_name);
                    $fileNames[] = $unique_name;
                }
                $distribution->files = json_encode($fileNames);
            }
            $distribution->save();
            session()->put('code',$request->product_code);
            return redirect()->route('asset.distribution.index',['code'=>session('code')])->with('success', 'Distribution created successfully.');
    }


    public function edit($id){
        $data = ['title'=>'Products','subtitle'=>'Edit Product','packages'=>Package::IsShow()->get(),'categories'=>Category::all(),'product'=>Product::findOrFail($id)];
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

    public function fetch(Request $request)
    {


        $product_code = request()->query('code');
        $product = Product::with('distributions')->where('code', $product_code)->first();
        return response()->json($product);
    }
}
