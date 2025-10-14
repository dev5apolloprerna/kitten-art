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
                    <h2>Active Plan</h2>
                    <ul>
                        <li>
                            <a href="{{route('FrontIndex')}}">Home</a>
                        </li>
                        <li>Current Active Plan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@include('common.alert')



<!-- End Page Banner -->

<section class="event-area bg-ffffff pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 left-menu pt-70">
                <ul>
                    <li>
                        <a href="{{route('student_profile')}}">Student Profile</a>
                    </li>
                    <li>
                        <a href="{{route('student_dashboard')}}">Dashboard</a>
                    </li>
                    <li>
                        <a href="{{route('student_active_plan')}}" class="active">Current Active Plan</a>
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

                    <span>Current Active Plan</span>

                    <!-- <h2>Summer Camps</h2> -->

                </div>

                <div class="event-box-item">
                    <div class="row align-items-center">
                        @php
                            $messageDisplayed = true;
                        @endphp
                @foreach($active_plan as $plan1)
                    @if($debit_balance != $plan1->plan_session)
                    <div class=" card mb-5 p-2 row">
                    <div class="row align-items-center">
                        <div class="col-lg-4">
                            <div class="event-image">
                                <a href="#">
                                    <img src="{{ asset('plan_image') . '/' . $plan1->plan_image }}" alt="image"></a>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="event-content">
                                <h3>
                                    <a href="#">{{ $plan->planName }}</a>
                                </h3>
                                <ul class="event-list">
                                    <li>
                                         <i class="bi bi-person"></i>
                                        {{ $plan1->categoryName }}
                                    </li>
                                    <li>
                                        <i class="fa fa-thin fa-child"></i>
                                        {{ $plan->batchname }}
                                    </li>

                                    <li>
                                        <i class="fa fa-thin fa-credit-card"></i>
                                        {{ $plan->plan_name }}
                                    </li>

                                    <li>
                                        <i class="bx bx-time"></i>
                                        {{ date('h:i a',strtotime($plan->batch_from_time)) }} - {{ date('h:i a',strtotime($plan->batch_to_time)) }}
                                    </li>

                                    <li>
                                        <i class="bx bx-dollar"></i>
                                        {{ $plan1->amount }} - {{ $plan1->plan_session }} session
                                    </li>
                                </ul>
                            </div>
                        </div>
                        </div>
                        </div>
                        @else
                        @php
                            $messageDisplayed = false;
                            
                        @endphp
                        @endif

                       @endforeach
                        @if(!$messageDisplayed)
                        <div class="event-content mb-5">
                            <ul class="event-list">
                                <li>
                                    No Current Active Plan Please Renew Plan 
                                </li>
                            </ul>
                        </div>
                        @endif
                        <!-- <div class="col-md-3">
                            <div class="event-date">
                                <h4></h4>
                                <span>                                   
                                <a  class="default-btn" data-bs-toggle="modal" data-bs-target="#ebookform">Renew Plan</a>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

