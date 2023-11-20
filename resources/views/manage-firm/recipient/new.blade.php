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

                        <form method="post" action="{{route('createRecipient',[Auth::user()->firm_id])}}">
                            @csrf
                            <input id="recipient_id" name="recipient_id" hidden value="">
                            <div class="form-group row">
                                <label for="recipient_input" class="col-4 col-form-label">Recipient</label>
                                <div class="col-8">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fa fa-address-card"></i></span>
                                        <input id="recipient_input" name="recipient_input" type="text" required="required" class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="type_select" class="col-4 col-form-label">Type</label>
                                <div class="col-8">
                                    <select id="type_select" name="type_select" class="form-select">
                                        <option selected value="Email">Email</option>
                                        <option value="Sms">Sms</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="status_select" class="col-4 col-form-label">Allow Status</label>
                                <div class="col-8">
                                    <select id="status_select" name="status_select" class="form-select">
                                        <option selected value="1">True</option>
                                        <option value="0">False</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="consent_date_input" class="col-4 col-form-label">Consent Date</label>
                                <div class="col-8">
                                    <div class="input-group mb-3">
                                        <input id="consent_date_input" name="consent_date_input" type="text" required="required" class="form-control" value="" placeholder="e.g. 2023-01-01 00:00:00">
                                    </div>
                                </div>
                            </div>
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
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
