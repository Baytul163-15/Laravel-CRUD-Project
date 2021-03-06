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
                                <a href="{{ route('add.about') }}"><button style="float:right" class="btn btn-info">Add About</button></a>
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
                        <div class="card-header bg-dark" style="color: white">All About Data</div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="10%">SI NO</th>
                                    <th scope="col" width="20%">Home Title</th>
                                    <th scope="col" width="25%">Short Description</th>
                                    <th scope="col" width="30%">Long Description</th>
                                    <th scope="col" width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>   
                                @php($i = 1)                       
                                @foreach($homeabout as $about)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $about->title }}</td>
                                    <td>{{ $about->short_des }}</td>
                                    <td>{{ $about->long_des }}</td>
                                    <td>
                                        <a href="{{ url('about/edit/'.$about->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ url('about/delete/'.$about->id) }}" onclick="return confirm('Are you sure to delete')" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                            {{ $homeabout->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

