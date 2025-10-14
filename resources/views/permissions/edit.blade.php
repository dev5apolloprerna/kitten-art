@extends('layouts.app')

@section('title', 'Edit Permission')

@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
                {{-- Alert Messages --}}
    @include('common.alert')

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Edit Permission</h4>
                        <div class="page-title-right">
                            <a href="{{ route('permissions.index') }}"
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
                            <form method="POST" action="{{route('permissions.update', ['permission' => $permission->id])}}">
                                @csrf
                                @method('PUT')
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
                                            value="{{ old('name') ? old('name') : $permission->name }}">

                                        @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>


                                    {{-- Guard Name --}}
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <span style="color:red;">*</span>Guard Name</label>
                                        <select class="form-control form-control-user @error('guard_name') is-invalid @enderror" name="guard_name">
                                            <option selected disabled>Select Guard Name</option>
                                            <option value="web" {{old('guard_name') ? ((old('guard_name') == 'web') ? 'selected' : '') : (($permission->guard_name == 'web') ? 'selected' : '')}}>Web</option>
                                            <option value="api" {{old('guard_name') ? ((old('guard_name') == 'api') ? 'selected' : '') : (($permission->guard_name == 'api') ? 'selected' : '')}}>Api</option>
                                        </select>
                                        @error('guard_name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                </div>
                                 <div class="mt-4">

                                {{-- Save Button --}}
                                <button type="submit" class="btn btn-success btn-user btn-block">
                                    Update
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