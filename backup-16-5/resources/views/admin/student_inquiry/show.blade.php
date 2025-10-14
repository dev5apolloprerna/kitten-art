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

                                    <a href="{{ route('studentinquiry.index') }}" style="float: right;" class="btn btn-sm btn-primary">

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

                                                                Student Category

                                                            </th>

                                                            <td>

                                                                {{ $data->categoryName ?? '' }}

                                                            </td>

                                                        </tr>

                                                        <tr>

                                                            <th>

                                                               Plan Name

                                                            </th>

                                                            <td> {{ $data->planName }}</td>

                                                        </tr>

                                                        <tr>

                                                            <th>

                                                               Batch 

                                                            </th>

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

                                                                {{$data->batchName  }}</td>

                                                        </tr>



                                                        <tr>

                                                            <th>

                                                                Student Name

                                                            </th>

                                                            <td>

                                                                {{ $data->student_first_name ?? '' }} {{ $data->student_last_name ?? '' }}

                                                            </td>

                                                        </tr>

                                                        <tr>

                                                            <th>

                                                               Student Age

                                                            </th>

                                                            <td> <p> {{ $data->student_age }} {{ Str::contains($data->student_age, 'year') ? '' : 'years' }}</p></td>

                                                        </tr>

                                                        <tr>

                                                            <th>

                                                               Mobile

                                                            </th>

                                                            <td> {{ $data->mobile }}</td>

                                                        </tr>

                                                        <tr>

                                                            <th>

                                                               Email

                                                            </th>

                                                            <td> {{ $data->email }}</td>

                                                        </tr>

                                                        <tr>

                                                            <th>

                                                               Parent Name

                                                            </th>

                                                            <td> {{ $data->parent_name   }}</td>

                                                        </tr>

                                                        

                                                    </tbody>

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