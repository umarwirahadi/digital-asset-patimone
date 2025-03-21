@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-1">
            <h3 class="card-title"><a href="{{ route('employee.create') }}" class="btn btn-link"><i class="bi bi-file-earmark-plus"></i> New Employee</a></h3>
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
                                <th>Full name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Position</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['employees'] as $key=>$employee)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $employee->code }}</td>
                                    <td>{{ $employee->full_name }}</td>
                                    <td>{{ $employee->phone }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{{ $employee->position->position_name }}</td>
                                    <td>{!! $employee->status == '1' ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Not Active</span>' !!}</td>
                                    <td>
                                        <a href="{{ route('employee.edit',$employee->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i> Edit</a>
                                        <button type="button" class="btn btn-sm btn-danger btn-destroy" data-url="{{ route('employee.destroy',$employee->id) }}"><i class="bi bi-trash3"></i> Delete</button>
                                        <a href="{{ route('employee.photo.index',['code'=>$employee->code]) }}" class="btn btn-sm btn-info" ><i class="bi bi-images"></i> Photo</a>
                                        @isset($employee->file_path)
                                            <a download="delivery_order" href="{{ asset($employee->file_path_location) }}" class="btn btn-sm btn-warning" ><i class="bi bi-file-earmark-pdf"></i> DO File</a>                                            
                                        @endisset

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">Data Employees</div>
        </div>
    </div>
</div>

@endsection