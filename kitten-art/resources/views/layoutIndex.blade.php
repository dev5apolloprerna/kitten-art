
{!! $layoutFile !!}

<script>
// Get the modal
var modal_share = document.getElementById("myModal_share");

// Get the button that opens the modal
var btn_share = document.getElementById("myBtn_share");

// Get the <span> element that closes the modal
var span_share = document.getElementsByClassName("close_share")[0];

// When the user clicks the button, open the modal 
btn_share.onclick = function() {
  modal_share.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span_share.onclick = function() {
  modal_share.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal_share) {
    modal_share.style.display = "none";
  }
}
</script>
<script>


function openModal() {
  document.getElementById("myModal").style.display = "block";
}

function closeModal() {
  document.getElementById("myModal").style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>
<script src="{{asset('front/js/jquery.min.js')}}"></script>
<script type="text/javascript">
function openShareModal(companyName)
{
  $('#shareModel').show();
 
}
function sendFeedbackData(id)
{
        var rating = $('#rating').val();
        var feedbackName = $('#feedbackName').val();
        var feedback = $('#feedback').val();
        var url = "{{route('front.feedback')}}";
        $.ajax({
          url : url,
          type : 'POST',
          //headers: {'x-csrf-token': _token},
          data : {rating: rating,feedbackName: feedbackName,feedback: feedback,id: id,"_token": "{{ csrf_token() }}"},
          success : function(data)
          {
            $('#rating').val("");
            $('#feedbackName').val("");
            $('#feedback').val("");
            window.location.href='';
          }
        });
        alert('Thanks for your feedback');
        return false;
        
}
    function sendEnquiryData(id,profileEmail){
   
    var enquiryName = $('#enquiryName').val();
    var phoneNumber = $('#phoneNumber').val();
    var email = $('#email').val();
    var message = $('#message').val();
    var url = "{{route('front.inquiry')}}";
    $.ajax({
      url : url,
      type : 'POST',
      data : {enquiryName: enquiryName,phoneNumber: phoneNumber,email: email,profileEmail: profileEmail,message: message,id: id,"_token": "{{ csrf_token() }}"},
      success : function(data)
      {
       
         $('#enquiryName').val("");
         $('#phoneNumber').val("");
         $('#email').val("");
         $('#message').val("");
         window.location.href='';
      }
    });
    alert('Inquiry Send Successfully');
    return false;
}

function onlyNumber(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)){
            return false;
        }
    return true;
}
</script>
