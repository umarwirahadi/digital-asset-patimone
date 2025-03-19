@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="card card-success card-outline mb-4">
        <div class="card-header">
            <div class="card-title">My Profile</div>
        </div>
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show m-2" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <form action="{{ route('my.profile.update') }}" method="POST" id="form-update-profile"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ auth()->user()->name }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ auth()->user()->email }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="phone" class="col-sm-2 col-form-label">Phone number</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{ auth()->user()->phone }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ auth()->user()->email }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-sm-2 col-form-label">Upload Photo</label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" id="profile_url" name="profile_url">
                                    <label class="input-group-text" for="profile_url">Upload</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <img src="{{ auth()->user()->profile_url }}" alt="{{ auth()->user()->name }}"
                            class="img-thumbnail img-fluid" id="imageUserPreview" style="max-width: 300px">
                    </div>
                </div>
                <button type="submit" form="form-update-profile" class="btn btn-success"><i class="bi bi-person-circle"></i> Update Profile</button>
                <a href="{{ route('change.password') }}" class="btn btn-info"><i class="bi bi-eye-slash"></i> Change Password</a>
            </form>
        </div>
        <div class="card-footer">
           
            
        </div>
    </div>
</div>

@endsection