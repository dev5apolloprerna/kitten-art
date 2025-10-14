@extends('include')
@section('content')
@foreach($profile as $profiles)
<?php $companies = App\Company::where('isDelete', '=', 0)->where('id', '=', $profiles->iCompanyId)->get();
$strCompanyName = "";
?>

@foreach ($companies as $company)
<?php
$strCompanyName = $company->strName;
?>
@endforeach

<head>
   <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0 minimal-ui">
   <meta property="og:image" itemprop="image" content="https://vbcardindia.com/images/profile/{{$profiles->strImage}}" />
   <meta property="og:type" content="website" />
   <meta property="og:description" content="{{$profiles->strName}}  ({{$profiles->strDesignation}})" />
   <title>{{strtoupper($strCompanyName)}}</title>
   <link rel="manifest" id="manifest-placeholder">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Shadows+Into Light&amp;display=swap" media="all" id="shr-font-shadows-into light">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
   <link href="{{asset('front/layout1/css/t3-style.css')}}" rel="stylesheet">
   <link href="{{asset('front/layout1/css/star-rating.css')}}" rel="stylesheet">
   <link href="{{asset('front/layout1/fonts/stylesheet.css')}}" rel="stylesheet">
   <link rel="stylesheet" href="{{asset('front/layout1/css/intlTelInput.min.css')}}">
   <script async defer crossorigin="anonymous" src="{{asset('front/layout1/js/sdk.js#xfbml=1&version=v5.0')}}"></script>
</head>

