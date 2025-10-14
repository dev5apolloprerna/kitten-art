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

                    <h2>Forgot Password</h2>
                                    @include('common.alert')

                    <form action="{{route('forgotpasswordsubmit')}}" method="post">
                        @csrf

                        <div class="form-group">
                            <label>Email <span style="color:red">*</span></label>
                            <input type="text" class="form-control" name="email" placeholder="Enter Register Email" required>
                        </div>

                        <button type="submit">Send Mail</button>
                    </form>

                    <div class="important-text">
                        <p>Don't have an account? <a href="{{route('FrontRegistration')}}">Register now!</a></p>
                    </div>
                </div>
            </div>
        </section>





@endsection