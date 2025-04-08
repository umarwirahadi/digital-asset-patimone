@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><a href="{{ $form['back'] }}" class="btn btn-link text text-danger"><i
                            class="bi bi-arrow-counterclockwise"></i> Back</a></h3>
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
                <form action="{{ $form['url'] }}" method="POST" @if($form['files']) enctype="multipart/form-data" @endif>
                    @csrf
                    @if($form['method'] == 'PUT')
                        @method('PUT')
                    @endif
                    <div class="card-body card-height">
                        <div class="row">
                            <div class="col-12">
                                <div class="row mb-3">
                                    <label for="requisition_type" class="col-sm-3 col-form-label">Request Type</label>
                                    <div class="col-sm-9">
                                        <select name="requisition_type" id="requisition_type" class="form-select @error('requisition_type') is-invalid @enderror">
                                            @foreach ($req_types as $item)
                                                <option value="{{ $item->item_code }}">{{ $item->item_name }}</option>                                                
                                            @endforeach
                                        </select>
                                        @error('requisition_type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="requisition_no" class="col-sm-3 col-form-label">Request. No</label>
                                    <div class="col-sm-9">
                                        <input type="text"
                                            class="form-control @error('requisition_no') is-invalid @enderror"
                                            id="requisition_no" name="requisition_no" value="{{ old('requisition_no') }}">
                                        @error('requisition_no')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="requisition_date" class="col-sm-3 col-form-label">Request Date</label>
                                    <div class="col-sm-9">
                                        <input type="date"
                                            class="form-control @error('requisition_date') is-invalid @enderror"
                                            id="requisition_date" name="requisition_date" value="{{ old('requisition_date') }}">
                                        @error('requisition_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                            @php
                                            $year_bottom = date('Y') - 3;
                                            $year_top    = date('Y') + 7;
                                            @endphp
                                <div class="row mb-3">
                                    <label for="requisition_year" class="col-sm-3 col-form-label">Year </label>
                                    <div class="col-sm-9">
                                        <select name="requisition_year" id="requisition_year" class="form-select @error('requisition_year') is-invalid @enderror">
                                            @for ($i = $year_bottom; $i <= $year_top; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                        @error('requisition_year')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="requisition_month" class="col-sm-3 col-form-label">Month</label>
                                    <div class="col-sm-9">
                                        <select name="requisition_month" id="requisition_month" class="form-select @error('requisition_month') is-invalid @enderror">
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                        @error('requisition_month')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="requisition_description" class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea name="requisition_description" id="requisition_description" cols="30" rows="4"
                                            class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="requisition_file" class="col-sm-3 col-form-label">File Upload</label>
                                    <div class="col-sm-9">
                                        <input type="file"
                                            class="form-control @error('requisition_file') is-invalid @enderror"
                                            id="requisition_file" name="requisition_file" value="{{ old('requisition_file') }}">
                                        @error('requisition_file')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-8 offset-3">
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i>
                                        @if ($form['method'] == 'PUT')
                                            Update
                                        @else
                                            Save
                                        @endif
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </form>

            </div>
            <div class="card-footer">Footer</div>
        </div>
    </div>
</div>

@endsection
