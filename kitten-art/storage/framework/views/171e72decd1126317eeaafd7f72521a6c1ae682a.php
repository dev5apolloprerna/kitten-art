<?php $__env->startSection('title', 'Gallery List'); ?>
<?php $__env->startSection('content'); ?>

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                
                <?php echo $__env->make('common.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-lg-4">

                                        <div class="d-flex justify-content-between card-header">
                                            <h5 class="card-title mb-0">Add Gallery </h5>
                                        </div>

                                        <div class="live-preview">
                                            <form method="POST" action="<?php echo e(route('gallery.store')); ?>" autocomplete="off"
                                                enctype="multipart/form-data" id="add_gallery">
                                                <?php echo csrf_field(); ?>

                                                <div class="modal-body">
                                                    <div class="mt-4 mb-3">
                                                        Image <span style="color:red;">*</span>
                                                        <input type="file" id="image" name="image" class="form-control" value="<?php echo e(old('image')); ?>" placeholder="Enter Name" required  onchange="return validateFile()">  
                                                        <?php if($errors->has('image')): ?>
                                                            <span class="text-danger">
                                                                <?php echo e($errors->first('image')); ?>

                                                            </span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="mt-4 mb-3">
                                                        Select Type  <span style="color:red;">*</span>
                                                        <select class="form-control" name="type" required>
                                                                <option value="">Select Type</option>
                                                                <option value="1">Owner</option>
                                                                <option value="2">Student</option>
                                                        </select>
                                                    </div>
                                                    <div class="mt-4 mb-3">
                                                        <span style="color:red;"></span>Comment
                                                        <textarea id="editor1" name="comment" class="form-control" ><?php echo e(old('comment')); ?></textarea>  
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
                                            <h5 class="card-title mb-0">Gallery List</h5>

                                        </div>
                                        <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                                            <thead>
                                                <tr class="text-center">
                                                    

                                                    <th width="1%"> Sr No</th>
                                                    <th width="2%"> Image</th>
                                                    <th width="2%"> Type</th>
                                                    <th width="2%"> Comment</th>
                                                    <th width="1%"> Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                             <?php if(count($gallery) > 0): ?>
                                                <?php $i = 1; ?>
                                                    <?php $__currentLoopData = $gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $glry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr class="text-center">
                                                        <td><?php echo e($i + $gallery->perPage() * ($gallery->currentPage() - 1)); ?>

                                                        </td>
                                                        <td>
                                                            <!-- Image Thumbnail with Click Event -->
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal_<?php echo e($i); ?> ">
                                                        <img width="50" height="50" src="<?php echo e(asset($glry->image ? 'Gallery/' . $glry->image : 'images/noImage.png')); ?>">
                                                    </a>

                                                    <!-- Bootstrap Modal -->
                                                    <div class="modal fade" id="imageModal_<?php echo e($i); ?>" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    <img id="modalImage" src="<?php echo e(asset($glry->image ? 'Gallery/' . $glry->image : 'images/noImage.png')); ?>" class="img-fluid">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                        </td>
                                                        <td><?php if($glry->type == 1): ?> <?php echo e('Owner'); ?> 
                                                            <?php elseif($glry->type == 2): ?> <?php echo e('Student'); ?> 
                                                            <?php else: ?>
                                                                <?php echo e('-'); ?>

                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?php echo e(Str::words($glry->comment ?? '-', 3, '...')); ?></td>

                                                        <td>
                                                            <div class="gap-2">
                                                                <a class="mx-1" title="Edit" href="#"
                                                                    onclick="getGalleryEditData(<?= $glry->gallery_id ?>)"
                                                                    data-bs-toggle="modal" data-bs-target="#editModal">
                                                                    <i class="far fa-edit"></i>
                                                                </a>

                                                                <a class="" href="#" data-bs-toggle="modal"
                                                                    title="Delete" data-bs-target="#deleteRecordModal"
                                                                    onclick="deleteData(<?= $glry->gallery_id ?>);">
                                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                                </a>
                                                                 <a class="mx-1"  href="#" data-bs-toggle="modal" data-bs-target="#viewModal_<?php echo e($glry->gallery_id); ?>" title="View">
                                                                    <i class="fa fa-info" aria-hidden="true"></i>
                                                                </a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <!------model for view description ------------------->

                                                        <div class="modal fade flip" id="viewModal_<?php echo e($glry->gallery_id); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-light p-3">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Gallery Comment </h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                                                        id="close-modal"></button>
                                                                </div>

                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <p ><?php echo $glry->comment; ?></p>
                                                                            
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <?php $i++; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                 <?php else: ?>
                                                         <tr>
                                                            <td colspan="5">
                                                                <center>
                                                            No data Found
                                                        </center>
                                                            <td>

                                                        </tr>
                                                        <?php endif; ?>
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-center mt-3">
                                            <?php echo e($gallery->links()); ?>

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
                                <h5 class="modal-title" id="exampleModalLabel">Edit Gallery</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    id="close-modal"></button>
                            </div>
                            <form method="POST" action="<?php echo e(route('gallery.update')); ?>" autocomplete="off"
                                enctype="multipart/form-data" id="edit_gallery">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="gallery_id" id="gallery_id" value="">

                                <div class="modal-body">

                                    <div class="mb-3">
                                        Image <span style="color:red;"></span>
                                        <input type="file" id="editImage" name="image" class="form-control"  onchange="return editvalidateFile()" accept="image/*">
                                        <input type="hidden" name="hiddenImage" id="hiddenImage"  class="form-control">
                                        <p id="error" style="color:red"></p>
                                        <img src="" width="50px" height="50px" id="editphoto">
                                        
                                        <div id="error"></div>
                                    </div>
                                    <div class="mb-3">
                                         Select Type <span style="color:red;"></span>
                                        <select class="form-control" name="type" id="EditType">
                                                <option value="">Select Type</option>
                                                <option value="1">Owner</option>
                                                <option value="2">Student</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <span style="color:red;"></span>Comment
                                        <textarea type="text" class="form-control" name="comment" id="Editcomment"
                                            placeholder="Enter Comment"></textarea>
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
                                    <a class="btn btn-primary mx-2" href="<?php echo e(route('logout')); ?>"
                                        onclick="event.preventDefault(); document.getElementById('user-delete-form').submit();">
                                        Yes,
                                        Delete It!
                                    </a>
                                    
                                    <button type="button" class="btn w-sm btn-primary mx-2"
                                        data-bs-dismiss="modal">Close</button>
                                    <form id="user-delete-form" method="POST" action="<?php echo e(route('gallery.delete')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <input type="hidden" name="gallery_id" id="deleteid" value="">

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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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
            var url = "<?php echo e(route('gallery.edit', ':id')); ?>";
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

                            var imageUrl="https://kittenart.com/newkittenart/Gallery/"+obj.image;
                        }

                        $('#gallery_id').val(id);
                        $("#hiddenImage").val(obj.image);
                        $('#editphoto').attr('src', imageUrl);
                        $('#Editcomment').val(obj.comment);
                        $('#EditType').val(obj.type);

                var updateUrl = "<?php echo e(route('gallery.update', ':id')); ?>";
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
        $("#add_gallery").validate({

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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/admin/gallery/index.blade.php ENDPATH**/ ?>