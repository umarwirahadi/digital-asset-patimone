@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><a href="{{ route('package.index') }}" class="btn btn-link text text-danger"><i
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
                <form action="{{ route('package.update',$data['package']->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="card-body card-height">
                        <div class="row">
                            <div class="col-12">
                                <div class="row mb-3">
                                    <label for="package_name" class="col-sm-3 col-form-label">Package Name</label>
                                    <div class="col-sm-9">
                                        <input type="text"
                                            class="form-control @error('package_name') is-invalid @enderror"
                                            id="package_name" name="package_name" value="{{ $data['package']->package_name }}">
                                        @error('package_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="short_name" class="col-sm-3 col-form-label">Short Package Name</label>
                                    <div class="col-sm-9">
                                        <input type="text"
                                            class="form-control @error('short_name') is-invalid @enderror"
                                            id="short_name" name="short_name" value="{{ $data['package']->short_name }}">
                                        @error('short_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="category_name" class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea name="description" id="description" cols="30" rows="4"
                                            class="form-control">{{ $data['package']->description }}</textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="category_name" class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <select name="status" id="status" class="form-select">
                                            @php
                                            $cat = $data['package']->status;
                                        @endphp
                                        <option value="1" @if ($cat == '1') selected @endif>Active</option>
                                        <option value="0" @if ($cat == '0') selected @endif>Not Active</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-8 offset-3">
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i>
                                            Update</button>
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