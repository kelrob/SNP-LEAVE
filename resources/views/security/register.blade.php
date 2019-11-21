@extends('security.template')

@section('form')
    <!-- Sign up form -->
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">Sign up</h2>
                    <form method="POST" action="{{ url('/register') }}" class="register-form" id="register-form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="name" id="name" placeholder="Your Name"/>
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email" placeholder="Your Email"/>
                        </div>
                        <div class="form-group">
                            <label for="password"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="password" placeholder="Password"/>
                        </div>
                        <div class="form-group">
                            <label for="role"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <select name="role" class="zmdi zmdi-account" style="font-family: Poppins;" id="role" required>
                                <option value="">Select role</option>
                                @foreach ($data['roles'] as $roles)
                                    <option value="{{ $roles->id }}">{{ $roles->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group form-button">

                            <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <h1>WELCOME</h1>
                    <hr />
                    <a href="{{ url('/') }}">Login</a>
                </div>
            </div>
        </div>
    </section>
@endsection