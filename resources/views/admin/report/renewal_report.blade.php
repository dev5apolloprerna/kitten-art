@extends('layouts.app')

@section('title', 'Upcoming Renewals - Last 2 Subscriptions')

@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            @include('common.alert')

            <div class="row">
                <div class="col-lg-12">

                    <div class="card shadow-sm">
                       <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Renewal Report<!-- – Last 2 Subscription Details --></h5>
                            </div>

        <div class="card-body">
            <form method="GET" action="{{ route('report.renewal_report') }}" id="filterForm">
                <div class="row g-3">

                    {{-- BATCH FILTER --}}
                    <div class="col-md-4">
                        <label class="form-label">Search by Batch</label>
                        <select name="batch" id="batch" class="form-control">
                            <option value="">Select Batch</option>
                            @foreach($batchdata as $b)
                                <option value="{{ $b->batch_id }}" 
                                    {{ request('batch') == $b->batch_id ? 'selected' : '' }}>
                                    {{ $b->batch_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- STUDENT NAME SEARCH --}}
                    <div class="col-md-4">
                        <label class="form-label">Search by Student Name</label>
                        <input type="text" 
                               name="search" 
                               id="search"
                               placeholder="Enter student name"
                               value="{{ request('search') }}"
                               class="form-control">
                    </div>

                    {{-- BUTTONS --}}
                    <div class="col-md-4 d-flex align-items-end">
                        <div>
                            <button type="submit" class="btn btn-primary me-2">Search</button>

                            <a href="{{ route('report.renewal_report') }}" 
                               class="btn btn-secondary">
                                Reset
                            </a>
                        </div>
                    </div>

                </div>
            </form>
        </div>


                        <div class="card-body">

                            @php
                                $grouped = $Student->groupBy('student_id');
                            @endphp

                            @forelse($grouped as $student_id => $records)

                                {{-- =======================
                                     STUDENT INFORMATION
                                   ======================= --}}
                                @php
                                    $stu = $records->first();
                                @endphp

                                <div class="border rounded p-3 mb-4">

                                    <h5 class="text-primary mb-2">
                                        {{ $stu->student_first_name }} {{ $stu->student_last_name }}
                                    </h5>

                                    <div class="row mb-3">
                                        <!-- <div class="col-md-3"><strong>ID:</strong> {{ $stu->student_id }}</div> -->
                                        <div class="col-md-3"><strong>Mobile:</strong> {{ $stu->mobile }}</div>
                                        <div class="col-md-3"><strong>Email:</strong> {{ $stu->email }}</div>
                                        <div class="col-md-3"><strong>Age:</strong> {{ $stu->categoryName ?? '-' }}</div>
                                        <div class="col-md-3"><strong>Batch:</strong> {{ $stu->batch_name ?? '-' }}</div>
                                    </div>

                                    {{-- =======================
                                         LAST 2 SUBSCRIPTIONS
                                       ======================= --}}
                                    <table class=" table table-bordered table-striped table-hover datatable">
                                        <thead class="text-center">
                                            <tr>
                                                <!-- <th>Subscription ID</th> -->
                                                <th>Plan</th>
                                                <th>Batch</th>
                                                <th>Subscription Date</th>
                                                <th>Payment Date</th>
                                                <th>Payment Mode</th>
                                                <th>Total Sessions</th>
                                                <th>Amount</th>
                                                <th>Used Session</th>
                                            </tr>
                                        </thead>

                                        <tbody class="text-center">

                                            @foreach($records as $sub)
                                                <tr>
                                                    <!-- <td><span class="badge bg-info">{{ $sub->subscription_id }}</span></td> -->

                                                    <td>{{ $sub->plan_name }}</td>
                                                    <td>{{ $sub->batch_name }}</td>

                                                    <td>{{ date('d-m-Y', strtotime($sub->activate_date)) }}</td>
                                                    <td>
                                                        {{ $sub->payment_date ? date('d-m-Y', strtotime($sub->payment_date)) : '-' }}
                                                    </td>
                                                    <td>{{ $sub->payment_mode }}</td>

                                                    <td>{{ $sub->total_session }}</td>

                                                    <td>₹{{ number_format($sub->amount) }}</td>

                                                    <td>
                                                        @php
                                                            $balance = $sub->debit_balance;
                                                        @endphp

                                                        @if($balance > 0)
                                                            <span class="badge bg-danger">{{ $balance }}</span>
                                                        @else
                                                            <span class="badge bg-success">0</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>

                                </div>

                            @empty
                                <p class="text-center text-muted">No renewal data found.</p>
                            @endforelse

                            {{-- PAGINATION --}}
                            <div class="mt-3">
                                {{ $Student->appends(request()->query())->links() }}
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
