@extends('layouts.app')
@section('title', 'Page List')
@section('content')

<?php $profileId = Request::segment(3);?>

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                {{-- Alert Messages --}}
                @include('common.alert')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Page List
                                  
                                </h5>
                                
                            </div> 
                             <div class="row">
                                <div class="col-lg-12">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class=" table table-bordered table-striped table-hover datatable">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th width="50"> Sr No </th>
                                                            <th> Page Name </th>  
                                                            <th> Name </th>  
                                                           <th> Action </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                     @if(count($page) > 0)
                                                    <?php $i = 1;
                                                    ?>
                                                        @foreach($page as $key => $cdata)
                                                            <tr data-entry-id="{{ $cdata->id }}" class="text-center">
                                                                <td>
                                                                    {{ $i + $page->perPage() * ($page->currentPage() - 1) }}
                                                                </td>
                                                                <td>
                                                                    {{ $cdata->page_name ?? '' }}
                                                                </td>
                                                                <td>
                                                                    {{ $cdata->name ?? '' }}
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex gap-2">
                                                                        <a class="" title="Edit"
                                                                            href="{{ route('page.edit', $cdata->id) }}">
                                                                            <i class="far fa-edit"></i>
                                                                        </a>
                                                                      
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php $i++; ?>
                                                        @endforeach
                                                        @else
                                                         <tr>
                                                            <td colspan="3">
                                                                <center>
                                                            No data Found
                                                        </center>
                                                            <td>

                                                        </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                             <div class="d-flex justify-content-center mt-3">
                                                {{ $page->links() }}
                                            </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection
@section('scripts')
    <script>
        function deleteData(id) {
            $("#deleteid").val(id);
        }
        function myFunction() 
        {
            $('#search').removeAttr('value');
        }
    </script>

@endsection

