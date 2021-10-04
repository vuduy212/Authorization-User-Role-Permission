@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$permission->name}} Detail</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">{{$permission->id}}</th>
                                <td>{{$permission->name}}</td>
                                <td>{{$permission->action}}</td>
                              </tr>
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
