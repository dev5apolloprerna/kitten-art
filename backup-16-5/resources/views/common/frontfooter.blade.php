
    <!-- Start Footer Area -->
    <section class="footer-area pt-100 pb-70">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-sm-6">
            <div class="single-footer-widget">
              <div class="logo">
                <h2>
                  <a href="{{route('FrontIndex')}}">Kitten Art Classes</a>
                </h2>
              </div>
              <p>Kitten art classes help kids to develop their motor skills, improve their confidence, develop more focus & improve memory.</p>
              <ul class="social">
                <li>
                  <a href="https://www.facebook.com/share/1FL88yjexz/?mibextid=wwXIfr" target="_blank">
                    <i class="bx bxl-facebook"></i>
                  </a>
                </li>
               
                <li>
                  <a href="https://www.instagram.com/kittenartclasses?igsh=MTRscTlwMWhxd3cydw%3D%3D&utm_source=qr" target="_blank">
                    <i class="bx bxl-instagram-alt"></i>
                  </a>
                </li>
                <li>
            <a target="_blank" class="whatsapp-icon text-center" href="https://api.whatsapp.com/send/?phone=1(980)254-5836">
                <i class="bx bxl-whatsapp"></i>
            </a>

                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="single-footer-widget pl-5">
              <h3>Quick Links</h3>
              <ul class="quick-links">
                <li>
                  <a href="{{route('FrontIndex')}}">Home</a>
                </li>
                <li>
                  <a href="{{route('FrontAbout')}}">About us</a>
                </li>
                <li>
                  <a href="{{route('FrontClass')}}">Classes</a>
                </li>
                <li>
                  <a href="{{route('FrontService')}}">Services</a>
                </li>
                <li>
                  <a href="{{route('FrontContact')}}">Contact us</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="single-footer-widget">
              <h3>Contact Us</h3>
              <ul class="footer-contact-info">
                <li>
                  <i class="bx bxs-phone"></i>
                  <span>Phone</span>
                  <a href="tel:9802545836">+1 (980) 254-5836</a>
                </li>
                <li>
                  <i class="bx bx-envelope"></i>
                  <span>Email</span>
                  <a href="mailto:kittenart15@gmail.com">
                    <span class="">kittenart15@gmail.com</span>
                  </a>
                </li>
                <li>
                  <i class="bx bx-map"></i>
                  <span>Address</span> 9308, Kitchin Farms Way, Wake Forest, 27587.
                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="single-footer-widget">
              <h3>Photo Gallery</h3>
              <ul class="photo-gallery-list">
                   <?php
                      $Gallery = App\Models\Gallery::orderBy('gallery_id', 'asc')->limit(9)->get();
                     ?>
                @foreach ($Gallery as $g)
                <li>
                  <div class="single-gallery-box box">
                        <img src="{{ asset($g->image ? 'Gallery/' . $g->image : 'images/noImage.png') }}" alt="image">

                        <a href="{{ asset($g->image ? 'Gallery/' . $g->image : 'images/noImage.png') }}" class="gallery-btn" data-imagelightbox="popup-btn">
                            <i class="bx bx-search-alt"></i>
                        </a>
                    </div> 
                </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Footer Area -->
    <!-- Start Copy Right Area -->
    <div class="copyright-area">
      <div class="container">
        <div class="copyright-area-content">
          <p> <?php echo date('Y'); ?> &copy; Copyright <a href="#" target="_blank"> Kitten Art</a>. All Rights Reserved | Designed & Developed by <a href="https://www.apolloinfotech.com/" target="_blank"> Apollo Infotech </a>
          </p>
        </div>
      </div>
    </div>
    <!-- End Copy Right Area -->
    <!-- Start Go Top Area -->
    <div class="go-top">
      <i class="bx bx-up-arrow-alt"></i>
    </div>