<?php $__env->startSection('title', 'Service List'); ?>
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
                                <h5 class="card-title mb-0">Service List
                                    <a href="<?php echo e(route('service.create')); ?>" style="float: right;" class="btn btn-sm btn-primary">
                                        <i class="far fa-plus"></i> Add Service
                                    </a>

                                </h5>
                                
                            </div> 
                           <!--  <div class="card-body">
                                <form method="post" action="<?php echo e(route('service.index')); ?>" id="myForm">
                                    <?php echo csrf_field(); ?>
                                     <div class="row"> 
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="name">Search By Student Name </label>
                                                <input type="text" name="search" id="search" class="form-control" value="<?php echo e($search ?? ''); ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <div class="form-group">
                                            <input class="btn btn-primary" style="margin-top: 15%;" type="submit" value="<?php echo e('Search'); ?>">
                                            <input class="btn btn-primary" style="margin-top: 15%;" type="submit" onclick="myFunction()" value="<?php echo e('Reset'); ?>">

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
                                                        <tr class="text-center">
                                                            <th width="50"> Sr No </th>
                                                            <th> Service Name </th>  
                                                            <th> Image </th>  
                                                            <th> Action </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                     <?php if(count($Service) > 0): ?>
                                                    <?php $i = 1;
                                                    ?>
                                                        <?php $__currentLoopData = $Service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr data-entry-id="<?php echo e($sdata->service_id); ?>" class="text-center">
                                                                <td>
                                                                    <?php echo e($i + $Service->perPage() * ($Service->currentPage() - 1)); ?>

                                                                </td>
                                                                <td>
                                                                    <?php echo e($sdata->service_name ?? ''); ?>

                                                                </td>
                                                                 <td>
                                                                    <a target="_blank"  href="<?php echo e(asset($sdata->image ? 'Service/' . $sdata->image : 'images/noImage.png')); ?>">
                                                                    <img width="50" height="50" src="<?php echo e(asset($sdata->image ? 'Service/' . $sdata->image : 'images/noImage.png')); ?>"></a>
                                                                </td>
                                                                
                                                                <td>
                                                                    <div class="d-flex gap-2">
                                                                        <a class="" title="Edit" href="<?php echo e(route('service.edit', $sdata->service_id)); ?>">  <i class="far fa-edit"></i>
                                                                        </a>

                                                                        <a class="" href="#" data-bs-toggle="modal"
                                                                            title="Delete" data-bs-target="#deleteRecordModal"
                                                                            onclick="deleteData(<?= $sdata->service_id ?>);">
                                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                                        </a>

                                                                        <a class="" title="Add Images" href="<?php echo e(route('service.images', $sdata->service_id)); ?>">  <i class="far fa-plus"></i>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php $i++; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php else: ?>
                                                         <tr>
                                                            <td colspan="4">
                                                                <center>
                                                            No Data Found
                                                        </center>
                                                            <td>

                                                        </tr>
                                                        <?php endif; ?>
                                                    </tbody>
                                                </table>
                                             <div class="d-flex justify-content-center mt-3">
                                                <?php echo e($Service->links()); ?>

                                            </div>
                                                <?php if(count($Service) > 0): ?>

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
                                                                        
                                                                        <form id="bus-delete-form" method="POST" action="<?php echo e(route('service.delete')); ?>">
                                                                            <?php echo csrf_field(); ?>
                                                                            <?php echo method_field('DELETE'); ?>
                                                                            <input type="hidden" name="service_id" id="deleteid" value="">

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

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        function deleteData(id) {
            $("#deleteid").val(id);
        }
        function myFunction() 
        {
            $('#search').removeAttr('value');
        }
    </script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/admin/service/index.blade.php ENDPATH**/ ?>