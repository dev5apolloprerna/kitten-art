@extends('layouts.front')

@section('content')

<!-- Start Page Banner -->

<div class="page-banner-area item-bg4">

    <div class="d-table">

        <div class="d-table-cell">

            <div class="container">

                <div class="page-banner-content">

                    <h2>Service - Detail</h2>

                    <ul>

                        <li>

                            <a href="{{route('FrontIndex')}}">Home</a>

                        </li>

                        <li>Service - Detail</li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- End Page Banner -->



<section class="class-area bg-fdf6ed pt-100 pb-70">

      <div class="container">

        <div class="section-title">

          <span>Our Services</span>

          <h2>{{ $service->service_name }}</h2>

        </div>

        <div class="row">

            <div class="col-lg-5">

                <img src="{{ asset($service->image ? 'Service/' . $service->image : 'images/noImage.png') }}" alt="image" width="750px">

            </div>

            <div class="col-lg-7">

                <div class="card single-class">

                    <div class="card-body class-content">

                       <h4> {{ $service->service_name }} </h4>

                  

                        <ul class="class-list d-block">



                            {!! $service->description !!}<br>

                        </ul><br>
                        @if($service->serivce_id == 1)
                        <a  href="#" id="registerButton" class="default-btn" data-bs-toggle="modal" data-bs-target="#eventRegister" style="border:none;">Register</a>
                        @else
                        <a  href="#" id="registerButton" class="default-btn" data-bs-toggle="modal" data-bs-target="#eventRegister" style="border:none;">Book Now</a>
                        @endif
                    </div>

                </div>

            </div>

        </div>

    </div>

    

                   

      <div class="gallery-area pt-100 pb-70">

            <div class="container">

                <div class="row">

                    @foreach($ServiceImages as $g)

                    <div class="col-lg-3 col-md-6">

                        <div class="single-gallery-box">

                            <img src="{{ asset($g->image ? 'Service/service_images/' . $g->image : 'images/noImage.png') }}" alt="image">

                            <a href="{{ asset($g->image ? 'Service/service_images/' . $g->image : 'images/noImage.png') }}" class="gallery-btn" data-imagelightbox="popup-btn">

                                <i class="bx bx-search-alt"></i>

                            </a>

                        </div>

                    </div>



                    @endforeach

                </div>



                <!-- <div class="view-btn">

                    <a href="#" class="default-btn">View More</a>

                </div> -->

            </div>

        </div>



    </section>




@if($service->service_id != 2)


<div class="modal" id="eventRegister">

  <div class="modal-dialog">

    <div class="modal-content">



      <!-- Modal Header -->

      <div class="modal-header">

        <h4 class="modal-title">Fill This Form For Service Registration</h4>

        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

      </div>



           <!-- Modal body -->

      <div class="modal-body">

            <form method="post" action="{{route('ServiceRegisteration')}}" id="serviceForm">

            @csrf

            <input type="hidden" name="service_id" value="{{ $service->service_id }}">

            <div class="form-group py-2"><label>Student First Name <span style="color:red;">*</span></label>

                <input type="text"  name="student_first_name" id="student_first_name" minlength="3"  oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')"   value="{{ old('student_first_name') }}" class="form-control" required> 

            </div>           
             <div class="form-group py-2"><label>Student Last Name <span style="color:red;">*</span></label>

                <input type="text"  name="student_last_name" id="student_last_name" minlength="3"  oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')"   value="{{ old('student_last_name') }}" class="form-control" required> 

            </div>

            <div class="form-group py-2"><label>Student Age <span style="color:red;">*</span></label>

                <input type="text"  name="student_age" id="student_age"  value="{{ old('student_age') }}" class="form-control" required> 

            </div>

            <div class="form-group py-2"><label>Parent Name <span style="color:red;">*</span></label>

                <input type="text"  name="parent_name" minlength="3"  oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')"  id="parent_name" value="{{ old('parent_name') }}"  class="form-control" required> 

            </div>



            <div class="form-group py-2"><label>Mobile <span style="color:red;">*</span></label>

                <input type="text"  name="mobile" id="mobile" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" minlength="5" maxlength="10"  value="{{ old('mobile') }}" class="form-control" required> 

            </div>



            <div class="form-group py-2"><label>Email <span style="color:red;">*</span></label>

                <input type="text"  name="email" id="email" value="{{ old('email') }}"  class="form-control" required> 

            </div>
            </div>              

            <div class="modal-footer">

                <button type="submit" class="btn btn-danger"> Submit Now </button> 

              </div>

            </form>

      </div>

    </div>

  </div>

