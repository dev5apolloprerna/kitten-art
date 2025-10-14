@extends('layouts.app')

@section('title', 'Add Users')

@section('content')
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            {{-- Alert Messages --}}
            @include('common.alert')

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Add Users</h4>
                        <div class="page-title-right">
                            <a href="{{ route('admin.users.index') }}"
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
                            <div class="live-preview">
                                <form action="{{ route('admin.users.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                        <div class="row gy-4">
                                        <div class="col-lg-4 col-md-6">

                                            <label for="first_name"><span style="color:red;">*</span>First Name </label>
                                            <input type="text" id="first_name" name="first_name" class="form-control" value="{{ old('first_name', isset($user) ? $user->first_name : '') }}">
                                            @if($errors->has('first_name'))
                                                 <span class="text-danger">
                                                {{ $errors->first('first_name') }}
                                            </span>
                                            @endif
                                        </div>
                                         <div class="col-lg-4 col-md-6">
                                            <label for="last_name"><span style="color:red;">*</span>Last Name </label>
                                            <input type="text" id="last_name" name="last_name" class="form-control"  value="{{ old('last_name', isset($user) ? $user->last_name : '') }}">
                                            @if($errors->has('last_name'))
                                                 <span class="text-danger">
                                                {{ $errors->first('last_name') }}
                                            </span>
                                            @endif
                                        </div>
                                        <div class="col-lg-4 col-md-6">

                                            <label for="email"><span style="color:red;">*</span>Email </label>
                                            <input type="text" id="email" name="email" class="form-control"  value="{{ old('email', isset($user) ? $user->email : '') }}">
                                            @if($errors->has('email'))
                                                 <span class="text-danger">
                                                {{ $errors->first('email') }}
                                            </span>
                                            @endif
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                        <div>
                                            <span style="color:red;">*</span>Mobile Number
                                            <input type="text" class="form-control" name="mobile_number" id="mobile_number"
                                                value="{{ old('mobile_number')}}" pattern="\d{10}" maxlength="10"
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
                                                            <option value="{{ $role->id }}" {{ old('role_id')== $role->id ? 'selected' :'' }}>
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
                                           <label  for="password">Password</label>
                                            <input id="password" name="password" type="password" 
                                                class="form-control" value="{{ old('password', isset($user) ? $user->password : '') }}">
                                            @if($errors->has('password'))
                                                 <span class="text-danger">
                                                {{ $errors->first('password') }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <input type="hidden" name="strIP"
                                            value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
                                        <input class="btn btn-success btn-user float-right" type="submit" id="submit"
                                            value="save">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
