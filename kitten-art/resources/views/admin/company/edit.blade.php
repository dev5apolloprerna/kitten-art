@extends('layouts.app')

@section('title', 'Edit Company Details')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                {{-- Alert Messages --}}
                @include('common.alert')

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Edit Company Details</h4>
                            <div class="page-title-right">
                                <a href="{{ route('admin.company.index') }}"
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
                             <form action="{{ route('admin.company.update', [$company->companyId]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="companyId" id="companyId" value="{{ $company->companyId }}">
                                   <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('companyName') ? 'has-error' : '' }}">
                                                <label for="companyName">Company Name *</label>
                                                <input type="text" id="companyName" name="companyName" class="form-control" value="{{ old('companyName', isset($company) ? $company->companyName : '') }}" >
                                                @if($errors->has('companyName'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('companyName') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>                                        
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('upiId') ? 'has-error' : '' }}">
                                                <label for="upiId">UPI Id *</label>
                                                <input type="text" id="upiId" name="upiId" class="form-control" value="{{ old('upiId', isset($company) ? $company->upiId : '') }}" >
                                                @if($errors->has('upiId'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('upiId') }}
                                                    </span>
                                                @endif
                                            </div> 
                                        </div>
                                         <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('qrCode') ? 'has-error' : '' }}">
                                                <label for="qrCode">QrCode *</label>
                                                <input type="file" id="qrCode" name="qrCode" class="form-control"  accept="image/*" onChange="validate(this.value)" value="{{ old('qrCode', isset($company) ? $company->qrCode : '') }}">
                                                <input type="hidden" name="hiddenqrCode" value="{{$company->qrCode}}" class="form-control" >
                                                <p id="error" style="color:red"></p>
                                                @if($company->qrCode == '')
                                                    <img src="/images/noImage.png" width="50px" height="50px">
                                                @else
                                                    <img src="/school_bus/images/company/{{ $company->qrCode}}" width="50px" height="50px" >
                                                @endif
                                                <div id="error"></div>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('company_logo') ? 'has-error' : '' }}">
                                                <label for="company_logo">Company Logo *</label>
                                                <input type="file" id="company_logo" name="company_logo" class="form-control"  accept="image/*" onChange="validate(this.value)" value="{{ old('company_logo', isset($company) ? $company->company_logo : '') }}">
                                                <input type="hidden" name="hiddenqrCode" value="{{$company->company_logo}}" class="form-control" >
                                                <p id="error" style="color:red"></p>
                                                @if($company->company_logo == '')
                                                    <img src="/images/noImage.png" width="50px" height="50px">
                                                @else
                                                    <img src="/school_bus/images/company/logo/{{ $company->company_logo}}" width="250px" height="50px" >
                                                @endif
                                                <div id="error"></div>

                                            </div>
                                        </div>
                                    </div>   

                                        <div class="card-footer mt-2">
                                            <div class="mb-3" style="float: right;">
                                                <button type="submit"
                                                class="btn btn-success btn-user float-right" >Update</button>
                                                <a class="btn btn-primary float-right mr-3"
                                                    href="{{ route('admin.area.index') }}">Cancel</a>
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
<script type="text/javascript">
    CKEDITOR.replace('description');
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const phoneNumberInput = document.getElementById('mobile');
        
        phoneNumberInput.addEventListener('input', function() {
            const value = phoneNumberInput.value.replace(/\D/g, ''); // Remove non-digit characters
            phoneNumberInput.value = value.slice(0, 10); // Limit to 10 digits
        });
    });
</script>

@endsection
