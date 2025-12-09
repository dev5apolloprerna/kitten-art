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

                                    <a href="{{ route('attendance.index') }}" style="float: right;" class="btn btn-sm btn-primary">

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
@foreach($subscriptions as $sub)
    {{-- Subscription Details as Card --}}
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">{{ $sub->planName }}</h5>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-4"><strong>Payment Date:</strong> {{ $sub->payment_date ? date('d-m-Y', strtotime($sub->payment_date)) : '-' }}</div>
                <div class="col-md-4"><strong>Payment Mode:</strong> {{ $sub->payment_mode }}</div>
                <div class="col-md-4"><strong>Plan Amount:</strong> {{ $sub->planAmount }}</div>
                
            </div>
            <div class="row mb-2">
                <div class="col-md-4"><strong>Total Sessions:</strong> {{ $sub->total_session }}</div>
                <div class="col-md-4"><strong>Used Sessions:</strong> {{ $sub->debit_balance }}</div>
                <div class="col-md-4"><strong>Remaining Sessions:</strong> {{ $sub->total_session-$sub->debit_balance }}</div>
            </div>
            <div class="row mb-2">
                
                <div class="col-md-4"><strong>Activation Date:</strong> {{ date('d-m-Y', strtotime($sub->activate_date)) }}</div>
                <div class="col-md-4"><strong>Batch Name:</strong> {{ $sub->batchName }}</div>
            </div>
        </div>
    </div>

    {{-- Attendance Table (as-is) --}}
    <h6 class="mt-3">Student Attendance Details</h6>
    <table class="table table-bordered table-striped table-hover datatable">
        <thead>
            <tr>
                <th>Category Name</th>
                <th>Batch Name</th>
                <th>Day</th>
                <th>Attendance</th>
                <th>Attendance Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sub->attendance as $a)
                <tr>
                    <td>{{ $a->categoryName }}</td>
                    <td>{{ $a->batchName }}</td>
                    <td>
                        @php
                            $daysOfWeek = [1=>'Monday',2=>'Tuesday',3=>'Wednesday',4=>'Thursday',5=>'Friday',6=>'Saturday',7=>'Sunday'];
                        @endphp
                        {{ $daysOfWeek[$a->day] ?? 'Invalid Day' }}
                    </td>
                    <td>{{ $a->attendance }}</td>
                    <td>{{ date('d-m-Y', strtotime($a->attendance_date)) }}</td>
                    <td>
                        @if($loop->first && $sub->status == 1) 
                            <a title="Change Attendance Status" href="#"  
                               data-bs-toggle="modal" 
                               data-bs-target="#attendanceModal_{{ $a->attendence_id }}" 
                               onclick="attendanceData({{ $a->attendence_id }});" 
                               class="mx-2">
                               <i class="fas fa-edit"></i>
                            </a>
                        @endif
                    </td>
                </tr>

                {{-- Modal for editing attendance --}}
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
                                <input type="hidden" name="attendence_id" value="{{ $a->attendence_id }}">
                                <input type="hidden" name="subscription_id" value="{{ $a->subscription_id }}">

                                <div class="modal-body text-center">
                                    <h4>Are you sure?</h4>
                                    <p class="text-muted">
                                        You want to update attendance from 
                                        @if($a->attendance == 'P') 
                                            <input type="hidden" name="status" value="A">
                                            <strong>Present</strong> to <strong>Absent</strong>?
                                        @elseif($a->attendance == 'A') 
                                            <input type="hidden" name="status" value="P">
                                            <strong>Absent</strong> to <strong>Present</strong>?
                                        @endif
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No attendance records found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endforeach

                                               
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