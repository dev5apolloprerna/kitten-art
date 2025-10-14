@extends('layouts.app')
@section('title', 'Popup Image')
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

                                    

                                    <div class="col-lg-8">
                                        <div class="d-flex justify-content-between card-header">
                                            <h5 class="card-title mb-0">Popup Image</h5>

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
                                                <?php $i = 1; ?>
                                                    <tr class="text-center">
                                                        <td>1
                                                        </td>
                                                        <td>
                                                            <!-- Image Thumbnail with Click Event -->
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal_{{ $i }} ">
                                                        <img width="50" height="50" src="{{ asset($gallery->image ? 'POPUPImage/' . $gallery->image : 'images/noImage.png') }}">
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
                                                                    <img id="modalImage" src="{{ asset($gallery->image ? 'POPUPImage/' . $gallery->image : 'images/noImage.png') }}" class="img-fluid">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                        </td>
                                                        
                                                        <td>
                                                            <div class="gap-2">
                                                                <a class="mx-1" title="Edit" href="#"
                                                                    onclick="getGalleryEditData(<?= $gallery->image_id ?>)"
                                                                    data-bs-toggle="modal" data-bs-target="#editModal">
                                                                    <i class="far fa-edit"></i>
                                                                </a>

                                                                 <a class="mx-1"  href="#" data-bs-toggle="modal" data-bs-target="#viewModal_{{$gallery->image_id}}" title="View">
                                                                    <i class="fa fa-info" aria-hidden="true"></i>
                                                                </a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                   


                                                    <?php $i++; ?>
                                               
                                            </tbody>
                                        </table>
                                      
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
                                <h5 class="modal-title" id="exampleModalLabel">Edit Popup Image</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    id="close-modal"></button>
                            </div>
                            <form method="POST" action="{{ route('popupImage.updateImage') }}" autocomplete="off"
                                enctype="multipart/form-data" id="edit_gallery">
                                @csrf
                                <input type="hidden" name="image_id" id="image_id" value="">

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

               
            </div>
        </div>
    </div>
@endsection

@section('scripts')
        <script>
           
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
            var url = "{{ route('popupImage.editImage', ':id') }}";
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

                            var imageUrl="https://kittenart.com/newkittenart/POPUPImage/"+obj.image;
                        }

                        $('#image_id').val(id);
                        $("#hiddenImage").val(obj.image);
                        $('#editphoto').attr('src', imageUrl);

                var updateUrl = "{{ route('popupImage.updateImage', ':id') }}";
                updateUrl = updateUrl.replace(":id", id);
                $('form').attr('action', updateUrl); // Set the updated action to the form

                    }
                });
            }
        }
    </script>

    <script>
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
