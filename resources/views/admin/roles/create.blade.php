@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Role</div>
                <div class="card-body">
                    <form action="{{ route('roles.store') }}" method="POST">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" required autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @csrf
                        @method('POST')
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">Permissions</label>
                            <div class="col-md-6">
                                @foreach ($permissions as $permission)
                                    <div class="form-check">
                                        <input type="checkbox" name="permissions[{{$permission->action}}]" value="{{ $permission->id }}">
                                        <label for="">{{ $permission->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Create
                        </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
