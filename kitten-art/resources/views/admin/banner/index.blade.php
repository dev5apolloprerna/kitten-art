    @extends('layouts.app')
@section('title', 'Banner List')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                {{-- Alert Messages --}}
                @include('common.alert')

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-lg-4">

                                        <div class="d-flex justify-content-between card-header">
                                            <h5 class="card-title mb-0">Add Banner </h5>
                                        </div>

                                        <div class="live-preview">
                                            <form method="POST" action="{{ route('banner.store') }}" autocomplete="off"
                                                enctype="multipart/form-data" id="add_banner">
                                                @csrf

                                                <div class="modal-body">
                                                    <div class="mt-4 mb-3">
                                                        Image <span style="color:red;">*</span>
                                                        <input type="file" id="image" name="image" class="form-control" value="{{ old('image') }}" placeholder="Enter Name" required  onchange="return validateFile()">  
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
                                                            <button type="reset" class="btn btn-primary mx-2"
                                                            id="add-btn">Clear</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>


                                    <div class="col-lg-8">
                                        <div class="d-flex justify-content-between card-header">
                                            <h5 class="card-title mb-0">Banner List</h5>

                                        </div>
                                        <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                                            <thead>
                                                <tr class="text-center">
                                                    

                                                    <th> Sr No</th>
                                                    <th> Image</th>
                                                    <th> Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                             @if(count($banner) > 0)
                                                <?php $i = 1; ?>
                                                    @foreach($banner as $key => $glry)
                                                    <tr class="text-center">
                                                        <td>{{ $i + $banner->perPage() * ($banner->currentPage() - 1) }}
                                                        </td>
                                                        <td>
                                                            <!-- Image Thumbnail with Click Event -->
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal_{{ $i }} ">
                                                        <img width="50" height="50" src="{{ asset($glry->image ? 'Banner/' . $glry->image : 'images/noImage.png') }}">
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
                                                                    <img id="modalImage" src="{{ asset($glry->image ? 'Banner/' . $glry->image : 'images/noImage.png') }}" class="img-fluid">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                        </td>
                                                        
                                                        <td>
                                                            <div class="gap-2">
                                                                <a class="mx-1" title="Edit" href="#"
                                                                    onclick="getGalleryEditData(<?= $glry->bannerId ?>)"
                                                                    data-bs-toggle="modal" data-bs-target="#editModal">
                                                                    <i class="far fa-edit"></i>
                                                                </a>

                                                                <a class="" href="#" data-bs-toggle="modal"
                                                                    title="Delete" data-bs-target="#deleteRecordModal"
                                                                    onclick="deleteData(<?= $glry->bannerId ?>);">
                                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                                </a>
                                                                 <a class="mx-1"  href="#" data-bs-toggle="modal" data-bs-target="#viewModal_{{$glry->bannerId}}" title="View">
                                                                    <i class="fa fa-info" aria-hidden="true"></i>
                                                                </a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <!------model for view description ------------------->


                                                    <?php $i++; ?>
                                                @endforeach
                                                 @else
                                                         <tr>
                                                            <td colspan="5">
                                                                <center>
                                                            No data Found
                                                        </center>
                                                            <td>

                                                        </tr>
                                                        @endif
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-center mt-3">
                                            {{ $banner->links() }}
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <!--Edit Modal Start-->
                <div class="modal fade flip" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-light p-3">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Banner</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    id="close-modal"></button>
                            </div>
                            <form method="POST" action="{{ route('banner.update') }}" autocomplete="off"
                                enctype="multipart/form-data" id="edit_gallery">
                                @csrf
                                <input type="hidden" name="bannerId" id="bannerId" value="">

                                <div class="modal-body">

                                    <div class="mb-3">
                                        Image <span style="color:red;"></span>
                                        <input type="file" id="editImage" name="image" class="form-control"  onchange="return editvalidateFile()" accept="image/*">
                                        <input type="hidden" name="hiddenImage" id="hiddenImage"  class="form-control">
                                        <p id="error" style="color:red"></p>
                                        <img src="" width="50px" height="50px" id="editphoto">
                                        
                                        <div id="error"></div>
                                    </div>
                                   
                                 
                                </div>
                                <div class="modal-footer">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-primary mx-2"
                                            id="add-btn">Update</button>
                                        <button type="button" class="btn btn-primary mx-2"
                                            data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--Edit Modal End -->

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
                                    <form id="user-delete-form" method="POST" action="{{ route('banner.destroy') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="bannerId" id="deleteid" value="">

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
            var fileExtension = document.getElementById('image').value.split('.').pop().toLowerCase();
            var isValidFile = false;
            var image = document.getElementById('image').value;

            for (var index in allowedExtension) {

                if (fileExtension === allowedExtension[index]) {
                    isValidFile = true;
                    break;
                }
            }
            if (image != "") {
                if (!isValidFile) {
                    alert('Allowed Extensions are : *.' + allowedExtension.join(', *.'));
                    $('#image').val("")
                }
                return isValidFile;
            }

            return true;
        }
          function editvalidateFile() {
            var allowedExtension = ['jpeg', 'jpg', 'png', 'webp'];
            var fileExtension = document.getElementById('editImage').value.split('.').pop().toLowerCase();
            var isValidFile = false;
            var image = document.getElementById('editImage').value;

            for (var index in allowedExtension) {

                if (fileExtension === allowedExtension[index]) {
                    isValidFile = true;
                    break;
                }
            }
            if (image != "") {
                if (!isValidFile) {
                    alert('Allowed Extensions are : *.' + allowedExtension.join(', *.'));
                    $('#editImage').val("")
                }
                return isValidFile;
            }

            return true;
        }

         function getGalleryEditData(id) 
         {
            var url = "{{ route('banner.edit', ':id') }}";
            url = url.replace(":id", id);
            if (id) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        id,
                        id
                    },
                    success: function(data) 
                    {
                        var obj = JSON.parse(data);
                        console.log(obj);
                        if(obj.image == null)
                        {
                            var imageUrl="./assets/images/noImage.png";
                        }else{

                            var imageUrl="https://kittenart.com/newkittenart/Banner/"+obj.image;
                        }

                        $('#bannerId').val(id);
                        $("#hiddenImage").val(obj.image);
                        $('#editphoto').attr('src', imageUrl);

                var updateUrl = "{{ route('banner.update', ':id') }}";
                updateUrl = updateUrl.replace(":id", id);
                $('form').attr('action', updateUrl); // Set the updated action to the form

                    }
                });
            }
        }
    </script>

    <script>
        function deleteData(id) {
            $("#deleteid").val(id);
        }
          function myFunction() 
        {
            $('#search').val('');

        }
        $("#add_banner").validate({

        errorPlacement: function (error, element) {
            error.insertAfter(element);
            error.css("color", "red"); // Set error message color to red
        },
        submitHandler: function (form) {
            form.submit();
            $('section').addClass('blurred'); // Blur the page
            $('#loader-overlay').show();   // Show overlay
            $('#loader').show();           // Show spinner
            
        }
    });
        $("#edit_gallery").validate({

        errorPlacement: function (error, element) {
            error.insertAfter(element);
            error.css("color", "red"); // Set error message color to red
        },
        submitHandler: function (form) {
            form.submit();
            $('section').addClass('blurred'); // Blur the page
            $('#loader-overlay').show();   // Show overlay
            $('#loader').show();           // Show spinner
            
        }
    });
    </script>

@endsection
