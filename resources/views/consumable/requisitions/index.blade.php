@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-1">
            <h3 class="card-title"><a href="{{ $form['url'] }}" class="btn btn-link"><i class="bi bi-file-earmark-plus"></i> New Request</a></h3>
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
                                <th>Req. No</th>
                                <th>Month</th>
                                <th>Year</th>
                                <th>Req. Type</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            @foreach ($requisitions as $key=>$requisition)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td><a href="#">{{ $requisition->requisition_no }}</a></td>
                                    <td>{{ $requisition->requisition_month }}</td>
                                    <td>{{ $requisition->requisition_year }}</td>
                                    <td>{{ $requisition->requisition_type }}</td>
                                    <td>{{ $requisition->requisition_description }}</td>
                                    <td>{{ $requisition->status }}</td>
                                    <td>
                                        <a href="{{ route('requisitions.edit',$requisition->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i> Edit</a>
                                        <button type="button" class="btn btn-sm btn-danger btn-destroy" data-url="{{ route('requisitions.destroy',$requisition->id) }}"><i class="bi bi-trash3"></i> Delete</button>
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
