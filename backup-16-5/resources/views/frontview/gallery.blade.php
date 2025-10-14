@extends('layouts.front')
@section('content')
<!-- Start Page Banner -->
<div class="page-banner-area item-bg4">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-banner-content">
                    <h2>Gallery</h2>
                    <ul>
                        <li>
                            <a href="{{ route('FrontIndex') }}">Home</a>
                        </li>
                        <li>Gallery</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Banner -->
        <div class="gallery-area pt-100 pb-70">
            <div class="container">
                <div class="row">
                    @foreach($gallery as $g)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-gallery-box">
                            <img src="{{ asset($g->image ? 'Gallery/' . $g->image : 'images/noImage.png') }}" alt="image">
    
                            <a href="{{ asset($g->image ? 'Gallery/' . $g->image : 'images/noImage.png') }}" class="gallery-btn" data-imagelightbox="popup-btn">
                                <i class="bx bx-search-alt"></i>
                            </a>
                        </div>
                    </div>

                    @endforeach
                </div>

                <!-- <div class="view-btn">
                    <a href="#" class="default-btn">View More</a>
                </div> -->
            </div>
        </div>





@endsection