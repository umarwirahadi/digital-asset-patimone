@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="card card-success card-outline mb-4">
        <div class="card-header">
            <div class="card-title">Change Password</div>
        </div>
        <div class="card-body">
            <form action="{{ route('change.password.action',auth()->user()->id) }}" id="form-change-password" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 offset-2">
                        <div class="row mb-3">
                            <label for="name" class="col-sm-4 col-form-label">Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control"value="{{ auth()->user()->name }}" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="current_password" class="col-sm-4 col-form-label">Current Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password">
                                @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-sm-4 col-form-label">New Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" autocomplete="off">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password_confirmation" class="col-sm-4 col-form-label">Confirm new Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="off">
                            </div>
                        </div>
                    </div>                    
                </div>
            </form>

        </div>
        <div class="card-footer">
            <button type="submit" form="form-change-password" class="btn btn-success"><i class="bi bi-eye-slash"></i> Change Password</button>
            <a href="{{ route('my.profile') }}"  class="btn btn-warning"><i class="bi bi-person-circle"></i> My Profile</a>
            <a href="/"  class="btn btn-danger"><i class="bi bi-house-door"></i> Home</a>
        </div>
    </div>
</div>

@endsection