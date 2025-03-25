@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><a href="{{ route('employee.index') }}" class="btn btn-link text text-danger"><i
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
                <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body card-height">
                        <div class="row">
                            <div class="col-9">

                                <div class="row mb-3">
                                    <label for="position_id" class="col-sm-3 col-form-label">Position</label>
                                    <div class="col-sm-9">
                                        <select name="position_id" id="position_id" class="form-select @error('position_id') is-invalid @enderror">
                                            @forelse ($data['positions'] as $position)
                                            <option value="{{ $position->id }}">{{ $position->code }} - {{
                                                $position->position_name }}</option>
                                            @empty
                                            <option>No Position available</option>
                                            @endforelse
                                        </select>
                                        @error('position_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="code" class="col-sm-3 col-form-label">Employee code</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('code') is-invalid @enderror"
                                            id="code" name="code" value="{{ old('code') }}">
                                        @error('code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="full_name" class="col-sm-3 col-form-label">Full Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                            id="full_name" name="full_name" value="{{ old('full_name') }}">
                                        @error('full_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="birth_date" class="col-sm-3 col-form-label">Birth Date / Sex</label>
                                    <div class="col-sm-4">
                                        <input type="date"
                                            class="form-control @error('birth_date') is-invalid @enderror"
                                            id="birth_date" name="birth_date" value="{{ old('birth_date') }}">
                                        @error('birth_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-5">
                                        <select name="sex" id="sex" class="form-select">
                                            <option value="M">Male</option>
                                            <option value="F">Female</option>
                                        </select>
                                        @error('sex')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="phone" class="col-sm-3 col-form-label">Phone/Email</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            id="phone" name="phone" value="{{ old('phone') }}"
                                            placeholder="Phone number">
                                        @error('brand')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="email" class="form-control @error('model') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('model') }}" placeholder="Email">
                                        @error('model')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="address" class="col-sm-3 col-form-label">Address</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                            class="form-control @error('address') is-invalid @enderror"
                                            id="address" name="address" value="{{ old('address') }}"
                                            placeholder="Please fill the contractor or supplier name">
                                        @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="city"
                                        class="col-sm-3 col-form-label">City</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('city') is-invalid @enderror"
                                            id="city" name="city" value="{{ old('city') }}"
                                            placeholder="City">
                                        @error('city')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="mobilization" class="col-sm-3 col-form-label">Mobilization Plan</label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control @error('mobilization') is-invalid @enderror"
                                            id="mobilization" name="mobilization">
                                        @error('mobilization')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="date" class="form-control @error('demobilization') is-invalid @enderror"
                                            id="demobilization" name="demobilization" >
                                        @error('demobilization')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="status" class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-3">
                                        <select name="status" id="status"
                                            class="form-select @error('status') is-invalid @enderror">
                                            <option value="1">Active</option>
                                            <option value="0">Not Active</option>
                                        </select>
                                        @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    
                                    
                                </div>
                                 
                                <div class="row mb-3">
                                    <label for="photo" class="col-sm-3 col-form-label">Photo Profile</label>
                                    <div class="col-sm-9">
                                        <div class="input-group mb-3">
                                            <input type="file" class="form-control" id="photo" name="photo"
                                                accept="image/*" onchange="previewImage(event)">
                                            <label class="input-group-text" for="photo">Upload</label>
                                            @error('photo')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <script>
                                        function previewImage(event) {
                                            const input = event.target;
                                            const file = input.files[0];
                                            const reader = new FileReader();
                                            reader.onload = function (e) {
                                                const imagePreview = document.getElementById('imageUserPreview');
                                                imagePreview.src = e.target.result;
                                            };
                                            reader.readAsDataURL(file);
                                        }
                                    </script>


                                </div>
                                <div class="row mb-3">
                                    <div class="col-8 offset-3">
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i>
                                            Save</button>
                                        <button type="reset" class="btn btn-danger"><i class="bi bi-x-circle"></i>
                                            Reset</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card">
                                    <img src="{{ asset('statics/dist/assets/img/avatar5.png') }}" alt=""
                                        class="img-thumbnail img-fluid img-responsive" id="imageUserPreview">
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