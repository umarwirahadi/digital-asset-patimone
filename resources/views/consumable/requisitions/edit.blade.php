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
                                            <option value="1" {{ $requisition->requisition_type == '1' ? 'selected' : '' }}>Requisition / Supply of Expendable Items for Engineer's Site Office</option>
                                            <option value="2" {{ $requisition->requisition_type == '2' ? 'selected' : '' }}>Requisition For Maintenance Site Office</option>
                                            <option value="3" {{ $requisition->requisition_type == '3' ? 'selected' : '' }}>Requisition For Maintenance Air Condition</option>
                                            <option value="4" {{ $requisition->requisition_type == '4' ? 'selected' : '' }}>Requisition For PEST Control</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="requisition_no" class="col-sm-3 col-form-label">Request. No</label>
                                    <div class="col-sm-9">
                                        <input type="text"
                                            class="form-control @error('requisition_no') is-invalid @enderror"
                                            id="requisition_no" name="requisition_no" value="{{ $requisition->requisition_no }}">
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
                                            id="requisition_date" name="requisition_date" value="{{ $requisition->requisition_date }}">
                                        @error('requisition_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="requisition_year" class="col-sm-3 col-form-label">Year </label>
                                    <div class="col-sm-9">
                                        <select name="requisition_year" id="requisition_year" class="form-select @error('requisition_year') is-invalid @enderror">
                                            @for ($i = date('Y') - 3; $i <= date('Y') + 7; $i++)
                                                <option value="{{ $i }}" {{ $requisition->requisition_year == $i ? 'selected' : '' }}>{{ $i }}</option>
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
                                            @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $key => $month)
                                                <option value="{{ $month }}" {{ $requisition->requisition_month == $month ? 'selected' : '' }}>{{ $month }}</option>
                                            @endforeach
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
                                            class="form-control">{{$requisition->requisition_description}}</textarea>
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
                                    <label for="date_supplied_by_contractor" class="col-sm-3 col-form-label">Supplied date (The Contractor)</label>
                                    <div class="col-sm-9">
                                        <input type="date"
                                            class="form-control @error('date_supplied_by_contractor') is-invalid @enderror"
                                            id="date_supplied_by_contractor" name="date_supplied_by_contractor" value="{{ $requisition->date_supplied_by_contractor }}">
                                        @error('date_supplied_by_contractor')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="remark_by_contractor" class="col-sm-3 col-form-label">Remark (Contractor)</label>
                                    <div class="col-sm-9">
                                        <textarea name="remark_by_contractor" id="remark_by_contractor" cols="30" rows="3"
                                            class="form-control">{{$requisition->remark_by_contractor ?? ''}}</textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="date_received_by_engineer" class="col-sm-3 col-form-label">Received By Engineer</label>
                                    <div class="col-sm-9">
                                        <input type="date"
                                            class="form-control @error('date_received_by_engineer') is-invalid @enderror"
                                            id="date_received_by_engineer" name="date_received_by_engineer" value="{{ $requisition->date_received_by_engineer }}">
                                        @error('date_received_by_engineer')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="remark_by_contractor" class="col-sm-3 col-form-label">Remark (engineer)</label>
                                    <div class="col-sm-9">
                                        <textarea name="remark_by_engineer" id="remark_by_engineer" cols="30" rows="3"
                                            class="form-control">{{$requisition->remark_by_engineer ?? ''}}</textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="status" class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                                            @foreach ($status_label as $key => $status)
                                                <option value="{{ $key }}" @if($requisition->status == $key) selected @endif>{{ $status }}</option>
                                            @endforeach
                                        </select>

                                        @error('status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
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
