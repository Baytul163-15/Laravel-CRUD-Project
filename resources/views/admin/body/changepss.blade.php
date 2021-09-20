@extends('admin.admin_master')
@section('admin')
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Change Password</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('password.update') }}" method="POST" class="form-pill">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlPassword3">Current Password</label>
                    <input type="password" name="current_password" class="form-control" id="current_password" placeholder="Current Password">
                    @error('current_password')
                        <span class="text-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlPassword3">New Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="New Password">
                    @error('password')
                        <span class="text-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlPassword3">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm Password">
                    @error('password_confirmation')
                        <span class="text-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default">Update Password</button>
                </div>
            </form>
        </div>
    </div>
@endsection