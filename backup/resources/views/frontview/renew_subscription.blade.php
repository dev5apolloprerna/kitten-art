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
            
            <div class="col-lg-9">
                <div class="section-title">
                    <span>Renew Subscription</span>
                    <!--<h2>Student </h2>-->
                </div>

                <div class="event-box-item">
                    <div class="row align-items-center">

                      <form method="post" action="{{route('student_renew_plan')}}">
                        @csrf 
                        <input type="hidden" name="student_id"  id="student_id"value="{{ $id }}"> 
                        <input type="hidden"  id="planId"value="{{ $plan->plan_id }}"> 
                        <input type="hidden"   id="batchId"value="{{ $plan->batch_id }}"> 
                        <div class="form-group py-2">
                          <select class="form-control"  name="category_id" id="category_id" required>
                            <option value="">Select Class *</option>
                            @foreach($category as $c)
                                <option value="{{ $c->category_id }}" {{ $plan->category_id == $c->category_id ? 'selected' : '' }}>{{ $c->category_name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group py-2">
                          <select class="form-control" name="plan_id" id="plan_id" required>
                            <option value="">select plan</option>
                        </select>
                        </div>
                        <div class="form-group py-2">
                          <select class="form-control" name="batch_id" id="batch_id" required>
                            <option value="">select batch</option>
                        </select>
                        </div>
                        <div class="form-group py-2">
                            <input type="text" value="" name="amount" id="amount" placeholder="Plan Amount" class="form-control" disabled> 
                        </div>
                        <div class="form-group py-2">
                            <input type="text" value="" name="plan_session" placeholder="Plan Session" id="plan_session" class="form-control" disabled> 
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
<script>
    $(document).ready(function() 
{
    
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
    function fetchPlans(categoryid, selectedPlanId) 
    {
        $.ajax({
            url: '../get-plan/' + categoryid,
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('#plan_id').empty();
                $('#plan_id').append('<option value="">Select Plan</option>');
                $.each(data, function(key, value) 
                {
                    const isSelected = value.planId == selectedPlanId ? 'selected' : '';
                    $('#plan_id').append('<option value="'+ value.planId +'" '+ isSelected +'>'+ value.plan_name +'</option>');
                     $('#amount').val(value.plan_amount);
                    $('#plan_session').val(value.plan_session);

                });
            }
        });
    }
    function fetchPlanAmount(planId) {
        $.ajax({
            url: '../get-plan-amount/' + planId,
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
    $('#plan_id').change(function() {
        var planId = $(this).val();
        if (planId) {
            // Fetch the plan amount when the plan is changed
            fetchPlanAmount(planId);
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