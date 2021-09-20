<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hi...<b>{{ Auth::user()->name }}</b>
            <button type="button" class="btn btn-deafult position-relative" style="float: right;">
                total Users
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ count($users) }}
                    <span class="visually-hidden">unread messages</span>
                </span>
            </button>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">SI NO</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Create at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach($users as $user)
                        <tr>
                        <th scope="row">{{$i++}}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{$user->email}}</td>
                        <td>{{Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
