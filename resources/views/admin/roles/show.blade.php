@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Role {{$role->name}}</div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Permissions</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">{{$role->id}}</th>
                                <td>{{$role->name}}</td>
                                <td>{{ implode(', ', $role->permissions()->get()->pluck('name')->toArray()) }}</td>
                              </tr>
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
