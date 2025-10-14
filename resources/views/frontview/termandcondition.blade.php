@extends('layouts.front')
@section('content')
<style>
  .single-class .class-image img {
    transition: 0.5s;
    border-radius: 5px 5px 0 0;
    object-fit: cover;
    width: 100%;
    height: 250px;
}
</style>
<!-- Start Page Banner -->
<div class="page-banner-area item-bg4">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-banner-content">
                    <h2>Terms And Conditions</h2>
                    <ul>
                        <li>
                            <a href="{{route('FrontIndex')}}">Home</a>
                        </li>
                        <li>Terms And Conditions</li>
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
          <span>Terms And Conditions</span>
          <h2>Our {{ $data->name }}</h2>
        </div>
        <div class="row">
        <p class="text-center">
        {!! $data->description !!}
        </p>
        </div>
        </div>
      </div>
    </section>





@endsection