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

                        <a href="{{route('student_renew_plan')}}">Renew Plan</a>

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

                         <table class="datatable table table-hover">
                                <tr>
                                    <th>Student Name</th>    
                                    <td>{{ $Student->student_first_name }} {{ $Student->student_Last_name }}</td>
                                </tr> 
                                <tr>
                                    <th>Parent Name</th>    
                                    <td>{{ $Student->parent_name }}</td>
                                </tr>                 
                                <tr>
                                    <th>Student Age</th>    
                                    <td>{{ $Student->student_age }}</td>
                                </tr>                  
                                <tr>
                                    <th>Mobile</th>    
                                    <td>{{ $Student->mobile }}</td>
                                </tr>     
                                <tr>
                                    <th>Email</th>    
                                    <td>{{ $Student->email }}</td>
                                </tr>      
                                <tr>
                                    <th>Contact Preference</th>    
                                    <td>@if($Student->communication_mode == 1)
                                        {{ 'Whats App'  }}
                                        @elseif($Student->communication_mode == 2)
                                        {{ 'Email' }}
                                        @elseif($Student->communication_mode == 3)
                                        {{ 'Text SMS' }}
                                        @endif
                                    </td>
                                </tr>                  
                            
                        </table>

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