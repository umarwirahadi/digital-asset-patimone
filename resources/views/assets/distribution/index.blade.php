@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-1">
                <h3 class="card-title">
                    <a href="{{ route('asset.distribution.create') }}" class="btn btn-link"><i
                            class="bi bi-file-earmark-plus"></i> New Distribution</a>
                    <a href="{{ route('product.index') }}" class="btn btn-link"><i
                            class="bi bi-arrow-counterclockwise"></i> List Product</a>

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
                <div class="table-responsive">
                    <table class="table table-striped table-sm table-hover" style="width:100%" id="table-distribution" data-url="{{ route('asset.distribution.index') }}">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Asset Name</th>
                                <th>Category</th>
                                <th>Number</th>
                                <th>Date</th>
                                <th>Location</th>
                                <th>Condition</th>
                                <th>Handover to</th>
                                <th>Remark</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="card-footer">Data Distribution</div>
        </div>
    </div>
</div>

@endsection