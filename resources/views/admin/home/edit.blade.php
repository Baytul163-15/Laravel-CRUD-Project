@extends('admin.admin_master')
@section('admin')

    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Create About Data</h2>
            </div>
            <div class="card-body">
                <form action="{{ url('about/update/'.$homeabout->id) }}" method="POST">
                @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">About Title</label>
                        <input type="Text" name="title" class="form-control" value="{{ $homeabout->title }}" id="exampleFormControlInput1" placeholder="Write Title">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Short Description</label>
                        <textarea name="short_des" class="form-control" placeholder="Write Description" id="exampleFormControlTextarea1" rows="3">{{ $homeabout->short_des }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Long Description</label>
                        <textarea name="long_des" class="form-control" placeholder="Write Description" id="exampleFormControlTextarea1" rows="3">{{ $homeabout->long_des }}</textarea>
                    </div>
                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Update About Data</button>
                    </div>
                </form>
            </div>
        </div> 
    </div>

@endsection