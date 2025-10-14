@extends('layouts.app')
@section('title', 'EBook List')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                {{-- Alert Messages --}}
                @include('common.alert')

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-lg-5">

                                        <div class="d-flex justify-content-between card-header">
                                            <h5 class="card-title mb-0">Add E-Book </h5>
                                        </div>

                                        <div class="live-preview">
                                            <form method="POST" action="{{ route('ebook.store') }}" autocomplete="off"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <div class="modal-body">
                                                    <div class="mt-4 mb-3">
                                                        Book Name <span style="color:red;">*</span>
                                                        <input type="text" id="editor1" name="ebook_name" class="form-control" placeholder="Enter Book Name"  required>{{ old('ebook_name') }}</textarea>  
                                                    </div>
                                                    <div class="mt-4 mb-3">
                                                        Image <span style="color:red;">*</span>
                                                        <input type="file" id="ebook_image" name="ebook_image" class="form-control" value="{{ old('ebook_image') }}" reqired onchange="return validateFile1()">  
                                                        @if($errors->has('ebook_image'))
                                                            <span class="text-danger">
                                                                {{ $errors->first('ebook_image') }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="mt-4 mb-3">
                                                        PDF <span style="color:red;">*</span>
                                                        <input type="file" id="ebook_pdf" name="ebook_pdf" class="form-control" value="{{ old('ebook_pdf') }}" reqired onchange="return validateFile()">  
                                                        @if($errors->has('ebook_pdf'))
                                                            <span class="text-danger">
                                                                {{ $errors->first('ebook_pdf') }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                    

                                                </div>
                                                <div class="modal-footer">
                                                    <div class="hstack gap-2 justify-content-end">
                                                        <button type="submit" class="btn btn-primary mx-2"
                                                            id="add-btn">Submit</button>
                                                            <button type="reset" class="btn btn-primary mx-2"
                                                            id="add-btn">Clear</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="col-lg-1">
                                    </div>

                                    <div class="col-lg-5">
                                        <div class="d-flex justify-content-between card-header">
                                            <h5 class="card-title mb-0">E-Book List</h5>

                                        </div>
                                        <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                                            <thead>
                                                <tr class="text-center">
                                                    

                                                    <th width="1%"> Sr No</th>
                                                    <th width="2%"> Book Name</th>
                                                    <th width="2%"> Image</th>
                                                    <th width="1%"> Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                    @foreach($EBook as $key => $book)
                                                    <tr class="text-center">
                                                        <td>{{ $i + $EBook->perPage() * ($EBook->currentPage() - 1) }}
                                                        </td>
                                                        <td>{{ $book->ebook_name}}</td>
                                                        <td>
                                                            @if($book->ebook_image != null)
                                                            <a target="_blank"  href="{{ asset('EBook/') . '/' . $book->ebook_pdf }}">
                                                                <img src="{{ asset('EBook/img') . '/' . $book->ebook_image }}" width="50" height="50">
                                                            @else
                                                            <a  href="#">
                                                            <img src="{{ asset('assets/images/noImage.png') }}" width="50" height="50">
                                                            @endif

                                                            
                                                        </td>

                                                        <td>
                                                            <div class="gap-2">
                                                                <a class="mx-1" title="Edit" href="#"
                                                                    onclick="getPDFEditData(<?= $book->ebook_id ?>)"
                                                                    data-bs-toggle="modal" data-bs-target="#editModal">
                                                                    <i class="far fa-edit"></i>
                                                                </a>

                                                                <a class="" href="#" data-bs-toggle="modal"
                                                                    title="Delete" data-bs-target="#deleteRecordModal"
                                                                    onclick="deleteData(<?= $book->ebook_id ?>);">
                                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                                </a>
                                                               
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <?php $i++; ?>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-center mt-3">
                                            {{ $EBook->links() }}
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <!--Edit Modal Start-->
                <div class="modal fade flip" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-light p-3">
                                <h5 class="modal-title" id="exampleModalLabel">Edit E-Book</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    id="close-modal"></button>
                            </div>
                            <form method="POST" action="{{ route('ebook.update') }}" autocomplete="off"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="ebook_id" id="ebook_id" value="">

                                <div class="modal-body">
                                    <div class="mb-3">
                                        Book Name <span style="color:red;">*</span>
                                        <input type="text" class="form-control" name="ebook_name" placeholder="Enter Book Name" id="Editbook_name"
                                            placeholder="Enter Book Name" required>
                                    </div>
                                 
                                    <div class="mb-3">
                                        Image <span style="color:red;">*</span>
                                        <input type="file" id="editebook_image" name="ebook_image" class="form-control"  onchange="return editvalidateFile1()" accept="ebook_image/*">
                                        <input type="hidden" name="hiddenebook_image" id="hiddenebook_image"  class="form-control">
                                        <p id="error" style="color:red"></p>
                                        <img src="" width="50px" height="50px" id="editimage">

                                        <div id="error"></div>
                                    </div>

                                    <div class="mb-3">
                                        PDF <span style="color:red;">*</span>
                                        <input type="file" id="editebook_pdf" name="ebook_pdf" class="form-control"  onchange="return editvalidateFile()" accept="ebook_pdf/*">
                                        <input type="hidden" name="hiddenebook_pdf" id="hiddenebook_pdf"  class="form-control">
                                        <p id="error" style="color:red"></p>
                                        <a id="editphoto" target="_blank"><i class="fas fa-file-pdf" aria-hidden="true"></i>
                                        <div id="error"></div>
                                    </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-primary mx-2"
                                            id="add-btn">Update</button>
                                        <button type="button" class="btn btn-primary mx-2"
                                            data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--Edit Modal End -->

                <!--Delete Modal Start -->
                <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    id="btn-close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mt-2 text-center">
                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                        colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px">
                                    </lord-icon>
                                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                        <h4>Are you Sure ?</h4>
                                        <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Record
                                            ?</p>
                                    </div>
                                </div>
                                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                    <a class="btn btn-primary mx-2" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('user-delete-form').submit();">
                                        Yes,
                                        Delete It!
                                    </a>
                                    
                                    <button type="button" class="btn w-sm btn-primary mx-2"
                                        data-bs-dismiss="modal">Close</button>
                                    <form id="user-delete-form" method="POST" action="{{ route('ebook.delete') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="ebook_id" id="deleteid" value="">

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Delete modal End -->

            </div>
        </div>
    </div>
@endsection

@section('scripts')
        <script>
        function validateFile() {
            var allowedExtension = ['pdf'];
            var fileExtension = document.getElementById('ebook_pdf').value.split('.').pop().toLowerCase();
            var isValidFile = false;
            var image = document.getElementById('ebook_pdf').value;

            for (var index in allowedExtension) {

                if (fileExtension === allowedExtension[index]) {
                    isValidFile = true;
                    break;
                }
            }
            if (image != "") {
                if (!isValidFile) {
                    alert('Allowed Extensions are : *.' + allowedExtension.join(', *.'));
                    $('#ebook_pdf').val("")
                }
                return isValidFile;
            }

            return true;
        }

        function validateFile1() {
            var allowedExtension = ['jpeg', 'jpg', 'png', 'webp'];
            var fileExtension = document.getElementById('ebook_image').value.split('.').pop().toLowerCase();
            var isValidFile = false;
            var image = document.getElementById('ebook_image').value;

            for (var index in allowedExtension) {

                if (fileExtension === allowedExtension[index]) {
                    isValidFile = true;
                    break;
                }
            }
            if (image != "") {
                if (!isValidFile) {
                    alert('Allowed Extensions are : *.' + allowedExtension.join(', *.'));
                    $('#ebook_image').val("")
                }
                return isValidFile;
            }

            return true;
        }
        
        function editvalidateFile() {
            var allowedExtension = ['pdf'];
            var fileExtension = document.getElementById('editebook_pdf').value.split('.').pop().toLowerCase();
            var isValidFile = false;
            var image = document.getElementById('editebook_pdf').value;

            for (var index in allowedExtension) {

                if (fileExtension === allowedExtension[index]) {
                    isValidFile = true;
                    break;
                }
            }
            if (image != "") {
                if (!isValidFile) {
                    alert('Allowed Extensions are : *.' + allowedExtension.join(', *.'));
                    $('#editImage').val("")
                }
                return isValidFile;
            }

            return true;
        }

        function editvalidateFile1() {
            var allowedExtension = ['jpeg', 'jpg', 'png', 'webp'];
            var fileExtension = document.getElementById('editebook_image').value.split('.').pop().toLowerCase();
            var isValidFile = false;
            var image = document.getElementById('editebook_image').value;

            for (var index in allowedExtension) {

                if (fileExtension === allowedExtension[index]) {
                    isValidFile = true;
                    break;
                }
            }
            if (image != "") {
                if (!isValidFile) {
                    alert('Allowed Extensions are : *.' + allowedExtension.join(', *.'));
                    $('#editebook_image').val("")
                }
                return isValidFile;
            }

            return true;
        }

         function getPDFEditData(id) 
         {
            var url = "{{ route('ebook.edit', ':id') }}";
            url = url.replace(":id", id);
            if (id) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        id,
                        id
                    },
                    success: function(data) 
                    {
                        var obj = JSON.parse(data);
                        if(obj.ebook_pdf == null)
                        {
                            var pdfUrl="./assets/images/noImage.png";
                        }else{

                            var pdfUrl="https://getdemo.in/kitten_craft/EBook/"+obj.ebook_pdf;
                        }

                        if(obj.ebook_image == null)
                        {
                            var imageUrl="./assets/images/noImage.png";
                        }else{

                            var imageUrl="https://getdemo.in/kitten_craft/EBook/img/"+obj.ebook_image;
                        }

                        $('#id').val(id);
                        $("#hiddenebook_pdf").val(obj.ebook_pdf);
                        $('#editphoto').attr('href', pdfUrl);
                        $("#hiddenebook_image").val(obj.ebook_image);
                        $('#editimage').attr('src', imageUrl);
                        $('#Editbook_name').val(obj.ebook_name);

                var updateUrl = "{{ route('ebook.update', ':id') }}";
                updateUrl = updateUrl.replace(":id", id);
                $('form').attr('action', updateUrl); // Set the updated action to the form

                    }
                });
            }
        }
    </script>

    <script>
        function deleteData(id) {
            $("#deleteid").val(id);
        }
          function myFunction() 
        {
            $('#search').val('');

        }
    </script>

@endsection