<div class="page-wrapper" id="home-section">
   <div class="section-separator">
      <div></div>
   </div>
   <div class="upper">
      <div class="side-piller"></div>
      <div class="views-label"><i class="fas fa-eye"></i> Views: <b>{{ $profiles->iViewCoiunt }}</b></div>
      @if(Request::routeIs('front.index'))
      <?php
      $viewCount = $profiles->iViewCoiunt + 1;
      $UniqueUrl = $profiles->strUrlDisplayName;
      App\Profile::where('id', '=', $profiles->id)->where('strUrlDisplayName', '=', $UniqueUrl)->update(['iViewCoiunt' => $viewCount]);
      ?>
      @endif
      <div class="profile-info">
         <!-- User Profile Pic -->
         <img src="images/profile/{{$profiles->strImage}}" class="profile-pic-img">
         <!-- User Company Name -->
         <?php
         $pos = strpos($strCompanyName, '(');
         $companyName = nl2br(substr_replace($strCompanyName, "\r\n", $pos, 0));
         ?>
         <div class="firmname">{!!strtoupper($companyName)!!}</div>
         <div class="company-separator"></div>
         <!-- User First Name and Last Name -->
         <div class="name">{{$profiles->strName}}<span style="margin-top: 5px;display: block"><i style="font-size: 12px;">({{$profiles->strDesignation}})</i></span></div>
      </div>
   </div>
   <div class="contact-info-container">
      @if($profiles->iMobile != "")
      <div class="contact-info-wrapper">
         <a class="contact-piller-button call" target="_blank" href="tel:{{$profiles->iMobile}}">
            <i class="fas fa-phone fa-flip-horizontal"></i>
         </a>
         <div class="contact-info">
            <div style="margin-bottom: 5px;"><a target="_blank" href="tel:{{$profiles->iMobile}}">
                  @if( substr_count($profiles->iMobile, '+', 0) >0)
                  {{$profiles->iMobile}}
                  @else
                  +91{{$profiles->iMobile}}
                  @endif
               </a></div>
         </div>
      </div>
      @endif
      @if($profiles->strAddress != "")
      <div class="contact-info-wrapper">
         <a class="contact-piller-button address" href='https://www.google.com/maps/search/{{$profiles->strAddress}}' target="_blank">
            <i class="fas fa-map-marker-alt"></i>
         </a>
         <div class="contact-info">
            <a target="_blank" href='https://www.google.com/maps/search/{{$profiles->strAddress}}'>{{$profiles->strAddress}}</a>
         </div>
      </div>
      @endif
      @if($profiles->iWhatsAppNo != "" && substr_count($profiles->iWhatsAppNo, '+', 0) >0)
      <div class="contact-info-wrapper">
         <a class="contact-piller-button whatsapp" target="_blank" href="https://wa.me/{{$profiles->iWhatsAppNo}}?text=Got reference from your Digital vCard. Want to know more about your products and services.">
            <i class="fab fa-whatsapp"></i>
         </a>
         <div class="contact-info">
            <a target="_blank" href="https://wa.me/{{$profiles->iWhatsAppNo}}?text=Got reference from your Digital vCard. Want to know more about your products and services.">{{$profiles->iWhatsAppNo}}</a>
         </div>
      </div>
      @else
      <div class="contact-info-wrapper">
         <a class="contact-piller-button whatsapp" target="_blank" href="https://wa.me/91{{$profiles->iWhatsAppNo}}?text=Got reference from your Digital vCard. Want to know more about your products and services.">
            <i class="fab fa-whatsapp"></i>
         </a>
         <div class="contact-info">
            <a target="_blank" href="https://wa.me/91{{$profiles->iWhatsAppNo}}?text=Got reference from your Digital vCard. Want to know more about your products and services.">+91{{$profiles->iWhatsAppNo}}</a>
         </div>
      </div>
      @endif
      @if($profiles->strEmail != "")
      <div class="contact-info-wrapper">
         <a class="contact-piller-button mail" target="_blank" href="mailto:{{$profiles->strEmail}}">
            <i class="fas fa-envelope"></i>
         </a>
         <div class="contact-info">
            <a target="_blank" href="mailto:{{$profiles->strEmail}}">{{$profiles->strEmail}}</a>
         </div>
      </div>
      @endif
      @if($profiles->strWebsite != "")
      <div class="contact-info-wrapper">
         <a class="contact-piller-button website" target="_blank" href="{{$profiles->strWebsite}}">
            <i class="fas fa-globe"></i>
         </a>
         <div class="contact-info">
            <a target="_blank" href="{{$profiles->strWebsite}}">{{$profiles->strWebsite}}</a>
         </div>
      </div>
      @endif
   </div>
   <div class="lower">
      <div class="side-piller"></div>
      <div class="share-options">
         <div class="whatsapp-input">
            <div class="input-wrapper">
               <input type="tel" id="whatsapp-input" class="input" placeholder="Enter whatsapp number" oninput="this.value=this.value.replace(/[^0-9]/g,'');" />
            </div>
            <a class="whatsapp-button" target="_blank" href="javascript:;" onclick="handleWhatsappShare(this)">
               <i class="fab fa-whatsapp"></i>Share on Whatsapp
            </a>
         </div>
         <div class="p-10"></div>
         <div class="shadow-buttons">
            <a class="shadow-button" href="{{ route('front.visitingcard',$profiles->id)}}"><i class="fas fa-download shadow-button-icon"></i>Add to Phone Book</a>
            <a class="shadow-button" onclick="openShareModal(this, `{{ $strCompanyName }}`)"><i class="fas fa-share-alt shadow-button-icon"></i>Share</a>
            <a class="shadow-button save-card-button"><i class="fas fa-cloud-download-alt shadow-button-icon"></i>Save Card</a>
         </div>
         <div class="p-10"></div>
         <ul class="inprofile share-buttons">
            @if($profiles->strFacebook != "")
            <li class="share-button">
               <a target="_blank" href="{{$profiles->strFacebook}}"><i class="share-button-facebook fab fa-facebook-f"></i></a>
            </li>
            @endif
            @if($profiles->strTwitter != "")
            <li class="share-button">
               <a target="_blank" href="{{$profiles->strTwitter}}"><i class="share-button-twitter fab fa-twitter"></i></a>
            </li>
            @endif
            @if($profiles->strInsta != "")
            <li class="share-button">
               <a target="_blank" href="{{$profiles->strInsta}}"><i class="share-button-instagram fab fa-instagram"></i></a>
            </li>
            @endif
            @if($profiles->strYoutube != "")
            <li class="share-button">
               <a target="_blank" href="{{$profiles->strYoutube}}"><i class="share-button-youtube fab fa-youtube"></i></a>
            </li>
            @endif
            @if($profiles->strLinkedin != "")
            <li class="share-button">
               <a target="_blank" href="{{$profiles->strLinkedin}}"><i class="share-button-linkedin fab fa-linkedin-in"></i></a>
            </li>
            @endif
         </ul>
         <div class="p-20"></div>
      </div>
   </div>
