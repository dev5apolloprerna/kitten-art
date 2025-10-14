<?php $__env->startSection('title', 'Student Attendance List'); ?>

<?php $__env->startSection('content'); ?>


<style>
    .myclass 
{
    text-transform:capitalize;
}

</style>
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

                            <div id="message-container" style="display: none; padding: 10px; margin-bottom: 10px;"></div>

                            <div class="card-body">

                                <form method="post" action="<?php echo e(route('report.attendance_report')); ?>" >

                                    <?php echo csrf_field(); ?>

                                     <div class="row"> 

                                        <div class="col-md-4"> 

                                            <div class="form-group">

                                                <label for="name">Search By Batch Name</label>

                                                <select name="batch" id="batch" class="form-control"  required> 

                                                    <option value="">Select Batch</option>

                                                    <?php $__currentLoopData = $batchdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <option value="<?php echo e($b->batch_id); ?>" <?php echo e($b->batch_id == $batch ? 'selected' : ''); ?>><?php echo e($b->batch_name); ?></option>

                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                </select>   



                                            </div>

                                        </div>

                                        <div class="col-md-4">

                                            <div class="form-group">
                                            <label for="name">Search By Date </label>
                                            <input type="date" name="search" id="date" class="form-control" value="<?php echo e($search ?? ''); ?>" required>
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

                             <div class="row" id="attendance_data">
                                <div class="col-lg-12">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class=" table table-bordered table-striped table-hover datatable">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th width="50"> Sr No </th>
                                                            <th> Student Name </th>  
                                                            <th> Student Age </th>  
                                                            <th> Age Group </th>  
                                                            <th> Plan Name </th>  
                                                            <th> Batch Name </th>  
                                                            <th> Total Session </th>  
                                                            <th> Used Session </th>  
                                                            <th> Available Session </th>  
                                                            <th> Date </th>  
                                                            <th> Status </th>  
                                                            <th> Action </th>  
                                                        </tr>

                                                    </thead>

                                                    <tbody>
                                                    
                                                     <?php if(count($Student) > 0): ?>

                                                    <?php $i = 1;
                                                     
                                                    ?>

                                                        <?php $__currentLoopData = $Student; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                         

                                                            <tr data-entry-id="<?php echo e($sdata->student_id); ?>" class="text-center">
                                                                <td>
                                                                    <?php echo e($i + $Student->perPage() * ($Student->currentPage() - 1)); ?>

                                                                </td>
                                                                <td>
                                                                <?php echo e($sdata->student_first_name ?? ''); ?> <?php echo e($sdata->student_last_name ?? ''); ?>

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
                                                                    <?php echo e($sdata->batchName ?? '-'); ?>

                                                                </td>
                                                                <td>
                                                                    <?php echo e($sdata->total_session ?? '0'); ?>

                                                                </td>
                                                                <td>
                                                                    <a href="javascript:void(0);" 
                                                                       class="view-attendance" 
                                                                       data-student-id="<?php echo e($sdata->student_id); ?>" 
                                                                       data-batch-id="<?php echo e($sdata->batch_id); ?>"
                                                                       data-subscription-id="<?php echo e($sdata->subscription_id); ?>"
                                                                       >
                                                                       <?php echo e($sdata->debit_balance ?? '-'); ?>

                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <?php echo e($sdata->total_session - $sdata->debit_balance ?? '-'); ?>

                                                                </td>
                                                                <td>
                                                                    <?php echo e(date('d-m-Y',strtotime($sdata->attendance_date)) ?? '-'); ?>

                                                                </td>
                                                                <td>
                                                                    <?php echo e($sdata->attendance); ?>

                                                                </td>
                                                                <td>
                                                                    <?php if($sdata->status == 1): ?>
                                                                    <a  title="Change Attendance Status" href="#"  data-bs-toggle="modal"data-bs-target="#attendanceReportModal_<?php echo e($sdata->attendence_id); ?>" class="mx-2">
                                                                        <i class="fas fa-edit"></i> <!-- Edit Icon -->
                                                                    </a>
                                                                    <?php endif; ?>
                                                                </td>
                                                        </tr>

 <div class="modal fade flip" id="attendanceReportModal_<?php echo e($sdata->attendence_id); ?>" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-light p-3">
                        <h5 class="modal-title" id="reportModalLabel">Edit Attendance</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="close-modal"></button>
                    </div>
                    <form method="POST" action="<?php echo e(route('report.editAttendance')); ?>" autocomplete="off"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="attendence_id" id="attendence_id" value="<?php echo e($sdata->attendence_id); ?>">
                        <input type="hidden" name="subscription_id" id="subscription_id" value="<?php echo e($sdata->subscription_id); ?>">
                        <input type="hidden" name="searchh"  class="form-control" value="<?php echo e($search ?? ''); ?>" required>
                        <input type="hidden" name="batchh"  value="<?php echo e($batch); ?>">
                        <div class="modal-body">
                            <div class="mb-5">
                                 <div class="mt-2 text-center">
                                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                        <h4>Are you Sure ?</h4>
                                        <p class="text-muted mx-4 mb-0">
                                             You want to Update Attendance From 
                                            <?php if($sdata->attendance == 'P'): ?> 
                                        <input type="hidden" name="status" value="A">

                                            <h5><?php echo e('Present To Absent'); ?> ?</h5>

                                            <?php elseif($sdata->attendance == 'A'): ?> 
                                           <h5> <?php echo e('Absent To Present'); ?> ?
                                        <input type="hidden" name="status" value="P">

                                           </h5>
                                            <?php endif; ?> </p>
                                    </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="submit" name="submit"  value="yes" class="btn btn-primary mx-2" id="button_1">Update</button>
                                <button type="button" class="btn btn-primary mx-2"
                                    data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

                                                        <?php $i++; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php else: ?>
                                                         <tr>
                                                            <td colspan="9">
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

                                            <!--end modal -->
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

