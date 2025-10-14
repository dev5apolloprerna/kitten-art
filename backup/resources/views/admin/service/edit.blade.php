@extends('layouts.app')

@section('title', 'Add Service')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Add Service</h4>
                        <div class="page-title-right">
                            <a href="{{ route('service.index') }}"
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
                             <form method="POST" action="{{ route('service.update',$data['service_id']) }}" autocomplete="off" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="service_id" value="{{ $data['service_id'] }}">
                               <div class="row">
                                        <div class="col-md-6 mt-4">
                                            <div class="form-group {{ $errors->has('service_name') ? 'has-error' : '' }}">
                                                <label for="service_name">Service Name <span style="color:red">*</span></label>
                                                <input type="text" id="service_name" name="service_name" class="form-control" value="{{ $data['service_name'] }}" maxlength="100" required>
                                                @if($errors->has('service_name'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('service_name') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>

                                        <div class="col-md-6 mt-4">
                                            <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                                                <label for="image">Service Image<span style="color:red">*</span></label>
                                                <input type="file" id="image" name="image" class="form-control" onchange="return validateFile()"> 
                                                <input type="hidden" name="hiddenImage" class="form-control"
                                                        value="{{ old('image') ? old('image') : $data['image'] }}"
                                                        id="hiddenImage">
                                                    <div id="viewimg">
                                                        <img src="{{ asset('Service') . '/' . $data['image'] }}"
                                                            alt="" height="70" width="70">
                                                        @error('image')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                @if($errors->has('image'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('image') }}
                                                    </span>
                                                @endif 
                                                @if($errors->has('image'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('image') }}
                                                    </span>
                                                @endif
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
                                    
                                <div class="mt-4">
                                 <div class="card-footer mt-2">
                                        <div class="mb-3" style="float: right;">
                                            <button type="submit"
                                            class="btn btn-success btn-user float-right" >Update</button>
                                            <a class="btn btn-primary float-right mr-3"
                                                href="{{ route('service.index') }}">Cancel</a>
                                        </div>
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