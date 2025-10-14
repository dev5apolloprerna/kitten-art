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

            <div class="col-lg-3 left-menu pt-70">

                <ul>

                     <li>

                        <a href="{{route('student_profile')}}" >Student Profile</a>

                    </li>

                    <li>

                        <a href="{{route('student_dashboard')}}" class="active">Dashboard</a>

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

            <span>Student Details</span>

            <!--<h2>Student </h2>-->

        </div>



        <div class="event-box-item">

            <div class="row align-items-center">

                <table class=" table table-bordered table-striped table-hover datatable">

                        <tr>

                            <th>

                                Student Name

                            </th>

                            <th>

                               Student Age

                            </th>

                            <th>

                               Mobile

                            </th>

                            <th>

                               Email

                            </th>

                            <th>

                               Parent Name

                            </th>

                            <th>

                               Communication Mode

                            </th>

                        </tr>

                        <tr>

                            <td>{{ $data->student_first_name ?? '' }} {{ $data->student_last_name ?? '' }} </td>

                            <td> {{ $data->student_age }}</td>

                            <td> {{ $data->mobile }}</td>

                            <td> {{ $data->email }}</td>

                            <td> {{ $data->parent_name   }}</td>

                            <td>

                                @if($data->communication_mode == 1)

                                    {{ 'Whats App' }}

                                @elseif($data->communication_mode == 2)

                                 {{ 'Email' }}

                                @elseif($data->communication_mode == 3)

                                 {{ 'Text' }}

                                @endif



                            </td>

                        </tr>



                    </tbody>

                </table>

            </div>

        </div>

                

        <div class="section-title">
            <span>Student Subscription</span>
        </div>
        <div class="event-box-item">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <table class=" table table-bordered table-striped table-hover datatable">
                            <tr>    

                                <th>Plan Name</th>

                                <th>Plan Amount</th>

                                <th>Plan Session</th>

                                <th>Used Session</th>

                                <th>Remaining Session</th>

                                <th>Activation Date</th>

                            </tr>

                            <?php

                              $dbalance=$debit_balance-$credit_balance;

                            ?>

                            @foreach($subscription as $s)

                             <?php 

                                // Determine how many sessions have been used

                                $usedsession = min($s->plan_session, $dbalance);

                                $remainingSession = $s->plan_session - $usedsession;

                                $dbalance -= $usedsession; // Deduct used sessions from balance

                        

                                // If dbalance goes negative, show the remaining session correctly

                                if ($dbalance < 0) {

                                    $remainingSession = $dbalance;

                                }

                            ?>

                            <tr>

                               <td>{{ $s->planName }}</td>

                               <td>{{ $s->amount }}</td>

                               <td>{{ $s->total_session }}</td>

                                <td>{{ $s->debit_balance }}</td>

                                <td>{{ $s->total_session - $s->debit_balance }}</td>

                               <td>{{ date('d-m-Y',strtotime($s->activate_date)) }}</td>

                            </tr>

                            @endforeach

                        </table>

                    </div>

                </div>

            </div>

    

            <div class="section-title">

                <span>Student Attendance</span>

            </div>

                <div class="event-box-item">

                    <div class="row align-items-center">



                        <div class="col-md-12">

                           <table class=" table table-bordered table-striped table-hover datatable">

                               <thead>

                            <tr>    

                                <th>Category Name</th>

                                <th>Batch Name</th>

                                <th>Day</th>

                                <th>Attendance</th>

                                <th>Attendance Date</th>

                            </tr>

                            </thead>

                            <tbody>
                            @if(sizeof($attendance) > 0)

                            @foreach($attendance as $a)

                            <tr>

                               <td>{{ $a->categoryName }}</td>

                               <td>{{ $a->batchname }}</td>

                               <td>

                                 <?php 

                                            $daysOfWeek = [

                                                    1 => 'Monday',

                                                    2 => 'Tuesday',

                                                    3 => 'Wednesday',

                                                    4 => 'Thursday',

                                                    5 => 'Friday',

                                                    6 => 'Saturday',

                                                    7 => 'Sunday',

                                                ];   

                                            ?>

                                            {{ $daysOfWeek[$a->day] ?? 'Invalid Day'  }}

                               </td>

                               <td>{{ $a->attendance }}</td>

                               <td>{{ date('d-m-Y',strtotime($a->attendance_date)) }}</td>

                            </tr>

                            @endforeach
                            @else
                            <tr> <td colspan="5">No Data Found</td> </tr>
                            @endif
                            </tbody>

                        </table>

                    </div>

                </div>

              </div>

              

            </div>

        </div>

        </div>

    </div>

    </div>

</section>





@endsection