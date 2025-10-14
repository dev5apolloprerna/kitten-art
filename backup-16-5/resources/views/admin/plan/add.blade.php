@extends('layouts.app')



@section('title', 'Add Student Plan')



@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">



<div class="main-content">

    <div class="page-content">

        <div class="container-fluid">

            <div class="row">

                <div class="col-12">

                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                        <h4 class="mb-sm-0">Add Student Plan</h4>

                        <div class="page-title-right">

                            <a href="{{ route('plan.index') }}"

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

                            <form action="{{ route('plan.store') }}" method="POST" enctype="multipart/form-data" id="planForm">

                                @csrf

                                    <div class="row">

                                        <div class="col-md-6">

                                            <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">

                                                <label for="category_id">Category Name <span style="color:red">*</span></label>

                                                <select class="form-control" name="category_id" id="category_idd" required>

                                                    <option value="">select category</option>

                                                        @foreach($category as $c)

                                                        <option value="{{ $c->category_id }}">{{ $c->category_name }}</option>

                                                        @endforeach

                                                </select>

                                            </div> 

                                        </div>

                                        <div class="col-md-6">

                                            <div class="form-group {{ $errors->has('plan_name') ? 'has-error' : '' }}">

                                                <label for="plan_name">Plan Name <span style="color:red">*</span></label>

                                                <input type="text" id="plan_name" name="plan_name" class="form-control" value="{{ old('plan_name') }}" placeholder="Enter Plan Name" maxlength="50" required>

                                                @if($errors->has('plan_name'))

                                                    <span class="text-danger">

                                                        {{ $errors->first('plan_name') }}

                                                    </span>

                                                @endif

                                            </div> 

                                        </div>



                                        <div class="col-md-6 mt-4">

                                            <div class="form-group {{ $errors->has('plan_session') ? 'has-error' : '' }}">

                                                <label for="plan_session">Plan Session <span style="color:red">*</span></label>

                                                <input type="text" id="plan_session" name="plan_session" class="form-control" value="{{ old('plan_session') }}" placeholder="Enter Plan Session" maxlength="11" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>

                                                @if($errors->has('plan_session'))

                                                    <span class="text-danger">

                                                        {{ $errors->first('plan_session') }}

                                                    </span>

                                                @endif

                                            </div> 

                                        </div>

                                         

                                         <div class="col-md-6 mt-4">

                                            <div class="form-group {{ $errors->has('plan_amount') ? 'has-error' : '' }}">

                                                <label for="plan_amount">Plan Amount <span style="color:red">*</span></label>

                                                <input type="text" id="plan_amount" name="plan_amount" class="form-control" value="{{ old('plan_amount') }}" placeholder="Enter Plan Amount" maxlength="10" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>

                                                @if($errors->has('plan_amount'))

                                                    <span class="text-danger">

                                                        {{ $errors->first('plan_amount') }}

                                                    </span>

                                                @endif

                                            </div> 

                                        </div>

                                        <div class="col-md-6 mt-4">

                                            <div class="form-group {{ $errors->has('plan_image') ? 'has-error' : '' }}">

                                                <label for="plan_image">Plan Image <span style="color:red">*</span></label>

                                                <input type="file" id="plan_image" name="plan_image" placeholder="Eneter Plan Image" class="form-control" value="{{ old('plan_image') }}" onchange="return validateFile()" required>

                                                @if($errors->has('plan_image'))

                                                    <span class="text-danger">

                                                        {{ $errors->first('plan_image') }}

                                                    </span>

                                                @endif

                                            </div> 

                                        </div>



                                        <div class="col-md-12 mt-4">

                                            <div class="form-group {{ $errors->has('plan_description') ? 'has-error' : '' }}">

                                                <label for="plan_descriptionn"> Plan Description <span style="color:red">*</span></label>

                                                <textarea id="plan_descriptionn" rows="10" cols="10" name="plan_description" class="form-control ckeditor" value="{{ old('plan_description') }}" required></textarea>

                                                @if($errors->has('plan_description'))

                                                    <span class="text-danger">

                                                        {{ $errors->first('plan_description') }}

                                                    </span>

                                                @endif

                                            </div> 

                                        </div>

                                    </div> 



                                    <div class="col-md-12 mt-4">

                                            <div class="form-group {{ $errors->has('detail_description') ? 'has-error' : '' }}">

                                                <label for="detail_descriptionn"> Detail Description <span style="color:red">*</span></label>

                                                <textarea id="detail_descriptionn" rows="10" cols="10" name="detail_description" class="form-control ckeditor" value="{{ old('detail_description') }}" required></textarea>

                                                @if($errors->has('detail_description'))

                                                    <span class="text-danger">

                                                        {{ $errors->first('detail_description') }}

                                                    </span>

                                                @endif

                                            </div> 

                                        </div>

                                    </div>  

                                    

                                <div class="mt-4">

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script type="text/javascript">

      function validateFile() {

            var allowedExtension = ['jpeg', 'jpg', 'png', 'webp'];

            var fileExtension = document.getElementById('plan_image').value.split('.').pop().toLowerCase();

            var isValidFile = false;

            var image = document.getElementById('plan_image').value;



            for (var index in allowedExtension) {



                if (fileExtension === allowedExtension[index]) {

                    isValidFile = true;

                    break;

                }

            }

            if (image != "") {

                if (!isValidFile) {

                    alert('Allowed Extensions are : *.' + allowedExtension.join(', *.'));

                    $('#plan_image').val("")

                }

                return isValidFile;

            }



            return true;

        }
$("#planForm").validate({
        rules: {
            category_id: {
                required: true,
            },
            plan_name: {
                required: true,
            },
            plan_image: {
                required: true,
            },
            plan_amount: {
                required: true,
            },
            plan_session: {
                required: true,
            },
            plan_description: {
                required: true,
            },detail_description: {
                required: true,
            },
           
        },
        messages: {
            category_id: {
                required: "Please Select Category",
            },
            plan_name: {
                required: "Please Enter Plan Name",
            },
            plan_image: {
                required: "Please Select Plan Image",
            },
             plan_session: {
                required: "Please Enter Plan Session",
            },plan_amount: {
                required: "Please Enter Plan Amount",
            },
            plan_description: {
                required: "Please Enter Plan Description",
            }, detail_description: {
                required: "Please Enter Detail Description",
            },
            
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
            error.css("color", "red"); // Set error message color to red
        },
        submitHandler: function (form) {
            form.submit();
            $('section').addClass('blurred'); // Blur the page
            $('#loader-overlay').show();   // Show overlay
            $('#loader').show();           // Show spinner

        }
    });


</script>

@endsection