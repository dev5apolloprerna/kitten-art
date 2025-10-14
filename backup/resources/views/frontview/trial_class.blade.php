@extends('layouts.front')
@section('content')
<!-- Start Page Banner -->
<div class="page-banner-area item-bg4">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-banner-content">
                    <h2>Trial Class Registration</h2>
                    <ul>
                        <li>
                            <a href="{{route('FrontIndex')}}">Home</a>
                        </li>
                        <li>Trial Class Registration</li>
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
          <span>Trial Class Registration</span>
          <h2>Join us</h2>
        </div>
        <div class="row">
        
        </div>
        
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="">
              <img src="{{ asset('front/assets/images/register.jpg')}}" />
            </div>
          </div>
          <div class="col-lg-6">
            <div class="quote-item">
              <div class="content">
                <span>Join Us Now!</span>
                <h3>Register Now For Trial Class</h3>
              </div>
              <form method="post" action="{{ route('trialclass_registration') }}">
                @csrf
                
               <div class="form-group">
                  <input type="text" class="form-control" name="student_name" placeholder="Student Name*" maxlength="100" required>
                </div>
                 <div class="form-group">
                  <input type="number" class="form-control" name="student_age" placeholder="Kids Age*" max="99" min="0" oninput="if(this.value.length > 2) this.value = this.value.slice(0, 2);"  required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="parent_name" placeholder="Parents Name*"  maxlength="100"  required>
                </div>
                <div class="form-group">
                  <input type="tel" class="form-control" name="mobile" placeholder="Your Phone*" minlength="10" maxlength="20" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="email" placeholder="Email Address*" maxlength="150"  required>
                </div>
                <div class="form-group">
                 <select class="form-control" aria-label="Default select Class" name="category_id" id="category_id" required>
                    <option value="">Select Class *</option>
                    @foreach($category as $c)
                        <option value="{{ $c->category_id }}">{{ $c->category_name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                 <select class="form-control" aria-label="Default select Class" name="plan_id" id="plan_id" required>
                    <option value="">Select Plan *</option>
                  </select>
                </div>

                <div class="form-group">
                 <select class="form-control" aria-label="Default select Class" name="batch_id" id="batch_id" required>
                    <option value="">Select Batch *</option>
                  </select>
                </div>
                <div class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">

                      <label for="password" class="col-md-4 control-label">Captcha</label>



                      <div class="col-md-6">

                          <div class="captcha">

                          <span>{!! captcha_img() !!}</span>

                          <button type="button" class="btn btn-success btn-refresh"><i class="fa fa-refresh"></i></button>

                          </div>

                          <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">



                          @if ($errors->has('captcha'))

                              <span class="help-block">

                                  <strong>{{ $errors->first('captcha') }}</strong>

                              </span>

                          @endif

                      </div>

                  </div>
                <button type="submit" class="default-btn"> Submit Now </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    
      </div>
    </section>
@endsection

@section('scripts')
<script>
$(".btn-refresh").click(function(){

  $.ajax({

     type:'GET',

     url:'./refresh_captcha',

     success:function(data){

        $(".captcha span").html(data.captcha);

     }

  });

});

  document.querySelector('input[name="student_age"]').addEventListener('input', function (e) {
    if (this.value < 0) {
      this.value = 0;
    }
  });

    $(document).ready(function() {
            $('#category_id').change(function() {
                var categoryid = $(this).val();
                if(categoryid) 
                {
                    $.ajax({
                        url: './get-batch/' + categoryid,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('#batch_id').empty();
                            $('#batch_id').append('<option value="">Select Batch</option>');
                            $.each(data, function(key, value) {
                            const weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                             $('#batch_id').append('<option value="'+ value.batch_id +'">'+ value.batch_name +'</option>');
                            //$('#batch_id').append('<option value="' + value.batch_id + '">'+ value.batch_name + ' (' + value.batch_from_time + ' to ' + value.batch_to_time + ' - ' + weekdays[value.batch_day - 1] + ')</option>');
                            });
                        }
                    });


                    $.ajax({
                        url: './get-plan/' + categoryid,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('#plan_id').empty();
                            $('#plan_id').append('<option value="">Select Plan</option>');
                            $.each(data, function(key, value) {
                                $('#plan_id').append('<option value="'+ value.planId +'">'+ value.plan_name +'</option>');
                            });
                        }
                    });
                } else {
                    $('#plan_id').empty();
                    $('#plan_id').append('<option value="">Select Batch</option>');
                }
            });
        });
</script>
@endsection