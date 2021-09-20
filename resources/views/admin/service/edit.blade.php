@extends('admin.admin_master')
@section('admin')

    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Create About Data</h2>
            </div>
            <div class="card-body">
                <form action="{{ url('service/update/'.$homeservice->id) }}" method="POST">
                @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Service Title</label>
                        <input type="Text" name="sub_title" class="form-control" value="{{ $homeservice->sub_title }}" id="exampleFormControlInput1" placeholder="Write Title">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Service Description</label>
                        <textarea name="sud_des" class="form-control" placeholder="Write Description" id="exampleFormControlTextarea1" rows="3">{{ $homeservice->sud_des }}</textarea>
                    </div>
                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Update Service Data</button>
                    </div>
                </form>
            </div>
        </div> 
    </div>

@endsection