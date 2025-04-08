@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><a href="{{ $form['back'] }}" class="btn btn-link text text-danger"><i
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
                    <form action="{{ $form['url'] }}" method="POST">
                        @csrf
                        <div class="card-body card-height">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row mb-3">
                                        <label for="item_code" class="col-sm-3 col-form-label">Item Code</label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                class="form-control @error('item_code') is-invalid @enderror" id="item_code"
                                                name="item_code" value="{{ old('item_code') }}">
                                            @error('item_code')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="item_name" class="col-sm-3 col-form-label">Item Name</label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                class="form-control @error('item_name') is-invalid @enderror" id="item_name"
                                                name="item_name" value="{{ old('item_name') }}">
                                            @error('item_name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="item_category" class="col-sm-3 col-form-label">Item Category</label>
                                        <div class="col-sm-9">

                                            <select name="item_category" id="item_category"
                                                class="form-select @error('item_category') is-invalid @enderror">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->item_category }}">
                                                        {{ $category->item_category }}</option>
                                                @endforeach
                                            </select>
                                            @error('item_category')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <label for="status" class="col-sm-3 col-form-label">Status</label>
                                        <div class="col-sm-9">
                                            <select name="status" id="status" class="form-select">
                                                <option value="Active">Active</option>
                                                <option value="Deactive">Deactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-8 offset-3">
                                            <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i>
                                                Save</button>
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
