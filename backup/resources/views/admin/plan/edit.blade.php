@extends('layouts.app')

@section('title', 'Edit Student Plan')

@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                {{-- Alert Messages --}}
                @include('common.alert')

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Edit Student Plan</h4>
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
                            <div class="card-body">
                                <form action="{{ route('plan.update', $data['planId']) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="planId" id="planId" value="{{ $data['planId'] }}">
                                     <div class="row">
                                        <div class="col-md-6">

                                            <div class="form-group {{ $errors->has('planName') ? 'has-error' : '' }}">
                                                <label for="planName">Category Name <span style="color:red">*</span></label>
                                                <select class="form-control" name="category_id" required>
                                                    <option>select category</option>
                                                        @foreach($category as $c)
                                                    <option value="{{ $c['category_id'] }}" {{ $data['category_id'] == $c['category_id'] ? 'selected' : '' }}>{{ $c['category_name'] }}</option>
                                                        @endforeach
                                                </select>
                                            </div> 
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('plan_name') ? 'has-error' : '' }}">
                                                <label for="plan_name">Plan Name <span style="color:red">*</span></label>
                                                <input type="text" id="plan_name" name="plan_name" class="form-control"  maxlength="50" value="{{$data['plan_name']}}" placeholder="Enter Plan Name" required>
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
                                                <input type="text" id="plan_session" name="plan_session" class="form-control"  maxlength="11" placeholder="Enter Plan Session" value="{{$data['plan_session']}}"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
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
                                                <input type="text" id="plan_amount" name="plan_amount" class="form-control"  maxlength="10" value="{{$data['plan_amount']}}" placeholder="Enter Plan Amount" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
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
                                                <input type="file" id="plan_image" name="plan_image" class="form-control" value="{{ old('plan_image') }}" maxlength="10" onchange="return validateFile()">
                                                    <input type="hidden" name="hiddenImage" class="form-control"
                                                        value="{{ old('plan_image') ? old('plan_image') : $data['plan_image'] }}"
                                                        id="hiddenImage">
                                                    <div id="viewimg">
                                                        <img src="{{ asset('plan_image') . '/' . $data['plan_image'] }}"
                                                            alt="" height="70" width="70">
                                                        @error('plan_image')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                @if($errors->has('plan_image'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('plan_image') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>

                                        <div class="col-md-12 mt-4">
                                            <div class="form-group {{ $errors->has('plan_description') ? 'has-error' : '' }}">
                                                <label for="plan_description"> Plan Description <span style="color:red">*</span></label>
                                                <textarea id="plan_description" rows="10" cols="10" name="plan_description" class="form-control ckeditor" value="{{ old('plan_description') }}" required>{{$data['plan_description'] }}</textarea>
                                                @if($errors->has('plan_description'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('plan_description') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>

                                        <div class="col-md-12 mt-4">
                                            <div class="form-group {{ $errors->has('detail_description') ? 'has-error' : '' }}">
                                                <label for="detail_description"> Detail Description <span style="color:red">*</span></label>
                                                <textarea id="detail_description" rows="10" cols="10" name="detail_description" class="form-control ckeditor" value="{{ old('detail_description') }}" required>{{$data['detail_description'] }}</textarea>
                                                @if($errors->has('detail_description'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('detail_description') }}
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
                                                    href="{{ route('plan.index') }}">Cancel</a>
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
</script>
@endsection
