@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-1">
            <h3 class="card-title"><a href="{{ route('options.create') }}" class="btn btn-link"><i class="bi bi-file-earmark-plus"></i> Add new</a></h3>
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
                    <table class="table table-sm table-bordered data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Option Name</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Group</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($options as $option)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $option->option_name }}</td>
                                    <td>{{ $option->option_value }}</td>
                                    <td>{{ $option->option_type }}</td>
                                    <td>{{ $option->option_group }}</td>
                                    <td>{!! $option->status == '1' ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Not Active</span>' !!}</td>
                                    <td>
                                        <a href="{{ route('options.edit', $option->id) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil-square"></i> Edit</a>
                                        <button type="button" class="btn btn-sm btn-outline-secondary btn-destroy" data-url="{{ route('options.destroy', $option->id) }}"><i class="bi bi-trash3"></i> Delete</button>
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