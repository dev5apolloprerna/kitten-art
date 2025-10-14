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
                        @foreach($active_plan as $plan1)
                                @if($debit_balance != $plan1->plan_session)
                                
                        <div class="col-md-4">
                            <div class="event-image">
                                <a href="#">
                                    <img src="{{ asset('plan_image') . '/' . $plan1->plan_image }}" alt="image"></a>
                            </div>
                        </div>

                        <div class="col-md-5">
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
                        @endif
                       @endforeach


                        <div class="col-md-3">
                            <div class="event-date">
                                <h4></h4>
                                <span>                                   
                                <a  class="default-btn" data-bs-toggle="modal" data-bs-target="#ebookform">Renew Plan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



    <!-- The Modal -->
<div class="modal" id="ebookform">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Fill this form to get your renew plan</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
         <form method="post" action="{{route('student_renew_plan')}}">
            @csrf 
            <input type="hidden" name="student_id"  id="student_id"value="{{ $id }}">
            <input type="hidden"  id="batchId" value="{{ $plan->batch_id }}">
            <input type="hidden"  id="planId" value="{{ $plan->plan_id }}">
 
            <div class="form-group py-2"><label>Category Name <span style="color:red;">*</span></label>
              <select class="form-control"  name="category_id" id="category_id" required>
                <option value="">Select Class *</option>
                @foreach($category as $c)
                    <option value="{{ $c->category_id }}" {{ $plan->category_id == $c->category_id ? 'selected' : '' }}>{{ $c->category_name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group py-2"><label>Plan Name <span style="color:red;">*</span></label>
              <select class="form-control" name="plan_id" id="plan_id" required>
                @foreach($plans as $plan)
                    <option value="{{ $plan->planId }}" {{ $plan->plan_id == $plan->planId ? 'selected' : '' }}>
                        {{ $plan->plan_name }}
                    </option>
                @endforeach
            </select>
            </div>
            <div class="form-group py-2"><label>Batch Name <span style="color:red;">*</span></label>
              <select class="form-control" name="batch_id" id="batch_id" required>
                @foreach($batches as $batch)
                        <option value="{{ $batch->batch_id }}" {{ $plan->batch_id == $batch->batch_id ? 'selected' : '' }}>
                            {{ $batch->batch_name }} 
                        </option>
                    @endforeach
            </select>
            </div>
            <div class="form-group py-2"><label>Plan Amount <span style="color:red;">*</span></label>
                <input type="text" value="" name="amount" id="amount" class="form-control" readonly> 
            </div>
            <div class="form-group py-2"><label>Plan Session <span style="color:red;">*</span></label>
                <input type="text" value="" name="plan_session" id="plan_session" class="form-control" readonly> 
            </div>
                  <!-- Modal footer -->
              <div class="modal-footer">
                <button type="submit" class="btn btn-danger"> Submit Now </button> 
              </div>
            </form>
      </div>



    </div>
  </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(document).ready(function() 
    {
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
                $('#batch_id').append('<option value="">Select Batch</option>');
                $.each(data, function(key, value) {
                    const isSelected = value.batch_id == selectedBatchId ? 'selected' : '';
                    $('#batch_id').append('<option value="'+ value.batch_id +'" '+ isSelected +'>'+ value.batch_name +'</option>');
                });
            }
        });
    }

    // Function to fetch and populate the plan dropdown
    function fetchPlans(categoryid, selectedPlanId) 
    {
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

         $.ajax({
                    url: './get-plan-amount/' + selectedPlanId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log('Response:', data);
                        $('#amount').val(data.plan_amount);
                        $('#plan_session').val(data.plan_session);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                    }
                });
    }

    $('#plan_id').change(function() 
        { 
                var plan_id = $(this).val();
                
                $.ajax({
                    url: './get-plan-amount/' + plan_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log('Response:', data);
                        $('#amount').val(data.plan_amount);
                        $('#plan_session').val(data.plan_session);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                    }
                });
            });


    // Populate dropdowns on category change
    $('#category_id').change(function() {
        var categoryid = $(this).val();
        if (categoryid) {
            fetchBatches(categoryid, null); // No pre-selected value on change
            fetchPlans(categoryid, null);
        } else {
            $('#batch_id').empty().append('<option value="">Select Batch</option>');
            $('#plan_id').empty().append('<option value="">Select Plan</option>');
        }
    });

    // Populate dropdowns on page load if category_id has a value
    if (selectedCategoryId) {
        fetchBatches(selectedCategoryId, selectedBatchId);
        fetchPlans(selectedCategoryId, selectedPlanId);
    }
    });
            /*$('#category_id').change(function() 
            {
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

                            $('#batch_id').append('<option value="'+ value.batch_id +'">'+ weekdays[value.batch_day - 1] +'</option>');
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
        });
        
        $('#plan_id').change(function() 
        {
                var plan_id = $(this).val();
                console.log('Selected Plan ID:', plan_id);
                
                $.ajax({
                    url: './get-plan-amount/' + plan_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log('Response:', data);
                        $('#amount').val(data.plan_amount);
                        $('#plan_session').val(data.plan_session);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                    }
                });
            });*/

    
        
</script>
@endsection