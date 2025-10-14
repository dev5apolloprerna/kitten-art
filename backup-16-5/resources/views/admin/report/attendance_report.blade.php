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

                            <div id="message-container" style="display: none; padding: 10px; margin-bottom: 10px;"></div>

                            <div class="card-body">

                                <form method="post" action="{{ route('report.attendance_report') }}" >

                                    @csrf

                                     <div class="row"> 

                                        <div class="col-md-4"> 

                                            <div class="form-group">

                                                <label for="name">Search By Batch Name</label>

                                                <select name="batch" id="batch" class="form-control"  required> 

                                                    <option value="">Select Batch</option>

                                                    @foreach($batchdata as $b)

                                                    <option value="{{$b->batch_id}}" {{ $b->batch_id == $batch ? 'selected' : '' }}>{{ $b->batch_name }}</option>

                                                    @endforeach

                                                </select>   



                                            </div>

                                        </div>

                                        <div class="col-md-4">

                                            <div class="form-group">
                                            <label for="name">Search By Date </label>
                                            <input type="date" name="search" id="date" class="form-control" value="{{ $search ?? '' }}" required>
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

                             <div class="row" id="attendance_data">
                                <div class="col-lg-12">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class=" table table-bordered table-striped table-hover datatable">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th width="50"> Sr No </th>
                                                            <th> Student Name </th>  
                                                            <th> Student Age </th>  
                                                            <th> Age Group </th>  
                                                            <th> Plan Name </th>  
                                                            <th> Total Session </th>  
                                                            <th> Used Session </th>  
                                                            <th> Available Session </th>  
                                                            <th> Date </th>  
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
                                                                    {{ $sdata->student_age ?? '' }}
                                                                </td>
                                                                <td>
                                                                    {{ $sdata->categoryName ?? '-'  }}
                                                                </td>
                                                                <td>
                                                                    {{ $sdata->planName ?? '-'  }}
                                                                </td>
                                                                <td>
                                                                    {{ $sdata->credit_balance ?? '0'  }}
                                                                </td>
                                                                <td>
                                                                    {{ $sdata->debit_balance ?? '-'  }}
                                                                </td>
                                                                <td>
                                                                    {{ $sdata->closing_balance ?? '-'  }}
                                                                </td>
                                                                <td>
                                                                    {{ date('d-m-Y',strtotime($sdata->attendance_date)) ?? '-'  }}
                                                                </td>
                                                                <td>
                                                                    {{ $sdata->attendance}}
                                                                </td>
                                                                <td>
                                                                    <a  title="Change Attendance Status" href="#"  data-bs-toggle="modal"data-bs-target="#attendanceReportModal_{{ $sdata->attendence_id }}" class="mx-2">
                                                                        <i class="fas fa-edit"></i> <!-- Edit Icon -->
                                                                    </a>
                                                                </td>
                                                        </tr>

 <div class="modal fade flip" id="attendanceReportModal_{{ $sdata->attendence_id }}" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-light p-3">
                        <h5 class="modal-title" id="reportModalLabel">Edit Attendance</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="close-modal"></button>
                    </div>
                    <form method="POST" action="{{ route('report.editAttendance') }}" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="attendence_id" id="attendence_id" value="{{ $sdata->attendence_id }}">
                        <input type="hidden" name="searchh"  class="form-control" value="{{ $search ?? '' }}" required>
                        <input type="hidden" name="batchh"  value="{{ $batch}}">
                        <div class="modal-body">
                            <div class="mb-5">
                                 <div class="mt-2 text-center">
                                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                        <h4>Are you Sure ?</h4>
                                        <p class="text-muted mx-4 mb-0">
                                             You want to Update Attendance From 
                                            @if($sdata->attendance == 'P') 
                                        <input type="hidden" name="status" value="A">

                                            <h5>{{ 'Present To Absent' }} ?</h5>

                                            @elseif($sdata->attendance == 'A') 
                                           <h5> {{ 'Absent To Present' }} ?
                                        <input type="hidden" name="status" value="P">

                                           </h5>
                                            @endif </p>
                                    </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="submit" class="btn btn-primary mx-2" id="button_1">Update</button>
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
                                                            <td colspan="9">
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

                                            <!--end modal -->
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

/*$('#myForm').on('submit', function(e) 
    {
            e.preventDefault();

            let date = $('#date').val();
            let batch = $('#batch').val();


    let messageContainer = $('#message-container');
    messageContainer.hide();

            $.ajax({
                url: 'ajax_attendance_report',
                type: 'POST',
                data: {
                    date: date,
                    batch: batch,
                    _token: '{{ csrf_token() }}' // Include CSRF token
                },
                success: function(response) 
                {                    
                    $('#attendance_data').html(response);
                        //messageContainer.hide(); // Hide the message on successful response

                },
                error: function (xhr) {
            let errorMessages = '<ul>';
            if (xhr.status === 422) { // Laravel validation error
                let errors = xhr.responseJSON.errors;
                $.each(errors, function (key, value) {
                    errorMessages += `<li>${value[0]}</li>`;
                });
                errorMessages += '</ul>';
                messageContainer.html(errorMessages)
                    .css({ 'color': 'red', 'background': '#ffdddd', 'border': '1px solid red' })
                    .fadeIn();
            } else {
                messageContainer.html('Error: ' + xhr.responseText)
                    .css({ 'color': 'red', 'background': '#ffdddd', 'border': '1px solid red' })
                    .fadeIn();
            }
        }
            });
    });

$(document).ready(function() {
  $("#button_1").click(function(e) {

 });
    });*/
    </script>



@endsection



