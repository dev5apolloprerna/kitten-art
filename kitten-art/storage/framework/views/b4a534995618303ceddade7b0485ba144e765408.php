<?php $__env->startSection('content'); ?>

<!-- Start Page Banner -->

<div class="page-banner-area item-bg4">

    <div class="d-table">

        <div class="d-table-cell">

            <div class="container">

                <div class="page-banner-content">

                    <h2>Service - Detail</h2>

                    <ul>

                        <li>

                            <a href="<?php echo e(route('FrontIndex')); ?>">Home</a>

                        </li>

                        <li>Service - Detail</li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- End Page Banner -->



<section class="class-area bg-fdf6ed pt-100 pb-70">

      <div class="container">

        <div class="section-title">

          <span>Our Services</span>

          <h2><?php echo e($service->service_name); ?></h2>

        </div>

        <div class="row">

            <div class="col-lg-5">

                <img src="<?php echo e(asset($service->image ? 'Service/' . $service->image : 'images/noImage.png')); ?>" alt="image" width="750px">

            </div>

            <div class="col-lg-7">

                <div class="card single-class">

                    <div class="card-body class-content">

                       <h4> <?php echo e($service->service_name); ?> </h4>

                  

                        <ul class="class-list d-block">



                            <?php echo $service->description; ?><br>

                        </ul><br>
                        <?php if($service->serivce_id == 1): ?>
                        <a  href="#" id="registerButton" class="default-btn" data-bs-toggle="modal" data-bs-target="#eventRegister" style="border:none;">Register</a>
                        <?php else: ?>
                        <a  href="#" id="registerButton" class="default-btn" data-bs-toggle="modal" data-bs-target="#eventRegister" style="border:none;">Book Now</a>
                        <?php endif; ?>
                    </div>

                </div>

            </div>

        </div>

    </div>

    

                   

      <div class="gallery-area pt-100 pb-70">

            <div class="container">

                <div class="row">

                    <?php $__currentLoopData = $ServiceImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="col-lg-3 col-md-6">

                        <div class="single-gallery-box">

                            <img src="<?php echo e(asset($g->image ? 'Service/service_images/' . $g->image : 'images/noImage.png')); ?>" alt="image">

                            <a href="<?php echo e(asset($g->image ? 'Service/service_images/' . $g->image : 'images/noImage.png')); ?>" class="gallery-btn" data-imagelightbox="popup-btn">

                                <i class="bx bx-search-alt"></i>

                            </a>

                        </div>

                    </div>



                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>



                <!-- <div class="view-btn">

                    <a href="#" class="default-btn">View More</a>

                </div> -->

            </div>

        </div>



    </section>




<?php if($service->service_id != 2): ?>


<div class="modal" id="eventRegister">

  <div class="modal-dialog">

    <div class="modal-content">



      <!-- Modal Header -->

      <div class="modal-header">

        <h4 class="modal-title">Fill This Form For Service Registration</h4>

        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

      </div>



           <!-- Modal body -->

      <div class="modal-body">

            <form method="post" action="<?php echo e(route('ServiceRegisteration')); ?>" id="serviceForm">

            <?php echo csrf_field(); ?>

            <input type="hidden" name="service_id" value="<?php echo e($service->service_id); ?>">

            <div class="form-group py-2"><label>Student First Name <span style="color:red;">*</span></label>

                <input type="text"  name="student_first_name" id="student_first_name" minlength="3"  oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')"   value="<?php echo e(old('student_first_name')); ?>" class="form-control" required> 

            </div>           
             <div class="form-group py-2"><label>Student Last Name <span style="color:red;">*</span></label>

                <input type="text"  name="student_last_name" id="student_last_name" minlength="3"  oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')"   value="<?php echo e(old('student_last_name')); ?>" class="form-control" required> 

            </div>

            <div class="form-group py-2"><label>Student Age <span style="color:red;">*</span></label>

                <input type="text"  name="student_age" id="student_age"  value="<?php echo e(old('student_age')); ?>" class="form-control" required> 

            </div>

            <div class="form-group py-2"><label>Parent Name <span style="color:red;">*</span></label>

                <input type="text"  name="parent_name" minlength="3"  oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')"  id="parent_name" value="<?php echo e(old('parent_name')); ?>"  class="form-control" required> 

            </div>



            <div class="form-group py-2"><label>Mobile <span style="color:red;">*</span></label>

                <input type="text"  name="mobile" id="mobile" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" minlength="5" maxlength="10"  value="<?php echo e(old('mobile')); ?>" class="form-control" required> 

            </div>



            <div class="form-group py-2"><label>Email <span style="color:red;">*</span></label>

                <input type="text"  name="email" id="email" value="<?php echo e(old('email')); ?>"  class="form-control" required> 

            </div>
            </div>              

            <div class="modal-footer">

                <button type="submit" class="btn btn-danger"> Submit Now </button> 

              </div>

            </form>

      </div>

    </div>

  </div>

