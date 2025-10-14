@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                {{-- Alert Messages --}}
                @include('common.alert')

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Edit Student</h4>
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
                                <form action="{{ route('studentinquiry.update', $data['student_inquiry_id']) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="student_inquiry_id" id="student_inquiry_id" value="{{ $data['student_inquiry_id'] }}">
                                     <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                                                <label for="category_id">Class<span style="color:red">*</span></label>
                                                <select class="form-control"  name="category_id" id="category_id" required>
                                                    <option value="">select class *</option>
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
                                        <div class="col-md-4 mt-4">
                                            <div class="form-group {{ $errors->has('student_name') ? 'has-error' : '' }}">
                                                <label for="student_name">Student Name <span style="color:red">*</span></label>
                                                <input type="text" id="student_name" name="student_name" class="form-control"  placeholder="Enter Student Name" maxlength="100" value="{{ $data['student_name'] }}">
                                                @if($errors->has('student_name'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('student_name') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>

                                        <div class="col-md-4 mt-4">
                                            <div class="form-group {{ $errors->has('student_age') ? 'has-error' : '' }}">
                                                <label for="student_age">Student Age <span style="color:red">*</span></label>
                                                <input type="number" id="student_age" name="student_age" class="form-control" placeholder="Enter Student Age" maxlength="2" value="{{ $data['student_age'] }}" required>
                                                @if($errors->has('student_age'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('student_age') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>
                                         
                                         <div class="col-md-4 mt-4">
                                            <div class="form-group {{ $errors->has('mobile') ? 'has-error' : '' }}">
                                                <label for="mobile">Mobile<span style="color:red">*</span></label>
                                                <input type="text" id="mobile" name="mobile" class="form-control" minlength="10" maxlength="10" placeholder="Enter  Mobile" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" value="{{ $data['mobile'] }}"  required>
                                                @if($errors->has('mobile'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('mobile') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div> 
                                        <div class="col-md-4 mt-4">
                                            <div class="form-group {{ $errors->has('mobile') ? 'has-error' : '' }}">
                                                <label for="mobile">Email<span style="color:red">*</span></label>
                                                <input type="email" id="email" name="email" class="form-control" value="{{ $data['email'] }}" placeholder="Enter Email" maxlength="100" required>
                                                @if($errors->has('email'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('email') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>
                                        
                                        <div class="col-md-4 mt-4">
                                            <div class="form-group {{ $errors->has('parent_name') ? 'has-error' : '' }}">
                                                <label for="parent_name">Parent Name <span style="color:red">*</span></label>
                                                <input type="text" id="parent_name" name="parent_name" class="form-control" value="{{ $data['parent_name'] }}"  placeholder="Enter Parent Name" maxlength="100" required>
                                                @if($errors->has('parent_name'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('parent_name') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>
                                        <div class="col-md-4 mt-4">
                                            <div class="form-group {{ $errors->has('communication_mode') ? 'has-error' : '' }}">
                                                <label for="communication_mode">Communication Mode <span style="color:red">*</span></label>
                                                <select class="form-control" name="communication_mode" id="communication_mode" required>
                                                        <option value="">Select Mode</option>
                                                        <option value="1" {{ $data['communication_mode'] == 1 ? 'selected' : '' }}>Whats App</option>
                                                        <option value="2" {{ $data['communication_mode'] == 2 ? 'selected' : '' }}>Email</option>
                                                        <option value="3" {{ $data['communication_mode'] == 3 ? 'selected' : '' }}>Text SMS</option>
                                                </select>
                                                @if($errors->has('communication_mode'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('communication_mode') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>
                                        
                                    </div>
                                        <div class="card-footer mt-2">
                                            <div class="mb-3" style="float: right;">
                                                <button type="submit"
                                                class="btn btn-success btn-user float-right" >Update</button>
                                                <a class="btn btn-primary float-right mr-3"
                                                    href="{{ route('student.index') }}">Cancel</a>
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
</script>
@endsection
