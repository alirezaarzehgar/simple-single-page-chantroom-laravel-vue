@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex">

            <div class="card w-25 Active">
                <div class="card-header">
                    <p class="text">Active Users</p>
                </div>

                <div id="app" class="card-body active_users">
                    <v-members user_id="{{ Auth::user()->id }}"></v-members>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-msg text">{{ __('Dashboard') }}</div>

                    <div id="app" class="card-body chat_container">
                        <v-messages user_id="{{ Auth::user()->id }}"></v-messages>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
