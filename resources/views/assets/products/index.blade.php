@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-1">
            <h3 class="card-title"><a href="{{ route('product.create') }}" class="btn btn-link"><i class="bi bi-file-earmark-plus"></i> New Product</a></h3>
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
                <form action="{{ route('product.index') }}" method="get">
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <input type="text" name="search" class="form-control" placeholder="Search by Code or Name" value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="category_id" class="form-select">
                                <option value="">All Categories</option>
                                @foreach ($data['categories'] as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="status" class="form-select">
                                <option value="">All Status</option>
                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Not Active</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Search</button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-striped table-sm table-hover data-table" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Index</th>
                                <th>Source</th>
                                <th>Code</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>QTY</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['products'] as $key=>$product)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $product->code_index }}</td>
                                    <td>{{ $product->package->short_name }}</td>
                                    <td>{{ $product->code }}</td>
                                    <td><a href="{{ route('asset.distribution.index',['code'=> $product->code ]) }}">{{ Illuminate\Support\Str::limit($product->name,30) }}</a></td>
                                    <td>{{ $product->category->category_name }}</td>
                                    <td style="text-align: center">{{ $product->quantity }}</td>
                                    <td>{{ Illuminate\Support\Str::limit($product->description,30) }}</td>
                                    <td>{!! $product->status == '1' ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Not Active</span>' !!}</td>
                                    <td>
                                        <a href="{{ route('product.print.label',$product->id) }}" class="btn btn-sm btn-success"><i class="bi bi-printer"></i> Label </a>
                                        <a href="{{ route('product.edit',$product->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i> Edit</a>
                                        <button type="button" class="btn btn-sm btn-danger btn-destroy" data-url="{{ route('product.destroy',$product->id) }}"><i class="bi bi-trash3"></i> Delete</button>
                                        <a href="{{ route('product.photo.index',['code'=>$product->code]) }}" class="btn btn-sm btn-info" ><i class="bi bi-images"></i> Photo</a>
                                        @isset($product->file_path)
                                            <a download="delivery_order" href="{{ asset($product->file_path_location) }}" class="btn btn-sm btn-warning" ><i class="bi bi-file-earmark-pdf"></i> DO File</a>                                            
                                        @endisset

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">Data Products</div>
        </div>
    </div>
</div>

@endsection