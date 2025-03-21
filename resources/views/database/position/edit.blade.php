@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><a href="{{ route('position.index') }}" class="btn btn-link text text-danger"><i
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
                <form action="{{ route('position.update',$data['position']->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="card-body card-height">
                        <div class="row">
                            <div class="col-12">
                                <div class="row mb-3">
                                    <label for="code" class="col-sm-3 col-form-label">Position Code</label>
                                    <div class="col-sm-9">
                                        <input type="text"
                                            class="form-control @error('code') is-invalid @enderror"
                                            id="code" name="code" value="{{ $data['position']->code }}">
                                        @error('code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="position_name" class="col-sm-3 col-form-label">Position Name</label>
                                    <div class="col-sm-9">
                                        <input type="text"
                                            class="form-control @error('position_name') is-invalid @enderror"
                                            id="position_name" name="position_name" value="{{ $data['position']->position_name }}">
                                        @error('position_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="category" class="col-sm-3 col-form-label">Category</label>
                                    <div class="col-sm-9">
                                        <select name="category" id="category" class="form-select @error('category') is-invalid @enderror">
                                            <option value="Employer">Employer</option>
                                            <option @if($data['position']->category == "Pro A" ) selected @endif value="Pro A">Pro A</option>
                                            <option @if($data['position']->category == "Pro B" ) selected @endif value="Pro B">Pro B</option>
                                            <option @if($data['position']->category == "SS" ) selected @endif value="SS">SS</option>
                                            <option @if($data['position']->category == "Inspector" ) selected @endif value="Inspector">Inspector</option>
                                            <option @if($data['position']->category == "Contractor" ) selected @endif value="Contractor">Contractor</option>
                                            <option @if($data['position']->category == "Sub-Contractor") selected @endif value="Sub-Contractor">Sub-Contractor</option>
                                        </select>                                      
                                        @error('category')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
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