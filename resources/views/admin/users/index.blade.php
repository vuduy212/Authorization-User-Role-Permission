@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Users
                    @create
                    <a href="{{ route('users.create') }}" class="btn btn-primary">Create New User</a>
                    @endif
                </div>
                <form action="{{ route('users.index') }}" method="GET" class="md-3 d-flex">
                    <input type="text" class="form-control" name="key" value="{{request('key')}}">
                    <button class="btn btn-primary" type="submit">Search</button>
                </form>
                <div class="card-body">

                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Roles</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{$user->id}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                                <td>
                                    @view
                                    <a href="{{ route('users.show', $user->id) }}"><button type="button" class="btn btn-success">DETAIL</button></a>
                                    @endif
                                    @update
                                    <a href="{{ route('users.edit', $user->id) }}"><button type="button" class="btn btn-warning">EDIT</button>
                                    @endif
                                    @delete
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="float-left">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">DELETE</button>
                                    </form>
                                    @endif
                                </td>
                              </tr>
                            @endforeach
                        </tbody>
                      </table>
                      {{$users->appends(request()->only('key','number'))->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
