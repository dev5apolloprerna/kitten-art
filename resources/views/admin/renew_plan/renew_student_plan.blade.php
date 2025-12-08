@extends('layouts.app')

@section('title', 'Student Renew Plan')

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

                                <h5 class="card-title mb-0">Student Renew Plan



                                </h5>

                                

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

                                                            <th> Category Name </th>  

                                                            <th> Plan Name </th>  

                                                            <th> Batch Name </th>  

                                                            <th> Amount </th>  
                                                            <th> Renew Request Date </th>  

                                                            <th> Status </th>  

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
                                                                    {{ date('d-m-Y',strtotime($sdata->created_at)) ?? '-'  }}
                                                                </td>

                                                                <td>
                                                                    @if($sdata->status == 0)
                                                                    {{ 'Pending' }}
                                                                    @elseif($sdata->status == 1)
                                                                    {{ 'Accepted' }}
                                                                    @else
                                                                    {{ 'Rejected' }}
                                                                    @endif
                                                                </td>

                                                                <td>
                                                                    <div class="d-flex gap-2">
                                                                        <a class="" title="Edit"
                                                                            href="{{ route('renewPlan.edit_renew_student', $sdata->renewplan_id) }}">
                                                                            <i class="far fa-edit"></i>
                                                                        </a>

                                                                        <a class="mx-1" title="Edit Status" href="#" 
                                                                            data-bs-toggle="modal" data-bs-target="#editModal_{{ $sdata->renewplan_id }}">
                                                                            <i class="fa fa-check"></i>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                <div class="modal fade flip" id="editModal_{{ $sdata->renewplan_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                                <div class="modal-dialog">

                                                    <div class="modal-content">

                                                        <div class="modal-header bg-light p-3">

                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Status</h5>

                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"

                                                                id="close-modal"></button>

                                                        </div>

                                                        <form method="POST" action="{{ route('renewPlan.updatestatus') }}" autocomplete="off"

                                                            enctype="multipart/form-data">

                                                            @csrf

                                                            <input type="hidden" name="renewplan_id" id="renewplan_id" value="{{ $sdata->renewplan_id }}">



                                                            <div class="modal-body">
                                                                    <div class="payment-section" id="payment_section_{{ $sdata->renewplan_id }}" style="display: none;">
                                                                <div class="mb-3">

                                                                        <span style="color:red;">*</span>Payment Date

                                                                        <input type="date" name="payment_date" class="form-control" >
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
                                                                <div class="mb-3">

                                                                    <span style="color:red;">*</span>Status

                                                                    <select class="form-control status-dropdown" name="status" id="Editreview_status" data-id="{{ $sdata->renewplan_id }}">

                                                                        <option value="0" {{ $sdata['status'] == 0 ? 'selected' : '' }}>Pending</option>

                                                                        <option value="1" {{ $sdata['status'] == 1 ? 'selected' : '' }}>Accepted</option>

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

        function myFunction() 

        {

            $('#search').removeAttr('value');

            $('#batch').val('');

        }

$(document).ready(function () {

    // On page load — handle each modal
    $('.status-dropdown').each(function () {
        togglePaymentFields($(this));
    });

    // When status changes
    $('.status-dropdown').on('change', function () {
        togglePaymentFields($(this));
    });

    function togglePaymentFields(elem) {
        let id = elem.data('id');
        let val = elem.val();
        let section = $("#payment_section_" + id);

        if (val == "1") {
            section.show();   // Accepted
        } else {
            section.hide();   // Pending or Rejected
        }
    }
});

    </script>



@endsection



