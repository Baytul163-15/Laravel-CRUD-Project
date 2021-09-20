@extends('admin.admin_master')
@section('admin')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('success')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Change Password</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('update.user.profile') }}" method="POST" class="form-pill">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlPassword3">User Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $user['name'] }}" placeholder="User Name">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlPassword3">User Email</label>
                    <input type="text" name="email" class="form-control" value="{{ $user['email'] }}" placeholder="User Email">
                </div>
                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
@endsection