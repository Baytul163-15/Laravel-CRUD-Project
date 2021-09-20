@extends('admin.admin_master')
@section('admin')

    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Create Contact Data</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('store.contact') }}" method="POST">
                @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Contact Address</label>
                        <input type="Text" name="address" class="form-control" id="exampleFormControlInput1" placeholder="Contact Address">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Contact Email</label>
                        <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="Contact Email">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Contact Call</label>
                        <input type="text" name="call" class="form-control" id="exampleFormControlInput1" placeholder="Contact Call">
                    </div>
                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Add Contact Data</button>
                    </div>
                </form>
            </div>
        </div> 
    </div>

@endsection