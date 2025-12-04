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
                            <h4 class="mb-sm-0">Pending Ticket List</h4>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" id="form" action="{{ route('ticket.pendingticket') }}">
                                @csrf
                                <div class="row mt-3 align-items-center">
                                    <div class="col-md-3 mt-2 mb-2">
                                        <div class="d-flex align-items-center">
                                            <select class="form-control" name="itickettype">
                                                <option selected disabled value="">Select Ticket Type</option>
                                                @foreach ($TicketType as $tickettype)
                                                    <option value="{{ $tickettype->tickettypeMasterId }}"
                                                        <?= isset($Tickettype) && $tickettype->tickettypeMasterId == $Tickettype ? 'Selected' : '' ?>>
                                                        {{ $tickettype->tickettypename }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2 mb-2">
                                        <div class="d-flex align-items-center">
                                            <input placeholder="Name" type="text" class="form-control" name="ticketname"
                                                autocomplete="off" value="<?= isset($Name) ? $Name : '' ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2 mb-2">
                                        <div class="d-flex align-items-center">
                                            <input placeholder="Mobile" type="text" class="form-control"
                                                onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                                autocomplete="off" name="imobile"
                                                value="<?= isset($Mobile) ? $Mobile : '' ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2 mb-2">
                                        <div class="input-group">
                                            <input type="submit" id="search" class="btn btn-primary" name="search"
                                                title="Search" value="Search">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Ticket No.</th>
                                            <th scope="col"> Name</th>
                                            <th scope="col">Mobile</th>
                                            <th scope="col">Ticket Type</th>
                                            <th scope="col">Enter By</th>
                                            {{--  <th scope="col">Action</th>  --}}
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
                                                {{--  <td>
                                                    <div class="d-flex gap-2">
                                                        <a class="m-2" title="Edit" href="#"
                                                            onclick="getEditData(<?= $ticket->ticketId ?>)"
                                                            data-bs-toggle="modal" data-bs-target="#showModal">
                                                            <i data-feather="edit"></i>
                                                        </a>
                                                        <a class="m-2" href="#" data-bs-toggle="modal"
                                                            title="Delete" data-bs-target="#deleteRecordModal"
                                                            onclick="deleteData(<?= $ticket->ticketId ?>);">
                                                            <i data-feather="trash"></i>
                                                        </a>
                                                    </div>
                                                </td>  --}}
                                            </tr>
                                            <?php $i++; ?>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $Ticket->appends(request()->except('page'))->links() }}

                                    {{--  {{ $Ticket->links() }}  --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--  <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-light p-3">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Ticket</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    id="close-modal"></button>
                            </div>
                            <form method="POST" action="{{ route('ticket.update') }}" class="tablelist-form"
                                autocomplete="off">
                                @csrf
                                <input type="hidden" name="ticketId" id="ticketId" value="">

                                <div class="modal-body">
                                    <div class="mb-3" id="modal-id" style="display: none;">
                                        <label for="id-field" class="form-label">ID</label>
                                        <input type="text" id="id-field" class="form-control" placeholder="ID"
                                            readonly />
                                    </div>

                                    <div class="mb-3">
                                        <span style="color:red;">*</span>Name
                                        <input type="text" class="form-control" name="ticketname" id="Editticketname"
                                            placeholder="Enter Name" autocomplete="off" required>
                                    </div>

                                    <div class="mb-3">
                                        <span style="color:red;">*</span>Mobile
                                        <input type="text" class="form-control"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                            id="Editimobile" name="imobile" maxlength="10" placeholder="Enter Mobile"
                                            required>
                                    </div>

                                    <div class="mb-3">
                                        <span style="color:red;">*</span>Ticket Type
                                        <select class="form-control form-control-user" name="itickettype"
                                            id="Edititickettype" required>
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
                                <div class="modal-footer">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success" id="add-btn">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>  --}}

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
                                    <form id="user-delete-form" method="POST" action="{{ route('tickettype.delete') }}">
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
        function getEditData(id) {
            //alert(id);
            var url = "{{ route('ticket.edit', ':id') }}";
            url = url.replace(":id", id);
            if (id) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        id,
                        id
                    },
                    success: function(data) {
                        //console.log(data);
                        var obj = JSON.parse(data);
                        $("#Editticketname").val(obj.ticketname);
                        $("#Editimobile").val(obj.imobile);
                        $("#Edititickettype").val(obj.itickettype);
                        $('#ticketId').val(id);
                    }
                });
            }
        }
    </script>

    <script>
        function deleteData(id) {
            $("#deleteid").val(id);
        }
    </script>
@endsection
