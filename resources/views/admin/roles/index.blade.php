@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Roles
                    @create
                    <a href="{{ route('roles.create') }}" class="btn btn-primary">Create New Role</a>
                    @endif
                </div>
                <form action="{{ route('roles.index') }}" method="GET" class="md-3 d-flex">
                    <input type="text" class="form-control" name="key" value="{{request('key')}}">
                    <button class="btn btn-primary" type="submit">Search</button>
                </form>
                <div class="card-body">

                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Permissions</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                <th scope="row">{{$role->id}}</th>
                                <td>{{$role->name}}</td>
                                <td>{{ implode(', ', $role->permissions()->get()->pluck('name')->toArray()) }}</td>
                                <td>
                                    @view
                                    <a href="{{ route('roles.show', $role->id) }}"><button type="button" class="btn btn-success">DETAIL</button></a>
                                    @endif
                                    @update
                                    <a href="{{ route('roles.edit', $role->id) }}"><button type="button" class="btn btn-warning">EDIT</button>
                                    @endif
                                    @delete
                                    <form action="{{ route('roles.destroy', $role) }}" method="POST" class="float-left">
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
                      {{$roles->appends(request()->only('key','number'))->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