</div>
<?php else: ?>


<div class="modal" id="eventRegister">

  <div class="modal-dialog">

    <div class="modal-content">



      <!-- Modal Header -->

      <div class="modal-header">

        <h4 class="modal-title">Fill This Form For Service Registration</h4>

        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

      </div>
           <!-- Modal body -->

      <div class="modal-body">

            <form method="post" action="<?php echo e(route('ServiceRegisteration')); ?>" id="serviceForm">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="service_id" value="<?php echo e($service->service_id); ?>">

            <div class="form-group py-2"><label> Name <span style="color:red;">*</span></label>

                <input type="text"  name="Name" id="Name" minlength="3"  oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')"   value="<?php echo e(old('Name')); ?>" class="form-control" required> 
            </div>           
            <div class="form-group py-2"><label>Phone Number <span style="color:red;">*</span></label>
                <input type="text"  name="mobile" id="mobile" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" minlength="5" maxlength="10"  value="<?php echo e(old('mobile')); ?>" class="form-control" required> 
            </div>

            <div class="form-group py-2"><label>Email <span style="color:red;">*</span></label>
                <input type="text"  name="email" id="email" value="<?php echo e(old('email')); ?>"  class="form-control" required> 

            </div>
            <div class="form-group py-2"><label>Event Date <span style="color:red;">*</span></label>
                <input type="date"  name="event_date" id="event_date"  value="<?php echo e(old('event_date')); ?>" class="form-control" required> 
            </div>
            <div class="form-group py-2"><label>Event Time <span style="color:red;">*</span></label>
                <input type="time"  name="event_time" id="event_time"  value="<?php echo e(old('event_time')); ?>" class="form-control" required> 
            </div>
            <div class="form-group py-2"><label>Event Location <span style="color:red;">*</span></label>
                <textarea type="text"  name="event_location" id="event_location"  class="form-control" required><?php echo e(old('event_location')); ?></textarea> 
            </div>
            <div class="form-group py-2"><label>Occasion <span style="color:red;">*</span></label>
                <input type="text"  name="occasion" id="occasion"  value="<?php echo e(old('occasion')); ?>" class="form-control" required> 
            </div>
            <div class="form-group py-2"><label>Estimated No of Painters <span style="color:red;">*</span></label>
                <input type="text"  name="painters" id="painters"  value="<?php echo e(old('painters')); ?>" class="form-control"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required> 
            </div>
            <div class="form-group py-2"><label>Ask Questions <span style="color:red;">*</span></label>
                <textarea type="text"  name="question" id="question"  class="form-control" required><?php echo e(old('question')); ?></textarea> 
            </div>
            </div>              

            <div class="modal-footer">

                <button type="submit" class="btn btn-danger"> Submit Now </button> 

              </div>

            </form>

      </div>

    </div>

  </div>

</div>
<?php endif; ?>
    <div id="loader-overlay"></div>
    <div id="loader">
        <div class="spinner"></div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>


<script>

    $(".btn-refresh").click(function(){



  $.ajax({



     type:'GET',



     url:'../refresh_captcha',



     success:function(data){



        $(".captcha span").html(data.captcha);



     }



  });



});



$(document).ready(function() 
    {
     $("#serviceForm").validate({
          rules: {
            Name: {
                required: true,
                minlength: 3,
                maxlength: 50
            },
            mobile: {
                required: true,
            },email: {
                required: true,
            },event_date: {
                required: true,
            },event_time: {
                required: true,
            },event_location: {
                required: true,
            },occasion : {
                required: true,
            },painters : {
                required: true,
            },question : {
                required: true,
            }
        },
        messages: {
            Name: {
                required: "Please Enter Name",
                minlength: "Name must be at least 3 characters long",
                maxlength: "Name cannot be more than 50 characters"
            },mobile: {
                required:"Please Enter Mobile No",
            },email: {
                required:"Please Enter Email Address",
            },event_date: {
                required:"Please Enter Event Date",
            },event_time: {
                required:"Please Enter Event Time",
            },event_location: {
                required:"Please Enter Event Location",
            },occasion: {
                required:"Please Enter Occasion",
            },painters: {
                required:"Please Enter No of painters",
            },question: {
                required:"Please Enter Question",
            }
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
            
            // Simulate processing delay
            setTimeout(() => {
                this.submit(); // Submit the form
            }, 2000);
        }
    });
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/frontview/service_details.blade.php ENDPATH**/ ?>