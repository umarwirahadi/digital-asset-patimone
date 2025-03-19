@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-1">
            <h3 class="card-title"><a href="{{ route('product.create') }}" class="btn btn-link"><i class="bi bi-file-earmark-plus"></i> New Photo for this product</a></h3>
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
                <div class="row">
                    <div class="col-6">
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
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <img src="" alt="">
                        </div>
                    </div>
                  
                </div>


            </div>
            <div class="card-footer">Data Products</div>
        </div>
    </div>
</div>

@endsection