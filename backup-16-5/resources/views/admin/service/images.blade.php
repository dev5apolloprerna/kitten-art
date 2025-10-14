@extends('layouts.app')
@section('title', 'Service Images')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Service Images</h4>
                        <div class="page-title-right">
                            <a href="{{ route('service.index') }}"
                                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
                {{-- Alert Messages --}}
                @include('common.alert')

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-lg-5">

                                        <div class="d-flex justify-content-between card-header">
                                            <h5 class="card-title mb-0">Add Service Images </h5>
                                        </div>

                                        <div class="live-preview">
                                            <form method="POST" action="{{ route('service.uploadimages') }}" autocomplete="off"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="service_id" value="{{ $serviceId }}">
                                                <div class="modal-body">
                                                    <div class="mt-4 mb-3">
                                                        <span style="color:red;">*</span>Image
                                                        <input type="file" id="image" name="image[]" class="form-control" value="{{ old('image') }}" placeholder="Enter Name"  onchange="return validateFile()" multiple>  
                                                        @if($errors->has('image'))
                                                            <span class="text-danger">
                                                                {{ $errors->first('image') }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="hstack gap-2 justify-content-end">
                                                        <button type="submit" class="btn btn-primary mx-2"
                                                            id="add-btn">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="col-lg-1">
                                    </div>

                                    <div class="col-lg-5">
                                        <div class="d-flex justify-content-between card-header">
                                            <h5 class="card-title mb-0">Service Images</h5>

                                        </div>
                                        <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                                            <thead>
                                                <tr class="text-center">
                                                    

                                                    <th width="1%"> Sr No</th>
                                                    <th width="2%"> Image</th>
                                                    <th width="1%"> Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; 
                                                if(sizeof($Images) != 0){
                                                 ?>
                                                    @foreach($Images as $key => $glry)
                                                    <tr class="text-center">
                                                        <td>{{ $i }}
                                                        </td>
                                                        <td>

                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal_{{ $i }} ">
                                                        <img width="50" height="50" src="{{ asset($glry['image'] ? '/Service/service_images/' . $glry['image'] : 'images/noImage.png') }}">
                                                    </a>

                                                    <!-- Bootstrap Modal -->
                                                    <div class="modal fade" id="imageModal_{{ $i }}" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    <img id="modalImage" src="{{ asset($glry['image'] ? '/Service/service_images/' . $glry['image'] : 'images/noImage.png') }}" class="img-fluid">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                        </td>

                                                        <td>
                                                            <div class="gap-2">
                                                                <a class="" href="#" data-bs-toggle="modal"
                                                                    title="Delete" data-bs-target="#deleteRecordModal"
                                                                    onclick="deleteData(<?= $glry['service_image_id'] ?>);">
                                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                                </a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php  $i++; ?>
                                                @endforeach
                                                <?php } else { ?>

                                                    <tr>
                                                        <td colspan="3" class="text-center">No Data Found</td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!--Delete Modal Start -->
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
                                    <a class="btn btn-primary mx-2" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('user-delete-form').submit();">
                                        Yes,
                                        Delete It!
                                    </a>
                                    
                                    <button type="button" class="btn w-sm btn-primary mx-2"
                                        data-bs-dismiss="modal">Close</button>
                                    <form id="user-delete-form" method="POST" action="{{ route('service.deleteImages') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="service_image_id" id="deleteid" value="">

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Delete modal End -->

            </div>
        </div>
    </div>
@endsection

@section('scripts')
        <script>
             function validateFile() {
            var allowedExtension = ['jpeg', 'jpg', 'png', 'webp'];
            var fileExtension = document.getElementById('strPhoto').value.split('.').pop().toLowerCase();
            var isValidFile = false;
            var image = document.getElementById('strPhoto').value;

            for (var index in allowedExtension) {

                if (fileExtension === allowedExtension[index]) {
                    isValidFile = true;
                    break;
                }
            }
            if (image != "") {
                if (!isValidFile) {
                    alert('Allowed Extensions are : *.' + allowedExtension.join(', *.'));
                    $('#strPhoto').val("")
                }
                return isValidFile;
            }

            return true;
        }

    </script>

    <script>
        function deleteData(id) {
            $("#deleteid").val(id);
        }
    </script>

@endsection
