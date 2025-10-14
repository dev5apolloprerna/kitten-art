@extends('layouts.front')
@section('content')
<?php 
  $id=session()->get('student_id');
?>

<!-- Start Page Banner -->
<div class="page-banner-area item-bg4">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-banner-content">
                    <h2>Event - Detail</h2>
                    <ul>
                        <li>
                            <a href="{{route('FrontIndex')}}">Home</a>
                        </li>
                        <li>Event - Detail</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Banner -->
@include('common.alert')

<section class="class-area bg-fdf6ed pt-100 pb-70">
      <div class="container">
        <div class="section-title">
          <span>Events</span>
          <h2>{{ $events->event_name }}</h2>
        </div>
        <div class="row">
            <div class="col-lg-5">
                <img src="{{ asset('Events/') . '/' . $events->image }}" alt="image">
            </div>
            <div class="col-lg-7">
                <div class="card single-class">
                
                <div class="card-body class-content">
                   <h4> Age : {{ $events->categoryName }}</h4>
              
                <ul class="class-list d-block">
                   <li>
                    <span>Location:</span> {{ $events->location }}
                  </li><br>
                  <li><span>Date: </span>  {{date('d-M-Y',strtotime($events->from_date)) }} - {{date('d-M-Y',strtotime($events->to_date)) ?? '-' }}</li><br>
                  <li><span>Time: </span>  {{date('h:i a',strtotime($events->from_time)) }} - {{date('h:i a',strtotime($events->to_time)) ?? '-' }}
                  </li><br>
                   <li><span>Capacity: </span>  {{ $events->capacity }}
                  </li><br> 
                  <li><span>Discounts: </span>  {{ $events->discounts }}
                  </li><br>
                  
                  <li>
                    <span>Instructors:</span> {{ $events->Instructors }}
                  </li>
                  <br>
                  <li>
                    <div class="class-btn">
                        @if(isset($id) && (!empty($id))) 
                        <a  href="#" id="registerButton" class="default-btn" data-bs-toggle="modal" data-bs-target="#eventRegister" style="border:none;">Register</a>
                        @else
                            <a  href="{{ route('FrontLogin') }}"  class="default-btn"  style="border:none;">Register</a>
                        @endif

                </div>
                  </li>
                      
            </div>
                
            </div>
            </div>
            <div class="col-lg-12">
                <div class="card single-class">
                
                    <div class="card-body class-content">
                       <h4> Description</h4>
                    </div>
                    <ul>

                    {!! $events->detail_description !!}<br><br>
                    </li>
                    </ul>
                    </ul>
                </div>
            </div>
        </div>
      </div>
    </section>

<div class="modal" id="eventRegister">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Fill this form for event registration</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <?php
          $student = App\Models\Student::where(['student_id' => $id])->first();
          if(isset($id) && (!empty($id))) {

         ?>
      <!-- Modal body -->
      <div class="modal-body">
            <form method="post" action="{{route('EventRegisteration')}}" id="myEventForm">
            @csrf
              <input type="hidden" name="student_id" value="{{ $id }}">
              <input type="hidden" name="category_id" value="{{$events->category_id}}">
              <input type="hidden" name="event_id" value="{{$events->event_id}}">
            
            <div class="form-group py-2"><label>Student First Name <span style="color:red;">*</span></label>
                <input type="text"  name="student_first_name" id="student_first_name" value="{{ $student->student_first_name }}" class="form-control" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')"  required> 
            </div>
            <div class="form-group py-2"><label>Student Last Name <span style="color:red;">*</span></label>
                <input type="text"  name="student_last_name" id="student_last_name" value="{{ $student->student_last_name }}" class="form-control" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')"  required> 
            </div>
            <div class="form-group py-2"><label>Student Age <span style="color:red;">*</span></label>
                <input type="text"  name="student_age" id="student_age" value="{{ $student->student_age }}" class="form-control" required> 
            </div>
            <div class="form-group py-2"><label>Parent Name <span style="color:red;">*</span></label>
                <input type="text" name="parent_name" id="parent_name" value="{{ $student->parent_name }}" class="form-control" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')"  required> 
            </div>

            <div class="form-group py-2"><label>Mobile <span style="color:red;">*</span></label>
                <input type="text"  name="mobile" id="mobile" value="{{ $student->mobile }}" maxlength="10" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control" required> 
            </div>

            <div class="form-group py-2"><label>Email <span style="color:red;">*</span></label>
                <input type="text"  name="email" id="email" value="{{ $student->email }}" class="form-control" required> 
            </div>
                  <!-- Modal footer -->
                  <!-- <div class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">

                      <label for="password" class="col-md-4 control-label">Captcha</label>



                      <div class="col-md-6">

                          <div class="captcha">

                          <span>{!! captcha_img() !!}</span>

                          <button type="button" class="btn btn-success btn-refresh"><i class="fa fa-refresh"></i></button>

                          </div>

                          <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">



                          @if ($errors->has('captcha'))

                              <span class="help-block" style="color:red;">

                                  <strong>{{ $errors->first('captcha') }}</strong>

                              </span>

                          @endif

                      </div>

                  </div> -->
              <div class="modal-footer">
                <button type="submit" class="btn btn-danger"> Submit Now </button> 
              </div>
            </form>
      </div>
  <?php }?>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script>
    
$(".btn-refresh").click(function(){
  $.ajax({

     type:'GET',

     url:'../refresh_captcha',

     success:function(data){

        $(".captcha span").html(data.captcha);

     }

  });

});

 $(document).ready(function() 
    {
      $("#myEventForm").validate({
            rules: {
                student_first_name: {
                    required: true,
                    minlength: 3,
                    maxlength: 20
                },
                student_last_name: {
                    required: true,
                    minlength: 3,
                    maxlength: 20
                },
                parent_name: {
                    required: true,
                    minlength: 3,
                    maxlength: 20
                }
            },
            messages: {
                student_first_name: {
                    required: "Student first name is required",
                    minlength: "Student first name must be at least 3 characters long",
                    maxlength: "Student first name cannot be more than 20 characters"
                },student_last_name: {
                    required: "Student last name is required",
                    minlength: "Student last name must be at least 3 characters long",
                    maxlength: "Student last name cannot be more than 20 characters"
                },
                parent_name: {
                    required: "Parent name is required",
                    minlength: "Parent name must be at least 3 characters long",
                    maxlength: "Parent name cannot be more than 20 characters"
                }
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element);
                error.css("color", "red"); // Set error message color to red
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
  });
</script>
@endsection