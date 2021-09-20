<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           All Category <b></b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                        <div class="card-header bg-dark" style="color: white">All Category</div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SI NO</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Create at</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- @php($i=1) -->
                                @foreach($categories as $categorie)
                                <tr>
                                    <th scope="row">{{ $categories->firstItem()+$loop->index }}</th>
                                    <td>{{ $categorie->category_name }}</td}>
                                    <td>{{ $categorie->users->name }}</td>
                                    <td>
                                        @if($categorie->created_at == NULL)
                                            <span class="text-danger">No Data set</span>
                                        @else
                                            {{ Carbon\Carbon::parse($categorie->created_at)->diffForHumans() }} 
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('category/edit/'.$categorie->id) }}" class="btn btn-info">Edit</a>
                                        <!-- SoftDelete -->
                                        <a href="{{ url('softdelete/category/'.$categorie->id) }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                            {{ $categories->links() }}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Add Category</div>
                        <div class="card-body">
                            <form action="{{ route('store.category') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="category_name" class="form-label">Add Category</label>
                                    <input type="text" class="form-control" name="category_name" id="exampleInputEmail1" aria-describedby="emailHelp">

                                    @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Add Category</button>
                            </form>
                        </div>
                    </div>
                </div>        
            </div>
        </div>

        <!-- Trash Part -->
        <div class="container pt-5">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                    @if(session('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('message')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                        <div class="card-header bg-dark" style="color:white">Trash List</div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SI NO</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Create at</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- @php($i=1) -->
                                @foreach($trachCat as $categorie)
                                <tr>
                                    <th scope="row">{{ $categories->firstItem()+$loop->index }}</th>
                                    <td>{{ $categorie->category_name }}</td}>
                                    <td>{{ $categorie->users->name }}</td>
                                    <td>
                                        @if($categorie->created_at == NULL)
                                            <span class="text-danger">No Data set</span>
                                        @else
                                            {{ Carbon\Carbon::parse($categorie->created_at)->diffForHumans() }} 
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('category/restore/'.$categorie->id) }}" class="btn btn-info">Resore</a>
                                        <a href="{{ url('pdelete/category/'.$categorie->id) }}" class="btn btn-danger">Parmanent Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                            {{ $trachCat->links() }}
                    </div>
                </div>

                <div class="col-md-4">
                    
                </div>        
            </div>
        </div>
    </div>
</x-app-layout>
