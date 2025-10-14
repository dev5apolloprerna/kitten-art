@extends('layouts.front')
@section('content')
<!-- Start Page Banner -->
<div class="page-banner-area item-bg4">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-banner-content">
                    <h2>Events</h2>
                    <ul>
                        <li>
                            <a href="{{route('FrontIndex')}}">Home</a>
                        </li>
                        <li>Events</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Banner -->
<section class="event-area bg-ffffff pt-100 pb-70">
            <div class="container">
                <div class="section-title">
                    <span>Events</span>
                    <!-- <h2>Summer Camps</h2> -->
                </div>

                @foreach($events as $e)
                <div class="event-box-item">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <div class="event-image">
                                <a href="{{ asset('Events/') . '/' . $e->image }}"><img src="{{ asset('Events/') . '/' . $e->image }}" alt="image"></a>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="event-content">
                                <h2>
                                    <a href="{{route('FrontEventsDetail',$e->event_id)}}">
                                    {{$e->categoryName}}</a>
                                </h2>
                                <h3>
                                    <a href="{{route('FrontEventsDetail',$e->event_id)}}">
                                    {{$e->event_name}}</a>
                                </h3>
                                <ul class="event-list">
                                    <li>
                                        <i class="bx bx-time"></i>
                                        {{date('h:i a',strtotime($e->from_time)) }} - {{date('h:i a',strtotime($e->to_time)) ?? '-' }}
                                    </li>
                                    <li>
                                        <i class="bx bxs-map"></i>
                                        {{ $e->location }}
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="event-date">
                                <h4>{{date('d',strtotime($e->from_date)) }}</h4>
                                <span>{{date('F',strtotime($e->from_date)) }}</span>
                            </div>
                            <div class="class-btn" style="float: right;padding: 10px 70px;">
                                   <a href="{{route('FrontEventsDetail',$e->event_id)}}" class="default-btn btn" style="border:none;"> Details</a>
                               </div>

                        </div>
                    </div>
                </div>

               @endforeach
            </div>
        </section>





@endsection