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
                            <div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="users-tab">users</div>
                            <div class="tab-pane fade" id="recipients" role="tabpanel" aria-labelledby="recipients-tab">recipients</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
