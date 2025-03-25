@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-1">
            <h3 class="card-title">
                <a href="{{ route('product.photo.create',['code'=>session('code')]) }}" class="btn btn-link"><i class="bi bi-file-earmark-plus"></i> Upload Photo</a>
                <a href="{{ route('product.index') }}" class="btn btn-link"><i class="bi bi-arrow-counterclockwise"></i> List Product</a>

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
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show m-2" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="row mb-2">
                    <label for="name" class="col-sm-3 col-form-label">Asset Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{ $data['product']->name }}" disabled>                     
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="name" class="col-sm-3 col-form-label">Category</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{ $data['product']->category->category_name }}" disabled>                     
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="name" class="col-sm-3 col-form-label">Quantity</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" value="{{ $data['product']->quantity }}" disabled>                     
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{ $data['product']->unit }}" disabled>                     
                    </div>
                </div>
                <div class="row mb-1">
                    <label for="name" class="col-sm-3 col-form-label">Category</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            id="name" name="name" value="{{ old('name') }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-1">
                    <label for="name" class="col-sm-3 col-form-label">Quantity</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            id="name" name="name" value="{{ old('name') }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    </div>                  
                </div>
            </div>
            <div class="card-footer">Data Productss</div>
        </div>
    </div>
</div>

@endsection