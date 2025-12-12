
<?php $__env->startSection('content'); ?>
<?php 
  $id=session()->get('student_id');
?>

<!-- Start Page Banner -->
<div class="page-banner-area item-bg4">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-banner-content">
                    <h2>Batch-Calender</h2>
                    <ul>
                        <li>
                            <a href="<?php echo e(route('FrontIndex')); ?>">Home</a>
                        </li>
                        <li>Batch-Calender</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Banner -->
<?php echo $__env->make('common.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="class-area bg-fdf6ed pt-100 pb-70">
      <div class="container">
        <div class="section-title">
          <span>Calender</span>
          <h2>Batch - Calander</h2>
        </div>

         <div class="row">
            <div class="col-lg-12">
                <div id="calendar"></div>
            </div>
              </div>
          </div>
      </section>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <script>
document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    // Initialize the calendar
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        initialDate: '<?php echo e(now()->toDateString()); ?>', // Ensure the calendar starts with today's date
        events: [
            <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            {
                title:'<?php echo e($event->title); ?>', // Event title
                daysOfWeek: [<?php echo e($event->dayOfWeek); ?>], // Recurring on this day of the week (0 = Sunday, 6 = Saturday)
                startRecur: '<?php echo e(now()->startOfMonth()->toDateString()); ?>', // Start of recurrence
                endRecur: '<?php echo e(now()->endOfMonth()->toDateString()); ?>', // End of recurrence
                extendedProps: {
                    batchName: '<?php echo e($event->title); ?>',
                    category: '<?php echo e($event->categoryName); ?>', // Example of additional info
                    description: '<?php echo e($event->batch_from_time); ?>- <?php echo e($event->batch_to_time); ?>', // Pass dynamic descriptions
                },
            },
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ],
        eventMouseEnter: function (info) {
            // Create a tooltip element
            var tooltip = document.createElement('div');
            tooltip.className = 'tooltip-popup';
            tooltip.style.position = 'absolute';
            tooltip.style.zIndex = '1000';
            tooltip.style.background = '#fff';
            tooltip.style.border = '1px solid #ccc';
            tooltip.style.padding = '10px';
            tooltip.style.borderRadius = '4px';
            tooltip.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.2)';
            tooltip.innerHTML = `
                <strong>${info.event.extendedProps.batchName}</strong><br>
                Category: ${info.event.extendedProps.category}<br>
                Time: ${info.event.extendedProps.description}
            `;

            // Position the tooltip near the mouse
            document.body.appendChild(tooltip);

            document.addEventListener('mousemove', function moveTooltip(event) {
                tooltip.style.top = event.pageY + 10 + 'px';
                tooltip.style.left = event.pageX + 10 + 'px';
            });

            // Store the tooltip reference in the event object for later removal
            info.event.setProp('tooltipEl', tooltip);
        },
        eventMouseLeave: function (info) {
            // Remove the tooltip on mouse leave
            var tooltip = info.event.extendedProps.tooltipEl;
            if (tooltip) {
                tooltip.remove();
                info.event.setProp('tooltipEl', null);
            }
        },
    });

    // Render the calendar
    calendar.render();
});

    </script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/labtrade/public_html/kittenart/newkittenart/resources/views/frontview/event_calander.blade.php ENDPATH**/ ?>