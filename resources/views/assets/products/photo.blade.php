@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-1">
            <h3 class="card-title"><a href="{{ route('product.photo.create') }}" class="btn btn-link"><i class="bi bi-file-earmark-plus"></i> New Photo for this product</a></h3>
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
                    @foreach ($data['productimages'] as $photo)
                        <div class="card" style="width:400px">
                        <img class="card-img-top" src="img_avatar1.png" alt="Card image">
                        <div class="card-body">
                          <h4 class="card-title">John Doe</h4>
                          <p class="card-text">Some example text.</p>
                          <a href="#" class="btn btn-primary">See Profile</a>
                        </div>
                      </div>
                        
                    @endforeach
                </div>


            </div>
            <div class="card-footer">Data Productss</div>
        </div>
    </div>
</div>

@endsection