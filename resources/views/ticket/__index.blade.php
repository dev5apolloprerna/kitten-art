@extends('layouts.app')
@section('title', 'Ticket List')
@section('content')



    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                {{-- Alert Messages --}}
                @include('common.alert')

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Add Ticket</h4>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="live-preview">
                                    <form action="{{ route('ticket.store') }}" method="post">
                                        @csrf
                                        <div class="row gy-4" style="align-items: end;">
                                            <div class="col-lg-3 col-md-3">
                                                <div>
                                                    <span style="color:red;">*</span>Name
                                                    <input type="text" class="form-control" name="ticketname"
                                                        id="ticketname" placeholder="Enter Name" maxlength="100"
                                                        autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3">
                                                <div>
                                                    <span style="color:red;">*</span>Mobile
                                                    <input type="text" class="form-control"
                                                        onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                                        name="imobile" value="{{ old('imobile') }}" maxlength="10"
                                                        minlength="10" id="mobile-num" autocomplete="off"
                                                        placeholder="Enter Mobile" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3">
                                                <div>
                                                    <span style="color:red;">*</span>Ticket Type
                                                    <select class="form-control" name="itickettype" required>
                                                        <option selected disabled value="">Select Ticket Type</option>
                                                        @foreach ($TicketType as $tickettype)
                                                            <option value="{{ $tickettype->tickettypeMasterId }}"
                                                                {{ old('itickettype') == $tickettype->tickettypeMasterId ? 'selected' : '' }}>
                                                                {{ $tickettype->tickettypename }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3">
                                                <button type="submit" class="btn btn-success btn-user float-right">Save
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Ticket List</h5>
                            </div>
                            <div class="card-body">
                                <?php //echo date('M-y');
                                ?>
                                <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Ticket No.</th>
                                            <th scope="col"> Name</th>
                                            <th scope="col">Mobile</th>
                                            <th scope="col">Ticket Type</th>
                                            <th scope="col">Enter By</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($Ticket as $ticket)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $ticket->strticket }}</td>
                                                <td>{{ $ticket->ticketname }}</td>
                                                <td>{{ $ticket->imobile }}</td>
                                                <td>{{ $ticket->tickettypename }}</td>
                                                <td>{{ $ticket->ienterbyname }}</td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a class="" title="Edit"
                                                            href="{{ route('ticket.edit', $ticket->ticketId) }}">
                                                            <i class="far fa-edit"></i>
                                                        </a>
                                                        <a class="" href="#" data-bs-toggle="modal"
                                                            title="Delete" data-bs-target="#deleteRecordModal"
                                                            onclick="deleteData(<?= $ticket->ticketId ?>);">
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
                                    {{ $Ticket->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
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
                                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                    <a class="btn btn-danger" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('user-delete-form').submit();">
                                        Yes,
                                        Delete It!
                                    </a>
                                    <form id="user-delete-form" method="POST" action="{{ route('ticket.delete') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="ticketId" id="deleteid" value="">

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end modal -->

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function deleteData(id) {
            $("#deleteid").val(id);
        }
    </script>

@endsection
