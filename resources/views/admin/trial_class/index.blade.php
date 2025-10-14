@extends('layouts.app')
@section('title', 'Trial Class Student List')
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
                                <h5 class="card-title mb-0">Trial Class Student List
                                </h5>
                                
                            </div> 
                            <div class="card-body">
                                <form method="post" action="{{ route('trialClass.index') }}" id="myForm">
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
<!--                                                             <th> Plan Name (interested) </th>  
                                                            <th> Batch </th>  
 -->                                                            <th> No of Reminder Sent </th>  
                                                            <th> Status </th>  
                                                            <th> Action </th>
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
                                                                    {{ $sdata->parent_name ?? '' }}
                                                                </td>
                                                                <td>
                                                                    {{ $sdata->student_age ?? '' }}
                                                                </td>
                                                                <td>
                                                                    {{ $sdata->categoryName ?? '' }}
                                                                </td>
                                                                <!-- <td>
                                                                    {{ $sdata->planName ?? '' }}
                                                                </td>
                                                                <td>
                                                                    {{ $sdata->batchName ?? '' }}
                                                                </td> -->
                                                                <td>
                                                                    {{ $sdata->no_of_reminder_sent ?? '' }}
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
                                                                        <a class="mx-1" title="Edit Status" href="#" 
                                                                            data-bs-toggle="modal" data-bs-target="#editModal_{{ $sdata->trialclass_student_id }}">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>

                                                                        <a class="" href="#" data-bs-toggle="modal"
                                                                            title="Delete" data-bs-target="#deleteRecordModal"
                                                                            onclick="deleteData(<?= $sdata->trialclass_student_id ?>);">
                                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                                        </a>
                                                                        <a class="" title="View"
                                                                            href="{{ route('trialClass.view', $sdata->trialclass_student_id) }}">
                                                                            <i class="fa fa-info"></i>
                                                                        </a>
                                                                        <a class="mx-1" title="Send Mail" href="#" 
                                                                            data-bs-toggle="modal"
                                                                            title="Delete" data-bs-target="#mailModal"
                                                                            onclick="mailData(<?= $sdata->trialclass_student_id ?>);">
                                                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                        <div class="modal fade flip" id="editModal_{{ $sdata->trialclass_student_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-light p-3">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Status</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                                                id="close-modal"></button>
                                                        </div>
                                                        <form method="POST" action="{{ route('trialClass.updatestatus') }}" autocomplete="off"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="trialclass_student_id" id="trialclass_student_id" value="{{ $sdata->trialclass_student_id }}">

                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <span style="color:red;">*</span>Status
                                                                    <select class="form-control" name="status" id="Editreview_status">
                                                                        <option value="0" {{ $sdata['status'] == 0 ? 'selected' : '' }}>Pending</option>
                                                                        <option value="1" {{ $sdata['status'] == 1 ? 'selected' : '' }}>Convert</option>
                                                                        <option value="2" {{ $sdata['status'] == 2 ? 'selected' : '' }}>Rejected</option>
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


                                                        <?php $i++; ?>
                                                        @endforeach
                                                        @else
                                                         <tr>
                                                            <td colspan="10">
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
                                                                        
                                                                        <form id="bus-delete-form" method="POST" action="{{ route('trialClass.delete') }}">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <input type="hidden" name="trialclass_student_id" id="deleteid" value="">

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

<div class="modal fade flip" id="mailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel">Class Schedule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <form method="POST" action="{{ route('trialClass.sendmail') }}" autocomplete="off"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="trialclass_student_id" id="mailtrialclass_student_id" value="">

                    <div class="modal-body">
                        <div class="mb-3">
                            <span style="color:red;">*</span>Date
                                <input type="date" id="date" name="date" class="form-control">
                        </div>
                        <div class="mb-3">
                            <span style="color:red;">*</span>Time
                                <input type="time" id="time" name="time" class="form-control">
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="submit" class="btn btn-primary mx-2" id="add-btn">Send Mail</button>
                            <button type="button" class="btn btn-primary mx-2"
                                data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script>
        function deleteData(id) {
            $("#deleteid").val(id);
        }
         function mailData(id) { 
            $("#mailtrialclass_student_id").val(id);
        }
        function myFunction() 
        {
            $('#search').removeAttr('value');
        }
            document.addEventListener("DOMContentLoaded", function () {
        let today = new Date().toISOString().split("T")[0];
        document.getElementById("date").setAttribute("min", today);
    });

    </script>

@endsection

