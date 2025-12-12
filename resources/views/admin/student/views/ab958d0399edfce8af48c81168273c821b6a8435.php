<?php $__env->startSection('title', 'Edit Event Details'); ?>

<?php $__env->startSection('content'); ?>

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                
                <?php echo $__env->make('common.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Edit Event</h4>
                            <div class="page-title-right">
                                <a href="<?php echo e(route('events.index')); ?>"
                                    class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                    <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="<?php echo e(route('events.update', $data['event_id'])); ?>" method="POST" id="editform-id" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="event_id" id="event_id" value="<?php echo e($data['event_id']); ?>">
                                     <div class="row">
                                        <div class="col-md-6">

                                            <div class="form-group <?php echo e($errors->has('planName') ? 'has-error' : ''); ?>">
                                                <label for="planName">Category Name <span style="color:red">*</span></label>
                                                <select class="form-control" name="category_id" required>
                                                    <option value="">select category</option>
                                                        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($c['category_id']); ?>" <?php echo e($data['category_id'] == $c['category_id'] ? 'selected' : ''); ?>><?php echo e($c['category_name']); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div> 
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group <?php echo e($errors->has('event_name') ? 'has-error' : ''); ?>">
                                                <label for="event_name">Event Name <span style="color:red">*</span></label>
                                                <input type="text" id="event_name" name="event_name" class="form-control" value="<?php echo e($data['event_name']); ?>" required>
                                                <?php if($errors->has('event_name')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('event_name')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div> 
                                        </div>
                                        <div class="col-md-6 mt-4">
                                            <div class="form-group <?php echo e($errors->has('location') ? 'has-error' : ''); ?>">
                                                <label for="location">Location <span style="color:red">*</span></label>
                                                <input type="text" id="location" name="location" class="form-control" value="<?php echo e($data['location']); ?>"  required>
                                                <?php if($errors->has('location')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('location')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div> 
                                        </div>
                                        <div class="col-md-6 mt-4">
                                            <div class="form-group <?php echo e($errors->has('Instructors') ? 'has-error' : ''); ?>">
                                                <label for="Instructors">Instructors <span style="color:red">*</span></label>
                                                <input type="text" id="Instructors" name="Instructors" class="form-control" value="<?php echo e($data['Instructors']); ?>" required>
                                                <?php if($errors->has('Instructors')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('Instructors')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div> 
                                        </div>
                                        <div class="col-md-6 mt-4">
                                            <div class="form-group <?php echo e($errors->has('capacity') ? 'has-error' : ''); ?>">
                                                <label for="capacity">Capacity <span style="color:red">*</span></label>
                                                <input type="text" id="capacity" name="capacity" class="form-control" value="<?php echo e($data['capacity']); ?>" required>
                                                <?php if($errors->has('capacity')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('capacity')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div> 
                                        </div>

                                        <div class="col-md-6 mt-4">
                                            <div class="form-group <?php echo e($errors->has('discounts') ? 'has-error' : ''); ?>">
                                                <label for="discounts">Discounts <span style="color:red">*</span></label>
                                                <input type="text" id="discounts" name="discounts" class="form-control" value="<?php echo e($data['discounts']); ?>" maxlength="100" required>
                                                <?php if($errors->has('discounts')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('discounts')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div> 
                                        </div>

                                          <div class="col-md-6 mt-4">
                                            <div class="form-group <?php echo e($errors->has('from_date') ? 'has-error' : ''); ?>">
                                                <label for="from_datee">From Date <span style="color:red">*</span></label>
                                                <input type="date" id="from_datee" name="from_date" class="form-control" value="<?php echo e($data['from_date']); ?>"  required>
                                                <?php if($errors->has('from_date')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('from_date')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div> 
                                        </div>
                                         <div class="col-md-6 mt-4">
                                            <div class="form-group <?php echo e($errors->has('to_date') ? 'has-error' : ''); ?>">
                                                <label for="to_datee">To Date <span style="color:red">*</span></label>
                                                <input type="date" id="to_datee" name="to_date" class="form-control" value="<?php echo e($data['to_date']); ?>"  required>
                                                <?php if($errors->has('to_date')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('to_date')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div> 
                                        </div>

                                        <div class="col-md-6 mt-4">
                                            <div class="form-group <?php echo e($errors->has('from_time') ? 'has-error' : ''); ?>">
                                                <label for="from_timee">From Time <span style="color:red">*</span></label>
                                                <input type="time" id="from_timee" name="from_time" class="form-control" value="<?php echo e($data['from_time']); ?>"  required>
                                                <?php if($errors->has('from_time')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('from_time')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div> 
                                        </div>

                                         <div class="col-md-6 mt-4">
                                            <div class="form-group <?php echo e($errors->has('to_time') ? 'has-error' : ''); ?>">
                                                <label for="to_timee">To Time <span style="color:red">*</span></label>
                                                <input type="time" id="to_timee" name="to_time" class="form-control" value="<?php echo e($data['to_time']); ?>"  required>
                                                <?php if($errors->has('to_time')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('to_time')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div> 
                                        </div>

                                        

                                        
                                        <div class="col-md-6 mt-4">
                                            <div class="form-group <?php echo e($errors->has('image') ? 'has-error' : ''); ?>">
                                                <label for="image">Event Image <span style="color:red">*</span></label>
                                                <input type="file" id="image" name="image" class="form-control" value="<?php echo e(old('image')); ?>" onchange="return validateFile()" ><br>
                                                    <input type="hidden" name="hiddenImage" class="form-control"
                                                        value="<?php echo e(old('image') ? old('image') : $data['image']); ?>"
                                                        id="hiddenImage">
                                                    <div id="viewimg">
                                                        <img src="<?php echo e(asset('Events') . '/' . $data['image']); ?>"
                                                            alt="" height="70" width="70">
                                                        <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <span class="text-danger"><?php echo e($message); ?></span>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                <?php if($errors->has('image')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('image')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div> 
                                        </div>

                                        <div class="col-md-12 mt-4">
                                            <div class="form-group <?php echo e($errors->has('detail_description') ? 'has-error' : ''); ?>">
                                                <label for="detail_description"> Event Decription <span style="color:red">*</span></label>
                                                <textarea id="detail_description" rows="10" cols="10" name="detail_description" class="form-control ckeditor" value="<?php echo e(old('detail_description')); ?>"><?php echo e($data['detail_description']); ?></textarea>
                                                <?php if($errors->has('detail_description')): ?>
                                                    <span class="text-danger">
                                                        <?php echo e($errors->first('detail_description')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div> 
                                        </div>
                                    </div>  
                                    </div>
                                        <div class="card-footer mt-2">
                                            <div class="mb-3" style="float: right;">
                                                <button type="submit"
                                                class="btn btn-success btn-user float-right" onclick="return validateData();" >Update</button>
                                                <a class="btn btn-primary float-right mr-3"
                                                    href="<?php echo e(route('events.index')); ?>">Cancel</a>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script type="text/javascript">
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
    function validateData() 
    {
        var startdatetime = $('#from_datee').val();
        var enddatetime = $('#to_datee').val();

        if (enddatetime < startdatetime) {
            alert("EndDate Must Be Greater Than StartDate.")

            $('#startdatepicker').val("");
            $('#enddatepicker').val("");
            return false;
        } else {
            return true;
        }
    }
    $(document).ready(function() {
        $('#editform-id').on('submit', function(e) {
            let fromTime = $('#from_timee').val();
            let toTime = $('#to_timee').val();
            let hasError = false;

            // Clear previous error messages
            $('.text-danger').remove();

            // Validate if both times are entered
            
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
    });

$("#editform-id").validate({

    rules: {
            category_id: {
                required: true,
            },
            event_name: {
                required: true,
            },
            location: {
                required: true,
            },
            Instructors: {
                required: true,
            },
            capacity: {
                required: true,
            },
            discounts: {
                required: true,
            },
            from_date: {
                required: true,
            },
            to_date: {
                required: true,
            },
             from_time: {
                required: true,
            },
            to_time: {
                required: true,
            },
            detail_description: {
                required: true,
            },
           
        },
        messages: {
            category_id: {
                required: "Please Select Category",
            },
            event_name: {
                required: "Please Enter Event Name",
            },
            location: {
                required: "Please Enter Location",
            },
            Instructors: {
                required: "Please Enter Instructors",
            },
            capacity: {
                required: "Please Enter Capacity",
            },
            discounts: {
                required: "Please Enter Discount",
            },
            from_date: {
                required: "Please Enter From Date",
            },
            to_date: {
                required: "Please Enter To Date",
            },
            from_time: {
                required: "Please Enter From Time",
            },
            to_time: {
                required: "Please Enter To Time",
            },
            detail_description: {
                required: "Please Select Event Description",
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
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/admin/event/edit.blade.php ENDPATH**/ ?>