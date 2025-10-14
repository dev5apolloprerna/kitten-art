@extends('layouts.app')
@section('title', 'Events List')
@section('content')

<?php $profileId = Request::segment(3);?>

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                {{-- Alert Messages --}}
                @include('common.alert')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Events List
                                    <a href="{{ route('events.create') }}" style="float: right;" class="btn btn-sm btn-primary">
                                        <i class="far fa-plus"></i> Add Events
                                    </a>

                                </h5>
                                
                            </div> 
                            <div class="card-body">
                                <form method="post" action="{{ route('events.index') }}" id="myForm">
                                    @csrf
                                     <div class="row"> 
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="name">Search By Event Name </label>
                                                <input type="text" name="search" id="search" class="form-control" value="{{ $search ?? '' }}">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <div class="form-group">
                                            <input class="btn btn-primary" style="margin-top: 15%;" type="submit" value="{{'Search'}}">
                                            <input class="btn btn-primary" style="margin-top: 15%;" type="submit" onclick="myFunction()" value="{{'Reset'}}">

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div> 
                             <div class="row">
                                <div class="col-lg-12">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class=" table table-bordered table-striped table-hover datatable">
                                                    <thead>
                                                        <tr>
                                                            <th width="50"> Sr No </th>
                                                            <th> Category Name </th>  
                                                            <th> Event Name </th>  
                                                            <th> Capacity  </th>  
                                                            <th> Events Dates </th>  
                                                            <th> Events Time </th>  
                                                            <th> Image </th>  
                                                            <th> Action </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                     @if(count($event) > 0)
                                                    <?php $i = 1;
                                                    ?>
                                                        @foreach($event as $key => $edata)
                                                            <tr data-entry-id="{{ $edata->event_id }}">
                                                                <td>
                                                                    {{ $i + $event->perPage() * ($event->currentPage() - 1) }}
                                                                </td>
                                                                <td>
                                                                    {{ $edata->categoryName ?? '' }}
                                                                </td>
                                                                <td>
                                                                    {{ $edata->event_name ?? '' }}</td>
                                                                 <td>   {{ $edata->capacity ?? '' }}
                                                                </td>
                                                                <td>
                                                                    {{ date('d-m-Y',strtotime($edata->from_date)) }} - {{ date('d-m-Y',strtotime($edata->to_date)) }}
                                                                </td> 
                                                                <td>
                                                                    {{ date('h:i A',strtotime($edata->from_time)) }} - {{ date('h:i A',strtotime($edata->to_time)) }}
                                                                </td> 
                                                                <td>
                                                                    <a href="{{ asset('/Events/').'/'.$edata->image }}"
                                                                        target="_blank" class="mx-1">
                                                                        <img src="{{ asset('/Events/').'/'.$edata->image }}" alt="" width="50px" height="50px">
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex gap-2">
                                                                        <a class="" title="Edit"
                                                                            href="{{ route('events.edit', $edata->event_id) }}">
                                                                            <i class="far fa-edit"></i>
                                                                        </a>

                                                                        <a class="" href="#" data-bs-toggle="modal"
                                                                            title="Delete" data-bs-target="#deleteRecordModal"
                                                                            onclick="deleteData(<?= $edata->event_id ?>);">
                                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php $i++; ?>
                                                        @endforeach
                                                        @else
                                                         <tr>
                                                            <td colspan="3">
                                                                <center>
                                                            No data Found
                                                        </center>
                                                            <td>

                                                        </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                             <div class="d-flex justify-content-center mt-3">
                                                {{ $event->links() }}
                                            </div>
                                                @if(count($event) > 0)

                                                     <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                                                        id="btn-close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mt-2 text-center">
                                                                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                                                            colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px">
                                                                        </lord-icon>
                                                                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                                            <h4>Are you Sure ?</h4>
                                                                            <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Record
                                                                                ?</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                                        <a class="btn btn-danger" href="{{ route('logout') }}"
                                                                            onclick="event.preventDefault(); document.getElementById('bus-delete-form').submit();">
                                                                            Yes,
                                                                            Delete It!
                                                                        </a>
                                                                        <button type="button" class="btn w-sm btn-light"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        
                                                                        <form id="bus-delete-form" method="POST" action="{{ route('events.delete') }}">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <input type="hidden" name="event_id" id="deleteid" value="">

                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end modal -->
                                                    @endif
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
@section('scripts')
    <script>
        function deleteData(id) {
            $("#deleteid").val(id);
        }
        function myFunction() 
        {
            $('#search').removeAttr('value');
        }
    </script>

@endsection

