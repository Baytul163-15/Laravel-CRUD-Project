@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card-group">
                    @foreach($images as $multi)
                    <div class="col-md-3 mt-5 m-4">
                        <div class="card">
                            <img src="{{ asset($multi->image) }}" alt="">
                            <div class=" gap-2  text-center mt-2">
                                <a href="{{ route('add.service') }}"><button  class="btn btn-info btn-sm">Edit</button></a>
                                <a href="{{ route('add.service') }}"><button  class="btn btn-danger btn-sm">Delete</button></a>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Multi Image</div>
                        <div class="card-body">
                            <form action="{{ route('store.image') }}" method="POST" enctype="multipart/form-data" >
                                @csrf
                                <div class="mb-3">
                                    <label for="image" class="form-label">Brand Image</label>
                                    <input type="file" class="form-control" name="image[]" id="exampleInputEmail1" aria-describedby="emailHelp" multiple="">

                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Add Image</button>
                            </form>
                        </div>
                    </div>
                </div>        
            </div>
        </div>
    </div>
@endsection
