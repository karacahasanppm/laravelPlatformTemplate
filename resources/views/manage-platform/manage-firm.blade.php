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
                        <form method="post" action="{{route('updateFirm',[$firm->id])}}">
                            @csrf
                            <div class="form-group row">
                                <label for="firm_id" class="col-4 col-form-label">Firm Id</label>
                                <div class="col-8">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fa fa-address-card"></i></span>
                                        <input id="firm_id" name="firm_id" type="text" required="required" readonly class="form-control" value="{{$firm->id}}">
                                    </div>
                                </div>
                                <label for="name-input" class="col-4 col-form-label">Firm Name</label>
                                <div class="col-8">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fa fa-address-card"></i></span>
                                        <input id="name_input" name="name_input" type="text" required="required" class="form-control" value="{{$firm->name}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="offset-4 col-8">
                                    <button name="submit" type="submit" class="btn btn-primary">Update</button>
                                    <a target="_blank" style="float:right" href='{{ route('deleteFirm',[$firm->id]) }}' type="button" class="btn btn-danger">Delete</a>
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