</div>
<div class="section-container" id="about-us-section">
   <div class="section-separator">
      <div></div>
   </div>
   <h2 class="section-header">About Us</h2>
   <table class="about-us-table">
      <tbody>
         @if($strCompanyName != "")
         <tr>
            <td class="table-row-label">
               <h3 class="table-row-label-text">Company Name</h3>
               <b class="table-row-label-separator">:</b>
            <td>
            <td class="table-row-value">
               {{$strCompanyName}}
            <td>
         </tr>
         @endif
         @if($profiles->strNatureOfBusiness != "")
         <tr>
            <td class="table-row-label">
               <h3 class="table-row-label-text">Nature Of Business</h3>
               <b class="table-row-label-separator">:</b>
            <td>
            <td class="table-row-value">
               {{$profiles->strNatureOfBusiness}}
            <td>
         </tr>
         @endif
      </tbody>
   </table>
   @if($profiles->strAboutUs != "")
   <h3 class="speciality-label">Our Specialities</h3>
   <?php echo $profiles->strAboutUs ?>
   @endif
   <?php $document = App\Document::where('iProfileId', '=', $profiles->id)->where(['isDelete' => 0, 'iStatus' => 1])->get(); ?>
   @if(!$document->isEmpty())
   <h3 class="speciality-label">Documents</h3>

   @foreach($document as $documents)
   <a class="document-wrapper" href="/images/document/{{$profiles->iCompanyId}}/{{$documents->iProfileId}}/{{$documents->strPdf}}" download>
      <div class="pdf-icon"><i class="fa fa-file-pdf"></i></div>
      <div class="pdf-number">{{$documents->strName}}</div>
      <div class="download-icon"><i class="fa fa-download"></i></div>
   </a>
   @endforeach
   @endif
   @if($profiles->strOtherLink != "")
   <div class="other-links-wrapper">
      <h3 class="other-links-header">Other Links:</h3>
      <a class="other-links-link" href="{{$profiles->strOtherLink}}" target="_blank"><i class="fa fa-link"></i> {{$profiles->strOtherLink}}</a>
   </div>
   @endif
</div>
<?php
$type = '';
$service = App\Services::join('profile', 'profile.id', '=', 'services.iProfileId')
   ->select('services.*', 'profile.iType')
   ->where('services.iProfileId', '=', $profiles->id)
   ->where('services.isDelete', 0)
   ->where('services.iStatus', 1)
   ->get();
?>
@if(!$service->isEmpty())
<div class="section-container" id="products-services-section">
   <div class="section-separator">
      <div></div>
   </div>

   @foreach($service as $services)
   @if($services->iType == 2)
   @php $type = 'PRODUCTS'; @endphp
   @else
   @php $type = 'SERVICES'; @endphp
   @endif
   @endforeach
   <h2 class="section-header">{{$type}}</h2>

   <div class="p-10"></div>
   <div>
      @if(!$service->isEmpty())
      @foreach($service as $services)
      <div class="card">
         <h3 class="card-title">{{strtoupper($services->strName)}}</h3>
         <img onclick="openImageModal(this)" alt="{{$services->strName}}" src="images/services/{{$profiles->iCompanyId}}/{{$services->iProfileId}}/{{$services->strImage}}" style="width:100%;margin-bottom: 15px;">
         <p>{{$services->strDescription}}</p>
         <div class="product-enquiry-section">
            <div class="product-price">
            </div>
            <a href="https://wa.me/91{{ $profiles->iWhatsAppNo }}?text=Hi, I am interested in your product/service: {{$services->strName}}. Please provide more details." target="blank" class="product-enquiry-btn">Enquiry</a>
         </div>
      </div>
      @endforeach
      @endif

   </div>
   <div class="section-close"></div>
