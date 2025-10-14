@extends('layouts.front')
@section('content')
<?php 
     $id=session()->get('student_id');
     $name=session()->get('student_name');
?>

<div class="page-banner-area item-bg4">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-banner-content">
                    <h2>Change Password</h2>
                    <ul>
                        <li>
                            <a href="{{route('FrontIndex')}}">Home</a>
                        </li>
                        <li>Change Password</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Banner -->
<section class="event-area bg-ffffff pt-100 pb-70">
    <div class="container">
        <div class="row">
            @include('common.alert')
            <div class="col-lg-3 left-menu pt-70">
                <ul>
                    <li>
                        <a href="{{route('student_profile')}}" >Student Profile</a>
                    </li>
                    <li>
                        <a href="{{route('student_dashboard')}}" >Dashboard</a>
                    </li>
                    <li>
                        <a href="{{route('student_active_plan')}}">Current Active Plan</a>
                    </li>
                    <li>
                        <a href="{{route('student_testimonial')}}">Add Testimonial</a>
                    </li>
                    <li>
                        <a href="{{route('changepassword')}}" class="active">Change Password</a>
                    </li>
                     <li>
                        <a href="{{route('FrontStudentLogout')}}">Logout</a>
                    </li>
                </ul>
            </div>
                                    

            <div class="col-lg-9">
                <div class="section-title">
                    <span>Change Password</span>
                    <!--<h2>Student </h2>-->
                </div>

                <div class="event-box-item">
                    <div class="row align-items-center">
					<form action="{{ route('changepasswordsubmit') }}" method="post" class="form" >
         					@csrf
						<div class="form-group mb-2">
							Current Password<span style="color:red";>*</span>
							<input  type="password" class="form-control" placeholder="Enter Current Password" name="current_password">
						</div>

						<div class="form-group mb-2">
							New Password<span style="color:red";>*</span>
							<input type="password" class="form-control" placeholder="Enter New Password" name="newpassword">
						</div>
						 @error('newpassword')
		                    <span class="text-danger">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                	@enderror
               				
						<div class="form-group mb-2">
							Confirm Password<span style="color:red";>*</span>
							<input type="password" class="form-control" placeholder="Enter Confirm Password" name="confirmpassword">
						</div>
						@error('confirmpassword')
		                    <span class="text-danger">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror
					<button type="submit" class="default-btn"> Submit Now </button>
            		</form>
       		   </div>
  			</div>
		</div>
	 </div>
	</div>
</section>
@endsection

