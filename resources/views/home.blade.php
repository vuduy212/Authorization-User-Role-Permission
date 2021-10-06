@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User Management based on Roles and Permissions') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @super
                        {{ __('Welcome Super Admin to Index !!') }}
                    @else
                        {{ __('Welcome Normal User to Index !!') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
