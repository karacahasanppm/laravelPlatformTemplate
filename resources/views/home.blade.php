@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if($role === 'superadmin')
                        {{ __('You are logged in superadmin panel') }} <br>
                    @else
                        {{ __('You are logged in ' . $firm['name'] . ' Your Role is ' . $role) }} <br>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
