@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-1">
            <h3 class="card-title"><a href="{{ route('position.create') }}" class="btn btn-link"><i class="bi bi-file-earmark-plus"></i> New Position</a></h3>
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
                    <table class="table table-striped table-sm table-hover data-table" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Position</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['positions'] as $key=>$position)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $position->code }}</td>
                                    <td>{{ $position->position_name }}</td>
                                    <td>{{ $position->category }}</td>                                
                                    <td>
                                        <a href="{{ route('position.edit',$position->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i> Edit</a>
                                        <button type="button" class="btn btn-sm btn-danger btn-destroy" data-url="{{ route('position.destroy',$position->id) }}"><i class="bi bi-trash3"></i> Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">Data Position</div>
        </div>
    </div>
</div>

@endsection