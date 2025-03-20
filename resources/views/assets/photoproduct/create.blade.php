@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-1">
                <h3 class="card-title"><a href="{{ route('product.index') }} " class="btn btn-link"><i
                            class="bi bi-file-earmark-plus"></i> Back to product</a></h3>
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
                <form action="{{ route('product.photo.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        @csrf
                        <div class="col-6">
                            <input type="hidden" name="product_id" value="{{ $data['product']->id }}">
                            <div class="row mb-3">
                                <label for="file_path" class="col-sm-4 col-form-label">Product</label>
                                <div class="col-sm-8">
                                    <textarea disabled class="form-control"
                                        rows="5">{{ $data['product']->code }} - {{ $data['product']->name }} - {{ $data['product']->quantity }} - {{ $data['product']->description }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="file_path" class="col-sm-4 col-form-label">Upload Photo</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="file" class="form-control  @error('file_path') is-invalid @enderror" id="file_path" name="file_path"
                                            accept="image/png, image/gif, image/jpeg" />
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
                                <label for="description" class="col-sm-4 col-form-label">Description</label>
                                <div class="col-sm-8">
                                    <textarea name="description" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12 offset-4">
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <img src="{{ asset('statics/img/product.png') }}" alt="" class="img-thumbnail img-fluid"
                                    id="imageUserPreview"
                                    style="width: 700px; height:500px;object-fit: fit; aspect-ratio: 3/2;">
                            </div>
                        </div>

                    </div>
                </form>


            </div>
            <div class="card-footer">Data Products photo</div>
        </div>
    </div>
</div>

@endsection