@extends('layouts.app')

@section('title', 'Edit RenewPlan Student')

@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                {{-- Alert Messages --}}
                @include('common.alert')

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Edit RenewPlan Student</h4>
                            <div class="page-title-right">
                                <a href="{{ url()->previous() }}"
                                    class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                    <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('renewPlan.update_renew_student', $data['renewplan_id']) }}" method="POST" enctype="multipart/form-data" id="renew_plan_edit">
                                    @csrf
                                    <input type="hidden" name="renewplan_id" id="renewplan_id" value="{{ $data['renewplan_id'] }}">
                                    <input type="hidden"  id="batchId" value="{{ $data['batch_id'] }}">
                                    <input type="hidden"  id="planId" value="{{ $data['plan_id'] }}">
                                     <div class="row">
                                          
                                          <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('student_name') ? 'has-error' : '' }}">
                                                <label for="student_name">Student Name <span style="color:red">*</span></label>
                                                <input type="text" id="student_name" name="student_name" class="form-control"  placeholder="Enter Student Name" maxlength="100" value="{{ $data['student_name'] }}" disabled>
                                                @if($errors->has('student_name'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('student_name') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                                                <label for="category_id">Category Name<span style="color:red">*</span></label>
                                                <select class="form-control"  name="category_id" id="category_id" required>
                                                    <option value="">select category *</option>
                                                    @foreach($category as $c)
                                                        <option value="{{ $c->category_id }}" {{ $data['category_id'] == $c['category_id'] ? 'selected' : '' }}>{{ $c->category_name }}</option>
                                                    @endforeach
                                                  </select>
                                            </div>
                                        </div> 
                                        
                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('plan_id') ? 'has-error' : '' }}">
                                                <label for="plan_id">Plan<span style="color:red">*</span></label>
                                                <select class="form-control" name="plan_id" id="plan_id" required>
                                                    <option value="">select plan</option>
                                                        @foreach($plans as $plan)
                                                            <option value="{{ $plan->planId }}" {{ $data['plan_id'] == $plan->planId ? 'selected' : '' }}>
                                                                {{ $plan->plan_name }}
                                                            </option>
                                                        @endforeach

                                                </select>
                                            </div> 
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('batch_id') ? 'has-error' : '' }}">
                                                <label for="batch_id">Batch <span style="color:red">*</span></label>
                                                <select class="form-control" name="batch_id" id="batch_id" required>
                                                    <option value="">select batch</option>
                                                   @php
                                                        $weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                                    @endphp

                                                    @foreach($batches as $batch)
                                                        <option value="{{ $batch->batch_id }}" {{ $data['batch_id'] == $batch->batch_id ? 'selected' : '' }}>
                                                            {{ $batch->batch_name }} 
                                                        </option>
                                                    @endforeach
                                                    </option>
                                                </select>
                                            </div> 
                                        </div>
                                       

                                    </div>
                                        <div class="card-footer mt-2">
                                            <div class="mb-3" style="float: right;">
                                                <button type="submit"
                                                class="btn btn-success btn-user float-right" >Update</button>
                                                <a class="btn btn-primary float-right mr-3"
                                                    href="{{ route('renewPlan.renew_plan') }}">Cancel</a>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    $(document).ready(function() 
    {
            if($('#isPaid').val() == '1') {
                  // Disable the fields with the specified ids
                  $('#student_name').prop('disabled', true);
                  $('#student_age').prop('disabled', true);
                  $('#mobile').prop('disabled', true);
                  $('#email').prop('disabled', true);
                  $('#parent_name').prop('disabled', true);
                  $('#communication_mode').prop('disabled', true);
                }


                // Get initial values for category_id, batch_id, and plan_id
    var selectedCategoryId = $('#category_id').val(); // Get selected category ID from the dropdown
    var selectedBatchId = $('#batchId').val(); // Add a custom attribute for selected batch ID
    var selectedPlanId = $('#planId').val(); // Add a custom attribute for selected plan ID

    // Function to fetch and populate the batch dropdown
    function fetchBatches(categoryid, selectedBatchId) {
        $.ajax({
            url: '../get-batch/' + categoryid,
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
    function fetchPlans(categoryid, selectedPlanId) {
        $.ajax({
            url: '../get-plan/' + categoryid,
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

    $("#renew_plan_edit").validate({
        rules: {
            category_id: {
                required: true,
            },
            plan_id: {
                required: true,
            },
            batch_id: {
                required: true,
            },
            
        },
        messages: {
            category_id: {
                required: "Please Select Category",
            },
            plan_id: {
                required: "Please Select Plan",
            },
            batch_id: {
                required: "Please Select Batch",
            },
           
            
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
            
        }
    });
</script>
@endsection
