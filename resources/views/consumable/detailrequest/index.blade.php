@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-1">
            <h3 class="card-title"><a href="route('requisitions.index')" class="btn btn-link text text-danger"><i class="bi bi-arrow-counterclockwise"></i> Back</a></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse" title="Collapse">
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-lte-toggle="card-remove" title="Remove">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row mb-3">
                                        <label for="requisition_no" class="col-sm-3 col-form-label">Request Number.</label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                class="form-control @error('requisition_no') is-invalid @enderror"
                                                id="code" name="code" value="{{$requisiton->requisition_no ?? ''}}">
                                            
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="requisition_date" class="col-sm-3 col-form-label">Date</label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                class="form-control @error('requisition_date') is-invalid @enderror"
                                                id="requisition_date" name="requisition_date" value="{{\Carbon\Carbon::parse($requisiton->requisition_date ?? '')->format('d/m/Y')}}">
                                           
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="requisition_type" class="col-sm-3 col-form-label">Type</label>
                                        <div class="col-sm-9">
                                            <select name="requisition_type" id="requisition_type" class="form-select @error('requisition_type') is-invalid @enderror">
                                                @foreach ($request_type as $item)                                                 
                                                @if($item->item_code == $requisiton->requisition_type) 
                                                    <option value="{{ $item->item_code }}" selected>{{ $item->item_name }}</option>
                                                @endif
                                                
                                                @endforeach

                                            </select>
                                          
                                        </div>
                                    </div>                                    
                                    
                                    <div class="row mb-3">
                                        <div class="col-8 offset-3">
                                            <button type="button" class="btn btn-primary" id="addModalForm" data-url="{{route('detailreq.create')}}"><i class="bi bi-plus"></i>
                                                Add Item</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                        </div>
    
                </div>


                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show m-2" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped table-sm table-hover data-table" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Description of Item</th>
                                <th>Preferred Brand</th>
                                <th>Unit</th>
                                <th>Qty</th>
                                <th>Date Required By Engineer</th>
                                <th>Date Supplied By Contractor</th>
                                <th>Received By The Engineer</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                             
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">Data Products</div>
        </div>
    </div>
</div>
<div class="modal fade" id="FormModal">
    
  </div>

@endsection
