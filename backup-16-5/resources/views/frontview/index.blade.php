@extends('layouts.front')
@section('content')
<style>
  .single-class .class-image img {
    transition: 0.5s;
    border-radius: 5px 5px 0 0;
    object-fit: cover;
    width: 100%;
    height: 250px;
}
.readonly {
    pointer-events: none; /* Prevent clicking */
    background-color: #f1f1f1; /* Light gray background */
    color: #666; /* Dim text color */
}

</style>
                @include('common.alert')

<div class="main-banner">
      <div class="home-slides owl-carousel owl-theme">
        <div class="main-banner-item" style="background-image: url(front/assets/images/slide-1bg.jpg);">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-6 ">
              <div class="main-banner-content">
                  &nbsp;
                </div> 
              </div>
              
            </div>
          </div>
        </div>
        <div class="main-banner-item" style="background-image: url(front/assets/images/slide-2bg.jpg);">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-6 ">
              <div class="main-banner-content">
                  &nbsp;
                </div> 
              </div>
              
            </div>
          </div>
        </div>
        <div class="main-banner-item" style="background-image: url(front/assets/images/slide-3bg.jpg);">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-6 ">
                <div class="main-banner-content">
                  <span>Draw, Learn and Grow</span>
                  <h1> Kids Art Classes.</h1>
                  <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices
                        gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p><div class="banner-btn"><a href="#" class="default-btn">
                            Learn More
                        </a><a href="#" class="optional-btn">
                            Find Out More
                        </a></div> -->
                </div>
              </div>
              <!-- <div class="col-lg-6"><div class="main-banner-image"><img src="assets/images/hero.png" alt="image"></div></div> -->
            </div>
          </div>
        </div>
        <div class="main-banner-item" style="background-image: url(front/assets/images/slide-4bg.jpg);">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-6 ">
              <div class="main-banner-content">
                  &nbsp;
                </div> 
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Main Banner Area -->
    <!-- Start Who We Are Area -->
    <section class="who-we-are ptb-100">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-5">
            <div class="who-we-are-image">
              <img src="{{ asset('front/assets/images/who-we-are-who-we-are.png')}} " alt="image">
            </div>
          </div>
          <div class="col-lg-7">
            <div class="who-we-are-content">
              <span>Who We Are</span>
              <h3>Give kids space to explore their creativity</h3>
              <p>{!! $about->description !!}</p>
              <ul class="who-we-are-list">
                <li>
                  <span>1</span> Homelike Environment
                </li>
                <li>
                  <span>2</span> Affordable Art Classes
                </li>
                <li>
                  <span>3</span> All Supplies Included
                </li>
                <li>
                  <span>4</span> Explore Creativity
                </li>
              </ul>
              <div class="who-we-are-btn">
                <a href="{{route('FrontAbout')}}" class="default-btn">Read More</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="who-we-are-shape"><img src="assets/images/who-we-are-who-we-are-shape.png" alt="image"></div> -->
    </section>
    <!-- End Who We Are Area -->
    @if(sizeof($plan) != 0)
     <!-- Start Class Area -->
    <section class="class-area bg-fdf6ed pt-100 pb-70">
      <div class="container">
        <div class="section-title">
          <span>Classes</span>
          <h2>Popular Classes</h2>
        </div>
        <div class="row">
          @foreach($plan as $data)

          <div class="col-lg-4 col-md-6">
            <div class="single-class">
              <div class="class-image">
                <a href="#">
                  @if($data->plan_image == '' || !file_exists(public_path('plan_image/' . $data->plan_image)))
                      <img src="{{ asset('images/noImage.png')}}" height="2px" >
                  @else
                  <img src="{{ asset($data->plan_image ? 'plan_image/' . $data->plan_image : 'images/noImage.png') }}" alt="image">
                  @endif

                </a>
              </div>
              <?php
              if(!empty($matches))
              {

              preg_match('/\d+/', $data->plan_name, $matches);
                $intValue = $matches[0];

              }else{
                $intValue="";
              }
              ?>
              <div class="class-content">
                <div class="price">$  {{ $data->plan_amount }} / {{ $intValue }} Month</div>
                <h3>
                  <a href="{{route('FrontClassDetail',$data->planId)}}">  {{ $data->categoryName }} </a>
                </h3>
                <p>{{ $data->plan_name }}</p>
                <p>{!! $data->plan_description !!}</p>
                
                <ul class="class-list">
                  <!--  -->
                  <li>
                    <span>sessions:</span> {{ $data->plan_session }}
                  </li>
                </ul>
                <div class="class-btn">
                  <a href="{{route('FrontClassDetail',$data->planId)}}" class="default-btn">Join Class</a>
                </div>
              </div>
            </div>
          </div>
         @endforeach
         
        </div>
      </div>
    </section>
    @endif
    <!-- End Class Area -->
    <!-- Start Value Area -->
    <section class="value-area ptb-100">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="value-image">
              <img src="{{ asset('front/assets/images/img-core.jpg')}}" alt="image">
            </div>
          </div>
          <div class="col-lg-6">
            <div class="value-item">
              <div class="value-content">
                <span>Our Core Values</span>
                <h3>Art Classes</h3>
                <p>{!! $class->description !!}</p>
              </div>
              <div class="value-inner-content">
                <div class="number">
                  <span>01</span>
                </div>
                <h4>No Experience Required</h4>
                <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> -->
              </div>
              <div class="value-inner-content">
                <div class="number">
                  <span class="bg-2">02</span>
                </div>
                <h4> Explore Creativity</h4>
                <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> -->
              </div>
              <div class="value-inner-content">
                <div class="number">
                  <span class="bg-3">03</span>
                </div>
                <h4>Affordable Art Classes</h4>
                <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> -->
              </div>
              <div class="value-inner-content">
                <div class="number">
                  <span class="bg-4">04</span>
                </div>
                <h4>All Supplies Included</h4>
                <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="value-shape"><div class="shape-1"><img src="assets/images/value-value-shape-1.png" alt="image"></div><div class="shape-2"><img src="assets/images/value-value-shape-2.png" alt="image"></div><div class="shape-3"><img src="assets/images/value-value-shape-3.png" alt="image"></div></div> -->
    </section>
    <!-- End Value Area -->
    <!-- Start Teacher Area -->
    @if(sizeof($gallery) != 0)
    <section class="teacher-area bg-ffffff pt-100 pb-70">
      <div class="container-fluid">
        <div class="section-title">
          <span>Art Gallery</span>
          <h2>Student Art Creations</h2>
        </div>
        <div class="gallery-slides owl-carousel owl-theme">
          @foreach($gallery as $g)
          <div class="single-teacher">
            <div class="image">
              <img src="{{ asset('Gallery/') . '/' . $g->image }}" alt="image">
            </div>
          </div>
          @endforeach
          
        </div>
      </div>
      </div>
    </section>
    @endif

    <!-- End Teacher Area -->
    <section class="quote-area ptb-100">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="quote-image">
              <img src="{{ asset('front/assets/images/img-quote.png')}}" />
            </div>
          </div>
                @include('common.alert')

          <div class="col-lg-6">
            <div class="quote-item">
              <div class="content">
                <span>Join Us Now!</span>
                <h3>Register Now </h3>
              </div>
              <form method="post" action="{{ route('contactStore') }}" id="myForm">
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
                  <input type="tel" class="form-control" name="mobile" placeholder="Your Phone*" minlength="5" maxlength="20" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="email" placeholder="Email Address*" maxlength="150"  required>
                </div>
                <div class="form-group">
                 <select class="form-control" aria-label="Default select Class" name="category_id" id="category_id" required>
                    <option value="">Age Group *</option>
                    @foreach($category as $c)
                        <option value="{{ $c->category_id }}">{{ $c->category_name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                 <select class="form-control" aria-label="Default select Class" name="plan_id" id="plan_id" required>
                    <option value="">Select Plan *</option>
                  </select>
                </div>

               <!--  <div class="form-group">
                 <select class="form-select" name="batch_id" id="batch_id">
                    <option value="">Preferred Day</option>
                  </select>
                </div> -->

                <div class="form-group">
                    <select class="form-control" aria-label="Default select Class" name="communication_mode" id="communication_mode" required>
                            <option value="">Contact Preference</option>
                            <option value="1">Whats App</option>
                            <option value="2">Email</option>
                            <option value="3">Text SMS</option>
                    </select>
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
                </div>
                <button type="submit" class="default-btn"> Submit Now </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    @if(sizeof($Testimonials) != 0)
    <!-- Start Testimonials Area -->
    <section class="testimonials-area pt-100 pb-100">
      <div class="container">
        <div class="section-title">
          <span>Testimonials</span>
          <h2>What Parents Say About Us</h2>
        </div>
        <div class="testimonials-slides owl-carousel owl-theme">
          @foreach($Testimonials as $data)
          <div class="testimonials-item">
            <div class="testimonials-item-box justify-content-between">
              <div class="icon col-lg-4">
                <img src="{{ asset($data['student_photo'] ? 'Testimonial/' . $data['student_photo'] : 'images/noImage.png') }}" class="img-fluid">
              </div>
              <div class="col-lg-7 align-content-center">
                <p>{!! $data['description'] !!}</p>
                <div class="info-box d-flex">
                  <div class="testi-img">
                    <img src="{{ asset($data['parent_photo'] ? 'Testimonial/' . $data['parent_photo'] : 'images/noImage.png') }}">
                  </div>
                   <h3 class="align-content-center">{{ $data['parent_name'] }}</h3>
                  <span> Parent of {{ $data['student_name'] }}</span>
                </div>
              </div>
            </div>
            <!-- <div class="testimonials-image"><img src="assets/images/testimonials-testimonials-1.png" alt="image"></div> -->
          </div>
          
          @endforeach
        </div>
      </div>
    </section>
        <div id="loader-overlay"></div>
    <div id="loader">
        <div class="spinner"></div>
    </div>

    @endif
    <!-- End Testimonials Area -->
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
    $(document).ready(function() 
    {
    
        $('#student_age').on('change', function () 
        {
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

        });
</script>



<div class="modal fade" id="welcomeModal" tabindex="-1" aria-labelledby="welcomeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
       
         
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       
        <img src="{{ asset('front/assets/images/welcomebanner.jpg')}}" class="img-fluid" />
       
      </div>
    </div>
  </div>
  
  
  <script>
//     // Function to check if the modal should be shown
//     function shouldShowModal() {
//       const lastVisitDate = localStorage.getItem('lastVisitDate');
//       const today = new Date().toISOString().split('T')[0]; // Get only the date part

//       if (lastVisitDate === today) {
//         return false; // Already visited today
//       }

//       // Update last visit date to today
//       localStorage.setItem('lastVisitDate', today);
//       return true; // First visit today
//     }

//     // Show the Bootstrap modal on the first visit of the day
//     document.addEventListener('DOMContentLoaded', () => {
//       if (shouldShowModal()) {
//         const welcomeModal = new bootstrap.Modal(document.getElementById('welcomeModal'));
//         welcomeModal.show();
//       }
     
//     });
   </script>



<script>
    // Automatically open the modal on page load
    document.addEventListener('DOMContentLoaded', () => {
      const welcomeModal = new bootstrap.Modal(document.getElementById('welcomeModal'));
      welcomeModal.show();
    });
  </script>

  
// <script>
    
//     function showModalOnFirstVisit() {
//       const welcomeModal = new bootstrap.Modal(document.getElementById('welcomeModal'));

     
//       if (!localStorage.getItem('firstVisit')) {
        
//         welcomeModal.show();

        
//         localStorage.setItem('firstVisit', 'true');
//       }
//     }

   
//     document.addEventListener('DOMContentLoaded', showModalOnFirstVisit);
  </script>

@endsection
