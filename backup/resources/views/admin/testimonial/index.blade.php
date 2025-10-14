@extends('layouts.app')
@section('title', 'Testimonial List')
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
                                <h5 class="card-title mb-0">Testimonial List
                                    <a href="{{ route('testimonial.create') }}" style="float: right;" class="btn btn-sm btn-primary">
                                        <i class="far fa-plus"></i> Add Testimonial
                                    </a>
                                </h5>
                            </div> 
                           <!--  <div class="card-body">
                                <form method="post" action="{{ route('testimonial.index') }}" id="myForm">
                                    @csrf
                                     <div class="row"> 
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="name">Search By Student Name </label>
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
                            </div>  -->
                             <div class="row">
                                <div class="col-lg-12">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class=" table table-bordered table-striped table-hover datatable">
                                                    <thead>
                                                        <tr>
                                                            <th width="50"> Sr No </th>
                                                            <th> Parent Name </th>  
                                                            <th> Parent Photo </th>  
                                                            <th> Student Name </th>  
                                                            <th> Parent Photo </th>  
                                                            <th> Status </th>  
                                                            <th> Action </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                     @if(count($Testimonial) > 0)
                                                    <?php $i = 1;
                                                    ?>
                                                        @foreach($Testimonial as $key => $sdata)
                                                            <tr data-entry-id="{{ $sdata->testimonial_id }}">
                                                                <td>
                                                                    {{ $i + $Testimonial->perPage() * ($Testimonial->currentPage() - 1) }}
                                                                </td>
                                                                <td>
                                                                    {{ $sdata->parent_name ?? '' }}
                                                                </td>
                                                                 <td>
                                                                    <a target="_blank"  href="{{ asset('Testimonial/') . '/' . $sdata->parent_photo }}">
                                                                    <img width="50" height="50" src="{{ asset('Testimonial/') . '/' . $sdata->parent_photo }}"></a>
                                                                </td>
                                                                <td>
                                                                    {{ $sdata->student_name ?? '' }}
                                                                </td>
                                                                <td>
                                                                    <a target="_blank"  href="{{ asset('Testimonial/') . '/' . $sdata->student_photo }}">
                                                                    <img width="50" height="50" src="{{ asset('Testimonial/') . '/' . $sdata->student_photo }}"></a>
                                                                </td>
                                                                <td>
                                                                    @if($sdata->status == 0)
                                                                        <p > {{ 'Pending' }}</p>
                                                                    @elseif($sdata->status == 1)
                                                                        <p style="color:green;">{{ 'Approved' }}</p>
                                                                    @else
                                                                        <p style="color:red;">{{ 'Rejected' }}</p>
                                                                    @endif
                                                                </td>
                                                                
                                                                <td>
                                                                    <div class="d-flex gap-2">
                                                                        <a class="" title="Edit" href="{{ route('testimonial.edit', $sdata->testimonial_id) }}">  <i class="far fa-edit"></i>
                                                                        </a>

                                                                        <a class="" href="#" data-bs-toggle="modal"
                                                                            title="Delete" data-bs-target="#deleteRecordModal"
                                                                            onclick="deleteData(<?= $sdata->testimonial_id ?>);">
                                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                                        </a>

                                                                         <a class="mx-1" title="Edit Status" href="#" 
                                                                            data-bs-toggle="modal" data-bs-target="#editModal_{{ $sdata->testimonial_id }}">
                                                                            <i class="fa fa-check"></i>
                                                                        </a>
                                                                        <a class="mx-1" title="View" href="#" 
                                                                            data-bs-toggle="modal" data-bs-target="#viewModal_{{ $sdata->testimonial_id }}">
                                                                            <i class="fa fa-info"></i>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <!------model for view description ------------------->

                                                        <div class="modal fade flip" id="viewModal_{{$sdata->testimonial_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-light p-3">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Testimonial Comment </h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                                                        id="close-modal"></button>
                                                                </div>

                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <p >{!! $sdata->description !!}</p>
                                                                            
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                            <!--Edit Modal Start-->
                                            <div class="modal fade flip" id="editModal_{{ $sdata->testimonial_id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-light p-3">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Status</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                                                id="close-modal"></button>
                                                        </div>
                                                        <form method="POST" action="{{ route('testimonial.updatestatus') }}" autocomplete="off"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="testimonial_id" id="testimonial_id" value="{{ $sdata->testimonial_id }}">

                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <span style="color:red;">*</span>Status
                                                                    <select class="form-control" name="status" id="Editreview_status">
                                                                        <option value="0" {{ $sdata['status'] == 0 ? 'selected' : '' }}>Pending</option>
                                                                        <option value="1" {{ $sdata['status'] == 1 ? 'selected' : '' }}>Accepted</option>
                                                                        <option value="2" {{ $sdata['status'] == 2 ? 'selected' : '' }}>Rejected</option>
                                                                    </select >
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="hstack gap-2 justify-content-end">
                                                                    <button type="submit" class="btn btn-primary mx-2" id="add-btn">Update</button>
                                                                    <button type="button" class="btn btn-primary mx-2"
                                                                        data-bs-dismiss="modal">Cancel</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Edit Modal End -->


                                                        <?php $i++; ?>
                                                        @endforeach
                                                        @else
                                                         <tr>
                                                            <td colspan="3">
                                                                <center>
                                                            No Data Found
                                                        </center>
                                                            <td>

                                                        </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                             <div class="d-flex justify-content-center mt-3">
                                                {{ $Testimonial->links() }}
                                            </div>
                                                @if(count($Testimonial) > 0)

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
                                                                        
                                                                        <form id="bus-delete-form" method="POST" action="{{ route('testimonial.delete') }}">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <input type="hidden" name="testimonial_id" id="deleteid" value="">

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

