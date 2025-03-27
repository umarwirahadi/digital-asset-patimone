@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-1">
            <h3 class="card-title">
                <a href="{{ route('asset.distribution.index') }}" class="btn btn-link"><i class="bi bi-arrow-counterclockwise"></i> Back</a>
            </h3>
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
            <div class="card-body card-height">
                <form action="{{ route('asset.distribution.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show m-2" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="row mb-2">
                    <label for="product_id" class="col-sm-3 col-form-label">Asset Name</label>
                    <div class="col-sm-9">
                        <select name="product_id" id="product_id" class="form-select">
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->code }} - {{ $product->name }} Qty {{ $product->quantity }}</option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="product_number" class="col-sm-3 col-form-label">Asset Number</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="product_number">                     
                        @error('product_number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="product_label" class="col-sm-3 col-form-label">Label</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="product_label">                     
                        @error('product_label')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="distribute_date" class="col-sm-3 col-form-label">Distribution Date</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" name="distribute_date">                     
                        @error('distribute_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="distribute_time" class="col-sm-3 col-form-label">Distribution Time</label>
                    <div class="col-sm-9">
                        <input type="time" class="form-control" name="distribute_time">                     
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="serial_number" class="col-sm-3 col-form-label">Serial number</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="serial_number">
                        @error('serial_number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="location" class="col-sm-3 col-form-label">Location</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="location">
                        @error('location')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror                     
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="condition" class="col-sm-3 col-form-label">Condition</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="condition">                     
                        @error('condition')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="handed_over_by" class="col-sm-3 col-form-label">Handover by</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="handed_over_by" value="{{ auth()->user()->name }}">                     
                        @error('handed_over_by')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="employee_id" class="col-sm-3 col-form-label">Employee Name</label>
                    <div class="col-sm-9">
                        <select name="employee_id" id="employee_id" class="form-select">
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->code }} - {{ $employee->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="received_by" class="col-sm-3 col-form-label">Received By</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="received_by">                     
                        @error('received_by')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>  
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Upload Photo</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="file" class="form-control  @error('files') is-invalid @enderror" id="files" name="files[]"
                                accept="image/png, image/gif, image/jpeg" />
                            <label class="input-group-text" for="files">Upload</label>
                            @error('files')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                 
                 
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="row mb-3">
                            <label for="remark" class="col-sm-3 col-form-label">Remark</label>
                            <div class="col-sm-9">
                                <textarea name="remark" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12 offset-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </div>
                        </div>
                    </div>                  
                </div>
                </form>
            </div>
            <div class="card-footer">Data Productss</div>
        </div>
    </div>
</div>

@endsection