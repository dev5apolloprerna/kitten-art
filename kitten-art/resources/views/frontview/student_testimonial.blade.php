@extends('layouts.front')

@section('content')

<!-- Start Page Banner -->

<div class="page-banner-area item-bg4">

    <div class="d-table">

        <div class="d-table-cell">

            <div class="container">

                <div class="page-banner-content">

                    <h2>Student Detail</h2>

                    <ul>

                        <li>

                            <a href="{{route('FrontIndex')}}">Home</a>

                        </li>

                        <li>Student Detail</li>

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

                        <a href="{{route('student_renew_plan')}}">Renew Plan</a>

                    </li>

                    <li>

                        <a href="{{route('student_testimonial')}}" class="active">Add Testimonial</a>

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

                    <span>Add Testimonial</span>

                    <!--<h2>Student </h2>-->

                </div>



                <div class="event-box-item">

                    <div class="row align-items-center">



                      <form method="post" action="{{route('storeFeedback')}}" enctype="multipart/form-data">

                        @csrf

                        <input type="hidden" name="student_id" value="{{$id}}">

                      <div class="form-group mb-2">Parent Name<span style="color:red";>*</span>

                          <input type="text" class="form-control" name="parent_name"  placeholder="Parent Name*" required>

                      </div>

                      <div class="form-group mb-2">Student Name <span style="color:red";>*</span>

                          <input type="text" class="form-control" name="student_name"   placeholder="Student Name*" required>

                      </div>

                      <div class="form-group mb-2">Parent Photo<span style="color:red";></span>

                          <input type="file" class="form-control"  name="parent_photo"  id="parent_photo" onchange="return validateFile()" >

                      </div>

                      <div class="form-group mb-2">Student Photo<span style="color:red";></span>

                          <input type="file" class="form-control" name="student_photo" id="student_photo" onchange="return validateFile1()" >

                      </div>

                      <div class="form-group mb-2">Description<span style="color:red";>*</span>

                         <textarea  class="form-control" placeholder="Description" name="description" required></textarea>

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

     function validateFile1() {

            var allowedExtension = ['jpeg', 'jpg', 'png', 'webp'];

            var fileExtension = document.getElementById('student_photo').value.split('.').pop().toLowerCase();

            var isValidFile = false;

            var image = document.getElementById('student_photo').value;



            for (var index in allowedExtension) {



                if (fileExtension === allowedExtension[index]) {

                    isValidFile = true;

                    break;

                }

            }

            if (image != "") {

                if (!isValidFile) {

                    alert('Allowed Extensions are : *.' + allowedExtension.join(', *.'));

                    $('#student_photo').val("")

                }

                return isValidFile;

            }



            return true;

        }

         function validateFile() {

            var allowedExtension = ['jpeg', 'jpg', 'png', 'webp'];

            var fileExtension = document.getElementById('parent_photo').value.split('.').pop().toLowerCase();

            var isValidFile = false;

            var image = document.getElementById('parent_photo').value;



            for (var index in allowedExtension) {



                if (fileExtension === allowedExtension[index]) {

                    isValidFile = true;

                    break;

                }

            }

            if (image != "") {

                if (!isValidFile) {

                    alert('Allowed Extensions are : *.' + allowedExtension.join(', *.'));

                    $('#parent_photo').val("")

                }

                return isValidFile;

            }



            return true;

        }

</script>

@endsection