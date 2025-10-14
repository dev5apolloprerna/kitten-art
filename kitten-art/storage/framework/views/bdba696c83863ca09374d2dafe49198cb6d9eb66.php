<?php $__env->startSection('title', 'Student Attendance List'); ?>
<?php $__env->startSection('content'); ?>

<?php $profileId = Request::segment(3);?>

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                
                <?php echo $__env->make('common.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Student Attendance List
                                </h5>
                                
                            </div> 
                            <div class="card-body">
                                <form method="post" action="<?php echo e(route('attendance.index')); ?>" id="myForm">
                                    <?php echo csrf_field(); ?>
                                     <div class="row"> 
                                        <div class="col-md-4"> 
                                            <div class="form-group">
                                                <label for="name">Search By Batch Name</label>
                                                <select name="batch" id="batch" class="form-control"  > 
                                                    <option value="">Select Batch</option>
                                                    <?php $__currentLoopData = $batchdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($b->batch_id); ?>" <?php echo e($b->batch_id == $batch ? 'selected' : ''); ?>><?php echo e($b->batch_name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>   

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Search By Student Name </label>
                                                <input type="text" name="search" id="search" placeholder="Search By Student Name" class="form-control" value="<?php echo e($search ?? ''); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                            <input class="btn btn-primary" style="margin-top: 10%;" type="submit" value="<?php echo e('Search'); ?>">
                                            <input class="btn btn-primary" style="margin-top: 10%;" type="submit" onclick="myFunction()" value="<?php echo e('Reset'); ?>">

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div> 
                             <div class="row">
                                <div class="col-lg-12">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                 <div class=" col-lg-4">
                                                    <label for="attendance_date">Date</label>
                                                    <input type="date" name="attendance_date" id="attendance_date" class="form-control"  required>
                                                </div>
                                                    
                                                <button id="mark-absent" class="btn btn-sm btn-danger mb-2" style="float: right; margin-left: 10px;">Mark as Absent</button>
                                                <button id="mark-attended" class="btn btn-sm btn-success mb-2" style="float: right;">Mark as Attended</button>

                                                <table class=" table table-bordered table-striped table-hover datatable">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th width="50">
                                                                <input type="checkbox" id="select-all">
                                                            </th>
                                                            <th width="50"> Sr No </th>
                                                            <th> Student Name </th>  
                                                            <th> Mobile </th>  
                                                            <th> Email </th>  
                                                            <th> Student Age </th>  
                                                            <th> Category Name </th>  
                                                            <th> Plan Name </th>  
                                                            <th> Batch Name </th>  
                                                            <th> Batch Day </th>  
                                                            <th> Amount </th>  
                                                            <th> Status </th>  
                                                            <th> Action </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                     <?php if(count($Student) > 0): ?>
                                                    <?php $i = 1;
                                                    ?>
                                                        <?php $__currentLoopData = $Student; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr data-entry-id="<?php echo e($sdata->student_id); ?>"  data-subscription-id="<?php echo e($sdata->subscription_id); ?>" class="text-center">
                                                                <td >
                                                                    <input type="checkbox" class="student-checkbox" value="<?php echo e($sdata->student_id); ?>" data-subscription-id="<?php echo e($sdata->subscription_id); ?>">
                                                                </td>
                                                                <td>
                                                                    <?php echo e($i + $Student->perPage() * ($Student->currentPage() - 1)); ?>

                                                                </td>
                                                                <td>
                                                                    <?php echo e($sdata->student_first_name ?? ''); ?> <?php echo e($sdata->student_last_name ?? ''); ?>

                                                                </td>
                                                                <td>
                                                                    <?php echo e($sdata->mobile ?? ''); ?>

                                                                </td>
                                                                <td>
                                                                    <?php echo e($sdata->email ?? ''); ?>

                                                                </td>
                                                                <td>
                                                                    <?php echo e($sdata->student_age ?? ''); ?>

                                                                </td>
                                                                 <td>
                                                                    <?php echo e($sdata->categoryName ?? '-'); ?>

                                                                </td>
                                                                <td>
                                                                    <?php echo e($sdata->planName ?? '-'); ?>

                                                                </td>
                                                                <td>
                                                                    <?php echo e($sdata->batchname ?? '-'); ?>

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
                                                                    <?php echo e($daysOfWeek[$sdata->batchday] ?? 'Invalid Day'); ?>

                                                                </td>

                                                                <td>
                                                                    <?php echo e($sdata->amount); ?>

                                                                </td>
                                                                <td>
                                                                    <?php 
                                                                     $status = App\Models\StudentAttendance::select('attendance')
                                                                                  ->where(['student_id' => $sdata->student_id,'subscription_id'=>$sdata->subscription_id])
                                                                                  ->latest()->first();
                                                                    ?>
                                                                    <?php echo e($status->attendance ?? '-'); ?></td>
                                                                <td>
                                                                    <div class="d-flex gap-3">
                                                                        <a class="" title="View"
                                                                            href="<?php echo e(route('attendance.view', $sdata->student_id)); ?>">
                                                                            <i class="fa fa-info"></i>
                                                                        </a>
                                                                        <!-- <a href="javascript:void(0);" class="btn btn-sm btn-primary openAttendanceModal" 
                                                                        data-student-id="<?php echo e($sdata->student_id); ?>" data-category-id="<?php echo e($sdata->category_id); ?>" data-batch-id="<?php echo e($sdata->batch_id); ?>"
                                                                        data-subscription-id="<?php echo e($sdata->subscription_id); ?>"
                                                                        > <i class="fa fa-plus"></i>
                                                                        </a> -->
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php $i++; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php else: ?>
                                                         <tr>
                                                            <td colspan="11">
                                                                <center>
                                                            No data Found
                                                        </center>
                                                            <td>

                                                        </tr>
                                                        <?php endif; ?>
                                                    </tbody>
                                                </table>
                                             <div class="d-flex justify-content-center mt-3">
                                                <?php echo e($Student->links()); ?>

                                            </div>
                                                <?php if(count($Student) > 0): ?>

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
                                                                        <a class="btn btn-danger" href="<?php echo e(route('logout')); ?>"
                                                                            onclick="event.preventDefault(); document.getElementById('bus-delete-form').submit();">
                                                                            Yes,
                                                                            Delete It!
                                                                        </a>
                                                                        <button type="button" class="btn w-sm btn-light"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        
                                                                        <form id="bus-delete-form" method="POST" action="<?php echo e(route('student.delete')); ?>">
                                                                            <?php echo csrf_field(); ?>
                                                                            <?php echo method_field('DELETE'); ?>
                                                                            <input type="hidden" name="student_id" id="deleteid" value="">

                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end modal -->


                                                    <div class="modal fade zoomIn" id="requestModal" tabindex="-1" aria-hidden="true">
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
                                                                            <p class="text-muted mx-4 mb-0">Are you Sure You want to Send Payment Request To This Student
                                                                                 ?</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                                        <a class="btn btn-danger" href="<?php echo e(route('logout')); ?>"
                                                                            onclick="event.preventDefault(); document.getElementById('request-form').submit();">
                                                                            Yes,
                                                                            Send It!
                                                                        </a>
                                                                        <button type="button" class="btn w-sm btn-light"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        
                                                                        <form id="request-form" method="POST" action="<?php echo e(route('student.paymentRequest')); ?>">
                                                                            <?php echo csrf_field(); ?>
                                                                            <input type="hidden" name="student_request_id" id="requestid" value="">


                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end modal -->


                                                    <?php endif; ?>
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


<!-- Add Attendance Data  model-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
            const today = new Date().toISOString().split('T')[0];
    
    // Set the max attribute of the input
    document.getElementById('attendance_date').setAttribute('max', today);

        function requestData(id) {
            $("#requestid").val(id);
        }
        function myFunction() 
        {
            $('#search').removeAttr('value');
            $('#batch').val('');
        }

$('#attendanceForm').submit(function (e) {
    e.preventDefault();

    $.ajax({
        url: '<?php echo e(route("attendance.store")); ?>',
        method: 'POST',
        data: $(this).serialize(),
        success: function (response) {
            alert(response.message);
            $('#attendanceModal').modal('hide');
            location.reload();
        },
        error: function (xhr) {
            alert("Something went wrong");
        }
    });
});
    $(document).ready(function () {
        // Select all checkboxes
        $('#select-all').click(function () {
            $('.student-checkbox').prop('checked', this.checked);
        });

        // Mark selected students as attended
        $('#mark-attended').click(function () 
        {
            let attendance_date=$('#attendance_date').val();

            let selectedStudents = [];
            $('.student-checkbox:checked').each(function () {
                let studentId = $(this).val();
                let subscriptionId = $(this).data('subscription-id');

                selectedStudents.push({
                    student_id: studentId,
                    subscription_id: subscriptionId
                });
            });

            if (selectedStudents.length === 0) {
                alert('No students selected!');
                return;
            }


        if (confirm('Are you sure you want to mark the selected students as attended?')) 
        {
                $('section').addClass('blurred'); // Blur the page
                $('#loader-overlay').show();   
                $('#loader').show();   

            $.ajax({
                url: '<?php echo e(route("attendance.markAttended")); ?>',
                type: 'POST',
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    students: selectedStudents,
                    attendance_date: attendance_date

                },
                success: function (response) {
                    alert(response.message);
                    location.reload();
                },
                error: function (xhr) {
                    alert('Something went wrong!');
                },
                complete: function () {
                        // Hide loader after request completes (success or failure)
                        $('#loader-overlay').hide();
                        $('#loader').hide();
                        $('section').removeClass('blurred');
                }
            });
        }
        });

        $('#mark-absent').click(function () {
            let attendance_date=$('#attendance_date').val();

            let selectedStudents = [];
            $('.student-checkbox:checked').each(function () {
                let studentId = $(this).val();
                let subscriptionId = $(this).data('subscription-id');

                selectedStudents.push({
                    student_id: studentId,
                    subscription_id: subscriptionId,
                });
            });

            if (selectedStudents.length === 0) {
                alert('No students selected!');
                return;
            }

            if (confirm('Are you sure you want to mark the selected students as absent?')) {
                // Show loader before AJAX request
                $('section').addClass('blurred'); // Blur the page
                $('#loader-overlay').show();   
                $('#loader').show();   

                $.ajax({
                    url: '<?php echo e(route("attendance.markAbsent")); ?>',
                    type: 'POST',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        students: selectedStudents,
                        attendance_date: attendance_date

                    },
                    success: function (response) {
                        alert(response.message);
                        //location.reload();
                    },
                    error: function (xhr) {
                        alert('Something went wrong!');
                    },
                    complete: function () {
                        // Hide loader after request completes (success or failure)
                        $('#loader-overlay').hide();
                        $('#loader').hide();
                        $('section').removeClass('blurred');
                    }
                });
            }
        });


        /* $('#mark-absent').click(function () 
        {
            let selectedStudents = [];
            $('.student-checkbox:checked').each(function () {
                selectedStudents.push($(this).val());
            });

            if (selectedStudents.length === 0) {
                alert('No students selected!');
                return;
            }

          if (confirm('Are you sure you want to mark the selected students as absent?')) 
        {
            $.ajax({
                url: '<?php echo e(route("attendance.markAbsent")); ?>',
                type: 'POST',
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    student_ids: selectedStudents
                },
                success: function (response) {
                    alert(response.message);
                    location.reload();
                },
                error: function (xhr) {
                    alert('Something went wrong!');
                }
            });
        }
        });*/
    });
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/admin/student_attendance/index.blade.php ENDPATH**/ ?>