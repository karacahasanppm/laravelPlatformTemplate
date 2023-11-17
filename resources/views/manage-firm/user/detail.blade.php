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

                        <form method="post" action="{{route('updateUser')}}">
                            @csrf
                            <input id="user_id" name="user_id" hidden value="{{$user->id}}">
                            <div class="form-group row">
                                <label for="name-input" class="col-4 col-form-label">Name</label>
                                <div class="col-8">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fa fa-address-card"></i></span>
                                        <input id="name_input" name="name_input" type="text" required="required" class="form-control" value="{{$user->name}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email-input" class="col-4 col-form-label">Email</label>
                                <div class="col-8">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fa fa-at"></i></span>
                                        <input id="email_input" name="email_input" type="text" required="required" class="form-control" value="{{$user->email}}">
                                    </div>
                                </div>
                            </div>
                            @if(Auth()->user()->role === 'admin' || Auth()->user()->role === 'superuser')
                                <div class="form-group row">
                                    <label class="col-4 col-form-label">Role</label>
                                    <div class="col-8">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">{{$user->role}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="role_select" class="col-4 col-form-label">New Role</label>
                                    <div class="col-8">
                                        <select id="role_select" name="role_select" class="form-select">
                                            @if(Auth()->user()->role === 'admin' || Auth()->user()->role === 'superuser')
                                                <option disabled selected value="{{$user->role}}">{{$user->role}}</option>
                                                <option value="admin">admin</option>
                                                <option value="user">user</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group row mb-3">
                                <div class="offset-4 col-8">
                                    <button name="submit" type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                            @if (count($errors) > 0)
                                <div class = "alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
