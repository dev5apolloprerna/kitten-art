@extends('layouts.front')

@section('content')

 <style type="text/css">
     .readonly {
    pointer-events: none; /* Prevent clicking */
    background-color: #f1f1f1; /* Light gray background */
    color: #666; /* Dim text color */
}

 </style>
 <body>
  <div class="loading" style="display:none"></div>
</body>
<!-- Start Page Banner -->

<div class="page-banner-area item-bg4">

    <div class="d-table">

        <div class="d-table-cell">

            <div class="container">

                <div class="page-banner-content">

                    <h2>Login</h2>

                    <ul>

                        <li>

                            <a href="{{route('FrontIndex')}}">Home</a>

                        </li>

                        <li>Login</li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- End Page Banner -->



<section class="login-area ptb-100">

            <div class="container">

                <div class="login-form">



                    <h2>Forgot Password</h2>

                    @include('common.alert')



                    <form action="{{route('forgotpasswordsubmit')}}" method="post" id="forgot_password">

                        @csrf



                        <div class="form-group">

                            <label>Email <span style="color:red">*</span></label>

                            <input type="text" class="form-control" name="email" id="email" placeholder="Enter Register Email" required>

                        </div>



                        <button type="submit">Send Mail</button>

                    </form>



                    <div class="important-text">

                        <p>Don't have an account? <a href="{{route('FrontRegistration')}}">Register now!</a></p>

                    </div>

                </div>

            </div>

        </section>
            <div id="loader-overlay"></div>
    <div id="loader">
        <div class="spinner"></div>
    </div>

@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script type="text/javascript">
    $("#forgot_password").validate({
        rules: {
            email: {
                required: true,
            }
        },
        messages: {
            email: {
                required:"Please Enter Email Address",
            }
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
            error.css("color", "red"); // Set error message color to red
        },
        submitHandler: function (form) {
            form.submit();
            $('section').addClass('blurred'); // Blur the page
            $('#loader-overlay').show();   // Show overlay
            $('#loader').show();           // Show spinner
            
            // Simulate processing delay
            setTimeout(() => {
                this.submit(); // Submit the form
            }, 2000);
        }
    });
</script>
@endsection