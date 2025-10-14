@extends('layouts.app')

@section('title', 'Add Testimonial')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Add Testimonial</h4>
                        <div class="page-title-right">
                            <a href="{{ route('testimonial.index') }}"
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
                             <form method="POST" action="{{ route('testimonial.update',$data['testimonial_id']) }}" autocomplete="off" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="testimonial_id" value="{{ $data['testimonial_id'] }}">
                                    <div class="row">
                                        <div class="col-md-6 mt-4">
                                            <div class="form-group {{ $errors->has('parent_name') ? 'has-error' : '' }}">
                                                <label for="parent_name">Parent Name <span style="color:red">*</span></label>
                                                <input type="text" id="parent_name" name="parent_name" class="form-control" value="{{ $data['parent_name'] }}" maxlength="100" required>
                                                @if($errors->has('parent_name'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('parent_name') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>

                                        <div class="col-md-6 mt-4">
                                            <div class="form-group {{ $errors->has('parent_photo') ? 'has-error' : '' }}">
                                                <label for="parent_photo">Parent Image<span style="color:red">*</span></label>
                                                <input type="file" id="parent_photo" name="parent_photo" class="form-control" onchange="return validateFile1()">  
                                               <input type="hidden" name="hiddenImage2" class="form-control"
                                                        value="{{ old('parent_photo') ? old('parent_photo') : $data['parent_photo'] }}"
                                                        id="hiddenImage2">
                                                    <div id="viewimg">
                                                        <img src="{{ asset('Testimonial') . '/' . $data['parent_photo'] }}"
                                                            alt="" height="70" width="70">
                                                        @error('parent_photo')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                @if($errors->has('parent_photo'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('parent_photo') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>
                                       


                                        <div class="col-md-6 mt-4">
                                            <div class="form-group {{ $errors->has('student_name') ? 'has-error' : '' }}">
                                                <label for="student_name">Student Name <span style="color:red">*</span></label>
                                                <input type="text" id="student_name" name="student_name" class="form-control" value="{{ $data['student_name'] }}" maxlength="100">
                                                @if($errors->has('student_name'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('student_name') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>

                                       <div class="col-md-6 mt-4">
                                        <div class="form-group {{ $errors->has('student_photo') ? 'has-error' : '' }}">
                                            <label for="student_photo">Student Image<span style="color:red">*</span></label>
                                            <input type="file" id="student_photo" name="student_photo" class="form-control" onchange="return validateFile()">
                                            <input type="hidden" name="hiddenImage1" class="form-control"
                                                        value="{{ old('student_photo') ? old('student_photo') : $data['student_photo'] }}"
                                                        id="hiddenImage1">
                                                    <div id="viewimg">
                                                        <img src="{{ asset('Testimonial') . '/' . $data['student_photo'] }}"
                                                            alt="" height="70" width="70">  
                                                    @if($errors->has('student_photo'))
                                                        <span class="text-danger">
                                                            {{ $errors->first('student_photo') }}
                                                        </span>
                                                    @endif
                                                </div> 
                                            </div>
                                    </div>
                                        <div class="col-md-12 mt-4">
                                            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                                <label for="description">Description<span style="color:red">*</span></label>
                                                <textarea class="form-control ckeditor" name="description">{{ $data['description'] }}</textarea>
                                                @if($errors->has('description'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('description') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>
                                    </div>  
                                    
                                <div class="card-footer mt-2">
                                            <div class="mb-3" style="float: right;">
                                                <button type="submit"
                                                class="btn btn-success btn-user float-right" >Update</button>
                                                <a class="btn btn-primary float-right mr-3"
                                                    href="{{ route('testimonial.index') }}">Cancel</a>
                                            </div>
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
            var fileExtension = document.getElementById('student_photo').value.split('.').pop().toLowerCase();
            var isValidFile = false;
            var image = document.getElementById('student_photo').value;

            for (var index in allowedExtension) {

                if (fileExtension === allowedExtension[index]) {
                    isValidFile = true;
                    break;
                }
            }
            if (image != "") {
                if (!isValidFile) {
                    alert('Allowed Extensions are : *.' + allowedExtension.join(', *.'));
                    $('#student_photo').val("")
                }
                return isValidFile;
            }

            return true;
        }
         function validateFile2() {
            var allowedExtension = ['jpeg', 'jpg', 'png', 'webp'];
            var fileExtension = document.getElementById('parent_photo').value.split('.').pop().toLowerCase();
            var isValidFile = false;
            var image = document.getElementById('parent_photo').value;

            for (var index in allowedExtension) {

                if (fileExtension === allowedExtension[index]) {
                    isValidFile = true;
                    break;
                }
            }
            if (image != "") {
                if (!isValidFile) {
                    alert('Allowed Extensions are : *.' + allowedExtension.join(', *.'));
                    $('#parent_photo').val("")
                }
                return isValidFile;
            }

            return true;
        }
</script>
@endsection