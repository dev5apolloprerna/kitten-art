@extends('layouts.app')

@section('title', 'Add Student')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Add Student</h4>
                        <div class="page-title-right">
                            <a href="{{ route('student.index') }}"
                                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        {{-- Alert Messages --}}
                        @include('common.alert')

                        <div class="card-body">
                            <form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                                                <label for="category_id">Class<span style="color:red">*</span></label>
                                                <select class="form-control"  name="category_id" id="category_id" required>
                                                    <option value="">Select Class *</option>
                                                    @foreach($category as $c)
                                                        <option value="{{ $c->category_id }}">{{ $c->category_name }}</option>
                                                    @endforeach
                                                  </select>
                                            </div>
                                        </div> 
                                        
                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('plan_id') ? 'has-error' : '' }}">
                                                <label for="plan_id">Plan <span style="color:red">*</span></label>
                                                <select class="form-control" name="plan_id" id="plan_id" required>
                                                    <option value="">select plan</option>
                                                </select>
                                            </div> 
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('batch_id') ? 'has-error' : '' }}">
                                                <label for="batch_id">Batch <span style="color:red">*</span></label>
                                                <select class="form-control" name="batch_id" id="batch_id" required>
                                                    <option value="">select batch</option>
                                                </select>
                                            </div> 
                                        </div>
                                        <div class="col-md-4 mt-4">
                                            <div class="form-group {{ $errors->has('student_first_name') ? 'has-error' : '' }}">
                                                <label for="student_first_name">Student First Name <span style="color:red">*</span></label>
                                                <input type="text" id="student_first_name" name="student_first_name" placeholder="Enter Student Name" class="form-control" value="{{ old('student_first_name') }}" maxlength="100">
                                                @if($errors->has('student_first_name'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('student_first_name') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>
                                        <div class="col-md-4 mt-4">
                                            <div class="form-group {{ $errors->has('student_last_name') ? 'has-error' : '' }}">
                                                <label for="student_last_name">Student Last Name <span style="color:red">*</span></label>
                                                <input type="text" id="student_last_name" name="student_last_name" placeholder="Enter Student Name" class="form-control" value="{{ old('student_last_name') }}" maxlength="100">
                                                @if($errors->has('student_last_name'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('student_last_name') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>

                                        <div class="col-md-4 mt-4">
                                            <div class="form-group {{ $errors->has('student_age') ? 'has-error' : '' }}">
                                                <label for="student_age">Student Age <span style="color:red">*</span></label>
                                                <input type="number" id="student_age" name="student_age" class="form-control" placeholder="Enter Student Age" value="{{ old('student_age') }}" maxlength="2" required>
                                                @if($errors->has('student_age'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('student_age') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>
                                         
                                         <div class="col-md-4 mt-4">
                                            <div class="form-group {{ $errors->has('mobile') ? 'has-error' : '' }}">
                                                <label for="mobile">Mobile<span style="color:red">*</span></label>
                                                <input type="text" id="mobile" name="mobile" class="form-control" value="{{ old('mobile') }}" placeholder="Enter Student Mobile"  minlength="10" maxlength="10" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                                @if($errors->has('mobile'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('mobile') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div> 
                                        <div class="col-md-4 mt-4">
                                            <div class="form-group {{ $errors->has('parent_name') ? 'has-error' : '' }}">
                                                <label for="parent_name">Parent Name <span style="color:red">*</span></label>
                                                <input type="text" id="parent_name" name="parent_name" class="form-control" value="{{ old('parent_name') }}" placeholder="Enter Parent Name" maxlength="100" required>
                                                @if($errors->has('parent_name'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('parent_name') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>

                                        <div class="col-md-4 mt-4">
                                            <div class="form-group {{ $errors->has('mobile') ? 'has-error' : '' }}">
                                                <label for="mobile">Email<span style="color:red">*</span></label>
                                                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter Email" maxlength="100" required>
                                                @if($errors->has('email'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('email') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>
                                        
                                        
                                        
                                        <div class="col-md-4 mt-4">
                                            <div class="form-group {{ $errors->has('communication_mode') ? 'has-error' : '' }}">
                                                <label for="communication_mode">Communication Mode <span style="color:red">*</span></label>
                                                <select class="form-control" name="communication_mode" id="communication_mode" required>
                                                        <option value="">Select Mode</option>
                                                        <option value="1">Whats App</option>
                                                        <option value="2">Email</option>
                                                        <option value="3">Text SMS</option>
                                                </select>
                                                @if($errors->has('communication_mode'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('communication_mode') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>

                                    </div>  
                                    
                                <div class="col-md-4 mt-4">
                                     <input class="btn btn-success btn-user float-right" type="submit" value="{{ 'Submit' }}">
                                     <input class="btn btn-success btn-user float-right" type="reset" value="{{ 'Clear' }}">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    $(document).ready(function() {
            $('#category_id').change(function() {
                var categoryid = $(this).val();
                if(categoryid) 
                {
                    $.ajax({
                        url: './get-batch/' + categoryid,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('#batch_id').empty();
                            $('#batch_id').append('<option value="">Select Batch</option>');
                            $.each(data, function(key, value) {
                            const weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

                            $('#batch_id').append('<option value="'+ value.batch_id +'">'+ weekdays[value.batch_day - 1] +'</option>');
                            });
                        }
                    });


                    $.ajax({
                        url: './get-plan/' + categoryid,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('#plan_id').empty();
                            $('#plan_id').append('<option value="">Select Plan</option>');
                            $.each(data, function(key, value) {
                                $('#plan_id').append('<option value="'+ value.planId +'">'+ value.plan_name +'</option>');
                            });
                        }
                    });
                } else {
                    $('#plan_id').empty();
                    $('#plan_id').append('<option value="">Select Batch</option>');
                }
            });
        });
</script>
@endsection