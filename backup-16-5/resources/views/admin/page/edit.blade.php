@extends('layouts.app')

@section('title', 'Edit Page')

@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                {{-- Alert Messages --}}
                @include('common.alert')

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Edit Page</h4>
                            <div class="page-title-right">
                                <a href="{{ route('page.index') }}"
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
                            <div class="card-body">
                                <form action="{{ route('page.update', $data['id']) }}" id="edit_page" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" id="id" value="{{ $data['id'] }}">
                                     <div class="row">
                                        
                                         <div class="col-md-6 mt-4">
                                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                                <label for="name">Name <span style="color:red">*</span></label>
                                                <input type="text" id="name" name="name" class="form-control" value="{{$data['name']}}" placeholder="Enter Name" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" readonly>
                                                @if($errors->has('name'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('name') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>
                                       

                                        <div class="col-md-12 mt-4">
                                            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                                <label for="description"> Description <span style="color:red">*</span></label>
                                                <textarea id="description" rows="10" cols="10" name="description" class="form-control ckeditor" value="{{ old('description') }}" required>{{$data['description'] }}</textarea>
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
                                                    href="{{ route('page.index') }}">Cancel</a>
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
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

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
        $("#edit_page").validate({
        rules: {
            name: {
                required: true,
            },
            
            description: {
                required: true,
            },
            
        },
        messages: {
            name: {
                required: "Please Enter  Name",
            },
            
            description: {
                required: "Please Enter Description",
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
