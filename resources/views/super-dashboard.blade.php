@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('SuperUser Dashboard') }}
                        <button type="button" class="btn btn-primary" onclick="location.href='{{ route('createSuperUserPage') }}'" style="float: right;margin-left: 10px">Create Super User</button>
                        <button type="button" class="btn btn-primary" onclick="location.href='{{ route('createFirmPage') }}'" style="float: right;margin-left: 10px">Create Firm</button>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{ __('Select the company to manage') }} <br>
                            <form action="{{ route('superuserDashboard',[Auth::user()->id]) }}" method="get" style="margin-top: 10px">
                                <div class="row">
                                    <div class="col-md-10">
                                        <input type="text" class="form-control mb-3" placeholder="Firm or FirmId" name="q" value="{{app('request')->input('q')}}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="submit" class="form-control mb-3" value="Search">
                                    </div>
                                </div>
                            </form>
                            <table class="table table-striped">
                                <thead>
                                <th scope="col">Id</th>
                                <th scope="col">Firm</th>
                                <th scope="col">Operate</th>
                                </thead>
                                <tbody>
                                @foreach($firms as $firm)
                                    <tr>
                                        <td>{{$firm->id}}</td>
                                        <td>{{$firm->name}}</td>
                                        <td>
                                            <a target="_blank" href='{{ route('superuserAssignFirm',[$firm->id,Auth::user()->id]) }}' type="button" class="btn btn-primary">Manage</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $firms->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
