@extends('layouts.app')

@section('title', 'Roles')

@section('content')
 <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                    {{-- Alert Messages --}}
            @include('common.alert')

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">All Roles
                                    <a href="{{ route('roles.create') }}" style="float: right;" class="btn btn-sm btn-primary">
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
                                                       @foreach ($roles as $role)
                                                           <tr>
                                                               <td>{{$role->name}}</td>
                                                               <td>{{$role->guard_name}}</td>
                                                               <td style="display: flex">
                                                                   <a href="{{ route('roles.edit', ['role' => $role->id]) }}" class="">
                                                                        <i class="fa fa-pen"></i>
                                                                   </a>
                                                                   <form method="POST" action="{{ route('roles.destroy', ['role' => $role->id]) }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="" type="submit" style="border: none;background: none;">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>
                                                                   </form>
                                                               </td>
                                                           </tr>
                                                       @endforeach
                                                    </tbody>
                                                </table>
                                             <div class="d-flex justify-content-center mt-3">
                                                {{$roles->links()}}
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