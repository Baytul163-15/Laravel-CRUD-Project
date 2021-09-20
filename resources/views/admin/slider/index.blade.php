
@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class='row'>
                        <div class="col-md-10">
                        </div>
                        <div class="col-md-2">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('add.slider') }}"><button style="float:right" class="btn btn-info">Add Slider</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="card">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                        <div class="card-header bg-dark" style="color: white">All Slider</div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="10%">SI NO</th>
                                    <th scope="col" width="20%">Slider Title</th>
                                    <th scope="col" width="45%">Slider Description</th>
                                    <th scope="col" width="10%">Image</th>
                                    <th scope="col" width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>   
                                @php($i = 1)                       
                                @foreach($sliders as $slider)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->description }}</td>
                                    <td><img src="{{ asset($slider->image) }}" style="height: 40px; width:70"></td>
                                    <td>
                                        <a href="{{ url('slider/edit/'.$slider->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ url('slider/delete/'.$slider->id) }}" onclick="return confirm('Are you sure to delete')" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                            {{ $sliders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

