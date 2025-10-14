@extends('layouts.front')
@section('content')
<!-- Start Page Banner -->
<div class="page-banner-area item-bg4">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-banner-content">
                    <h2>Classes</h2>
                    <ul>
                        <li>
                            <a href="{{route('FrontIndex')}}">Home</a>
                        </li>
                        <li>Classes</li>
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
          <span>Classes</span>
          <h2>Our Classes</h2>
        </div>
        <div class="row">
        <p class="text-center">
        Kitten art classes help kids to develop their motor skills, improve their confidence, develop more focus & improve memory. We have created weekly, unique art classes for kids ages 5-14 to keep your child entertained & creative. It will help them to keep away from screens. Kids will learn something new & innovative in our classes. <br><br>
        </p>
        </div>
        <div class="row">
          @foreach($plan as $data)
          <div class="col-lg-4 col-md-6">
            <div class="single-class">
              <div class="class-image">
                <a href="{{route('FrontClassDetail',$data->planId)}}">
                  <img src="{{ asset('plan_image') . '/' . $data['plan_image'] }}" alt="image">
                </a>
              </div>
              <div class="class-content">
                <div class="price">$ {{ $data->plan_amount }}  / {{ $data->plan_session }} session</div>
                <h3>
                  <a href="#">{{ $data->categoryName }} </a>
                </h3>

                <ul class="class-list"><li><h4>{{ $data->plan_name }}</h4></li></ul>
                <p>
                  {!! Str::limit($data->plan_description, 200, '....') !!}
                </p>
                
                <!-- {!! $data->plan_description !!}</p> -->
                <!--<ul class="class-list">-->
                <!--  <li> <span>Batch Name: </span>{{ $data->batchname }}</li>-->
                   
                <!--  <li><span>Time: </span>{{date('h:i a',strtotime($data->batch_from_time)) }} - {{date('h:i a',strtotime($data->batch_to_time)) ?? '-' }} -->
                <!--  </li><br>-->
                <!--  <li>-->
                <!--    <span>sessions:</span> {{ $data->plan_session }} -->
                <!--  </li>-->
                <!--</ul> -->
                <div class="class-btn">
                  <form method="post" action="{{route('FrontRegistration')}}">
                    @csrf
                      <input type="hidden" name="category_id" value="{{$data->category_id}}">
                      <input type="hidden" name="plan_id" value="{{$data->planId}}"> 
                      <input type="hidden" name="batch_id" value="{{$data->batch_id}}"> 
                       <a href="{{route('FrontClassDetail',$data->planId)}}" class="default-btn btn" style="border:none;"> Details</a>
                  <button  type="submit" class="default-btn" style="border:none;">Join Class</button>
                 
                  </form>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>





@endsection