@extends('layouts.app')

@section('title', 'Add Events')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Add Events</h4>
                        <div class="page-title-right">
                            <a href="{{ route('events.index') }}"
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
                            <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" id="form-id">
                                @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                                                <label for="category_id">Category Name <span style="color:red">*</span></label>
                                                <select class="form-control" name="category_id" required>
                                                    <option>select category</option>
                                                        @foreach($category as $c)
                                                        <option value="{{ $c->category_id }}">{{ $c->category_name }}</option>
                                                        @endforeach
                                                </select>
                                            </div> 
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('event_name') ? 'has-error' : '' }}">
                                                <label for="event_name">Event Name <span style="color:red">*</span></label>
                                                <input type="text" id="event_name" name="event_name" class="form-control" value="{{ old('event_name') }}" required>
                                                @if($errors->has('event_name'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('event_name') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>
                                        <div class="col-md-6 mt-4">
                                            <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                                                <label for="location">Location <span style="color:red">*</span></label>
                                                <input type="text" id="location" name="location" class="form-control" value="{{ old('location') }}"  required>
                                                @if($errors->has('location'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('location') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>
                                        <div class="col-md-6 mt-4">
                                            <div class="form-group {{ $errors->has('Instructors') ? 'has-error' : '' }}">
                                                <label for="Instructors">Instructors <span style="color:red">*</span></label>
                                                <input type="text" id="Instructors" name="Instructors" class="form-control" value="{{ old('Instructors') }}" required>
                                                @if($errors->has('Instructors'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('Instructors') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>
                                        <div class="col-md-6 mt-4">
                                            <div class="form-group {{ $errors->has('capacity') ? 'has-error' : '' }}">
                                                <label for="capacity">Capacity <span style="color:red">*</span></label>
                                                <input type="text" id="capacity" name="capacity" class="form-control" value="{{ old('capacity') }}" required>
                                                @if($errors->has('capacity'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('capacity') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>

                                        <div class="col-md-6 mt-4">
                                            <div class="form-group {{ $errors->has('discounts') ? 'has-error' : '' }}">
                                                <label for="discounts">Discounts <span style="color:red">*</span></label>
                                                <input type="text" id="discounts" name="discounts" class="form-control" value="{{ old('discounts') }}" maxlength="100" required>
                                                @if($errors->has('discounts'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('discounts') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>

                                         <div class="col-md-6 mt-4">
                                            <div class="form-group {{ $errors->has('from_date') ? 'has-error' : '' }}">
                                                <label for="from_date">From Date <span style="color:red">*</span></label>
                                                <input type="date" id="from_date" name="from_date" class="form-control" value="{{ old('from_date') }}"  required>
                                                @if($errors->has('from_date'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('from_date') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>

                                         <div class="col-md-6 mt-4">
                                            <div class="form-group {{ $errors->has('to_date') ? 'has-error' : '' }}">
                                                <label for="to_date">To Date <span style="color:red">*</span></label>
                                                <input type="date" id="to_date" name="to_date" class="form-control" value="{{ old('to_date') }}"  required>
                                                @if($errors->has('to_date'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('to_date') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>

                                        <div class="col-md-6 mt-4">
                                            <div class="form-group {{ $errors->has('from_time') ? 'has-error' : '' }}">
                                                <label for="from_time">From Time <span style="color:red">*</span></label>
                                                <input type="time" id="from_time" name="from_time" class="form-control" value="{{ old('from_time') }}"  required>
                                                @if($errors->has('from_time'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('from_time') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>

                                         <div class="col-md-6 mt-4">
                                            <div class="form-group {{ $errors->has('to_time') ? 'has-error' : '' }}">
                                                <label for="to_time">To Time <span style="color:red">*</span></label>
                                                <input type="time" id="to_time" name="to_time" class="form-control" value="{{ old('to_time') }}"  required>
                                                @if($errors->has('to_time'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('to_time') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>

                                        
                                        <div class="col-md-6 mt-4">
                                            <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                                                <label for="image">Event Image <span style="color:red">*</span></label>
                                                <input type="file" id="image" name="image" class="form-control" value="{{ old('image') }}" maxlength="10" onchange="return validateFile()" required>
                                                @if($errors->has('image'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('image') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>

                                        <div class="col-md-12 mt-4">
                                            <div class="form-group {{ $errors->has('detail_description') ? 'has-error' : '' }}">
                                                <label for="detail_description"> Event Decription <span style="color:red">*</span></label>
                                                <textarea id="detail_description" rows="10" cols="10" name="detail_description" class="form-control ckeditor" value="{{ old('detail_description') }}" required></textarea>
                                                @if($errors->has('detail_description'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('detail_description') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>
                                    </div>  
                                    
                                <div class="mt-4">
                                     <input class="btn btn-success btn-user float-right" type="submit" value="{{ 'Submit' }}" onclick="return validateData();" >
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

<script type="text/javascript">
     function validateFile() {
            var allowedExtension = ['jpeg', 'jpg', 'png', 'webp'];
            var fileExtension = document.getElementById('image').value.split('.').pop().toLowerCase();
            var isValidFile = false;
            var image = document.getElementById('image').value;

            for (var index in allowedExtension) {

                if (fileExtension === allowedExtension[index]) {
                    isValidFile = true;
                    break;
                }
            }
            if (image != "") {
                if (!isValidFile) {
                    alert('Allowed Extensions are : *.' + allowedExtension.join(', *.'));
                    $('#image').val("")
                }
                return isValidFile;
            }

            return true;
        }
        function validateData() 
    {
        var startdatetime = $('#from_date').val();
        var enddatetime = $('#to_date').val();

        if (enddatetime < startdatetime) 
        {
            $('#to_date').focus();

            $('<span class="text-danger">End Date Must Be Greater Than StartDate.</span>')
                    .insertAfter('#to_date');
            $('#to_date').val("");
            return false;
        } else {
            return true;
        }
    }

   $(document).ready(function() 
   {
    
        $('#form-id').on('submit', function(e) {
            let fromTime = $('#from_time').val();
            let toTime = $('#to_time').val();
            let hasError = false;

            // Clear previous error messages
            $('.text-danger').remove();

            // Validate if both times are entered
            if (!fromTime) 
            {
                $('<span class="text-danger">From Time is required.</span>')
                    .insertAfter('#from_time');
                hasError = true;
            }

            if (!toTime) 
            {
                $('<span class="text-danger">To Time is required.</span>')
                    .insertAfter('#to_time');
                hasError = true;
            }

            // Validate time range
            if (fromTime && toTime && fromTime >= toTime) 
            {
                $('#to_time').focus();
                $('<span class="text-danger">To Time must be greater than From Time.</span>')
                    .insertAfter('#to_time');
                hasError = true;
            }

            // Prevent form submission if there are errors
            if (hasError) {
                e.preventDefault();
            }
        });
    });
</script>
@endsection