</div>
@else


<div class="modal" id="eventRegister">

  <div class="modal-dialog">

    <div class="modal-content">



      <!-- Modal Header -->

      <div class="modal-header">

        <h4 class="modal-title">Fill This Form For Service Registration</h4>

        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

      </div>
           <!-- Modal body -->

      <div class="modal-body">

            <form method="post" action="{{route('ServiceRegisteration')}}" id="serviceForm">
            @csrf
            <input type="hidden" name="service_id" value="{{ $service->service_id }}">

            <div class="form-group py-2"><label> Name <span style="color:red;">*</span></label>

                <input type="text"  name="Name" id="Name" minlength="3"  oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')"   value="{{ old('Name') }}" class="form-control" required> 
            </div>           
            <div class="form-group py-2"><label>Phone Number <span style="color:red;">*</span></label>
                <input type="text"  name="mobile" id="mobile" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" minlength="5" maxlength="10"  value="{{ old('mobile') }}" class="form-control" required> 
            </div>

            <div class="form-group py-2"><label>Email <span style="color:red;">*</span></label>
                <input type="text"  name="email" id="email" value="{{ old('email') }}"  class="form-control" required> 

            </div>
            <div class="form-group py-2"><label>Event Date <span style="color:red;">*</span></label>
                <input type="date"  name="event_date" id="event_date"  value="{{ old('event_date') }}" class="form-control" required> 
            </div>
            <div class="form-group py-2"><label>Event Time <span style="color:red;">*</span></label>
                <input type="time"  name="event_time" id="event_time"  value="{{ old('event_time') }}" class="form-control" required> 
            </div>
            <div class="form-group py-2"><label>Event Location <span style="color:red;">*</span></label>
                <textarea type="text"  name="event_location" id="event_location"  class="form-control" required>{{ old('event_location') }}</textarea> 
            </div>
            <div class="form-group py-2"><label>Occasion <span style="color:red;">*</span></label>
                <input type="text"  name="occasion" id="occasion"  value="{{ old('occasion') }}" class="form-control" required> 
            </div>
            <div class="form-group py-2"><label>Estimated No of Painters <span style="color:red;">*</span></label>
                <input type="text"  name="painters" id="painters"  value="{{ old('painters') }}" class="form-control"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required> 
            </div>
            <div class="form-group py-2"><label>Ask Questions <span style="color:red;">*</span></label>
                <textarea type="text"  name="question" id="question"  class="form-control" required>{{ old('question') }}</textarea> 
            </div>
            </div>              

            <div class="modal-footer">

                <button type="submit" class="btn btn-danger"> Submit Now </button> 

              </div>

            </form>

      </div>

    </div>

  </div>

</div>
@endif
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



     url:'../refresh_captcha',



     success:function(data){



        $(".captcha span").html(data.captcha);



     }



  });



});



$(document).ready(function() 
    {
     $("#serviceForm").validate({
          rules: {
            Name: {
                required: true,
                minlength: 3,
                maxlength: 50
            },
            mobile: {
                required: true,
            },email: {
                required: true,
            },event_date: {
                required: true,
            },event_time: {
                required: true,
            },event_location: {
                required: true,
            },occasion : {
                required: true,
            },painters : {
                required: true,
            },question : {
                required: true,
            }
        },
        messages: {
            Name: {
                required: "Please Enter Name",
                minlength: "Name must be at least 3 characters long",
                maxlength: "Name cannot be more than 50 characters"
            },mobile: {
                required:"Please Enter Mobile No",
            },email: {
                required:"Please Enter Email Address",
            },event_date: {
                required:"Please Enter Event Date",
            },event_time: {
                required:"Please Enter Event Time",
            },event_location: {
                required:"Please Enter Event Location",
            },occasion: {
                required:"Please Enter Occasion",
            },painters: {
                required:"Please Enter No of painters",
            },question: {
                required:"Please Enter Question",
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