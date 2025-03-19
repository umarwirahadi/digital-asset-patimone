@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-1">
            <h3 class="card-title"><a href="{{ route('package.create') }}" class="btn btn-link"><i class="bi bi-file-earmark-plus"></i> New Package</a></h3>
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

                <div class="table-responsive">
                    <table class="table table-sm table-borderless table-hover data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Package Name</th>
                                <th>Shorten name</th>
                                <th>Description</th>
                                <th>Show ?</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['packages'] as $key=>$package)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $package->package_name }}</td>
                                    <td>{{ $package->short_name }}</td>
                                    <td>{{ $package->description }}</td>
                                    <td>
                                        @if($package->is_show == 'no')
                                            <a href="{{ route('package.is-show',['id'=>$package->id,'show'=>'yes']) }}"><span class="badge bg-danger">No</span></a>
                                        @else
                                            <a href="{{ route('package.is-show',['id'=>$package->id,'show'=>'no']) }}"><span class="badge bg-success">Yes</span></a>
                                        @endif
                                    </td>
                                    <td>{!! $package->status == '1' ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Not Active</span>' !!}</td>
                                    <td>
                                        <a href="{{ route('package.edit',$package->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i> Edit</a>
                                        <button type="button" class="btn btn-sm btn-danger btn-destroy" data-url="{{ route('package.destroy',$package->id) }}"><i class="bi bi-trash3"></i> Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">Data Packages</div>
        </div>
    </div>
</div>

@endsection