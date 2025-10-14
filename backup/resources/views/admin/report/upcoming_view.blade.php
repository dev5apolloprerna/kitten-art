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
                                                            <td>{{ $data->student_name ?? '' }} </td>
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
                                                    @foreach($subscription as $s)
                                                    <tr>
                                                       <td>{{ $s->planName }}</td>
                                                       <td>{{ $s->amount }}</td>
                                                       <td>{{ $s->credit_balance }}</td>
                                                       <td>{{ $s->debit_balance }}</td>
                                                       <td>{{ $s->closing_balance }}</td>
                                                       <td>{{ date('d-m-Y',strtotime($s->activate_date)) }}</td>
                                                       <!-- <td>{{ date('d-m-Y',strtotime($s->expired_date)) }}</td> -->
                                                    </tr>
                                                    @endforeach
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
                                                    </tr>
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
                                                       <td>{{ date('d-m-Y',strtotime($a->attendance_date)) }}</td>
                                                    </tr>
                                                    @endforeach
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