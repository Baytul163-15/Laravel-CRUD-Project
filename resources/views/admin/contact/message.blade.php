@extends('admin.admin_master')
@section('admin')
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                </div>
                <div class="col-md-12 mt-3">
                    <div class="card">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                        <div class="card-header bg-dark" style="color: white">All Customer Messages</div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="10%">SI NO</th>
                                    <th scope="col" width="20%">Customer Name</th>
                                    <th scope="col" width="15%">Customer Email</th>
                                    <th scope="col" width="20%">Customer Subject</th>  
                                    <th scope="col" width="20%">Customer Message</th>
                                    <th scope="col" width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>   
                                @php($i = 1)                       
                                @foreach($messages as $msg)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $msg->name }}</td>
                                    <td>{{ $msg->email }}</td>
                                    <td>{{ $msg->subject }}</td>
                                    <td>{{ $msg->message }}</td>
                                    <td>
                                        <a href="{{ url('message/delete/'.$msg->id) }}" onclick="return confirm('Are you sure to delete')" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                            {{ $messages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

