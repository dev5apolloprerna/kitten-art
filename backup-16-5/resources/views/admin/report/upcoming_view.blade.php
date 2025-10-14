@extends('layouts.app')



@section('title', 'View Student Details')



@section('content')



      <div class="main-content">

        <div class="page-content">

            <div class="container-fluid">



                {{-- Alert Messages --}}

                @include('common.alert')

                <div class="row">

                    <div class="col-lg-12">

                        <div class="card">

                            <div class="card-header">

                                <h5 class="card-title mb-0">Student Details

                                    <a href="{{ url()->previous() }}" style="float: right;" class="btn btn-sm btn-primary">

                                        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back

                                    </a>



                                </h5>

                                

                            </div>

                             <div class="row">

                                <div class="col-lg-12">

                                    <div class="card">

                                        <div class="card-body">

                                            <div class="table-responsive">

                                                <table class=" table table-bordered table-striped table-hover datatable">

                                                        <tr>

                                                            <th>

                                                                Student Name

                                                            </th>

                                                            <th>

                                                               Student Age

                                                            </th>

                                                            <th>

                                                               Mobile

                                                            </th>

                                                            <th>

                                                               Email

                                                            </th>

                                                            <th>

                                                               Parent Name

                                                            </th>

                                                            <th>

                                                               Login Id

                                                            </th>

                                                            <th>

                                                               Communication Mode

                                                            </th>

                                                        </tr>

                                                        <tr>

                                                            <td>
                                                                    {{ $data->student_first_name ?? '' }} {{ $data->student_last_name ?? '' }}
                                                                </td>

                                                            <td> {{ $data->student_age }}</td>

                                                            <td> {{ $data->mobile }}</td>

                                                            <td> {{ $data->email }}</td>

                                                            <td> {{ $data->parent_name   }}</td>

                                                            <td> {{ $data->login_id   }}</td>

                                                            <td>

                                                                @if($data->communication_mode == 1)

                                                                    {{ 'Whats App' }}

                                                                @elseif($data->communication_mode == 2)

                                                                 {{ 'Email' }}

                                                                @elseif($data->communication_mode == 3)

                                                                 {{ 'Text SMS' }}

                                                                @endif



                                                            </td>

                                                        </tr>



                                                    </tbody>

                                                </table>

                                                <div class="card-header">

                                                        <h5 class="card-title mb-0">Student Subscription Details</h5>

                                                </div>

                                                <table class=" table table-bordered table-striped table-hover datatable">

                                                    <tr>    

                                                        <th>Plan Name</th>

                                                        <th>Plan Amount</th>

                                                        <th>Plan Session</th>

                                                        <th>Used Session</th>

                                                        <th>Remaining Session</th>

                                                        <th>Activation Date</th>

                                                        <!-- <th>Expiry Date</th> -->

                                                    </tr>

                                                    <?php

                                                   $dbalance=$debit_balance-$credit_balance;

                                                   

                                                    ?>
                                                    @if(sizeof($subscription) !=0)
                                                    @foreach($subscription as $s)

                                                    <?php 

                                                        // Determine how many sessions have been used

                                                        $usedsession = min($s->plan_session, $dbalance);

                                                        $remainingSession = $s->plan_session - $usedsession;

                                                        $dbalance -= $usedsession; // Deduct used sessions from balance

                                                

                                                        // If dbalance goes negative, show the remaining session correctly

                                                        if ($dbalance < 0) {

                                                            $remainingSession = $dbalance;

                                                        }

                                                    ?>

                                                    <tr>

                                                       <td>{{ $s->planName }}</td>

                                                       <td>{{ $s->amount }}</td>

                                                       <td>{{ $s->plan_session }}</td>

                                                        <td>{{ $usedsession }}</td>

                                                        <td>{{ $remainingSession }}</td>

                                                       <td>{{ date('d-m-Y',strtotime($s->activate_date)) }}</td>

                                                       <!-- <td>{{ date('d-m-Y',strtotime($s->expired_date)) }}</td> -->

                                                    </tr>

                                                    @endforeach
                                                    @else
                                                    <tr class="text-center">
                                                        <td colspan="6" ><b>No Data Found</b></td>
                                                    </tr>
                                                    @endif

                                                </table>





                                                <div class="card-header">

                                                        <h5 class="card-title mb-0">Student Attendance Details</h5>

                                                </div>

                                                <table class=" table table-bordered table-striped table-hover datatable">

                                                    <tr>    

                                                        <th>Category Name</th>

                                                        <th>Batch Name</th>

                                                        <th>Day</th>

                                                        <th>Attendance</th>

                                                        <th>Attendance Date</th>
                                                        <th>Action</th>

                                                    </tr>
                                                @if(sizeof($attendance) != 0)
                                                    @foreach($attendance as $a)

                                                    <tr>

                                                       <td>{{ $a->categoryName }}</td>

                                                       <td>{{ $a->batchname }}</td>

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

                                                                    {{ $daysOfWeek[$a->day] ?? 'Invalid Day'  }}

                                                       </td>

                                                       <td>{{ $a->attendance }}</td>

                                                       <td >{{ date('d-m-Y',strtotime($a->attendance_date)) }} </td>
                                                       <td>
                                                         @if($loop->first) <!-- Check if this is the last record -->
                                                            <a  title="Change Attendance Status" href="#"  data-bs-toggle="modal" data-bs-target="#attendanceModal_{{ $a->attendence_id }}"
                                                                class="mx-2">
                                                                <i class="fas fa-edit"></i> <!-- Edit Icon -->
                                                            </a>
                                                        @endif
                                                       </td>

                                                    </tr>
                                                    
                                                    <div class="modal fade flip" id="attendanceModal_{{ $a->attendence_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-light p-3">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Attendance</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                                                id="close-modal"></button>
                                                        </div>
                                                        <form method="POST" action="{{ route('attendance.edit') }}" autocomplete="off"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="attendence_id" id="attendence_id" value="{{ $a->attendence_id }}">
                                                            <div class="modal-body">
                                                                <div class="mb-5">
                                                                     <div class="mt-2 text-center">
                                                                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                                            <h4>Are you Sure ?</h4>
                                                                            <p class="text-muted mx-4 mb-0">
                                                                                 You want to Update Attendance From 
                                                                                @if($a->attendance == 'P') 
                                                                            <input type="hidden" name="status" value="A">

                                                                                <h5>{{ 'Present To Absent' }} ?</h5>

                                                                                @elseif($a->attendance == 'A') 
                                                                               <h5> {{ 'Absent To Present' }} ?
                                                                            <input type="hidden" name="status" value="P">

                                                                               </h5>
                                                                                @endif </p>
                                                                        </div>
                                                                        <!-- 
                                                                    <span style="color:red;">*</span>Attendance
                                                                    <select class="form-control" name="status" id="Editreview_status">
                                                                        <option value="P" {{ $a->attendance == 'P' ? 'selected' : '' }}>P</option>
                                                                        <option value="A" {{ $a->attendance == 'A' ? 'selected' : '' }}>A</option>
                                                                    </select > -->
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

                                                    @endforeach
                                                    @else
                                                    <tr class="text-center">
                                                        <td colspan="6" ><b>No Data Found</b></td>
                                                    </tr>
                                                    @endif

                                                </table>

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