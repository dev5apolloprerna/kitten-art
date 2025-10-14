@extends('layouts.front')
@section('content')
<!-- BOM Start  -->

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
                    <h2>New Password</h2>
@include('common.alert')
                            <form id="myForm" action="{{ route('newpasswordsubmit') }}" method="post" class="form">
                            @csrf
                            <input type="hidden" name="token"value="{{ $token }}">
                                <div class="row">
                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label>New Password<span style="color:red">*</span></label>
                                             <input type="password" name="newpassword" id="newpassword" class="form-control" placeholder="Enter New Password"
                                                id="sfpassword" required>
                                                    @error('newpassword')
                                                        <span class="text-danger">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                        </div>  
                                       
                                    </div>
                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label>Confirm Password<span style="color:red">*</span></label>
                                           <input type="password" name="confirmpassword" class="form-control" placeholder="Enter Confirm Password"
                                                id="ccpassword" required>
                                                @error('confirmpassword')
                                                    <span class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                        @error('password')
                                        <span class="text-danger">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror
                                  </div>
                                  
                                  <div class="col-12">
                                    <div class="form-group button">
                                        <button type="submit" class="btn">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    
</section>
<!--/ End Contact -->

@endsection
