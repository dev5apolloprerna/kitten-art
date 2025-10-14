@extends('layouts.front')
@section('content')
<!-- Start Page Banner -->
<div class="page-banner-area item-bg4">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-banner-content">
                    <h2>Login</h2>
                    <ul>
                        <li>
                            <a href="{{route('FrontIndex')}}">Home</a>
                        </li>
                        <li>Login</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Banner -->
               

<section class="login-area ptb-100">
            <div class="container">
                <div class="login-form">
                    <h2>Login</h2>
 @include('common.alert')
                    <form action="{{route('FrontStudentLogin')}}" method="post">
                        @csrf
                        <!-- <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" placeholder="Username">
                        </div> -->

                        <div class="form-group">
                            <label>Login Id</label>
                            <input type="text" class="form-control" name="loginId" placeholder="Login Id">
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>

                        <div class="row align-items-center">
                           
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <button type="submit" class="default-btn w-50">Login</button>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 lost-your-password text-right">
                                <a href="{{route('forgotpassword')}}" class="lost-your-password">Forgot your password?</a>
                            </div>

                        </div>

                        
                    </form>

                    <div class="important-text">
                        <p>Don't have an account? <a href="{{route('FrontRegistration')}}">Register now!</a></p>
                    </div>
                </div>
            </div>
        </section>





@endsection