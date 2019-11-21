@inject('userInfo', 'App\Models\Users\UserModel')
@extends('dashboard.template')

@section('main-content')
    <!-- Main Content -->
    <!-- Sing in  Form -->
    <section class="sign-in">
        <div class="container" style="border-radius: 0; margin-top: -5%;">
            <div class="row" id="row-content">

                <div class="col-lg-12">
                    <h3>Welcome, {{ $data['name'] }} <span class="pull-right"><a href="{{ url('/logout') }}">Logout</a> </span></h3>
                    <p><small>List of Pending leave request</small></p>
                </div>
                <hr />

                @if(empty($pendingRequests))
                    <h1>No More Request</h1>
                @endif

                @foreach($pendingRequests as $item)
                    <p style="line-height: 30px;">
                        {{ $userInfo->find($item->user_id)->name }}
                        requested for a leave of
                        <b>{{ $item->days_count }} days</b>

                        to start from <b>{{ $item->start_date }}</b>
                        to <b>{{ $item->end_date }}</b>

                    </p>
                    <form method="POST" action="{{ url('/accept-leave') }}" id="accept-form">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <input type="hidden" name="user_id" value="{{ $item->user_id }}">
                        <input type="hidden" name="days_count" value="{{ $item->days_count }}">
                        <input type="hidden" name="start_date" value="{{ $item->start_date }}">
                        <input type="hidden" name="end_date" value="{{ $item->end_date }}">

                        <a href="#" onclick="document.getElementById('accept-form').submit()">Approve Leave</a>
                        &nbsp;
                        <a href="decline-leave/{{ $item->id }}" style="color: red;" class="btn btn-primary btn-sm">Decline Leave</a>
                    </form>
                    <hr />

                @endforeach

            </div>
        </div>
    </section>
    
@endsection