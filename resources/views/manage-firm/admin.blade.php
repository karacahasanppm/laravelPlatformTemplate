@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Management') }}
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="users-tab" data-bs-toggle="tab" data-bs-target="#users" type="button" role="tab" aria-controls="users" aria-selected="true">Users</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="recipients-tab" data-bs-toggle="tab" data-bs-target="#recipients" type="button" role="tab" aria-controls="recipients" aria-selected="false">Recipient</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="users-tab">

                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email Address</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Operation</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->roles[0]['name']}}</td>
                                            <td>
                                                <a target="_blank" href='{{ route('userDetailPage',[$user->id]) }}' type="button" class="btn btn-primary">Manage</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4"><a target="_blank" href="{{route('createUserPage')}}" type="button" class="btn btn-primary" style="width: 100%">Add User</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="recipients" role="tabpanel" aria-labelledby="recipients-tab">
                                <table class="table table-striped">
                                    <thead>
                                        <th scope="col">Recipient Type</th>
                                        <th scope="col">Recipient</th>
                                        <th scope="col">Allow Status</th>
                                        <th scope="col">Consent Date</th>
                                    </thead>
                                    <tbody>
                                    @foreach($recipients as $recipient)
                                        <tr>
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
        </div>
    </div>

    <script>
        $(document).ready(function () {
            if({{!is_null(app('request')->input('page'))}}) {
                document.getElementById('users-tab').setAttribute('class','nav-link');
                document.getElementById('users-tab').setAttribute('aria-selected','false');
                document.getElementById('recipients-tab').setAttribute('class','nav-link active');
                document.getElementById('recipients-tab').setAttribute('aria-selected','true');
                document.getElementById('users').setAttribute('class','tab-pane fade');
                document.getElementById('recipients').setAttribute('class','tab-pane fade show active');
            }
        });
    </script>

@endsection
