@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                {{-- Alert Messages --}}
                @include('common.alert')

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Edit User</h4>
                            <div class="page-title-right">
                                <a href="{{ route('admin.users.index') }}"
                                    class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                    <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="live-preview">
                                    <form method="POST" action="{{ route('admin.users.update', ['user' => $user->id]) }}">

                                        @csrf
                                        @method('post')
                                        <input type="hidden" name="userId" value="{{ $user->id }}">
                                        <div class="row gy-4">

                                            <div class="col-lg-4 col-md-6">
                                                <div>
                                                    <span style="color:red;">*</span>First Name
                                                    <input type="text" class="form-control" name="first_name"
                                                        value="{{ old('first_name') ? old('first_name') : $user->first_name }}"
                                                        >
                                                         @if($errors->has('first_name'))
                                                 <span class="text-danger">
                                                {{ $errors->first('first_name') }}
                                            </span>
                                            @endif
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-4 col-md-6">
                                                <div>
                                                    <span style="color:red;">*</span>Last Name
                                                    <input type="text" class="form-control" name="last_name"
                                                        value="{{ old('last_name') ? old('last_name') : $user->last_name }}"
                                                        >
                                           @if($errors->has('last_name'))
                                                 <span class="text-danger">
                                                {{ $errors->first('last_name') }}
                                            </span>
                                            @endif

                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-4 col-md-6">
                                                <div>
                                                    <span style="color:red;">*</span>Email
                                                    <input type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        name="email"
                                                        value="{{ old('email') ? old('email') : $user->email }}"  disabled>
                                                    @error('email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-4 col-md-6">
                                                <div>
                                                    <span style="color:red;">*</span>Mobile Number
                                                    <input type="text" class="form-control" name="mobile_number" id="mobile"
                                                        value="{{ old('mobile_number') ? old('mobile_number') : $user->mobile_number }}" pattern="\d{10}" maxlength="10"
                                                        >
                                             @if($errors->has('mobile_number'))
                                                 <span class="text-danger">
                                                {{ $errors->first('mobile_number') }}
                                            </span>
                                            @endif

                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-6">
                                                <div>
                                                    <span style="color:red;">*</span>User Type
                                                    <select class="form-control" name="role_id" onchange="managerbind();"
                                                        id="managersssss" >
                                                        <option selected disabled value="">Select User Type</option>
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}"
                                                                {{ old('role_id') ? (old('role_id') == $role->id ? 'selected' : '') : ($user->role_id == $role->id ? 'selected' : '') }}>
                                                                {{ $role->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                             @if($errors->has('role_id'))
                                                 <span class="text-danger">
                                                {{ $errors->first('role_id') }}
                                            </span>
                                            @endif

                                                </div>
                                            </div>                                            
                                        <div class="col-lg-4 col-md-6">
                                                <div>
                                                    <span style="color:red;">*</span>Status
                                                    <select class="form-control" name="status" onchange="managerbind();"
                                                        id="managersssss" >
                                                            <option value="1"  
                                                               {{ old('status') ? (old('status') == $user->status ? 'selected' : '') : ($user->status == '1' ? 'selected' : '') }}>
                                                                {{ 'Active' }}
                                                            </option>                                                           
                                                             <option value="0"  
                                                               {{ old('status') ? (old('status') == $user->status ? 'selected' : '') : ($user->status == '0' ? 'selected' : '') }}>
                                                                {{ 'Inactive' }}
                                                            </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!--end col-->


                                        </div>
                                        <div class="card-footer mt-5" style="float: right;">
                                            <button type="submit"
                                                class="btn btn-success btn-user float-right mb-3">Update</button>
                                            <a class="btn btn-primary float-right mr-3 mb-3"
                                                href="{{ route('admin.users.index') }}">Cancel</a>
                                        </div>
                                        <!--end row-->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->

            </div>
        </div>
    </div>


@endsection


@section('scripts')

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const phoneNumberInput = document.getElementById('mobile');
        
        phoneNumberInput.addEventListener('input', function() {
            const value = phoneNumberInput.value.replace(/\D/g, ''); // Remove non-digit characters
            phoneNumberInput.value = value.slice(0, 10); // Limit to 10 digits
        });
    });
        function managerbind() {
            var manager = $('#managersssss').val();
            if (manager == 3) {
                $("#reporttoDiv").show();
                $("#ireportToo").attr("required", true);
                $("#TicketTypeDiv").show();
                $("#itickettype").attr("required", true);
            } else {
                $("#reporttoDiv").hide();
                $("#ireportToo").attr("required", false);
                $("#TicketTypeDiv").hide();
                $("#itickettype").attr("required", false);
            }
        }

        $(document).ready(function() {
            managerbind();
        });
    </script>

@endsection
