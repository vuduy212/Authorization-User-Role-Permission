@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Permissions
                    @can('permission.create')
                    <a href="{{ route('permissions.create') }}" class="btn btn-primary">Create New Permission</a>
                    @endcan
                </div>
                <form action="{{ route('permissions.index') }}" method="GET" class="md-3 d-flex">
                    <input type="text" class="form-control" name="key" value="{{request('key')}}">
                    <button class="btn btn-primary" type="submit">Search</button>
                </form>
                <div class="card-body">

                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                            <th scope="col">Options</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                            <tr>
                                <th scope="row">{{$permission->id}}</th>
                                <td>{{$permission->name}}</td>
                                <td>{{$permission->action}}</td>
                                <td>
                                    @can('permission.view')
                                    <a href="{{ route('permissions.show', $permission->id) }}"><button type="button" class="btn btn-success">DETAIL</button></a>
                                    @endcan
                                    @can('permission.update')
                                    <a href="{{ route('permissions.edit', $permission->id) }}"><button type="button" class="btn btn-warning">EDIT</button>
                                    @endcan
                                    @can('permission.delete')
                                    <form action="{{ route('permissions.destroy', $permission) }}" method="POST" class="float-left">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">DELETE</button>
                                    </form>
                                    @endcan
                                </td>
                              </tr>
                            @endforeach
                        </tbody>
                      </table>
                      {{$permissions->appends(request()->only('key','number'))->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
