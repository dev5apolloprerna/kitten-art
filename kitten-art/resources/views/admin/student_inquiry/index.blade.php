@extends('layouts.app')
@section('title', 'Student Inquiry')
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
                                <h5 class="card-title mb-0">Student Inquiry
                                </h5>
                                
                            </div> 
                            <div class="card-body">
                                <form method="post" action="{{ route('studentinquiry.index') }}" id="myForm">
                                    @csrf
                                     <div class="row"> 
                                        <div class="col-md-5">
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
                                                            <th> Parent Name </th>  
                                                            <th> Student Age </th>  
                                                            <th> Category Name </th>  
                                                            <th> Plan Name (interested) </th>  
                                                            <th> Batch </th>  
                                                            <th> Status </th>  
                                                            <th> Action </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                     @if(count($Student) > 0)
                                                        <?php $i = $Student->total() - ($Student->perPage() * ($Student->currentPage() - 1)); ?>
                                                        @foreach($Student as $key => $sdata)
                                                        <?php 
                                                        $batches = App\Models\Batch::where(['category_id'=>$sdata->category_id,'iStatus' => 1,'isDelete' => 0])->get();
                                                        $plans = App\Models\Plan::where(['category_id'=>$sdata->category_id,'iStatus' => 1,'isDelete' => 0])->get();
                                                        ?>

                                                            <tr data-entry-id="{{ $sdata->student_id }}" class="text-center">
                                                                <td>
                                                                    {{ $i }}
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
                                                                    {{ $sdata->parent_name ?? '' }}
                                                                </td>
                                                                <td>
                                                                    {{ $sdata->student_age ?? '' }}
                                                                </td>
                                                                <td>
                                                                    {{ $sdata->categoryName ?? '' }}
                                                                </td>
                                                                <td>
                                                                    {{ $sdata->planName ?? '' }}
                                                                </td>
                                                                <td>
                                                                    {{ $sdata->batchName ?? '' }}
                                                                </td>
                                                                <td>
                                                                    @if($sdata->status == 0)
                                                                        {{ 'Pending' }}
                                                                    @elseif($sdata->status == 1)
                                                                        {{ 'Rejected' }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex gap-2">
                                                                        <a class="" title="Edit"
                                                                            href="{{ route('studentinquiry.edit', $sdata->student_inquiry_id) }}">
                                                                            <i class="far fa-edit"></i>
                                                                        </a>
                                                                            <a class="mx-1" title="Edit Status" href="#" 
                                                                            data-bs-toggle="modal" data-bs-target="#editModal_{{ $sdata->student_inquiry_id }}">
                                                                            <i class="fa fa-check"></i>
                                                                        </a>

                                                                        <a class="" href="#" data-bs-toggle="modal"
                                                                            title="Delete" data-bs-target="#deleteRecordModal"
                                                                            onclick="deleteData(<?= $sdata->student_inquiry_id ?>);">
                                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                                        </a>
                                                                        <a class="" href="#" data-bs-toggle="modal"
                                                                            title="Request For Payment" data-bs-target="#requestModal"
                                                                            onclick="requestData(<?= $sdata->student_inquiry_id ?>);">
                                                                            <i class="fa fa-credit-card" aria-hidden="true"></i>
                                                                        </a>
                                                                        <a class="" title="View"
                                                                            href="{{ route('studentinquiry.view', $sdata->student_inquiry_id) }}">
                                                                            <i class="fa fa-info"></i>
                                                                        </a> 
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                <div class="modal fade flip" id="editModal_{{ $sdata->student_inquiry_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-light p-3">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Status</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                                                id="close-modal"></button>
                                                        </div>
                                                        <form method="POST" action="{{ route('studentinquiry.updatestatus') }}" autocomplete="off"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="student_inquiry_id" id="student_inquiry_id" value="{{ $sdata->student_inquiry_id }}">

                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                <span style="color:red;">*</span>Plan
                                                                <select class="form-control" name="plan_id" id="plan_id" required>
                                                                    <option value="">select plan</option>
                                                                   @foreach($plans as $plan)
                                                            <option value="{{ $plan->planId }}" {{ $sdata['plan_id'] == $plan->planId ? 'selected' : '' }}>
                                                                {{ $plan->plan_name }}
                                                            </option>
                                                        @endforeach

                                                                    </option>
                                                                </select> 
                                                                </div>
                                                                <div class="mb-3">
                                                                <span style="color:red;">*</span>Batch
                                                                <select class="form-control" name="batch_id" id="batch_id" required>
                                                                    <option value="">select batch</option>
                                                                   @php
                                                                        $weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                                                    @endphp

                                                                    @foreach($batches as $batch)
                                                                        <option value="{{ $batch->batch_id }}" {{ $sdata['batch_id'] == $batch->batch_id ? 'selected' : '' }}>
                                                                            {{ $batch->batch_name }} 
                                                                        </option>
                                                                    @endforeach
                                                                    </option>
                                                                </select> 
                                                                </div>
                                                                <div class="mb-3">
                                                                    <span style="color:red;">*</span>Status
                                                                    <select class="form-control" name="status" id="Editreview_status">
                                                                        <option value="0" {{ $sdata['status'] == 0 ? 'selected' : '' }}>Pending</option>
                                                                        <option value="2" {{ $sdata['status'] == 2 ? 'selected' : '' }}>Convert</option>
                                                                        <option value="1" {{ $sdata['status'] == 1 ? 'selected' : '' }}>Rejected</option>
                                                                    </select >
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="hstack gap-2 justify-content-end">
                                                                    <button type="submit" class="btn btn-primary mx-2" id="add-btn">Update</button>
                                                                    <button type="button" class="btn btn-primary mx-2"
                                                                        data-bs-dismiss="modal">Cancel</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade zoomIn" id="requestModal" tabindex="-1" aria-hidden="true">
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
                                                                            <p class="text-muted mx-4 mb-0">Are you Sure You want to Send Payment Request To This Student
                                                                                 ?</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                                        <a class="btn btn-danger" href="{{ route('logout') }}" id="resend-payment-request"
                                                                            onclick="event.preventDefault(); document.getElementById('request-form').submit();">
                                                                            Yes,
                                                                            Send It!
                                                                        </a>
                                                                        <button type="button" class="btn w-sm btn-light"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        
                                                                        <form id="request-form" method="POST" action="{{ route('student.paymentRequest') }}">
                                                                            @csrf
                                                                            <input type="hidden" name="student_request_id" id="requestid" value="">


                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end modal -->

                                                        <?php $i--; ?>
                                                        @endforeach
                                                        @else
                                                         <tr>
                                                            <td colspan="11">
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
                                                                        
                                                                        <form id="bus-delete-form" method="POST" action="{{ route('studentinquiry.delete') }}">
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
        }
        function requestData(id) {
            $("#requestid").val(id);
        }
        $('#resend-payment-request').click(function () 
    {
        // Show loader
        $('#loader-overlay').show();
        $('#loader').show();           // Show spinner
        
        // Submit the form after showing the loader
        $('#request-form').submit();
    });

    // Hide loader on modal close
    $('#paymentModal').on('hidden.bs.modal', function () {
        $('#loader-overlay').hide();
        $('#loader').hide(); 
    });

    </script>

@endsection

