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
                <div class="row">
                    <div class="col-md-12">
                    </div>
                    @forelse ($data['product']->images as $photo)
                        <div class="card mx-2 p-1" style="width:300px">
                        <img class="card-img-top" src="{{ $photo->image_url }}" alt="photo assets">                        

                        <div class="card-body">
                          <p>{{ $photo->description }}</p>                          
                        </div>
                        <div class="card-footer p-1">
                            <p class="m-0"><span class="badge bg-dark text-white">Created at {{ $photo->created_at->format('d-M-y') }}</span></p>
                            <div class="d-flex justify-content-between">
                                <a href="" class="">Download</a>
                                <a href="javascript:void(0)" class="btn-destroy" data-url="">Delete</a>
                                <a href="{{ route('product.photo.edit',['code'=>$photo->product->code,'image_id'=>$photo->id]) }}" class="">Edit</a>
                            </div>

                        </div>
                        
                      </div>
                    @empty
                    <div class=" text bg-warning">
                        <strong>Warning!</strong> this Product doesn't have any photo, please <a href="{{ route('product.photo.create',['code'=>session('code')]) }}" class="btn btn-link"><i class="bi bi-file-earmark-plus"></i> Upload Photo</a>
                      </div>  
                    @endforelse
            
                </div>


            </div>
            <div class="card-footer">Data Productss</div>
        </div>
    </div>
</div>

@endsection