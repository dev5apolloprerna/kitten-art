@extends('layouts.app')
@section('title', 'Pending Student List')
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
                                <h5 class="card-title mb-0">Pending Student List
                                    
                                </h5>
                                
                            </div> 
                            <div class="card-body">
                                <form method="post" action="{{ route('student.register_student') }}" id="myForm">
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
                                                <input type="text" name="search" id="search" placeholder="Search By Student Name" class="form-control" value="{{ $search ?? '' }}">
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
                                                                    <div class="d-flex gap-2">
                                                                        <a class="" title="Edit"
                                                                            href="{{ route('student.edit', $sdata->student_id) }}">
                                                                            <i class="far fa-edit"></i>
                                                                        </a>
                                                                        
                                                                        <a class="" href="#" data-bs-toggle="modal"
                                                                            title="Mark As Paid" data-bs-target="#paymentModal_<?= $sdata->student_id ?>"
                                                                            onclick="paymentData(<?= $sdata->student_id ?>);">
                                                                            <i class="fa fa-dollar" aria-hidden="true"></i>
                                                                        </a>

                                                                        <a class="" href="#" data-bs-toggle="modal"
                                                                            title="Delete" data-bs-target="#deleteRecordModal"
                                                                            onclick="deleteData(<?= $sdata->student_id ?>);">
                                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                                        </a>
                                                                       <!--  <a class="mx-1" title="change password" href="{{ route('student.changepassword', $sdata->student_id) }}">
                                                                            <i class="fa-solid fa-key"></i>
                                                                        </a> -->
                                                                        <a class="" title="View"
                                                                            href="{{ route('student.view', $sdata->student_id) }}">
                                                                            <i class="fa fa-info"></i>
                                                                        </a> 
                                                                       
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php $i++; ?>

                                                        <div class="modal fade flip" id="paymentModal_{{ $sdata->student_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                                        <div class="modal-dialog">
                                                            <div class="modal-content">

                                                                <div class="modal-header bg-light p-3">

                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Status</h5>

                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"

                                                                    id="close-modal"></button>

                                                                </div>

                                                                <form id="request-form" method="POST" action="{{ route('student.updatepaid_student') }}">
                                                                            @csrf

                                                                <input type="hidden" name="student_request_id" id="paymentid" value="{{ $sdata->student_id }}">



                                                                <div class="modal-body">

                                                                    <div class="mb-3">

                                                                        <span style="color:red;">*</span>Payment Date

                                                                        <input type="date" name="payment_date" class="form-control" value="{{ date('Y-m-d') }}">

                                                                    </div>
                                                                    <div class="mb-3">

                                                                        <span style="color:red;">*</span>Status

                                                                        <select class="form-control" name="payment_mode" id="Editpayment_mode">
                                                                        @foreach($paymentmode as $p)
                                                                        <option value="{{ $p->id }}" {{ $p->type == $sdata->payment_mode ? 'selected' : '' }}>{{ $p->type }}</option>

                                                                        @endforeach
                                                                        </select >

                                                                    </div>

                                                                </div>

                                                                <div class="modal-footer">

                                                                    <div class="hstack gap-2 justify-content-end">

                                                                        <button type="submit" class="btn btn-primary mx-2" id="confirm-payment">Submit</button>

                                                                        <button type="button" class="btn btn-primary mx-2"

                                                                        data-bs-dismiss="modal">Cancel</button>

                                                                    </div>

                                                                </div>

                                                            </form>

                                                        </div>

                                                    </div>

                                                </div>

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
                                                                            onclick="event.preventDefault(); document.getElementById('student-delete-form').submit();">
                                                                            Yes,
                                                                            Delete It!
                                                                        </a>
                                                                        <button type="button" class="btn w-sm btn-light"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        
                                                                        <form id="student-delete-form" method="POST" action="{{ route('student.delete') }}">
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

                                                    

                                                    <!-- <div class="modal fade zoomIn" id="paymentModal" tabindex="-1" aria-hidden="true">
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
                                                                            <p class="text-muted mx-4 mb-0">Are you Sure You want to Confirm this Student Payment
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
                                                                        
                                                                        <form id="request-form" method="POST" action="{{ route('student.updatepaid_student') }}">
                                                                            @csrf
                                                                            <input type="hidden" name="student_request_id" id="paymentid" value="">


                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
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
        /*function paymentData(id) {
            $("#paymentid").val(id);
        }*/
        function myFunction() 
        {
            $('#search').removeAttr('value');
            $('#batch').val('');
        }
$('#confirm-payment').click(function () 
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

