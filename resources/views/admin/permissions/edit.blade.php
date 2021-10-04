@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit permission {{$permission->name}}</div>

                <div class="card-body">
                    <form action="{{ route('permissions.update', $permission->id) }}" method="POST">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $permission->name }}" required autofocus>
                                @error('name')
                                    <span class="invalid-feedback" permission="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <br> <br>
                            <label for="action" class="col-md-4 col-form-label text-md-right">Action</label>
                            <div class="col-md-6">
                                <input id="action" type="action" class="form-control @error('action') is-invalid @enderror" name="action" value="{{ $permission->action }}" required autofocus>
                                @error('action')
                                    <span class="invalid-feedback" permission="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @csrf
                        @method('PUT')
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
