<style>
/*.socialMedia_footer li a:hover {*/
/*  color: #0088c9 !important;*/
/*  background: #fff !important;*/
/*}*/
/*.socialMedia_footer{*/
/*    background: #166fe5;*/
/*    padding: 8px 12px;*/
/*    border-radius: 3px;*/
/*}*/
</style>
<footer id="footer" class="footer-area section-padding">
    <div class="container">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                    <h3 class="footer-titel">Keyword</h3>
                    <ul class="footer-link">
                        @php
                           $keywords = \App\Keyword::where(['istatus'=>1,'isDelete'=>0])->get();
                        @endphp
                        @foreach($keywords as $keyword)
                        <li>
                            <a href="#" title="{{ $keyword->strKeyword }}"><i class="fa fa-globe"></i>  {{ $keyword->strKeyword }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                    <h3 class="footer-titel">Helpdesk</h3>
                    <ul class="footer-link">
                        <li>
                            <a href="#"><i class="fa fa-envelope"></i> support@vbcadindia.com</a>
                        </li>
                    </ul>
                    <h3 class="footer-titel" style="padding: 10px 0 0 0;">Inquiry</h3>
                    <ul class="footer-link">
                        <li>
                            <a href="#"><i class="fa fa-envelope"></i> sales@vbcardindia.com</a>
                        </li>
                    </ul>
                    <h3 class="footer-titel">Phone</h3>
                    <ul class="footer-link">
                        <li>
                            <a href="#"><i class="fa fa-phone"></i> +91 98247 73136</a>
                        </li>
                    </ul>
                    <h3 class="footer-titel" style="padding: 10px 0 0 0;">Social Media</h3>
                    <ul class="footer-link">
                        <li>
                            <a class="socialMedia_footer" href="https://www.facebook.com/vbcardindia"  target="_blank"><i class="fa fa-facebook"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                    <h3 class="footer-titel">Address</h3>
                    <ul class="footer-link">
                        <li>
                            <a href="#"><i class="fa fa-map-marker"></i> Bhairavnath Cross Road, Maninagar, Ahemdabad.</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
                    <h3 class="footer-titel">Contact Us</h3>

                    <!--<form id="contactForm" novalidate="true">-->
                    <!--    <div class="row">-->

                    <!--        <div class="col-md-12">-->
                    <!--            <div class="form-group">-->
                    <!--                <input type="text" placeholder="Name" id="msg_subject" class="form-control" required="" data-error="Please enter your subject">-->
                    <!--                <div class="help-block with-errors"></div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--        <div class="col-md-12">-->
                    <!--            <div class="form-group">-->
                    <!--                <input type="text" placeholder="Mobile" id="msg_subject" class="form-control" required="" data-error="Please enter your subject">-->
                    <!--                <div class="help-block with-errors"></div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--        <div class="col-md-12">-->
                    <!--            <div class="form-group">-->
                    <!--                <textarea class="form-control" style="height: 82px;" id="message" placeholder="Your Message" rows="7" data-error="Write your message" required=""></textarea>-->
                    <!--                <div class="help-block with-errors"></div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--        <div class="col-md-12">-->

                    <!--            <div class="submit-button text-left">-->
                    <!--                <button class="btn btn-common disabled" id="form-submit" type="submit" style="pointer-events: all; cursor: pointer;">Send Message</button>-->
                    <!--                <div id="msgSubmit" class="h3 text-center hidden"></div>-->
                    <!--                <div class="clearfix"></div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</form>-->
                    <form id="contactForm" action="{{ route('front.getintouch') }}" method="post" novalidate="true">
                        @csrf
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Name *" id="name" name="name" class="form-control" required data-error="Please enter your Name">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Mobile *" onkeypress="return onlyNumber(event);" id="mobile" name="mobile" class="form-control" required data-error="Please enter your Mobile">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" style="height: 82px;" name="message" id="message" placeholder="Your Message *" rows="7" data-error="Write your message" required></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">

                                <div class="submit-button text-left">
                                    <button class="btn btn-common disabled" id="form-submit" type="submit" style="pointer-events: all; cursor: pointer;" onclick="validateGetinTouch();">Send Message</button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright-content">
                        <p>Copyright 2021 VB INDIA.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<a href="#" class="back-to-top">
    <i class="lni lni-arrow-up"></i>
</a>

<script data-cfasync="false" src="{{asset('front/js/email-decode.min.js')}}"></script>
<script src="{{asset('front/js/modernizr-3.5.0.min.js')}}" type="text/javascript"></script>
<script src="{{asset('front/js/jquery-3.5.1-min.js')}}" type="text/javascript"></script>
<script src="{{asset('front/js/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('front/js/bootstrap-4.5.0.min.js')}}" type="text/javascript"></script>
<script src="{{asset('front/js/owl.carousel.2.3.4.min.js')}}" type="text/javascript"></script>
<script src="{{asset('front/js/wow.js')}}" type="text/javascript"></script>
<script src="{{asset('front/js/main.js')}}" type="text/javascript"></script>
<script src="{{asset('front/js/form-validator.min.js')}}" type="text/javascript"></script>
<!--<script src="{{asset('front/js/contact-form-script.min.js')}}" type="text/javascript"></script>-->
<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js')}}" data-cf-settings="a7908079abbf435af98f34d8-|49" defer=""></script>
<script>
    function validateGetinTouch(){
        var name = $("#name").val();
        var mobile = $("#mobile").val();
        var message = $("#message").val();
        var flag = 0;
        if(name == '' || name == null){
            $("#name").focus();
            flag = 1;
            return false;
        }
        if(mobile == "" || mobile == null){
            $("#mobile").focus();
            flag = 1;
            return false();
        }
        if(message == '' || message == null){
            $("#message").focus();
            flag = 1;
            return false;
        }
        if(flag == 1){
            return false;
        } else {
            window.location.href="{{ route('front.getintouch') }}";
            return true;
        }
    }
    // function validateInquery(){
    //     var name = $("#name").val();
    //     var mobile = $("#mobile").val();
    //     var message = $("#message").val();
    //     var flag = 0;
    //     if(name == '' || name == null){
    //         $("#name").focus();
    //         flag = 1;
    //         return false;
    //     }
    //     if(mobile == "" || mobile == null){
    //         $("#mobile").focus();
    //         flag = 1;
    //         return false();
    //     }
    //     if(message == '' || message == null){
    //         $("#message").focus();
    //         flag = 1;
    //         return false;
    //     }
    //     if(flag == 1){
    //         return false;
    //     } else {
    //         return true;
    //     }
    // }
    function onlyNumber(evt) {
          var charCode = (evt.which) ? evt.which : event.keyCode
          if (charCode > 31 && (charCode < 48 || charCode > 57)){
                  return false;
              }
          return true;
      }
      // Get the modal
      var modal = document.getElementById("myModal");

      // Get the button that opens the modal
      var btn = document.getElementById("myBtn");

      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[0];

      // When the user clicks the button, open the modal
      btn.onclick = function () {
         modal.style.display = "block";
      }

      // When the user clicks on <span> (x), close the modal
      span.onclick = function () {
         modal.style.display = "none";
      }

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function (event) {
         if (event.target == modal) {
            modal.style.display = "none";
         }
      }
   </script>

   <script type="text/javascript">
      function shiftLeft() {
         const boxes = document.querySelectorAll(".box");
         const tmpNode = boxes[0];
         boxes[0].className = "box move-out-from-left";

         setTimeout(function () {
            if (boxes.length > 5) {
               tmpNode.classList.add("box--hide");
               boxes[5].className = "box move-to-position5-from-left";
            }
            boxes[1].className = "box move-to-position1-from-left";
            boxes[2].className = "box move-to-position2-from-left";
            boxes[3].className = "box move-to-position3-from-left";
            boxes[4].className = "box move-to-position4-from-left";
            boxes[0].remove();

            document.querySelector(".cards__container").appendChild(tmpNode);

         }, 500);

      }

      function shiftRight() {
         const boxes = document.querySelectorAll(".box");
         boxes[4].className = "box move-out-from-right";
         setTimeout(function () {
            const noOfCards = boxes.length;
            if (noOfCards > 4) {
               boxes[4].className = "box box--hide";
            }

            const tmpNode = boxes[noOfCards - 1];
            tmpNode.classList.remove("box--hide");
            boxes[noOfCards - 1].remove();
            let parentObj = document.querySelector(".cards__container");
            parentObj.insertBefore(tmpNode, parentObj.firstChild);
            tmpNode.className = "box move-to-position1-from-right";
            boxes[0].className = "box move-to-position2-from-right";
            boxes[1].className = "box move-to-position3-from-right";
            boxes[2].className = "box move-to-position4-from-right";
            boxes[3].className = "box move-to-position5-from-right";
         }, 500);

      }
    </script>
    <script>(function(w, d) { w.CollectId = "62567bc4840efa10b931dcdb"; var h = d.head || d.getElementsByTagName("head")[0]; var s = d.createElement("script"); s.setAttribute("type", "text/javascript"); s.async=true; s.setAttribute("src", "https://collectcdn.com/launcher.js"); h.appendChild(s); })(window, document);</script>ss
