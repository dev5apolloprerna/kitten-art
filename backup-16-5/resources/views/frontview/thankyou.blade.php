@extends('layouts.front')
@section('content')

  
<section class="section">

<div class="container">
    <div class="row">
        <div class="col-lg-6" style="align-content: center;">
            <h3>

                <?php     $data = session('data'); ?>

                @if(isset($data['service_id']))
                Thank You For Your {{ $data['service_name'] }} Registration With Kitten Art Classes. </h3>
                <p>We will get back to you soon...</p>

                @else
            Thank You For Your Free Trial Class Registration With Kitten Art Classes. </h3>
            <p>We will get back to you soon...</p>
            @endif 
        </div>
        <div class="col-lg-6">
            <img src="{{ asset('front/assets/images/thankyou.png')}}" />
        </div>
    </div>
</div>

</section>

@endsection