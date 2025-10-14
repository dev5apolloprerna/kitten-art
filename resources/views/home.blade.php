@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col">

                        <div class="h-100">
                            <div class="row mb-3 pb-1">
                                <div class="col-12">
                                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                        <div class="flex-grow-1">
                                            <?php if(Auth::user()->role_id == 1){ ?>
                                            <h4 class="fs-16 mb-1">Admin Login</h4>
                                            <?php }elseif(Auth::user()->role_id == 2){ ?>
                                            <h4 class="fs-16 mb-1">Manager Login</h4>
                                            <?php }else{ ?>
                                            <h4 class="fs-16 mb-1">Employee Login</h4>
                                            <?php } ?>
                                        </div>

                                    </div><!-- end card header -->
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->

                             <div class="row">
                                <!-- Batch wise student count -->  
                                <div class="col-xl-3 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate bg-info">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-bold text-white text-truncate mb-0">
                                                        Batch Wise Student Count</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-bold ff-secondary text-white mb-4">
                                                        <span class="counter-value"
                                                            data-target="{{ $batchStudent }}">{{ $batchStudent }}</span>
                                                    </h4>
                                                    <a href="{{ route('student.index') }}"
                                                        class="text-decoration-underline text-white">View
                                                        Student</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-soft-light rounded fs-3">
                                                        <i class="fas fa-user-graduate"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pending renewal count -->  
                                <div class="col-xl-3 col-md-6">
                                    <div class="card card-animate" style="background-color: #FFA500;">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-bold text-white text-truncate mb-0">
                                                        Pending Renewal Count</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-bold ff-secondary text-white mb-4">
                                                        <span class="counter-value"
                                                            data-target="{{ 0 }}">{{ 0 }}</span>
                                                    </h4>
                                                    <a href="{{ route('student.index') }}"
                                                        class="text-decoration-underline text-white">View
                                                        Payment</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-soft-light rounded fs-3">
                                                        <i class="fa fa-repeat"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Batchwise upcoming renewal -->
                                 <div class="col-xl-3 col-md-6">
                                    <div class="card card-animate" style="background-color: #008080;">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-bold text-white text-truncate mb-0">
                                                        Batchwise Upcoming Renewal</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-bold ff-secondary text-white mb-4">
                                                        <span class="counter-value"
                                                            data-target="{{ 0 }}">{{ 0 }}</span>
                                                    </h4>
                                                    <a href="{{ route('student.index') }}"
                                                        class="text-decoration-underline text-white">View
                                                        Payment</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-soft-light rounded fs-3">
                                                        <i class="fas fa-credit-card"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>  
                        </div>
                    </div>

                  
                    </div> <!-- end col -->
                </div>

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        
    </div>
    <!-- end main content-->


@endsection
