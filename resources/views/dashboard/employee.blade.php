@extends('dashboard.template')

@section('main-content')
    <!-- Main Content -->
    <!-- Sing in  Form -->
    <section class="sign-in">
        <div class="container" style="border-radius: 0; margin-top: -5%;">
            <div class="row" id="row-content">

                @isset($_GET['success'])
                    <div id="success">Leave Request Submitted Successfully</div>
                @endisset

                <div class="col-lg-12">
                    <h3>Welcome, {{ $data['name'] }} <span class="pull-right"><a href="{{ url('/logout') }}">Logout</a> </span></h3>
                    <p> <small>You have <b>{{ $data['days_left'] }} days left</b></small></p>
                </div>
                <hr />

                @if ( $data['request_count']  == 0)
                    <form method="post" action="{{ url('process-leave') }}" class="register-form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <p> Start Date of Leave</p>
                            <input type="date" id="start_date" name="start_date" placeholder="Start date of Leave">
                        </div>
                        <div class="form-group">
                            <p> End Date of Leave</p>
                            <input type="date" id="z_date" name="end_date" placeholder="End date of Leave">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="form-submit">
                        </div>
                    </form>
                @elseif ( $data['request_count'] > 0 )
                    <div id="info">You have a pending request on going</div>
                @endif

            </div>
        </div>
    </section>
    
@endsection