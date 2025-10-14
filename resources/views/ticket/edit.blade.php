@extends('layouts.app')
@section('title', 'Edit Ticket')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                {{-- Alert Messages --}}
                @include('common.alert')

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Edit Ticket</h4>
                            <div class="page-title-right">
                                <a href="{{ route('ticket.index') }}"
                                    class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                    <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="live-preview">
                                    <form method="POST" action="{{ route('ticket.update', $Ticket->ticketId) }}"
                                        class="tablelist-form" autocomplete="off">
                                        @csrf

                                        <div class="row gy-4">

                                            <div class="col-lg-4 col-md-6">
                                                <span style="color:red;">*</span>Ticket
                                                <input type="text" class="form-control" name="strticket"
                                                    id="Editticketname" maxlength="100" placeholder="Enter Ticket"
                                                    autocomplete="off" required readonly value="{{ $Ticket->strticket }}">
                                            </div>

                                            <div class="col-lg-4 col-md-6">
                                                <span style="color:red;">*</span>Name
                                                <input type="text" class="form-control" name="ticketname"
                                                    id="Editticketname" maxlength="100" placeholder="Enter Name"
                                                    autocomplete="off" required readonly value="{{ $Ticket->ticketname }}">
                                            </div>

                                            <div class="col-lg-4 col-md-6">
                                                <span style="color:red;">*</span>Mobile
                                                <input type="text" class="form-control"
                                                    onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                                    autocomplete="off" id="Editimobile" name="imobile" minlength="10"
                                                    maxlength="10" required value="{{ $Ticket->imobile }}">
                                            </div>

                                            <div class="col-lg-4 col-md-6">
                                                <span style="color:red;">*</span>Ticket Type
                                                <select class="form-control form-control-user" name="itickettype"
                                                    id="Edititickettype" required>
                                                    <option selected disabled value="">Select Ticket Type</option>
                                                    @foreach ($TicketType as $tickettype)
                                                        <option value="{{ $tickettype->tickettypeMasterId }}"
                                                            {{ old('itickettype') ? (old('itickettype') == $tickettype->tickettypeMasterId ? 'selected' : '') : ($Ticket->itickettype == $tickettype->tickettypeMasterId ? 'selected' : '') }}>
                                                            {{ $tickettype->tickettypename }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-lg-4 col-md-6">
                                                <span style="color:red;">*</span>Current Status
                                                <select class="form-control form-control-user" name="ifinalticketstatus"
                                                    required>
                                                    <option selected disabled value="">Select Current Status</option>
                                                    <option value="Open"
                                                        {{ $Ticket->ifinalticketstatus == 'Open' ? 'selected' : '' }}>
                                                        Open
                                                    </option>
                                                    <option value="In Process"
                                                        {{ $Ticket->ifinalticketstatus == 'In Process' ? 'selected' : '' }}>
                                                        In Process
                                                    </option>
                                                    <option value="Closed"
                                                        {{ $Ticket->ifinalticketstatus == 'Closed' ? 'selected' : '' }}>
                                                        Closed
                                                    </option>

                                                </select>
                                            </div>

                                            <div class="col-lg-4 col-md-6">
                                                <span style="color:red;"></span>Assign To
                                                <select class="form-control form-control-user" name="assignto"
                                                    id="Edititickettype">
                                                    <option selected disabled value="">Select Assign To</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}"
                                                            {{ old('assignto') == $user->id ? 'selected' : '' }}>
                                                            {{ $user->first_name . ' ' . $user->last_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-lg-4 col-md-6">
                                                <span style="color:red;"></span>Remark
                                                <textarea class="form-control" name="comments" id="comments" cols="30" rows="5">
                                                </textarea>
                                            </div>

                                        </div>

                                        <div class="card-footer mt-2" style="float: right;">
                                            <button type="submit"
                                                class="btn btn-success btn-user float-right">Update</button>
                                            <a class="btn btn-primary float-right mr-3"
                                                href="{{ route('ticket.index') }}">Cancel</a>
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
                                <h5 class="card-title mb-0">History</h5>
                            </div>
                            <div class="card-body">
                                <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Assign By</th>
                                            <th scope="col">Assign To</th>
                                            <th scope="col">Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($Historys as $History)
                                            <tr>
                                                <?php
                                                $first = $History->first_name ?? '';
                                                $second = $History->last_name ?? '';
                                                $fullname = $first . ' ' . $second;
                                                ?>
                                                <td>{{ $i }}</td>
                                                <td>{{ $History->assignbyName ?? '-' }}</td>
                                                <td>{{ $fullname }}</td>
                                                <td>{{ $History->comments ?? '-' }}</td>
                                            </tr>
                                            <?php $i++; ?>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
