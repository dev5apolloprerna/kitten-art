@extends('layouts.front')
@section('content')
<!-- Start Page Banner -->
<div class="page-banner-area item-bg4">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-banner-content">
                    <h2>Ebooks</h2>
                    <ul>
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>Ebooks</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Banner -->
<section class="ebooks-area pt-100 pb-100">
            <div class="container">
                <div class="row">
                    @foreach($EBook as $ebook)
                    <div class="col-lg-3 col-md-6 ebooks-block">
                        <div class="single-ebooks-item">
                            <div class="ebooks-image">
                                <a data-bs-target="#ebookform" data-bs-toggle="modal" onclick="pdfData(<?= $ebook->ebook_id ?>);">
                                    <img src="{{ asset('EBook/img') . '/' . $ebook->ebook_image }}" alt="image">
                                </a>
                            </div>

                            <div class="ebooks-content">
                               
                                <h5>
                                    <a data-bs-target="#ebookform" data-bs-toggle="modal" onclick="pdfData(<?= $ebook->ebook_id ?>);">{{ $ebook->ebook_name }}</a>
                                </h5>
                                <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> -->

                                <div class="ebooks-btn">
                                    <a  class="default-btn" data-bs-toggle="modal" data-bs-target="#ebookform" onclick="pdfData(<?= $ebook->ebook_id ?>);">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>        
                @endforeach
                <div class="pagination-wrap"><div class="pagination">
                    {{ $EBook->appends(request()->except('page'))->links() }}
                </div>
                </div>
             </div>
            </div>
        </section>




<!-- Modal -->


    <!-- Modal content-->
    <!-- The Modal -->
<div class="modal" id="ebookform">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Fill this form to get your Ebook</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
         <form method="post" action="{{route('FrontEbooksRegistration')}}">
            @csrf 
            <input type="hidden" name="ebook_id"  id="pebook_id"value=""> 
            <div class="form-group py-2">
              <input type="text" class="form-control" name="name" placeholder="Your Name" required>
            </div>
            <div class="form-group py-2">
              <input type="tel" class="form-control" name="mobile" placeholder="Your Phone" minlength="10" maxlength="10"  required>
            </div>
            <div class="form-group py-2">
              <input type="text" class="form-control" name="email" placeholder="Your Email Address" required>
            </div>
                  <div class="modal-footer">

                <button type="submit" class="btn btn-danger"> Submit Now </button> 
                </div>
              </form>
      </div>

      <!-- Modal footer -->

    </div>
  </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
     function pdfData(id) {
            $("#pebook_id").val(id);
        }
</script>
@endsection