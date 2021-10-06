@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit role {{$role->name}}</div>

                <div class="card-body">
                    <form action="{{ route('roles.update', $role->id) }}" method="POST">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $role->name }}" required autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">Permissions</label>
                            <div class="col-md-6">
                                @foreach ($permissions as $permission)
                                    <div class="form-check">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            @if($role->permissions->pluck('id')->contains($permission->id)) checked @endif>
                                        <label for="">{{ $permission->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
