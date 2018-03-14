@extends('layouts.app')






@section('content')


<section id="wrapper">
        <div class="login-register" style="background-image:url(img/login-register.jpg);">
            <div class="login-box card">
                <div class="card-body">
                    <div>
                        <center>
                            <img src="img/logo.png" style="height: 100px; width: 100px;">
                            <h3 class="box-title m-b-20">Deright Events SMS Client</h3>
                        </center>
                    </div>
                    <hr>

                   

                    <form class="form-horizontal form-material" id="loginform" action="{{ route('register') }}" method="POST">
                        {{ csrf_field() }}

                        <h3 class="box-title m-b-20">Create SMS account</h3>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="col-xs-12">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus placeholder="Name">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-xs-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Email">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                           
                            <div class="col-xs-12">
                                <input id="password" type="password" class="form-control" name="password" required placeholder="Password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            

                            <div class="col-xs-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm password">
                            </div>
                        </div>

                        
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Sign Up</button>
                            </div>
                        </div>
                        <div class="form-group m-b-0">
                            <div class="col-sm-12 text-center">
                                <p>Already have an account? <a href="{{ route('login')}}" class="text-info m-l-5"><b>Sign In</b></a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>







@endsection
