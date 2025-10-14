@extends('layouts.front')
@section('content')
<!-- Start Page Banner -->
<div class="page-banner-area item-bg4">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-banner-content">
                    <h2>Class - Detail</h2>
                    <ul>
                        <li>
                            <a href="{{route('FrontIndex')}}">Home</a>
                        </li>
                        <li>Class - Detail</li>
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
          <span>Art Classes</span>
          <h2>Age: {{ $plan->categoryName }}</h2>
        </div>
        <div class="row">
            <div class="col-lg-5">
                <img src="{{ asset('plan_image') . '/' . $plan->plan_image}}" alt="image">
            </div>
            <div class="col-lg-7">
            <div class="card single-class">
                
                <div class="card-body class-content">
                   <h4> {{ $plan->plan_name }} (Age: {{ $plan->categoryName }})</h4>
              
                <ul class="class-list d-block">
                  <li> <span>Batch Name: </span> {{ $plan->batchname }} </li><br>
                   
                  <li><span>Time: </span>  {{date('h:i a',strtotime($plan->batch_from_time)) }} - {{date('h:i a',strtotime($plan->batch_to_time)) ?? '-' }}
                  </li><br>
                   <li><span>Amount: </span>  {{ $plan->plan_amount }}
                  </li><br>
                  <li>
                    <span>Sessions:</span> {{ $plan->plan_session }}
                  </li><br>
                    <li> <span>Description:</span>
                    
                    {!! $plan->plan_description !!}<br><br>
                    </li>
                    @if($plan->detail_description )
                    <li> <span>Detail Description:</span>
                    
                    {!! $plan->detail_description ?? '-' !!}<br><br>
                    </li>
                    @endif
                    </ul>
                      <form method="post" action="{{route('FrontRegistration')}}">
                    @csrf
                      <input type="hidden" name="category_id" value="{{$plan->category_id}}">
                      <input type="hidden" name="plan_id" value="{{$plan->planId}}"> 
                      <input type="hidden" name="batch_id" value="{{$plan->batch_id}}"> 
                  <button  type="submit" class="default-btn" style="border:none;">Join Class</button>
                 
                  </form>
                </div>
               
            </div>
            </div>
            
        </div>
        
      </div>
    </section>





@endsection