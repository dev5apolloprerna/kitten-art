@extends('layouts.app')
@section('title', 'Users List')
@section('content')


    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                {{-- Alert Messages --}}
                @include('common.alert')

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Show Users
                                </h5>
                                
                            </div>
                            <div class="card-body">
                                <?php //echo date('ymd');
                                ?>
                                <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                                    <tbody>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <td>{{ $user->first_name.' '.$user->last_name ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Email</th>
                                                <td>{{ $user->email ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Email verified at</th>
                                                <td>{{ $user->email_verified_at ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Mobile Number</th>
                                                <td>{{ $user->mobile_number ?? '' }}</td>
                                            </tr>
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
