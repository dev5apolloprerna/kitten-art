@extends('layouts.front')
@section('content')
<!-- Start Page Banner -->
<div class="page-banner-area item-bg4">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-banner-content">
                    <h2>About us</h2>
                    <ul>
                        <li>
                            <a href="{{route('FrontIndex')}}">Home</a>
                        </li>
                        <li>About us</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Banner -->

<!-- Start Teacher Details Area -->
<section class="teacher-details-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 mx-auto">
                <div class="teacher-details-desc row">
                    <div class="teacher-desc-image col-lg-6 ">
                        <img src="{{asset('front/assets/images/manushi.jpeg')}}" alt="image">
                    </div>

                    <div class="teacher-desc-content  col-lg-6 ">
                        <h3>Welcome to Manushi&#39;s Artistic World</h3>
                        <p>Hello and welcome! I&#39;m Manushi Shah, an artist driven by my own passion. Through my
                            work, I strive to share my art skills and knowledge to others. Ever since I was young,
                            I&#39;ve been fascinated by my mother. My journey as an artist has taken me through
                            various mediums and styles, each shaping my perspective and approach to creation.
                            My inspiration stems from my mother. My mother was a henna artist and she inspired
                            me to learn art since my childhood.</p>




                    </div>

                    <div class="teacher-desc-content  col-lg-12 ">

                        <h3>My Skills</h3>
                        <p> I find beauty in teaching art to kids. My artistic style
                            is characterized by sketching, drawing, pencil shading and other mediums like oil
                            pastels, watercolor, color pencils, acrylics etc. I enjoy experimenting with new art
                            mediums like brush pens, watercolor pencils, and alcohol-based markers. For me, art is
                            a creativity which comes from the heart &amp; imagination. I believe that art is a skill
                            that you
                            can learn &amp; develop by practice.</p>
                        <p>&nbsp;</p>
                        <p>I&#39;d love to hear from you! Feel free to reach out to me through my website or via phone
                            @ 980-254-5836. Please do follow me on Instagram and Facebook. Let&#39;s connect and
                            share our passion for art!</p>
                    </div>
                </div>
            </div>

            <!-- <div class="col-lg-4 col-md-12">
                <div class="teacher-details-information">
                    <h3>Profile Details</h3>

                    <ul>
                        <li>
                            <span>Name:</span>
                            Manushi Shah
                        </li>
                        <li>
                            <span>Phone:</span>
                            <a href="tel:9802545836">980-254-5836</a>
                        </li>
                        <li>
                            <span>Email:</span>
                            <a href="mailto:kittenart15@gmail.com">kittenart15@gmail.com</a>
                        </li>
                        <li>
                            <span>Address:</span>

                            9308, Kitchin Farms Way, Wake Forest, 27587.
                        </li>

                        <li>
                            <span>Experience:</span>
                            10 Years
                        </li>
                        <li>
                            <span>Social Media:</span>

                            <a href="#"><i class="bx bxl-facebook"></i></a>
                            <a href="#"><i class="bx bxl-twitter"></i></a>
                            <a href="#"><i class="bx bxl-linkedin"></i></a>
                            <a href="#"><i class="bx bxl-instagram"></i></a>
                        </li>
                    </ul>
                </div>
            </div> -->
        </div>
    </div>
</section>
<!-- End Teacher Details Area -->

    @if(sizeof($gallery) != 0)

    <section class="teacher-area bg-ffffff pt-100 pb-70">
      <div class="container-fluid">
        <div class="section-title">
          <span>My Portfolio</span>
          <h2>My Art Creations</h2>
        </div>
        <div class="gallery-slides owl-carousel owl-theme">
          
          @foreach($gallery as $g)
          <div class="single-teacher">
            <div class="image">
              <img src="{{ asset('Gallery/') . '/' . $g->image }}" alt="image">
            </div>
          </div>
          @endforeach

        </div>
      </div>
      </div>
    </section>
    
@endif


@endsection