</div>
@endif
<?php $galleries = App\Gallery::where('iProfileId', '=', $profiles->id)->where(['isDelete' => 0, 'iStatus' => 1])->get(); ?>
@if(!$galleries->isEmpty())
<div class="section-container" id="gallery-section">
   <div class="section-separator">
      <div></div>
   </div>
   <h2 class="section-header">Gallery</h2>
   <div class="p-10"></div>
   <div class="f_gallery">
      <div class="row">
         <?php
         $counter = 1;
         foreach ($galleries as $key => $gallery) { ?>
            <div class="column">
               <img src="images/gallery/{{$profiles->iCompanyId}}/{{$gallery->iProfileId}}/{{ $gallery->strImage }}" style="width:100%" onclick="openModal();currentSlide(<?php echo $counter  ?>)" class="hover-shadow cursor">
            </div>
            <?php $counter++; ?>
         <?php } ?>

      </div>
      <div id="myModal" class="modal">
         <span class="close cursor" onclick="closeModal()">&times;</span>
         <div class="modal-content">
            <?php $iCounter = 1; ?>
            @foreach($galleries as $gallery)

            <div class="mySlides">
               <div class="numbertext">{{$iCounter}} / 4</div>
               <img src="images/gallery/{{$profiles->iCompanyId}}/{{$gallery->iProfileId}}/{{ $gallery->strImage }}" style="width:100%">
            </div>
            <?php $iCounter++; ?>
            @endforeach
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
            <div class="caption-container">
               <p id="caption"></p>
            </div>
         </div>
      </div>
   </div>
  
   <div class="section-close"></div>
</div>
@endif
<?php $video = App\Video::where('iProfileId', '=', $profiles->id)->where(['isDelete' => 0, 'iStatus' => 1])->get(); ?>
@if(!$video->isEmpty())
<div class="section-container" id="video-section">
   <div class="section-separator">
      <div></div>
   </div>
   <h2 class="section-header">Videos</h2>

   <div class="p-10"></div>
   <div>

      @foreach($video as $videos)
      <div class="card" style="padding: 10px">
         <iframe src="{{$videos->strUrl}}" frameborder="0" allowfullscreen style="width: 100%"></iframe>
      </div>
      @endforeach
   </div>
