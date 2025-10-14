@extends('layouts.app')

@section('title', 'Permissions')

@section('content')
 <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

    {{-- Alert Messages --}}
    @include('common.alert')
   
    <!-- DataTales Example -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">All Permissions
                                        <a href="{{ route('permissions.create') }}" style="float: right;" class="btn btn-sm btn-primary">
                                            <i class="far fa-plus"></i> Add New
                                        </a>
                                    </h5>
                                </div>
                            <div class="card-body">
                             <div class="row">
                                <div class="col-lg-12">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class=" table table-bordered table-striped table-hover datatable">
                                                    <thead>
                                                        <tr>
                                                            <th width="40%">Name</th>
                                                            <th width="40%">Guard Name</th>
                                                            <th width="20%">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                       @foreach ($permissions as $permission)
                                                           <tr>
                                                               <td>{{$permission->name}}</td>
                                                               <td>{{$permission->guard_name}}</td>
                                                               <td style="display: flex">
                                                                   <a href="{{ route('permissions.edit', ['permission' => $permission->id]) }}" class="">
                                                                        <i class="fa fa-pen"></i>
                                                                   </a>
                                                                   <form method="POST" action="{{ route('permissions.destroy', ['permission' => $permission->id]) }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="" type="submit" style="border: none;background: none;">
                                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                                        </button>
                                                                   </form>
                                                               </td>
                                                           </tr>
                                                       @endforeach
                                                    </tbody>
                                                </table>
                                             <div class="d-flex justify-content-center mt-3">

                                                {{$permissions->links()}}
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

                                @endsection