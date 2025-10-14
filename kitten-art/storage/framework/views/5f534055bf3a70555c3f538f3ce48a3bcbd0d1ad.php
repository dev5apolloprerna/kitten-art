
<?php if(Session::has('success')): ?>
    <!-- Success Alert -->
    <div class="alert alert-primary alert-dismissible alert-solid alert-label-icon fade show" role="alert" id="success-alert">
        <i class="ri-user-smile-line label-icon"></i>
        <strong>Success !</strong> <?php echo e(session('success')); ?>

        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if(Session::has('error')): ?>
    <!-- Danger Alert -->
    <div class="alert alert-danger alert-dismissible alert-solid alert-label-icon fade show" role="alert" id="error-alert">
        <i class="ri-error-warning-line label-icon"></i>
        <strong>Error !</strong> <?php echo e(session('error')); ?>

        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <!-- `Warning Alert -->
    
<?php endif; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">

$(document).ready(function() 
{
    $("#success-alert").fadeTo(5000, 500).slideUp(500, function() {
      $("#success-alert").slideUp(500);
    });
  
    $("#error-alert").fadeTo(5000, 500).slideUp(500, function() {
      $("#error-alert").slideUp(500);
    });
  
});
    

</script>
<?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/common/alert.blade.php ENDPATH**/ ?>