</div>
@endif
<div class="section-container" id="feedback-section">
   <div class="section-separator">
      <div></div>
   </div>
   <h2 class="section-header">Feedbacks</h2>
   <div class="feedback-list">
      <?php $feedbacks = App\Feedback::where('iProfileId', '=', $profiles->id)->where(['isDelete' => 0, 'iStatus' => 1])->orderBy('id', 'desc')->take(10)->get(); ?>
      @foreach($feedbacks as $feedback)
      <div class="feedback-wrapper">
         <span class="feedback-name-wrapper"><span class="feedback-name">{{ $feedback->strName }}</span> on {{ date('M d,Y', strtotime($feedback->created_at) ) }}</span>
         <div>

            <?php
            $rate = $feedback->iStarRate;
            for ($i = 1; $i <= $rate; $i++) { ?>
               <span class="gl-star-rating-stars s50">
                  <span data-value="{{ $i }}" data-text="<?php if ($rate == 1) {
                                                            echo "Terrible";
                                                         } elseif ($rate == 2) {
                                                            echo "Poor";
                                                         } elseif ($rate == 3) {
                                                            echo "Average";
                                                         } elseif ($rate == 4) {
                                                            echo "Very Good";
                                                         } else {
                                                            echo "Excellent";
                                                         } ?> "></span>
               </span>
            <?php }
            ?>

            <!-- <span data-value="1" data-text="Terrible"></span>
               <span data-value="2" data-text="Poor"></span>
               <span data-value="3" data-text="Average"></span>
               <span data-value="4" data-text="Very Good"></span>
               <span data-value="5" data-text="Excellent"></span> -->

         </div>
         <div>{{ $feedback->strFeedbackMessage }}</div>
         <hr />
      </div>
      @endforeach

   </div>
   <form class="feedback-form card" validate>
      <div class="feedback-form-heading">Give Feedback</div>
      <select class="star-rating" id="rating" name="rating" required="">
         <option value="">Select a rating</option>
         <option value="5">Excellent</option>
         <option value="4">Very Good</option>
         <option value="3">Average</option>
         <option value="2">Poor</option>
         <option value="1">Terrible</option>
      </select>
      <input type="text" name="feedbackName" id="feedbackName" placeholder="Enter Full Name" required="" />
      <textarea name="feedback" id="feedback" placeholder="Enter your feedback" required=""></textarea>
      <!-- Message:<br/> -->
      <input type="submit" value="Give Feedback" onclick="sendFeedbackData('{{ $profiles->id }}');" />
   </form>
</div>

<div class="section-container" id="enquiry-section">
   <div class="section-separator">
      <div></div>
   </div>
   <h2 class="section-header">Enquiry Form</h2>
   <form class="enquiry-form" novalidate>
      <!-- Full Name:<br/> -->
      <input type="text" name="enquiryName" required id="enquiryName" placeholder="Enter Full Name" /><br />
      <div class="flex">
         <div class="enquiry-phoneNumber">
            <!-- Phone Number:<br/> -->
            <input type="text" name="phoneNumber" onkeypress="return onlyNumber(event);" maxlength="10" required id="phoneNumber" placeholder="Enter Phone Number" /><br />
         </div>
         <div class="enquiry-email">
            <!-- Email:<br/> -->
            <input type="text" name="email" required id="email" placeholder="Enter Email" /><br />
         </div>
      </div>
      <!-- Message:<br/> -->
      <textarea name="message" id="message" placeholder="Enter Message"></textarea>
      <br />
      <input type="submit" value="Send" onclick="sendEnquiryData('{{ $profiles->id }}','{{ $profiles->strEmail }}')" />
   </form>
</div>

<!-- The image Modal -->
<div id="imageModal" class="modal">
   <span class="close" id="imageModalClose">&times;</span>
   <img class="modal-content fadeIn" id="img01">
   <div id="caption"></div>
</div>
<!-- The share Modal -->
<div id="shareModal" class="modal share-modal">
   <div class="share-form fadeInUpBig">
      <div class="share-form-header">
         <h3 class="share-form-header-text">Share Profile</h3>
         <span class="close" id="shareModalClose">&times;</span>
      </div>
      <div class="share-form-buttons-container">
         <p>Share my Digital vCard in your network.</p>
         <div class="share-buttons-heading">
            <!-- <img src="../templates/template3/tild-arrow.svg" class="share-buttons-arrow"> -->
            <div class="share-buttons-heading-text">Share my Digital vCard</div>
         </div>
         <!-- Go to www.addthis.com/dashboard to customize your tools -->
         <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5f435040eecca22e"></script>

         <!-- Go to www.addthis.com/dashboard to customize your tools -->
         <div class="addthis_inline_share_toolbox_hd57"></div>
      </div>
   </div>
</div>
@endforeach
<?php echo View::make('footer', compact('video', 'galleries', 'service', 'type')) ?>
<?php echo View::make('footerJs') ?>
@section('scripts')
@parent
<script>

</script>
@endsection
@endsection