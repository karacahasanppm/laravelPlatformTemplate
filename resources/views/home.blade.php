@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Dashboard') }}
                    @if($user->hasRole('SuperUser'))
                        <button type="button" class="btn btn-primary" onclick="location.href='{{ route('superuserDashboard') }}'" style="float: right;margin-left: 10px">Choose Firm</button>
                    @endif
                    @if($user->hasRole('Admin'))
                        <button type="button" class="btn btn-primary" onclick="location.href='{{ route('adminPage',[$user->firm_id]) }}'" style="float: right;margin-left: 10px">Manage Firm</button>
                    @elseif($user->hasPermissionTo('view recipient'))
                        <button type="button" class="btn btn-primary" onclick="location.href='{{ route('adminPage',[$user->firm_id]) }}'" style="float: right;margin-left: 10px">Inspect Recipients</button>
                    @endif
                    <button type="button" class="btn btn-primary" onclick="location.href='{{ route('profileDetailPage',[$user->firm_id,$user->id]) }}'" style="float: right">Profile</button>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('Welcome to ' . $user->firm()->value('name')) }} <br>

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">##</th>
                                <th scope="col">Recipient Type</th>
                                <th scope="col">Recipient</th>
                                <th scope="col">Allow Status</th>
                                <th scope="col">Consent Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($recipients as $recipient)
                                <tr>
                                    <th scope="row">{{$recipient->id}}</th>
                                    <td>{{$recipient->recipient_type}}</td>
                                    <td>{{$recipient->recipient}}</td>
                                    <td>{{$recipient->allow_status}}</td>
                                    <td>{{$recipient->consent_date}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $recipients->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
