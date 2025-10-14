@extends('layouts.front')
@section('content')
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
                            <a href="{{route('FrontIndex')}}">Home</a>
                        </li>
                        <li>Batch-Calender</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Banner -->
@include('common.alert')

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


@endsection


@section('scripts')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <script>
document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    // Initialize the calendar
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        initialDate: '{{ now()->toDateString() }}', // Ensure the calendar starts with today's date
        events: [
            @foreach ($events as $event)
            {
                title:'{{ $event->title }}', // Event title
                daysOfWeek: [{{ $event->dayOfWeek }}], // Recurring on this day of the week (0 = Sunday, 6 = Saturday)
                startRecur: '{{ now()->startOfMonth()->toDateString() }}', // Start of recurrence
                endRecur: '{{ now()->endOfMonth()->toDateString() }}', // End of recurrence
                extendedProps: {
                    batchName: '{{ $event->title }}',
                    category: '{{ $event->categoryName }}', // Example of additional info
                    description: '{{ $event->batch_from_time }}- {{ $event->batch_to_time }}', // Pass dynamic descriptions
                },
            },
            @endforeach
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


@endsection