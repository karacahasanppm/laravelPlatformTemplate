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
                    @if($user->role === 'superadmin')
                        {{ __('You are logged in superadmin panel') }} <br>
                        {{ __($user->name) }} <br>
                        @foreach($firms as $firm)
                            {{$firm->name}} <br>
                        @endforeach
                    @else
                        {{ __('You are logged in ' . $user->firm()->value('name') . ' Your Role is ' . $user->role) }} <br>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
