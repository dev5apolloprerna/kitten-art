@extends('layouts.app')
@section('title', 'Company List')
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
                                <h5 class="card-title mb-0">Company List
                                </h5>
                            </div>
                             <div class="row">
                                <div class="col-lg-12">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class=" table table-bordered table-striped table-hover datatable">
                                                    <thead>
                                                        <tr>
                                                            <th width="50">
                                                            Sr No
                                                            </th>
                                                            <th>
                                                               Company Name
                                                            </th>
                                                            <th>
                                                               QR Code
                                                            </th>
                                                            <th>
                                                               UPI Id
                                                            </th>
                                                            
                                                            <th>
                                                                Action
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                     @if(count($company) > 0)
                                                    <?php $i = 1;
                                                    ?>

                                                        @foreach($company as $key => $companydata)
                                                            <tr >
                                                                <td>
                                                                    {{ $i }}
                                                                </td>
                                                                <td>
                                                                    {{ $companydata->companyName ?? '' }}
                                                                </td>
                                                               <td>
                                                                     @if($companydata->qrCode == '')
                                                                    @else
                                                                        <img src="/school_bus/images/company/{{ $companydata->qrCode}}" width="50px" height="50px" >
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    {{ $companydata->upiId ?? '' }}
                                                                </td>

                                                                <td>
                                                                    <div class="d-flex gap-2">
                                                                        <a class="" title="Edit"
                                                                            href="{{ route('admin.company.edit', $companydata->companyId) }}">
                                                                            <i class="far fa-edit"></i>
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
                                                @if(count($company) > 0)

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
                                                                        <button type="button" class="btn w-sm btn-light"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <a class="btn btn-danger" href="{{ route('logout') }}"
                                                                            onclick="event.preventDefault(); document.getElementById('area-delete-form').submit();">
                                                                            Yes,
                                                                            Delete It!
                                                                        </a>
                                                                        <form id="area-delete-form" method="POST" action="{{ route('admin.area.destroy') }}">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <input type="hidden" name="id" id="deleteid" value="">

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
    </script>

@endsection

