@extends('layouts.front')
@section('content')
<!-- Start Page Banner -->
<div class="page-banner-area item-bg4">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-banner-content">
                    <h2>Registration</h2>
                    <ul>
                        <li>
                            <a href="{{route('FrontIndex')}}">Home</a>
                        </li>
                        <li>Registration</li>
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
          <span>Registration</span>
          <h2>Join us</h2>
        </div>
        <div class="row">
        
        </div>
        
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="">
              <img src="{{ asset('front/assets/images/register.jpg')}}" />
            </div>
          </div>
          <div class="col-lg-6">
            <div class="quote-item">
              <div class="content">
                <span>Join Us Now!</span>
                <h3>Register Now</h3>
              </div>
              <form method="post" action="{{ route('contactStore') }}" id="myForm">
              <!--<form method="post" action="{{ route('student_registration') }}">-->
                @csrf
                <input type="hidden" id="batchId" value="{{$batchId}}">
                <input type="hidden" id="planId" value="{{$planId}}">
                
               <div class="form-group">
                  <input type="text" class="form-control" name="student_first_name" id="student_first_name" placeholder="Student First Name*" minlength="3"  maxlength="20" value="" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')"  required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="student_last_name" id="student_last_name" placeholder="Student Last Name*" minlength="3"  maxlength="20" value="" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')"  required>
                </div>
                 <div class="form-group">
                  <input type="number" class="form-control" name="student_age" placeholder="Kids Age*"  max="99" min="0" oninput="if(this.value.length > 2) this.value = this.value.slice(0, 2);" value="{{ old('student_age') }}" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="parent_name" id="parent_name" placeholder="Parents Name*" maxlength="100" value="" minlength="3"  oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')"  required>
                  <p class="error" id="error2" style="color:red"></p>
                </div>
                <div class="form-group">
                  <input type="tel" class="form-control" name="mobile" placeholder="Your Phone*" minlength="10" maxlength="10" value="{{ old('mobile') }}" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="email" placeholder="Email Address*" maxlength="150" value="{{ old('email') }}" required>
                </div>
                <div class="form-group">
                 <select class="form-control" aria-label="Default select Class" name="category_id" id="category_id" required>
                    <option value="">Age group *</option>
                    @foreach($category as $c)
                        <option value="{{ $c->category_id }}" {{ $c->category_id == $categoryId || old('category_id') == $c->category_id ? 'selected' : '' }}>{{ $c->category_name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                 <select class="form-control" aria-label="Default select Class" name="plan_id" id="plan_id" required>
                    <option value="">Select Plan *</option>
                  </select>
                </div>

                <div class="form-group">
                 <select class="form-control" aria-label="Default select Class" name="batch_id" id="batch_id" required>
                    <option value="">Preferred Day *</option>
                  </select>
                </div>
                <div class="form-group">
                    <select class="form-control" aria-label="Default select Class" name="communication_mode" id="communication_mode" required>
                            <option value="">Contact Preference *</option>
                            <option value="1" {{ old('communication_mode')==1 ? 'selected' :'' }}>Whats App</option>
                            <option value="2" {{ old('communication_mode')==2 ? 'selected' :'' }}>Email</option>
                            <option value="3" {{ old('communication_mode')==3 ? 'selected' :'' }}>Text SMS</option>
                    </select>
                </div>
                <!-- <div class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">

                      <label for="password" class="col-md-4 control-label">Captcha</label>



                      <div class="col-md-6">

                          <div class="captcha">

                          <span>{!! captcha_img() !!}</span>

                          <button type="button" class="btn btn-success btn-refresh"><i class="fa fa-refresh"></i></button>

                          </div>

                          <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">



                          @if ($errors->has('captcha'))

                              <span class="help-block">

                                  <strong>{{ $errors->first('captcha') }}</strong>

                              </span>

                          @endif

                      </div>

                  </div> -->
                
                
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script>
    $(".btn-refresh").click(function(){

  $.ajax({

     type:'GET',

     url:'./refresh_captcha',

     success:function(data){

        $(".captcha span").html(data.captcha);

     }

  });

});
  document.querySelector('input[name="student_age"]').addEventListener('input', function (e) {
    if (this.value < 0) {
      this.value = 0;
    }
  });

    $(document).ready(function() 
    {

     $("#myForm").validate({
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

    // Get initial values for category_id, batch_id, and plan_id
    var selectedCategoryId = $('#category_id').val(); // Get selected category ID from the dropdown
    var selectedBatchId = $('#batchId').val(); // Add a custom attribute for selected batch ID
    var selectedPlanId = $('#planId').val(); // Add a custom attribute for selected plan ID

    // Function to fetch and populate the batch dropdown
    function fetchBatches(categoryid, selectedBatchId) {
        $.ajax({
            url: './get-batch/' + categoryid,
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('#batch_id').empty();
                $('#batch_id').append('<option value="">Select Day</option>');
                $.each(data, function(key, value) {
                    const isSelected = value.batch_id == selectedBatchId ? 'selected' : '';
                    $('#batch_id').append('<option value="'+ value.batch_id +'" '+ isSelected +'>'+ value.batch_name +'</option>');
                });
            }
        });
    }

    // Function to fetch and populate the plan dropdown
    function fetchPlans(categoryid, selectedPlanId) {
        $.ajax({
            url: './get-plan/' + categoryid,
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('#plan_id').empty();
                $('#plan_id').append('<option value="">Select Plan</option>');
                $.each(data, function(key, value) {
                    const isSelected = value.planId == selectedPlanId ? 'selected' : '';
                    $('#plan_id').append('<option value="'+ value.planId +'" '+ isSelected +'>'+ value.plan_name +'</option>');
                });
            }
        });
    }

    // Populate dropdowns on category change
    $('#category_id').change(function() {
        var categoryid = $(this).val();
        if (categoryid) {
            fetchBatches(categoryid, null); // No pre-selected value on change
            fetchPlans(categoryid, null);
        } else {
            $('#batch_id').empty().append('<option value="">Select Day</option>');
            $('#plan_id').empty().append('<option value="">Select Plan</option>');
        }
    });

    // Populate dropdowns on page load if category_id has a value
    if (selectedCategoryId) {
        fetchBatches(selectedCategoryId, selectedBatchId);
        fetchPlans(selectedCategoryId, selectedPlanId);
    }

});

</script>
@endsection