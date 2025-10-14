@extends('layouts.front')
@section('content')
<!-- Start Page Banner -->
<div class="page-banner-area item-bg4">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-banner-content">
                    <h2>Service</h2>
                    <ul>
                        <li>
                            <a href="{{route('FrontIndex')}}">Home</a>
                        </li>
                        <li>Service</li>
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
          <span>Service</span>
          <h2>Our Service</h2>
        </div>
        <div class="row">
        
        </div>
        <div class="row">
          @foreach($service as $data)
          <div class="col-lg-4 col-md-6">
            <div class="single-class">
              <div class="class-image">
                <a href="{{route('FrontServiceImages',$data->service_id)}}">
                  <img src="{{ asset('Service') . '/' . $data['image'] }}" alt="image">
                </a>
              </div>
              <div class="class-content">
                <h3>
                  <a href="#">{{ $data->service_name }} </a>
                </h3>

                <ul class="class-list"><li><h4>{{ $data->plan_name }}</h4></li></ul>
                <p>
                  {!! Str::limit($data->description, 200, '....') !!}
                </p>
                
                <div class="class-btn">
                       <a href="{{route('FrontServiceImages',$data->service_id)}}" class="default-btn btn" style="border:none;"> Details</a>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>





@endsection