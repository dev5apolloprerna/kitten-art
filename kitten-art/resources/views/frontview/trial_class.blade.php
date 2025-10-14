@extends('layouts.front')

@section('content')

<!-- Start Page Banner -->
<style type="text/css">
    .readonly {
    pointer-events: none; /* Prevent clicking */
    background-color: #f1f1f1; /* Light gray background */
    color: #666; /* Dim text color */
}

</style>
<body>
  <div class="loading"></div>
</body>

<div class="page-banner-area item-bg4">

    <div class="d-table">

        <div class="d-table-cell">

            <div class="container">

                <div class="page-banner-content">

                    <h2>Trial Class Registration</h2>

                    <ul>

                        <li>

                            <a href="{{route('FrontIndex')}}">Home</a>

                        </li>

                        <li>Trial Class Registration</li>

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

          <span>Trial Class Registration</span>

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

              <form method="post" action="{{ route('trialclass_registration') }}" id="tialForm">

                @csrf

                

               <div class="form-group">
                  <input type="text" class="form-control" name="student_first_name" id="student_first_name" placeholder="Student First Name*" minlength="3"  maxlength="20" value="{{ old('student_first_name') }}" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')"  required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="student_last_name" id="student_last_name" placeholder="Student Last Name*" minlength="3"  maxlength="20" value="{{ old('student_last_name') }}" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')"  required>
                </div>

                 <div class="form-group">

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


                </div>

                <div class="form-group">
                  <input type="text" class="form-control" name="parent_name" id="parent_name" placeholder="Parents Name*" maxlength="100" value="{{ old('parent_name') }}" minlength="3"  oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')"  required>
                  <p class="error" id="error2" style="color:red"></p>
                </div>


                <div class="form-group">

                  <input type="tel" class="form-control" name="mobile" placeholder="Your Phone*" minlength="5" maxlength="10" value="{{ old('mobile') }}" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>

                </div>

                <div class="form-group">

                  <input type="text" class="form-control" name="email" placeholder="Email Address*" value="{{ old('email') }}" maxlength="150"  required>

                </div>

                <div class="form-group">

                 <select class="form-control" aria-label="Default select Class" name="category_id" id="category_id" required>

                    <option value="">Age group *</option>

                    @foreach($category as $c)

                        <option value="{{ $c->category_id }}" {{ old('category_id') == $c->category_id ? 'selected' : '' }}>{{ $c->category_name }}</option>

                    @endforeach

                  </select>

                </div>

                <button type="submit" class="default-btn"> Submit Now </button>

              </form>

            </div>

          </div>

        </div>

      </div>

    

      </div>

    </section>

    <div id="loader-overlay"></div>
    <div id="loader">
        <div class="spinner"></div>
    </div>

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



  /*document.querySelector('input[name="student_age"]').addEventListener('input', function (e) {

    if (this.value < 0) {

      this.value = 0;

    }

  });*/



    $(document).ready(function() 
    {

hideLoader();
        function showLoader() {
            $('.loading').fadeIn();
        }

        // Hide loader
        function hideLoader() {
            $('.loading').fadeOut();
        }

  /*$('#tialForm').on('submit', function (e) {
        e.preventDefault(); // Prevent default for manual handling
        
        // Check if the form is valid
         if (this.checkValidity()) {
            $('section').addClass('blurred'); // Blur the page
            $('#loader-overlay').show();   // Show overlay
            $('#loader').show();           // Show spinner
            
            // Simulate processing delay
            setTimeout(() => {
                this.submit(); // Submit the form
            }, 2000); // Change delay as needed
        } else {
            this.reportValidity(); // Show HTML5 validation messages
        }
    });*/

         $('#student_age').on('change', function () {
                var age = parseInt($(this).val());
                var categoryDropdown = $('#category_id');
                var selectedCategory = '';
                var isValidAge = false;

                categoryDropdown.find('option').each(function () {
                    var categoryText = $(this).text().trim();
                    var match = categoryText.match(/(\d+)-(\d+)/); // Extract age range

                    if (match) {
                        var minAge = parseInt(match[1]);
                        var maxAge = parseInt(match[2]);

                        if (age >= minAge && age <= maxAge) {
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

                            $('#batch_id').append('<option value="">Select Batch</option>');

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

                    $('#plan_id').append('<option value="">Select Batch</option>');

                }

            });

$("#tialForm").validate({
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


        });

</script>

@endsection