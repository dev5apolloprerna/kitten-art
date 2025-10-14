@extends('layouts.front')
@section('content')
<!-- Start Page Banner -->
<div class="page-banner-area item-bg4">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-banner-content">
                    <h2>Student Profile</h2>
                    <ul>
                        <li>
                            <a href="{{route('FrontIndex')}}">Home</a>
                        </li>
                        <li>Student Profile</li>
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
                        <a href="{{route('student_profile')}}" class="active">Student Profile</a>
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
                        <a href="{{route('changepassword')}}">Change Password</a>
                    </li>
                     <li>
                        <a href="{{route('FrontStudentLogout')}}">Logout</a>
                    </li>
                </ul>
            </div>
                                    

            <div class="col-lg-9">
                <div class="section-title">
                    <span>Student Profile</span>
                    <!--<h2>Student </h2>-->
                </div>

                <div class="event-box-item">
                    <div class="row align-items-center">

                      <form method="post" action="{{route('student_update')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="student_id" value="{{$id}}">
                        <div class="form-group mb-2">Student First Name <span style="color:red";>*</span>
                          <input type="text" class="form-control" name="student_fist_name" value="{{ $Student->student_first_name }}"  placeholder="Student Name*" required>
                      </div>

                      <div class="form-group mb-2">Parent Name<span style="color:red";>*</span>
                          <input type="text" class="form-control" name="parent_name"  value="{{ $Student->parent_name }}"  placeholder="Parent Name*" required>
                      </div>
                      
                      <div class="form-group mb-2">Student Age<span style="color:red";>*</span>
                          <input type="text" class="form-control" name="student_age"  value="{{ $Student->student_age }}"  placeholder="Parent Name*" required>
                     </div>

                      <div class="form-group mb-2">Mobile<span style="color:red";>*</span>
                          <input type="text" class="form-control" name="mobile"  value="{{ $Student->mobile }}"  placeholder="Parent Name*" required>
                     </div>
                      <div class="form-group mb-2">Email<span style="color:red";>*</span>
                          <input type="text" class="form-control" name="email"  value="{{ $Student->email }}"  placeholder="Parent Name*" required>
                     </div>
                     <div class="form-group mb-2">Communication Mode<span style="color:red;">*</span>
                         <select class="form-control" name="communication_mode" id="communication_mode" required>
                                <option value="">Select Mode</option>
                                <option value="1" {{ $Student->communication_mode == 1 ? 'selected' : '' }}>Whats App</option>
                                <option value="2" {{ $Student->communication_mode == 2 ? 'selected' : '' }}>Email</option>
                                <option value="3" {{ $Student->communication_mode == 3 ? 'selected' : '' }}>Text SMS</option>
                        </select>
                        @if($errors->has('communication_mode'))
                            <span class="text-danger">
                                {{ $errors->first('communication_mode') }}
                            </span>
                        @endif
                     </div>
                     <button type="submit" class="default-btn"> Submit Now </button>
                 </form>
             </div>
         </div>
     </div>
 </div>
 </div>
</section>
@endsection
@section('scripts')
<script type="text/javascript">
      document.querySelector('input[name="student_age"]').addEventListener('input', function (e) {
    if (this.value < 0) {
      this.value = 0;
    }
  });
</script>
@endsection