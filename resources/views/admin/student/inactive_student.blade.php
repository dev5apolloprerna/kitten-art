@extends('layouts.app')

@section('title', 'Active Student List')

@section('content')



<?php $profileId = Request::segment(3);?>



    <div class="main-content">

        <div class="page-content">

            <div class="container-fluid">



                {{-- Alert Messages --}}

                @include('common.alert')

                <div class="row">

                    <div class="col-lg-12">

                        <div class="card">

                            <div class="card-header">

                                <h5 class="card-title mb-0">Active Student List



                                </h5>

                                

                            </div> 

                            <div class="card-body">

                                <form method="post" action="{{ route('student.active_student') }}" id="myForm">

                                    @csrf

                                     <div class="row"> 

                                        <div class="col-md-4"> 

                                            <div class="form-group">

                                                <label for="name">Search By Batch Name</label>

                                                <select name="batch" id="batch" class="form-control"  > 

                                                    <option value="">Select Batch</option>

                                                    @foreach($batchdata as $b)

                                                    <option value="{{$b->batch_id}}" {{ $b->batch_id == $batch ? 'selected' : '' }}>{{ $b->batch_name }}</option>

                                                    @endforeach

                                                </select>   



                                            </div>

                                        </div>

                                        <div class="col-md-4">

                                            <div class="form-group">

                                                <label for="name">Search By Student Name </label>

                                                <input type="text" name="search" id="search" class="form-control" value="{{ $search ?? '' }}">

                                            </div>

                                        </div>

                                        <div class="col-md-3">

                                            <div class="form-group">

                                            <input class="btn btn-primary" style="margin-top: 10%;" type="submit" value="{{'Search'}}">

                                            <input class="btn btn-primary" style="margin-top: 10%;" type="submit" onclick="myFunction()" value="{{'Reset'}}">



                                            </div>

                                        </div>

                                    </div>

                                </form>

                            </div> 

                             <div class="row">

                                <div class="col-lg-12">

                                        <div class="card-body">

                                            <div class="table-responsive">

                                                <table class=" table table-bordered table-striped table-hover datatable">

                                                    <thead>

                                                        <tr class="text-center">

                                                            <th width="50"> Sr No </th>

                                                            <th> Student Name </th>  

                                                            <th> Mobile </th>  

                                                            <th> Email </th>  

                                                            <th> Student Age </th>  

                                                            <th> Category Name </th>  

                                                            <th> Plan Name </th>  

                                                            <th> Batch Name </th>  

                                                            <th> Amount </th>  

                                                            <th> Total Session </th>  

                                                            <th> Used Session </th>  

                                                            <th> Available Session </th>  

                                                            <th width="90"> Action </th>

                                                        </tr>

                                                    </thead>

                                                    <tbody>

                                                     @if(count($Student) > 0)

                                                    <?php $i = 1;

                                                    ?>

                                                        @foreach($Student as $key => $sdata)

                                                            <tr data-entry-id="{{ $sdata->student_id }}" class="text-center">

                                                                <td>

                                                                    {{ $i + $Student->perPage() * ($Student->currentPage() - 1) }}

                                                                </td>

                                                                <td>
                                                                    {{ $sdata->student_first_name ?? '' }} {{ $sdata->student_last_name ?? '' }}
                                                                </td>

                                                                <td>

                                                                    {{ $sdata->mobile ?? '' }}

                                                                </td>

                                                                <td>

                                                                    {{ $sdata->email ?? '' }}

                                                                </td>

                                                                <td>

                                                                    {{ $sdata->student_age ?? '' }}

                                                                </td>

                                                                <td>

                                                                    {{ $sdata->categoryName ?? '-'  }}

                                                                </td>

                                                                <td>

                                                                    {{ $sdata->planName ?? '-'  }}

                                                                </td>

                                                                <td>

                                                                    {{ $sdata->batchname ?? '-'  }}

                                                                </td>

                                                                <td>

                                                                    {{ $sdata->amount ?? '-'  }}

                                                                </td>

                                                                <td>

                                                                    {{ $sdata->total_session ?? '0'  }}

                                                                </td>

                                                                <td>

                                                                    {{ $sdata->debit_balance ?? '-'  }}

                                                                </td>

                                                                <td>

                                                                    {{ $sdata->total_session  - $sdata->debit_balance ?? '-'  }}

                                                                </td>

                                                                

                                                                <td>

                                                                    <div class="d-flex gap-2">

                                                                        <!--<a class="" title="Edit"

                                                                            href="{{ route('student.edit', $sdata->student_id) }}">

                                                                            <i class="far fa-edit"></i>

                                                                        </a>-->

                                                                        <a class="" href="#" data-bs-toggle="modal"

                                                                            title="Delete" data-bs-target="#deleteRecordModal"

                                                                            onclick="deleteData(<?= $sdata->student_id ?>);">

                                                                            <i class="fa fa-trash" aria-hidden="true"></i>

                                                                        </a>

                                                                        <a class="mx-1" title="change password" href="{{ route('student.changepassword', $sdata->student_id) }}">

                                                                            <i class="fa-solid fa-key"></i>

                                                                        </a>

                                                                        <a class="" title="View"

                                                                            href="{{ route('student.active_student_view', ['id' => $sdata->student_id, 'ctx' => 'inactive']) }}">

                                                                            <i class="fa fa-info"></i>
                                                                        </a>
                                                                        <a class="" href="#" data-bs-toggle="modal"
                                                                            title="Renew Plan Form" data-bs-target="#RenewModal_{{ $sdata->student_id }}">
                                                                            <i class="fas fa-rotate-right"></i>
                                                                        </a>
                                                                        <a class="" href="#" data-bs-toggle="modal"
                                                                            title="Rewnew plan" data-bs-target="#renewModal"
                                                                            onclick="renewPlan(<?= $sdata->student_id ?>);">
                                                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                                                        </a>

                                                                    </div>

                                                                </td>

                                                            </tr>


                                                    <div class="modal fade zoomIn" id="renewModal" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                                                        id="btn-close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mt-2 text-center">
                                                                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                                                            colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px">
                                                                        </lord-icon>
                                                                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                                            <h4>Are you Sure ?</h4>
                                                                            <p class="text-muted mx-4 mb-0">Are you Sure You want Send Renew Plan Request For This Student
                                                                                ?</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                                        <a class="btn btn-danger" id="confirm-payment" href="{{ route('logout') }}"
                                                                            onclick="event.preventDefault(); document.getElementById('request-form').submit();">
                                                                            Yes,
                                                                            Confirm It!
                                                                        </a>
                                                                        <button type="button" class="btn w-sm btn-light"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        
                                                                        <form id="request-form" method="POST" action="{{ route('renewPlan.create') }}">
                                                                            @csrf
                                                                            <input type="hidden" name="student_id" id="renew_student_id" value="">


                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end modal -->

                                                    <div class="modal fade flip" id="RenewModal_{{ $sdata->student_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-light p-3">
                                                            <h5 class="modal-title" id="exampleModalLabel">Renew Student Plan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                                                id="close-modal"></button>
                                                        </div>
                                                        <form method="post" action="{{route('renewPlan.admin_submit_renew_plan')}}">

                                                            @csrf 

                                                            <input type="hidden" name="student_id"  id="student_id"value="{{ $sdata->student_id }}"> 

                                                            <input type="hidden"  id="planId"value="{{ $sdata->plan_id }}"> 

                                                            <input type="hidden"   id="batchId"value="{{ $sdata->batch_id }}"> 
                                                    <div class="modal-body">
                                                                <div class="mb-3">
                                                            <div class="mb-3">
                                                              <select class="form-control"  name="category_id" id="category_id" required>

                                                                <option value="">Select Class *</option>

                                                                @foreach($category as $c)

                                                                    <option value="{{ $c->category_id }}" {{ $sdata->category_id == $c->category_id ? 'selected' : '' }}>{{ $c->category_name }}</option>

                                                                @endforeach

                                                              </select>

                                                            </div>

                                                            <div class="mb-3">
                                                              <select class="form-control" name="plan_id" id="plan_id" required>

                                                                <option value="">select plan</option>

                                                            </select>

                                                            </div>

                                                            <div class="mb-3">
                                                              <select class="form-control" name="batch_id" id="batch_id" required>

                                                                <option value="">select batch</option>

                                                            </select>

                                                            </div>

                                                            <div class="mb-3">
                                                                <input type="text" value="" name="amount" id="amount" placeholder="Plan Amount" class="form-control" readonly> 

                                                            </div>

                                                            <div class="mb-3">
                                                                <input type="text" value="" name="plan_session" placeholder="Plan Session" id="plan_session" class="form-control" readonly> 

                                                            </div>
                                                        </div>


                                                         <div class="modal-footer">
                                                                <div class="hstack gap-2 justify-content-end">
                                                                    <button type="submit" class="btn btn-primary mx-2" id="add-btn">Submit</button>
                                                                    <button type="button" class="btn btn-primary mx-2"
                                                                        data-bs-dismiss="modal">Cancel</button>
                                                                </div>
                                                            </div>
                                                     </form>
                                                    </div>
                                                </div>
                                            </div>
                                                        <?php $i++; ?>

                                                        @endforeach

                                                        @else

                                                         <tr>

                                                            <td colspan="12">

                                                                <center>

                                                            No data Found

                                                        </center>

                                                            <td>



                                                        </tr>

                                                        @endif

                                                    </tbody>

                                                </table>

                                             <div class="d-flex justify-content-center mt-3">

                                                {{ $Student->links() }}

                                            </div>

                                                @if(count($Student) > 0)



                                                     <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">

                                                        <div class="modal-dialog modal-dialog-centered">

                                                            <div class="modal-content">

                                                                <div class="modal-header">

                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"

                                                                        id="btn-close"></button>

                                                                </div>

                                                                <div class="modal-body">

                                                                    <div class="mt-2 text-center">

                                                                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"

                                                                            colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px">

                                                                        </lord-icon>

                                                                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">

                                                                            <h4>Are you Sure ?</h4>

                                                                            <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Record

                                                                                ?</p>

                                                                        </div>

                                                                    </div>

                                                                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">

                                                                        <a class="btn btn-danger" href="{{ route('logout') }}"

                                                                            onclick="event.preventDefault(); document.getElementById('bus-delete-form').submit();">

                                                                            Yes,

                                                                            Delete It!

                                                                        </a>

                                                                        <button type="button" class="btn w-sm btn-light"

                                                                            data-bs-dismiss="modal">Close</button>

                                                                        

                                                                        <form id="bus-delete-form" method="POST" action="{{ route('student.delete') }}">

                                                                            @csrf

                                                                            @method('DELETE')

                                                                            <input type="hidden" name="student_id" id="deleteid" value="">



                                                                        </form>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <!--end modal -->

                                                    @endif

                                                </div>

                                            </div>



                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



@endsection

@section('scripts')

    <script>

        function deleteData(id) {

            $("#deleteid").val(id);

        }

        function myFunction() 

        {

            $('#search').removeAttr('value');

            $('#batch').val('');

        }

        function renewPlan(id) {
            $("#renew_student_id").val(id);
        }

 $(document).ready(function() 

{

    

  var selectedCategoryId = $('#category_id').val(); // Get selected category ID from the dropdown

    var selectedBatchId = $('#batchId').val(); // Add a custom attribute for selected batch ID

    var selectedPlanId = $('#planId').val(); // Add a custom attribute for selected plan ID



    // Function to fetch and populate the batch dropdown

    function fetchBatches(categoryid, selectedBatchId) {

        $.ajax({

            url: '../../get-batch/' + categoryid,

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

            url: '../../get-plan/' + categoryid,

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

            url: '../../get-plan-amount/' + planId,

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



