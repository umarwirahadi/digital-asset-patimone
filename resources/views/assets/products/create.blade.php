@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><a href="{{ route('product.index') }}" class="btn btn-link text text-danger"><i
                            class="bi bi-arrow-counterclockwise"></i> Back</a></h3>
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
                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body card-height">
                        <div class="row">
                            <div class="col-12">
                                <div class="row mb-3">
                                    <label for="package_id" class="col-sm-3 col-form-label">Package</label>
                                    <div class="col-sm-9">
                                        <select name="package_id" id="package_id" class="form-select">
                                            @foreach ($data['packages'] as $package)
                                            <option value="{{ $package->id }}">{{ $package->package_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="category_id" class="col-sm-3 col-form-label">Category Name</label>
                                    <div class="col-sm-9">
                                        <select name="category_id" id="category_id" class="form-select">
                                            @foreach ($data['categories'] as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="code" class="col-sm-3 col-form-label">Product code</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('code') is-invalid @enderror"
                                            id="code" name="code" value="{{ old('code') }}">
                                        @error('code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-3 col-form-label">Product Name</label>
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
                                <div class="row mb-3">
                                    <label for="quantity" class="col-sm-3 col-form-label">Quantity</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('quantity') is-invalid @enderror"
                                            id="quantity" name="quantity" value="{{ old('quantity') }}">
                                        @error('quantity')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="brand" class="col-sm-3 col-form-label">Brand/model</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control @error('brand') is-invalid @enderror"
                                            id="brand" name="brand" value="{{ old('brand') }}" placeholder="Brand">
                                        @error('brand')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control @error('model') is-invalid @enderror"
                                            id="model" name="model" value="{{ old('model') }}" placeholder="Model">
                                        @error('model')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="delivery_date" class="col-sm-3 col-form-label">Delivery</label>
                                    <div class="col-sm-4">
                                        <input type="date"
                                            class="form-control @error('delivery_date') is-invalid @enderror"
                                            id="delivery_date" name="delivery_date" value="{{ old('delivery_date') }}"
                                            placeholder="delivery_date">
                                        @error('delivery_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="text"
                                            class="form-control @error('delivery_no') is-invalid @enderror"
                                            id="delivery_no" name="delivery_no" value="{{ old('delivery_no') }}"
                                            placeholder="Delivery number">
                                        @error('delivery_no')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="delivery_from" class="col-sm-3 col-form-label">Proposed by</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                            class="form-control @error('delivery_from') is-invalid @enderror"
                                            id="delivery_from" name="delivery_from" value="{{ old('delivery_from') }}"
                                            placeholder="Please fill the contractor or supplier name">
                                        @error('delivery_from')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="category_name"
                                        class="col-sm-3 col-form-label">Description/Specification</label>
                                    <div class="col-sm-9">
                                        <textarea name="description" id="description" cols="30" rows="4"
                                            class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="delivery_from" class="col-sm-3 col-form-label">Warranty</label>
                                    <div class="col-sm-3">
                                        <select name="is_warranty" id="is_warranty" class="form-select @error('delivery_from') is-invalid @enderror">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                        @error('is_warranty')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="date"
                                            class="form-control @error('warranty_start_date') is-invalid @enderror"
                                            id="warranty_start_date" name="warranty_start_date"
                                            value="{{ old('warranty_start_date') }}">
                                        @error('warranty_start_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="date"
                                            class="form-control @error('warranty_end_date') is-invalid @enderror"
                                            id="warranty_end_date" name="warranty_end_date"
                                            value="{{ old('warranty_end_date') }}">
                                        @error('warranty_end_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="tags" class="col-sm-3 col-form-label">Product tags (optional)</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('tags') is-invalid @enderror"
                                            id="tags" name="tags" value="{{ old('tags') }}"
                                            placeholder="input tag product separated by comma">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="file_path" class="col-sm-3 col-form-label">Document Delivery Order(*.pdf)</label>
                                    <div class="col-sm-9">
                                        <div class="input-group mb-3">
                                            <input type="file" class="form-control" id="file_path" name="file_path" accept="application/pdf,application/vnd.ms-excel">
                                            <label class="input-group-text" for="file_path">Upload</label>
                                            @error('file_path')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                          </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-8 offset-3">
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i>
                                            Save</button>
                                        <button type="reset" class="btn btn-danger"><i class="bi bi-x-circle"></i>
                                            Reset</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </form>

            </div>
            <div class="card-footer">Footer</div>
        </div>
    </div>
</div>

@endsection