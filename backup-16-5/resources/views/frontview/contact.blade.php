@extends('layouts.front')

@section('content')
<style>
    .readonly {
    pointer-events: none; /* Prevent clicking */
    background-color: #f1f1f1; /* Light gray background */
    color: #666; /* Dim text color */
}

</style>
<body>
  <div class="loading"></div>
</body>
<!-- Start Page Banner -->
<div class="page-banner-area item-bg4">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-banner-content">
                    <h2>Contact us</h2>
                    <ul>
                        <li>
                            <a href="{{route('FrontIndex')}}">Home</a>
                        </li>
                        <li>Contact us</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Banner -->

    @include('common.alert')

<!-- Contact Page Section -->

<section class="class-area bg-fdf6ed pt-100 pb-70">
    <div class="container">
        <div class="section-title">
            <span>Contact us</span>
            <h2>Get In Touch</h2>
        </div>
        <div class="row">

        </div>
        <div class="row clearfix">
            <!-- Form Column -->
            <div class="col-lg-6">
          <div class="contact-panel">
            <h4 class="mb-4">Get in touch</h4>
            <form method="post" action="{{ route('contactStore') }}" id="contactForm" novalidate>
                @csrf
              <div class="row">
                <div class="col-sm-6 mb-3 form-group-icon">
                <i class="bi bi-book"></i>
                  <select class="form-select" name="category_id" id="category_id">
                    <option value="">Age group</option>
                    @foreach($category as $c)
                        <option value="{{ $c->category_id }}"  {{ old('category_id') == $c->category_id ? 'selected' : '' }}>{{ $c->category_name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-sm-6 mb-3 form-group-icon">
                <i class="fa fa-bookmark"></i>
                  <select class="form-select" name="plan_id" id="plan_id">
                    <option value="">Select Plan</option>
                  </select>
                </div>

                <!-- <div class="col-sm-6 mb-3 form-group-icon">
                <i class="fa fa-thin fa-child"></i>
                  <select class="form-select" name="batch_id" id="batch_id">
                    <option value="">Preferred Day</option>
                    
                  </select>
                </div>  -->

                <div class="col-sm-6 mb-3 form-group-icon">
                  <i class="bi bi-person"></i>
                  <input type="text" class="form-control" name="student_first_name" id="student_first_name" placeholder="Student First Name" maxlength="20" value="{{ old('student_first_name') }}" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')"  required>
                <div class="error" id="error1" style="color:red"></div>
                </div>

                 <div class="col-sm-6 mb-3 form-group-icon">
                  <i class="bi bi-person"></i>
                  <input type="text" class="form-control" name="student_last_name" id="student_last_name" placeholder="Student Last Name" maxlength="20" value="{{ old('student_last_name') }}" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')"  required>
                <div class="error" id="error1" style="color:red"></div>
                </div>

                <div class="col-sm-6 mb-3 form-group-icon">
                  <i class="bi bi-person"></i>
                  <select class="form-control" name="student_age" id="student_age" required>
                    <option value="">Select Age</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                  </select>
<!--                   <input type="text" class="form-control" name="student_age" id="student_age" placeholder="Student Age" value="{{ old('student_age') }}" max="99" min="0" oninput="if(this.value.length > 2) this.value = this.value.slice(0, 2);" required>
 -->                </div>
                <div class="col-sm-6 mb-3 form-group-icon">
                  <i class="bi bi-person"></i>
                  <input type="text" class="form-control" name="parent_name" id="parent_name" placeholder="Parents Name" value="{{ old('parent_name') }}" maxlength="20" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')" required>
                <div class="error" id="error2" style="color:red"></div>
                </div>
                

                <div class="col-sm-6 mb-3 form-group-icon">
                  <i class="bi bi-envelope"></i>
                  <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" maxlength="150"  required>
                </div>
                


                <div class="col-sm-6 mb-3 form-group-icon">
                  <i class="bi bi-telephone"></i>
                  <input type="text" class="form-control" name="mobile" placeholder="Phone" value="{{ old('mobile') }}"  minlength="5" maxlength="10"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"required>
                </div>
                <div class="col-sm-6 mb-3 form-group-icon">
                  <i class="bi bi-list"></i>

                    <select class="form-control" aria-label="Default select Class" name="communication_mode" id="communication_mode" required>
                            <option value="">Contact Preference</option>
                            <option value="1">Whats App</option>
                            <option value="2">Email</option>
                            <option value="3">Text SMS</option>
                    </select>
                </div>
                   <!-- -->
           <!--  <div class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">

                      <label for="password" class="col-md-4 control-label">Captcha</label>



                      <div class="col-md-6">

                          <div class="captcha">

                          <span>{!! captcha_img() !!}</span>

                          <button type="button" class="btn btn-success btn-refresh"><i class="fa fa-refresh"></i></button>

                          </div>

                          <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha" required>



                          @if ($errors->has('captcha'))

                              <span class="help-block">

                                  <strong>{{ $errors->first('captcha') }}</strong>

                              </span>

                          @endif

                      </div>

                  </div> -->
                <div class="col-12">
                  <button type="submit" class="default-btn">Submit Request</button>
                </div>
              </div>
            </form>
          </div>
        </div>

            <div class="contact-column col-lg-5 col-md-12 col-sm-12 col-xs-12 d-flex">
                <div class="inner-column">
                    <ul class="contact-info">
                        <li>
                        <i class="fa fa-home " ></i>
                            
                            <strong>Locate us</strong>
                            <p> 
                            9308, Kitchin Farms Way, Wake Forest, 27587.</p>
                        </li>

                        <li>
                        <i class="fa fa-envelope " ></i>
                            <strong>Send your mail at</strong>
                            <p><a href="mailto:kittenart15@gmail.com">kittenart15@gmail.com</a></p>
                        </li>


                        <li>
                        <i class="fa fa-phone " ></i>
                            <strong>Call us at</strong>
                            <p>+1 (980) 254-5836</p>
                        </li>


                        <!-- <li>
                                <span class="icon flaticon-clock"></span> 
                                <strong>Working Hours</strong>
                                <p>Mon-Sat:9.30am to 7.00pm</p>
                            </li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Contact Section -->


<!-- Contact Map Section -->
<section class="contact-map-section">
    <div class="auto-container">
        <!--Map Outer-->
        <div class="map-outer">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2599.8000993471974!2d-78.53157132520006!3d35.926916911751164!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89ac50fddcbdc2f9%3A0x69fe7e6a23683b70!2s9308%20Kitchin%20Farms%20Wy%2C%20Wake%20Forest%2C%20NC%2027587%2C%20USA!5e1!3m2!1sen!2sin!4v1735284027718!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

        </div>
    </div>
</section>

    <div id="loader-overlay"></div>
    <div id="loader">
        <div class="spinner"></div>
    </div>

<!-- End Map Section -->
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
  // document.querySelector('input[name="student_age"]').addEventListener('input', function (e) {
  //   if (this.value < 0) {
  //     this.value = 0;
  //   }
  // });

    $(document).ready(function() 
    {
                $('#student_age').on('change', function () {
                    var age = parseInt($(this).val());
                    var categoryDropdown = $('#category_id');
                    var selectedCategory = '';
                    var isValidAge = false;

                    categoryDropdown.find('option').each(function () {
                        var categoryText = $(this).text().trim();
                        var match = categoryText.match(/(\d+)-(\d+)/); // Extract age range

                        if (match) 
                        {
                            var minAge = parseInt(match[1]);
                            var maxAge = parseInt(match[2]);

                            if (age >= minAge && age <= maxAge) 
                            {
                                selectedCategory = $(this).val();
                                isValidAge = true;

                            }
                        }
                    });

                if (isValidAge) {
                    categoryDropdown.val(selectedCategory).trigger('change');
                    categoryDropdown.addClass('readonly'); // Apply CSS to prevent clicking
                } else {
                    categoryDropdown.removeClass('readonly'); // Allow selection again
                }

            });
        
         $("#contactForm").validate({
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
            },
            student_age: {
                required: true,
            },
            mobile: {
                required: true,
            },email: {
                required: true,
            },category_id: {
                required: true,
            }
            ,plan_id: {
                required: true,
            },communication_mode: {
                required: true,
            }
        },
        messages: {
            student_first_name: {
                required: "Please Enter Student First Name",
                minlength: "Student first name must be at least 3 characters long",
                maxlength: "Student first name cannot be more than 20 characters"
            },
            student_last_name: {
                required: "Pleaes Enter Student Last Name",
                minlength: "Student last name must be at least 3 characters long",
                maxlength: "Student last name cannot be more than 20 characters"
            },
            parent_name: {
                required: "Please Enter Parent name",
                minlength: "Parent name must be at least 3 characters long",
                maxlength: "Parent name cannot be more than 20 characters"
            },
            student_age: {
                required:"Please Select Student Age",
            },mobile: {
                required:"Please Enter Mobile No",
            },email: {
                required:"Please Enter Email Address",
            },category_id: {
                required:"Please Select Age Group",
            },plan_id: {
                required:"Please Select Plan",
            },communication_mode: {
                required:"Please Select Contact Preference",
            }
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
            error.css("color", "red"); // Set error message color to red
            
        },
        submitHandler: function (form) {
            form.submit();
            $('section').addClass('blurred'); // Blur the page
            $('#loader-overlay').show();   // Show overlay
            $('#loader').show();           // Show spinner
            
            // Simulate processing delay
            setTimeout(() => {
                this.submit(); // Submit the form
            }, 2000);
        }


    });

            $('#category_id').change(function() {
                var categoryid = $(this).val();
                if(categoryid) 
                {
                    $.ajax({
                        url: './get-batch/' + categoryid,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('#batch_id').empty();
                            $('#batch_id').append('<option value="">Select Day</option>');
                            $.each(data, function(key, value) {
                            const weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                             $('#batch_id').append('<option value="'+ value.batch_id +'">'+ value.batch_name +'</option>');
                            //$('#batch_id').append('<option value="' + value.batch_id + '">'+ value.batch_name + ' (' + value.batch_from_time + ' to ' + value.batch_to_time + ' - ' + weekdays[value.batch_day - 1] + ')</option>');
                            });
                        }
                    });


                    $.ajax({
                        url: './get-plan/' + categoryid,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('#plan_id').empty();
                            $('#plan_id').append('<option value="">Select Plan</option>');
                            $.each(data, function(key, value) {
                                $('#plan_id').append('<option value="'+ value.planId +'">'+ value.plan_name +'</option>');
                            });
                        }
                    });
                } else {
                    $('#plan_id').empty();
                    $('#plan_id').append('<option value="">Select Day</option>');
                }
            });
        });
</script>
@endsection