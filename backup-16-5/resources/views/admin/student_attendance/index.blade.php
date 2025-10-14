@extends('layouts.app')
@section('title', 'Student Attendance List')
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
                                <h5 class="card-title mb-0">Student Attendance List
                                </h5>
                                
                            </div> 
                            <div class="card-body">
                                <form method="post" action="{{ route('attendance.index') }}" id="myForm">
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
                                                <button id="mark-absent" class="btn btn-sm btn-danger mb-2" style="float: right; margin-left: 10px;">Mark as Absent</button>
                                                <button id="mark-attended" class="btn btn-sm btn-success mb-2" style="float: right;">Mark as Attended</button>

                                                <table class=" table table-bordered table-striped table-hover datatable">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th width="50">
                                                                <input type="checkbox" id="select-all">
                                                            </th>
                                                            <th width="50"> Sr No </th>
                                                            <th> Student Name </th>  
                                                            <th> Mobile </th>  
                                                            <th> Email </th>  
                                                            <th> Student Age </th>  
                                                            <th> Category Name </th>  
                                                            <th> Plan Name </th>  
                                                            <th> Batch Name </th>  
                                                            <th> Batch Day </th>  
                                                            <th> Amount </th>  
                                                            <th> Status </th>  
                                                            <th> Action </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                     @if(count($Student) > 0)
                                                    <?php $i = 1;
                                                    ?>
                                                        @foreach($Student as $key => $sdata)
                                                            <tr data-entry-id="{{ $sdata->student_id }}"  class="text-center">
                                                                <td >
                                                                    <input type="checkbox" class="student-checkbox" value="{{ $sdata->student_id }}">
                                                                </td>
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
                                                                     <?php 
                                                                    $daysOfWeek = [
                                                                            1 => 'Monday',
                                                                            2 => 'Tuesday',
                                                                            3 => 'Wednesday',
                                                                            4 => 'Thursday',
                                                                            5 => 'Friday',
                                                                            6 => 'Saturday',
                                                                            7 => 'Sunday',
                                                                        ];   
                                                                    ?>
                                                                    {{ $daysOfWeek[$sdata->batchday] ?? 'Invalid Day'  }}
                                                                </td>

                                                                <td>
                                                                    {{ $sdata->amount }}
                                                                </td>
                                                                <td>
                                                                    <?php 
                                                                     $status = App\Models\StudentAttendance::select('attendance')
                                                                                  ->where(['student_id' => $sdata->student_id])
                                                                                  ->latest()->first();
                                                                    ?>
                                                                    {{ $status->attendance ?? '-' }}</td>
                                                                <td>
                                                                    <div class="d-flex gap-2">
                                                                        <!-- 
                                                                        <a class="" href="#" data-bs-toggle="modal"
                                                                            title="Delete" data-bs-target="#deleteRecordModal"
                                                                            onclick="deleteData(<?= $sdata->student_id ?>);">
                                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                                        </a> -->
                                                                        <a class="" title="View"
                                                                            href="{{ route('attendance.view', $sdata->student_id) }}">
                                                                            <i class="fa fa-info"></i>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php $i++; ?>
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
                                                                        <a class="btn btn-danger" href="{{ route('logout') }}"
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
        function requestData(id) {
            $("#requestid").val(id);
        }
        function myFunction() 
        {
            $('#search').removeAttr('value');
            $('#batch').val('');
        }

    $(document).ready(function () {
        // Select all checkboxes
        $('#select-all').click(function () {
            $('.student-checkbox').prop('checked', this.checked);
        });

        // Mark selected students as attended
        $('#mark-attended').click(function () 
        {
            let selectedStudents = [];
            $('.student-checkbox:checked').each(function () {
                selectedStudents.push($(this).val());
            });

            if (selectedStudents.length === 0) {
                alert('No students selected!');
                return;
            }

        if (confirm('Are you sure you want to mark the selected students as attended?')) 
        {
                $('section').addClass('blurred'); // Blur the page
                $('#loader-overlay').show();   
                $('#loader').show();   

            $.ajax({
                url: '{{ route("attendance.markAttended") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    student_ids: selectedStudents
                },
                success: function (response) {
                    alert(response.message);
                    location.reload();
                },
                error: function (xhr) {
                    alert('Something went wrong!');
                },
                complete: function () {
                        // Hide loader after request completes (success or failure)
                        $('#loader-overlay').hide();
                        $('#loader').hide();
                        $('section').removeClass('blurred');
                }
            });
        }
        });

        $('#mark-absent').click(function () {
            let selectedStudents = [];
            $('.student-checkbox:checked').each(function () {
                selectedStudents.push($(this).val());
            });

            if (selectedStudents.length === 0) {
                alert('No students selected!');
                return;
            }

            if (confirm('Are you sure you want to mark the selected students as absent?')) {
                // Show loader before AJAX request
                $('section').addClass('blurred'); // Blur the page
                $('#loader-overlay').show();   
                $('#loader').show();   

                $.ajax({
                    url: '{{ route("attendance.markAbsent") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        student_ids: selectedStudents
                    },
                    success: function (response) {
                        alert(response.message);
                        //location.reload();
                    },
                    error: function (xhr) {
                        alert('Something went wrong!');
                    },
                    complete: function () {
                        // Hide loader after request completes (success or failure)
                        $('#loader-overlay').hide();
                        $('#loader').hide();
                        $('section').removeClass('blurred');
                    }
                });
            }
        });


        /* $('#mark-absent').click(function () 
        {
            let selectedStudents = [];
            $('.student-checkbox:checked').each(function () {
                selectedStudents.push($(this).val());
            });

            if (selectedStudents.length === 0) {
                alert('No students selected!');
                return;
            }

          if (confirm('Are you sure you want to mark the selected students as absent?')) 
        {
            $.ajax({
                url: '{{ route("attendance.markAbsent") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    student_ids: selectedStudents
                },
                success: function (response) {
                    alert(response.message);
                    location.reload();
                },
                error: function (xhr) {
                    alert('Something went wrong!');
                }
            });
        }
        });*/
    });
</script>
@endsection

