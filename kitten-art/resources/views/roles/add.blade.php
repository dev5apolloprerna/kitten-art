@extends('layouts.app')

@section('title', 'Add Role')

@section('content')


<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            {{-- Alert Messages --}}
            @include('common.alert')
   
    <!-- DataTales Example -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Add Role</h4>
                        <div class="page-title-right">
                            <a href="{{ route('roles.index') }}"
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
                            <form method="POST" action="{{route('roles.store')}}">
                                @csrf
                                <div class="form-group row">

                                    {{-- Name --}}
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <span style="color:red;">*</span>Name</label>
                                        <input 
                                            type="text" 
                                            class="form-control form-control-user @error('name') is-invalid @enderror" 
                                            id="exampleName"
                                            placeholder="Name" 
                                            name="name" 
                                            value="{{ old('name') }}">

                                        @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>


                                    {{-- Email --}}
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <span style="color:red;">*</span>Guard Name</label>
                                        <select class="form-control form-control-user @error('guard_name') is-invalid @enderror" name="guard_name">
                                            <option selected disabled>Select Guard Name</option>
                                            <option value="web" selected>Web</option>
                                            <option value="api">Api</option>
                                        </select>
                                        @error('guard_name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                </div>

                                {{-- Save Button --}}
                                <div class="mt-4">

                                <button type="submit" class="btn btn-success btn-user btn-block">
                                    Save
                                </button>
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