<!-- Attendance Dates Modal -->
<div class="modal fade" id="attendanceModal" tabindex="-1" aria-labelledby="attendanceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="attendanceModalLabel"><span id="student_name" class="myclass" style="Color:red;"></span>&nbsp;  Attendance Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <thead>
            <tr>
<!--               <th>Batch Name</th>
              <th>Day</th> -->
              <th>Attendance</th>
              <th>Attendance Date</th>
            </tr>
          </thead>
          <tbody id="attendanceTableBody">
            <!-- Data will be appended here by jQuery -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <script>
        $(document).on('click', '.view-attendance', function () {
    var studentId = $(this).data('student-id');
    var batchId = $(this).data('batch-id');
    var subscriptionId = $(this).data('subscription-id');

    $.ajax({
        url: "<?php echo e(route('report.get-attendance-dates')); ?>",
        type: 'GET',
        data: {
            student_id: studentId,
            batch_id: batchId,
            subscription_id:subscriptionId
        },
        success: function (response) {
            let html = '';

            if (response.length > 0) {
                response.forEach(function (item) {
                    $('#student_name').text(item.student_first_name + ' '+ item.student_last_name);
                    html += '<tr>' +
                        '<td>' + item.attendance + '</td>' +
                        '<td>' + item.attendance_date + '</td>' +
                        '</tr>';
                });
            } else {
                html = '<tr><td colspan="4" class="text-center">No attendance records found.</td></tr>';
            }

            $('#attendanceTableBody').html(html);
            $('#attendanceModal').modal('show');
        }
    });
});

        function deleteData(id) {

            $("#deleteid").val(id);

        }

        function myFunction() 

        {

            $('#date').val('');

            $('#batch').val('');

        }

/*$('#myForm').on('submit', function(e) 
    {
            e.preventDefault();

            let date = $('#date').val();
            let batch = $('#batch').val();


    let messageContainer = $('#message-container');
    messageContainer.hide();

            $.ajax({
                url: 'ajax_attendance_report',
                type: 'POST',
                data: {
                    date: date,
                    batch: batch,
                    _token: '<?php echo e(csrf_token()); ?>' // Include CSRF token
                },
                success: function(response) 
                {                    
                    $('#attendance_data').html(response);
                        //messageContainer.hide(); // Hide the message on successful response

                },
                error: function (xhr) {
            let errorMessages = '<ul>';
            if (xhr.status === 422) { // Laravel validation error
                let errors = xhr.responseJSON.errors;
                $.each(errors, function (key, value) {
                    errorMessages += `<li>${value[0]}</li>`;
                });
                errorMessages += '</ul>';
                messageContainer.html(errorMessages)
                    .css({ 'color': 'red', 'background': '#ffdddd', 'border': '1px solid red' })
                    .fadeIn();
            } else {
                messageContainer.html('Error: ' + xhr.responseText)
                    .css({ 'color': 'red', 'background': '#ffdddd', 'border': '1px solid red' })
                    .fadeIn();
            }
        }
            });
    });

$(document).ready(function() {
  $("#button_1").click(function(e) {

 });
    });*/
    </script>



<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/admin/report/attendance_report.blade.php ENDPATH**/ ?>