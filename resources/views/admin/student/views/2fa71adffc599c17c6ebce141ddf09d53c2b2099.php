<?php $__env->startSection('title', 'Batch List'); ?>
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
                                            <h5 class="card-title mb-0">Add Batch </h5>
                                        </div>

                                        <div class="live-preview">
                                            <form method="POST" action="<?php echo e(route('batch.store')); ?>" autocomplete="off"
                                                enctype="multipart/form-data" id="form-id">
                                                <?php echo csrf_field(); ?>

                                                <div class="modal-body">
                                                    <div class="mt-4 mb-3">
                                                     Category Name <span style="color:red;">*</span>
                                                        <select class="form-control" name="category_id" id="category_id" required>
                                                            <option value="">select category</option>
                                                                <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($c->category_id); ?>"><?php echo e($c->category_name); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                    <div class="mt-4 mb-3">
                                                     Batch Name <span style="color:red;">*</span>
                                                     <input type="text" name="batch_name" id="batch_name" value="<?php echo e(old('batch_name')); ?>" placeholder="Enter Batch Name" class="form-control" required>
                                                    </div>

                                                    <div class="mt-4 mb-3">
                                                            Batch Day <span style="color:red;">*</span>
                                                            <select class="form-control" name="batch_day" id="batch_day" required>
                                                                <option value="">Select Days</option>
                                                                    <option value="1">Monday</option>
                                                                    <option value="2">Tuesday</option>
                                                                    <option value="3">Wednesday</option>
                                                                    <option value="4">Thursday</option>
                                                                    <option value="5">Friday</option>
                                                                    <option value="6">Saturday</option>
                                                                    <option value="7">Sunday</option>
                                                            </select>
                                                    </div>
                                                    <div class="mt-4 mb-3">
                                                            Batch From Time <span style="color:red;">*</span>
                                                            <input type="time" name="batch_from_time" id="from_time" class="form-control" placeholder="Enter Time" value="<?php echo e(old('batch_from_time')); ?>" required>
                                                    </div>
                                                    <div class="mt-4 mb-3">
                                                            Batch To Time <span style="color:red;">*</span>
                                                            <input type="time" name="batch_to_time" id="to_time" class="form-control" placeholder="Enter Time" value="<?php echo e(old('batch_to_time')); ?>" required>
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

                                             <!--<form method="post" action="<?php echo e(route('batch.index')); ?>" id="myForm">-->
                                             <!--       <?php echo csrf_field(); ?>-->
                                             <!--   <div class="mt-4 mb-3"> Search By Batch Day-->
                                             <!--   <select name="search" id="search" class="form-control" value="<?php echo e(old('search', isset($search) ? $search : '')); ?>">-->
                                             <!--           <option value="">Select Day</option>-->
                                             <!--           <option value="1" <?php echo e($search == 1 ? 'selected' : ''); ?>>Monday</option>-->
                                             <!--           <option value="2" <?php echo e($search == 2 ? 'selected' : ''); ?>>Tuesday</option>-->
                                             <!--           <option value="3" <?php echo e($search == 3 ? 'selected' : ''); ?>>Wednesday</option>-->
                                             <!--           <option value="4" <?php echo e($search == 4 ? 'selected' : ''); ?>>Thursday</option>-->
                                             <!--           <option value="5" <?php echo e($search == 5 ? 'selected' : ''); ?>>Friday</option>-->
                                             <!--           <option value="6" <?php echo e($search == 6 ? 'selected' : ''); ?>>Saturday</option>-->
                                             <!--           <option value="7" <?php echo e($search == 7 ? 'selected' : ''); ?>>Sunday</option>-->
                                             <!--       </select>-->
                                             <!--   </div>-->
                                                
                                             <!--   <div class="mb-3">-->
                                             <!--       <input class="btn btn-primary mx-2" type="submit" value="<?php echo e('Search'); ?>">-->
                                             <!--       <input class="btn btn-primary" type="submit" onclick="myFunction()" value="<?php echo e('Reset'); ?>">-->
                                             <!--   </div>-->
                                             <!--   </form>-->
                                        <div class="d-flex justify-content-between card-header">
                                            <h5 class="card-title mb-0">Batch List</h5>

                                        </div>
                                        <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                                                    <thead>
                                                        <tr  class="text-center">
                                                            <th width="50"> Sr No </th>
                                                            <th> Category Name </th>  
                                                            <th> Batch Name </th>  
                                                            <th> Batch Day </th>  
                                                            <th> Batch From Time </th>  
                                                            <th> Batch To Time </th>  
                                                            <th> Action </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                     <?php if(count($batch) > 0): ?>
                                                    <?php $i = 1;
                                                    ?>
                                                        <?php $__currentLoopData = $batch; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bdate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr data-entry-id="<?php echo e($bdate->batch_id); ?>" class="text-center">
                                                                <td>
                                                                    <?php echo e($i + $batch->perPage() * ($batch->currentPage() - 1)); ?>

                                                                </td>
                                                                <td>
                                                                    <?php echo e($bdate->categoryName ?? ''); ?>

                                                                </td>
                                                                <td>
                                                                    <?php echo e($bdate->batch_name ?? ''); ?>

                                                                </td>
                                                                <td>
                                                                    <?php 
                                                                    $daysOfWeek = [
                                                                            1 => 'Monday',
                                                                            2 => 'Tuesday',
                                                                            3 => 'Wednesday',
                                                                            4 => 'Thursday',
                                                                            5 => 'Friday',
                                                                            6 => 'Saturday',
                                                                            7 => 'Sunday',
                                                                        ];

                                                                       
                                                                    ?>
                                                                    <?php echo e($daysOfWeek[$bdate->batch_day] ?? 'Invalid Day'); ?>

                                                                </td>
                                                                <td> <?php echo e(date('h:i A',strtotime($bdate->batch_from_time)) ?? ''); ?>

                                                                <td>
                                                                    <?php echo e(date('h:i A',strtotime($bdate->batch_to_time)) ?? ''); ?></td>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex gap-2">
                                                                       <a class="mx-1" title="Edit" href="#"
                                                                            onclick="getbatchEditData(<?= $bdate->batch_id ?>)"
                                                                            data-bs-toggle="modal" data-bs-target="#showModal">
                                                                            <i class="far fa-edit"></i>
                                                                        </a>
                                                                        <?php //if(!isset($bdata->student_batch_id) && $bdate->student_batch_id == "") ?>

                                                                        <a class="" href="#" data-bs-toggle="modal"
                                                                            title="Delete" data-bs-target="#deleteRecordModal"
                                                                            onclick="deleteData(<?= $bdate->batch_id ?>);">
                                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                                        </a>
                                                                        <?php //} ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php $i++; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php else: ?>
                                                         <tr>
                                                            <td colspan="3">
                                                                <center>
                                                            No data Found
                                                        </center>
                                                            <td>

                                                        </tr>
                                                        <?php endif; ?>
                                                    </tbody>
                                                </table>
                                             <div class="d-flex justify-content-center mt-3">
                                                <?php echo e($batch->links()); ?>

                                            </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <!--Edit Modal Start-->
                <div class="modal fade flip" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-light p-3">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Batch</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    id="close-modal"></button>
                            </div>
                            <form method="POST" action="<?php echo e(route('batch.update')); ?>" autocomplete="off"
                                enctype="multipart/form-data" id="editform-id">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="batch_id" id="batch_id" value="">

                                <div class="modal-body">

                                    <div class="mb-3">
                                         Category Name <span style="color:red;">*</span>
                                            <select class="form-control" name="category_id" id="editcategory_id" required>
                                            <option value="">select category</option>
                                            <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($c->category_id); ?>"><?php echo e($c->category_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                         Batch Name <span style="color:red;">*</span>
                                         <input type="text" name="batch_name" id="editbatch_name" class="form-control" placeholder="Enter Batch Name"  required>
                                    </div>
                                    <div class="mb-3">
                                       Batch Day <span style="color:red;">*</span>
                                        <select class="form-control" name="batch_day" id="editbatch_day" required>
                                            <option value="">Select Days</option>
                                                <option value="1">Monday</option>
                                                <option value="2">Tuesday</option>
                                                <option value="3">Wednesday</option>
                                                <option value="4">Thursday</option>
                                                <option value="5">Friday</option>
                                                <option value="6">Saturday</option>
                                                <option value="7">Sunday</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                            Batch From Time <span style="color:red;">*</span>
                                            <input type="time" name="batch_from_time" id="editbatch_from_time" class="form-control" placeholder="Enter Time" value="<?php echo e(old('batch_from_time')); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                            Batch To Time <span style="color:red;">*</span>
                                            <input type="time" name="batch_to_time" id="editbatch_to_time" class="form-control" placeholder="Enter Time" value="<?php echo e(old('batch_to_time')); ?>" required>
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
                                    <form id="user-delete-form" method="POST" action="<?php echo e(route('batch.destroy')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <input type="hidden" name="batch_id" id="deleteid" value="">

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
        <div id="loader-overlay"></div>
    <div id="loader">
        <div class="spinner"></div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <script>
         function getbatchEditData(id) 
         {

            var url = "<?php echo e(route('batch.edit', ':id')); ?>";
            url = url.replace(":id", id);
            if (id) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        id,id,
                       
                    },
                    success: function(data) 
                    {
                        var obj = JSON.parse(data);
                        console.log(obj);

                        $("#editcategory_id").val(obj.category_id);  // Fixed typo here
                        $('#batch_id').val(id);
                        $('#editbatch_name').val(obj.batch_name);
                        $('#editbatch_day').val(obj.batch_day);
                        $('#editbatch_to_time').val(obj.batch_to_time);
                        $('#editbatch_from_time').val(obj.batch_from_time);

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
$(document).ready(function() 
   {
    
        $('#form-id').on('submit', function(e) 
        {
            let fromTime = $('#from_time').val();
            let toTime = $('#to_time').val();
            let hasError = false;

            // Clear previous error messages
            $('.text-danger').remove();
            
            // Validate time range
            if (fromTime && toTime && fromTime >= toTime) 
            {
                $('#to_time').focus();
                $('<span class="text-danger">To Time must be greater than From Time.</span>')
                    .insertAfter('#to_time');
                hasError = true;
            }

            // Prevent form submission if there are errors
            if (hasError) {
                e.preventDefault();
            }
        });

$("#form-id").validate({
        rules: {
            category_id: {
                required: true,
            },
            batch_name: {
                required: true,
            },
            batch_from_time: {
                required: true,
            },
            batch_to_time: {
                required: true,
            },
            batch_day: {
                required: true,
            },
           
        },
        messages: {
            category_id: {
                required: "Please Select Category",
            },
            batch_name: {
                required: "Please Enter Batch Name",
            },
            batch_from_time: {
                required: "Please Enter From Time",
            },
            batch_to_time: {
                required: "Please Enter To Time",
            },
            batch_day: {
                required: "Please Select Batch day",
            },
            
        },

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
        $("#editform-id").validate({

           rules: {
            category_id: {
                required: true,
            },
            batch_name: {
                required: true,
            },
            batch_from_time: {
                required: true,
            },
            batch_to_time: {
                required: true,
            },
            batch_day: {
                required: true,
            },
           
        },
        messages: {
            category_id: {
                required: "Please Select Category",
            },
            batch_name: {
                required: "Please Enter Batch Name",
            },
            batch_from_time: {
                required: "Please Enter From Time",
            },
            batch_to_time: {
                required: "Please Enter To Time",
            },
            batch_day: {
                required: "Please Select Batch day",
            },
            
        },

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

        $('#editform-id').on('submit', function(e) 
        {
            let fromTime = $('#editbatch_from_time').val();
            let toTime = $('#editbatch_to_time').val();
            let hasError = false;

            // Clear previous error messages
            $('.text-danger').remove();

            
            // Validate time range
            if (fromTime && toTime && fromTime >= toTime) 
            {
                $('#editbatch_to_time').focus();
                $('<span class="text-danger">To Time must be greater than From Time.</span>')
                    .insertAfter('#editbatch_to_time');
                hasError = true;
            }

            // Prevent form submission if there are errors
            if (hasError) {
                e.preventDefault();
            }
        });
    });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/admin/batch/index.blade.php ENDPATH**/ ?>