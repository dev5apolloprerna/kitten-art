@extends('auth.layouts.app')

@section('title', 'Student Registration')

@section('content')
    <div class="row justify-content-center">

        <div class="auth-page-wrapper">
            <!-- auth page bg -->
            <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
                <div class="bg-overlay"></div>

                <div class="shape">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="0 0 1440 120">
                        <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                    </svg>
                </div>
            </div>

            <!-- auth page content -->
            <div class="auth-page-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center mt-sm-5 mb-4 text-white-50">
                                <div>
                                    <img src="./front/images/logo.png" alt="" height="190">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">

                                <div class="card-body p-4">
                                    <div class="text-center mt-2">
                                        <h5 class="text-primary">Student Registration Form !</h5>
                                    </div>
                                    
            {{-- Alert Messages --}}
            @include('common.alert')

                            <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="birthDate">Birth Date *</label>
                                                <input type="date" id="birthDate" name="birthDate" class="form-control" value="{{ old('birthDate')}}">
                                                @if($errors->has('birthDate'))
                                                 <span class="text-danger">
                                                    {{ $errors->first('birthDate') }}
                                                </span>
                                                @endif

                                            </div> 
                                        </div>
                                        <div class="col-md-6">                        
                                           <div class="form-group">
                                                <label for="formNumber">Form No *</label>
                                                <input type="text" id="formNumber" name="formNumber" class="form-control" value="{{ old('formNumber', isset($student) ? $student->formNumber : '') }}">
                                                 @if($errors->has('formNumber'))
                                                 <span class="text-danger">
                                                    {{ $errors->first('formNumber') }}
                                                </span>
                                                @endif

                                            </div>
                                        </div>
       
                                    </div>   
                                    <div class="row">                                       
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="studentName">Name *</label>
                                                <input type="text" id="studentName" name="studentName" class="form-control"  value="{{ old('studentName', isset($student) ? $student->studentName : '') }}">
                                                @if($errors->has('studentName'))
                                                 <span class="text-danger">
                                                    {{ $errors->first('studentName') }}
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">                        
                                           <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                                <label for="address">Address</label>
                                                <textarea  id="address" name="address" class="form-control" value="{{ old('address')}}">{{ old('address', isset($student) ? $student->address : '') }}</textarea>
                                                @if($errors->has('address'))
                                                     <span class="text-danger">
                                                        {{ $errors->first('address') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('phoneNumber') ? 'has-error' : '' }}">
                                                <label for="phoneNumber">Phone Number </label>
                                                <input type="number" id="phoneNumber" name="phoneNumber" class="form-control"  value="{{ old('phoneNumber', isset($student) ? $student->phoneNumber : '') }}" pattern="\d{10}" maxlength="10">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('mobile') ? 'has-error' : '' }}">
                                                <label for="mobile">Student Mobile Number *</label>
                                                <input type="text" id="mobile" name="mobile" class="form-control" value="{{ old('mobile', isset($student) ? $student->mobile : '') }}" pattern="\d{10}" maxlength="10" >
                                                <p class="invalid-feedback" id="mobileError" style="display:none;"></p>
                                                 @if($errors->has('mobile'))
                                                 <span class="text-danger">
                                                    {{ $errors->first('mobile') }}
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('schoolName') ? 'has-error' : '' }}">
                                                <label for="schoolName">College  Name *</label>
                                                <input type="hidden" name="schoolName" id="schoolName" value="{{ old('schoolName') }}">
                                                <select class="livesearch form-control p-3" name="schoolIdForStudent" id="schoolIdForStudent" value="{{ old('schoolIdForStudent')}}">
                                                   <option value="">Select School</option>

                                                @foreach ($school as $value)
                                                    <option value="{{ $value->schoolId }}" {{ old('schoolIdForStudent')== $value->schoolId ? 'selected' :'' }}>{{ $value->schoolName }}</option>
                                                @endforeach
                                                </select>
                                                @if($errors->has('schoolName'))
                                                 <span class="text-danger">
                                                    {{ $errors->first('schoolName') }}
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('branch') ? 'has-error' : '' }}">
                                                <label for="branch">Branch </label>
                                                <select class="form-control" id="branch" name="branch">
                                                 <option value="">Select Branch</option>
                                                @foreach ($branchMaster as $value)
                                                    <option value="{{ $value->branch_id }}" {{ old('branch')== $value->branch_id ? 'selected' :'' }}>{{ $value->branch_name }}</option>
                                                @endforeach
                                                </select>


                                                @if($errors->has('branch'))
                                                 <span class="text-danger">
                                                    {{ $errors->first('branch') }}
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('bloodGroup') ? 'has-error' : '' }}">
                                                <label for="bloodGroup">Blood Group </label>
                                                <input type="text" id="bloodGroup" name="bloodGroup" class="form-control" value="{{ old('bloodGroup', isset($student) ? $student->bloodGroup : '') }}" >
                                                @if($errors->has('bloodGroup'))
                                                 <span class="text-danger">
                                                    {{ $errors->first('bloodGroup') }}
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                                <label for="email">Email *</label>
                                                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($student) ? $student->email : '') }}">
                                                <p class="invalid-feedback" id="emailError" style="display:none;"></p>
                                                @if($errors->has('email'))
                                                 <span class="text-danger">
                                                    {{ $errors->first('email') }}
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('deposit') ? 'has-error' : '' }}">
                                                <label for="deposit">Deposit *</label>
                                                <input type="text" name="deposite" id="deposite" value="yes" class="form-control" readonly>
                                                  @if($errors->has('deposite'))
                                                 <span class="text-danger">
                                                    {{ $errors->first('deposite') }}
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                         
                                        <div class="col-md-6">
                                         <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('studentPhoto') ? 'has-error' : '' }}">
                                                <label for="studentPhoto">Student Photo *</label>
                                                <input type="file" id="studentPhoto" name="studentPhoto" class="form-control" accept="image/*" onChange="validate(this.value)" value="{{ old('studentPhoto')}}">
                                                @if($errors->has('studentPhoto'))
                                                     <span class="text-danger">
                                                        {{ $errors->first('studentPhoto') }}
                                                    </span>
                                                @endif
                                                <div id="error" class="text-danger"></div>
                                            </div>
                                        </div>
                                    </div>
                            
                                
                        <div class="card-header">
                           Parent Details
                        </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('fatherName') ? 'has-error' : '' }}">
                                        <label for="fatherName">Father Name *</label>
                                        <input type="fatherName" id="fatherName" name="fatherName" class="form-control" value="{{ old('fatherName', isset($student) ? $student->fatherName : '') }}">
                                        @if($errors->has('fatherName'))
                                         <span class="text-danger">
                                            {{ $errors->first('fatherName') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('fatherMobileNo') ? 'has-error' : '' }}">
                                        <label for="fatherMobileNo">Father Mobile Number *</label>
                                        <input type="text" id="fatherMobileNo" name="fatherMobileNo" class="form-control" value="{{ old('fatherMobileNo', isset($student) ? $student->fatherMobileNo : '') }}" pattern="\d{10}" maxlength="10">
                                        <p class="invalid-feedback" id="fatherPhone" style="display: none;"></p>
                                        @if($errors->has('fatherMobileNo'))
                                         <span class="text-danger">
                                            {{ $errors->first('fatherMobileNo') }}
                                        </span>
                                        @endif

                                    </div>
                                </div>
                            </div>
                               <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('motherName') ? 'has-error' : '' }}">
                                        <label for="motherName">Mother Name *</label>
                                        <input type="motherName" id="motherName" name="motherName" class="form-control" value="{{ old('motherName', isset($student) ? $student->motherName : '') }}">
                                        @if($errors->has('motherName'))
                                         <span class="text-danger">
                                            {{ $errors->first('motherName') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('motherMobileNo') ? 'has-error' : '' }}">
                                        <label for="motherMobileNo">Mother Mobile Number *</label>
                                        <input type="text" id="motherMobileNo" name="motherMobileNo" class="form-control" value="{{ old('motherMobileNo', isset($student) ? $student->motherMobileNo : '') }}" pattern="\d{10}" maxlength="10">
                                        @if($errors->has('motherMobileNo'))
                                         <span class="text-danger">
                                            {{ $errors->first('motherMobileNo') }}
                                        </span>
                                        @endif

                                    </div>
                                </div>
                               </div>
                        <div class="card-header">
                           Fees  Details
                        </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('year') ? 'has-error' : '' }}">  
                                                <label for="year">Year *</label>
                                                <input type="hidden" id="yearSemesterId" name="yearSemesterId" value="{{ old('yearSemesterId') }}">
                                                <select class="form-control" name="year" id="year" value="{{ old('year') }}">
                                                <option value="">Select Year</option>
                                                @foreach ($year as $value)
                                                    <option value="{{ $value->yearId }}" {{ old('year')== $value->yearId ? 'selected' :'' }}>{{ $value->year }}</option>
                                                @endforeach
                                                </select>
                                                @if($errors->has('year'))
                                                 <span class="text-danger">
                                                    {{ $errors->first('year') }}
                                                </span>
                                                @endif

                                            </div>
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('fee_sem1') ? 'has-error' : '' }}">
                                                <label for="fee_sem1">Month *</label>
                                                <select class="form-control" name="semester" id="semester" value="{{ old('semester') }}" disabled>
                                                    <option value="" >Select Semester </option>
                                                </select>
                                                @if($errors->has('semester'))
                                                 <span class="text-danger">
                                                    {{ $errors->first('semester') }}
                                                </span>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('fee_sem1') ? 'has-error' : '' }}">
                                                <label for="fee_sem1">Semester *</label>
                                                <input type="text" id="semester2" name="semester2" class="form-control" value="{{ old('semester2', isset($student) ? $student->semester2 : '') }}" >
                                                @if($errors->has('semester2'))
                                                 <span class="text-danger">
                                                    {{ $errors->first('semester2') }}
                                                </span>
                                                @endif

                                            </div>
                                        </div>
                                       
                                         <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('routeId') ? 'has-error' : '' }}">
                                                <label for="fee">Route *</label>
                                                 <select id="routeId" name="routeId" class="form-control" value="{{ old('routeId') }}">
                                                    <option value="">Select Route</option>
                                                 @foreach ($route as $val1)
                                                    <option value="{{ $val1->routeId }}" {{ old('routeId')== $val1->routeId ? 'selected' :'' }}>{{ $val1->routeNumber }}</option>
                                                @endforeach
                                                </select>
                                                @if($errors->has('routeId'))
                                                 <span class="text-danger">
                                                    {{ $errors->first('routeId') }}
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('fee') ? 'has-error' : '' }}">
                                                <label for="fee">Pickup Stand *</label>
                                                <select id="pickUpAreaId" name="pickUpAreaId" class="pickUpAreaIdGet form-control" value="{{ old('pickUpAreaId') }}" >
                                                   <option value="">Select Pickup stand</option>

                                                </select>
                                                @if($errors->has('pickUpAreaId'))
                                                 <span class="text-danger">
                                                    {{ $errors->first('pickUpAreaId') }}
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                         <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('fee') ? 'has-error' : '' }}">
                                                <label for="fee">Fees *</label>
                                                 <input type="fee" id="fee" name="fee" class="form-control" value="{{ old('fee') ?? ''  }}"  readonly>
                                                @if($errors->has('fee'))
                                                 <span class="text-danger">
                                                    {{ $errors->first('fee') }}
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                          <div class="col-md-6"  id="transaction">
                                            <div class="form-group {{ $errors->has('areaName') ? 'has-error' : '' }}">
                                                <label for="transactionId">Transaction Id *</label>
                                                <input type="text" name="transactionId" id="transactionId" class="form-control" value="{{ old('transactionId')}}">
                                                  @if($errors->has('transactionId'))
                                                 <span class="text-danger">
                                                    {{ $errors->first('transactionId') }}
                                                </span>
                                                @endif

                                          </div> 
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                <label for="areaName">QrCode :                                                  
                                                    @if($company != null)          
                                                    @if($company->qrCode == '')
                                                    {{ '-' }}
                                                    @else
                                                        <img src="{{ asset('images/company/'.$company->qrCode) }}" width="250px" height="250px" >
                                                    @endif 
                                                    @endif</td></label>
                                            </div> 
                                        </div>
                                        
                                    </div>
                                    
                                <div class="mt-4">
                                     <input class="btn btn-success btn-user float-right" type="submit" value="{{ 'Save' }}">
                                </div>
                                </div>
                            </form>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const phoneNumberInput = document.getElementById('mobile');
        
        phoneNumberInput.addEventListener('input', function() {
            const value = phoneNumberInput.value.replace(/\D/g, ''); // Remove non-digit characters
            phoneNumberInput.value = value.slice(0, 10); // Limit to 10 digits
        });
    });
     document.addEventListener('DOMContentLoaded', function() {
        const fatherphoneNumberInput = document.getElementById('fatherMobileNo');
        
        fatherphoneNumberInput.addEventListener('input', function() {
            const value = fatherphoneNumberInput.value.replace(/\D/g, ''); // Remove non-digit characters
            fatherphoneNumberInput.value = value.slice(0, 10); // Limit to 10 digits
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        const motherphoneNumberInput = document.getElementById('motherMobileNumber');
        
        motherphoneNumberInput.addEventListener('input', function() {
            const value = motherphoneNumberInput.value.replace(/\D/g, ''); // Remove non-digit characters
            motherphoneNumberInput.value = value.slice(0, 10); // Limit to 10 digits
        });
    });

</script>

                            <script type="text/javascript">
 $(document).ready(function() 
{ 
        $('.livesearch').select2();
        $('#schoolIdForStudent').select2({
            closeOnSelect: true,
            placeholder: "Select Collage Name",
            allowClear: true,
       
        });
        $('#schoolIdForStudent').on('change', function() {
        var selectedData = $('#schoolIdForStudent').select2('data');
        var selectedText = selectedData[0].text;
        $("#schoolName").val(selectedText);

        });
        $('.pickUpAreaIdGet').select2();
        $('#pickUpAreaId').select2({
            closeOnSelect: true,
            placeholder: "Select Pickup Area",
            allowClear: true,
       
        });
            $('#pickUpAreaId').on('change', function() 
            {
                var selectedData = $('#pickUpAreaId').select2('data');
                var selectedText = selectedData[0].text;
                var pickuparea=$('#pickUpAreaId').val();
                   
                    $.ajax({
                    url:"{{route('getAmount')}}",
                    type: "POST",
                    dataType : 'json',
                    data: {
                        pickuparea : pickuparea,
                        _token: '{{csrf_token()}}'
                    },
                    success: function(response)
                    {
                        $.each(response.amount,function(key,value)
                        {
                           $("#fee").val(value.Amount);
                        });
                    }
                });
            });

 $('#year').on('change', function()
     {
        $("#semester").prop('disabled', false);

       $('#semester').empty();
        var year = $('#year').val();

            $.ajax({
                url:"{{route('getSemester')}}",
                type: "POST",
                dataType : 'json',
                data: {
                    year : year,
                    _token: '{{csrf_token()}}'
                },
                success: function(response)
                {
                    $.each(response.semester,function(key,value)
                    {

                         $('#semester').append('<option value="' + value.sid + '">' + value.semesterMonth + '</option>');
                        $("#year").val(value.yearId);
                        var sid=$('#semester').prop("selectedIndex", 0).val();
                            $.ajax({
                                url:"{{route('getYearMapping')}}",
                                type: "POST",
                                dataType : 'json',
                                data: {
                                    year : value.yearId,
                                    semester : sid,
                                    _token: '{{csrf_token()}}'
                                },
                                success: function(response)
                                {

                                    $.each(response.mapping,function(key,value)
                                    {
                                       $("#yearSemesterId").val(value.yearSemesterId);

                                    });
                                }
                            });
                    });
                }
            });
        });

     $('#semester').on('change', function()
     {
        var year = $('#year').val();
        var semester = $('#semester').val();

            $.ajax({
                url:"{{route('getYearMapping')}}",
                type: "POST",
                dataType : 'json',
                data: {
                    year : year,
                    semester : semester,
                    _token: '{{csrf_token()}}'
                },
                success: function(response)
                {
                    $.each(response.mapping,function(key,value)
                    {
                        $("#yearSemesterId").val(value.yearSemesterId);

                    });
                }
            });
        });

        var routeId = $('#routeId').val();
        $.ajax({
            url:"{{route('getArea')}}",
            type: "POST",
            dataType : 'json',
            data: {
                routeId : routeId,
                _token: '{{csrf_token()}}'
            },
            success: function(response)
            {
                $.each(response.area,function(key,value)
                {
                    $('#pickUpAreaId').append('<option value="' + value.aid + '">' + value.areaName + '</option>');

                });
            }
        });
            $("#email").focusout(function() 
            { 
                var email=$(this).val();
                if(email =='') 
                { 
                    $('#email').css('border', 'solid 1px red'); 
                }
                else 
                {
                    $('#email').removeAttr('style'); 

                     $.ajax({
                        url:"{{route('getEmail')}}",
                        type: "POST",
                        data: {
                            email : email,
                            _token: '{{csrf_token()}}'
                        },
                        success: function(response)
                        {
                            if(response == 1)
                            {
                                $('#emailError').show().text('Email alredy exist!');
                            }else{
                                $('#emailError').hide()
                            }
                            
                        }
                    });  
                }    
            });     
            $("#mobile").focusout(function() 
            { 
                var mobile=$(this).val();
                    if(mobile =='') 
                    { 
                        $('#mobile').css('border', 'solid 1px red'); 
                    }
                    else 
                    {
                        $('#mobile').removeAttr('style'); 

                         $.ajax({
                            url:"{{route('getMobile')}}",
                            type: "POST",
                            data: {
                                mobile : mobile,
                                _token: '{{csrf_token()}}'
                            },
                            success: function(response)
                            {
                                if(response == 1)
                                {
                                    $('#mobileError').show().text('Mobile Number alredy exist!');
                                }else{
                                    $('#mobileError').hide()
                                }
                                
                            }
                        });  
                    } 
                }); 
            $("#fatherMobileNo").focusout(function() 
            { 
                var getFatherPhone=$(this).val();
                    if(getFatherPhone =='') 
                    { 
                        $('#fatherMobileNo').css('border', 'solid 1px red'); 
                    }
                    else 
                    {
                        $('#fatherMobileNo').removeAttr('style'); 

                         $.ajax({
                            url:"{{route('getFatherPhone')}}",
                            type: "POST",
                            data: {
                                getFatherPhone : getFatherPhone,
                                _token: '{{csrf_token()}}'
                            },
                            success: function(response)
                            {
                                if(response == 1)
                                {
                                    $('#fatherPhone').show().text('Mobile Number alredy exist!');
                                }else{
                                    $('#fatherPhone').hide()
                                }
                                
                            }
                        });  
                    } 
                }); 
    });
 function validate(file) {
    var ext = file.split(".");
    ext = ext[ext.length-1].toLowerCase();      
    var arrayExtensions = ["jpg" , "jpeg", "png", "bmp", "gif"];

    if (arrayExtensions.lastIndexOf(ext) == -1) {
        $('#error').text('Please select a valid image file');
        $("#studentPhoto").val("");
    }
}

      $('#routeId').on('change', function()
     {
        $("#pickUpAreaId").prop('disabled', false);

        $("#pickUpAreaId").empty();

        var routeId = $('#routeId').val();
        $.ajax({
            url:"{{route('getArea')}}",
            type: "POST",
            dataType : 'json',
            data: {
                routeId : routeId,
                _token: '{{csrf_token()}}'
            },
            success: function(response)
            {
                $.each(response.area,function(key,value)
                {
                    $('#pickUpAreaId').append('<option value="' + value.aid + '">' + value.areaName + '</option>');

                });
            }
        });
    });

</script>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

                

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@section('scripts')

@endsection
