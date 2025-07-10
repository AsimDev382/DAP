@extends('admin.layouts.adminlayout')
@section('main-content')
@section('style')
<style>
    .card p {
        font-size: 10px;
    }

    #myPieChart {
        height: 220px !important;
        display: flex !important;
    }

</style>
<style>
    .enforcement-wrapper {
        display: flex;
        gap: 12px;
        flex-wrap: nowrap;
        max-width: 1000px;
        margin: auto;
        margin-bottom: 30px;
    }

    .enforcement-card {
        text-align: center;
        width: 70px;
    }

    .enforcement-card canvas {
        width: 70px !important;
        height: 70px !important;
    }

    .enforcement-card .number {
        position: relative;
        top: -53px;
        font-weight: bold;
        font-size: 14px;
        color: #333;
    }

    .enforcement-card .label {
        margin-top: -10px;
        font-size: 11px;
        color: #333;
    }

</style>
<style>
    .performance-box {
        max-width: 500px;
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        font-family: Arial, sans-serif;
    }

    .performance-box h4 {
        color: #001F60;
        font-size: 16px;
        margin-bottom: 20px;
    }

    .progress-row {
        margin-bottom: 12px;
    }

    .label-row {
        display: flex;
        justify-content: space-between;
        font-size: 13px;
        margin-bottom: 4px;
        color: #333;
    }

    .progress-container {
        width: 100%;
        height: 16px;
        background: #e0e0e0;
        border-radius: 4px;
        overflow: hidden;
    }

    .progress-bar {
        height: 100%;
        border-radius: 4px;
    }

    .bg-blue {
        background-color: #0057B7;
    }

    .bg-cyan {
        background-color: #039BE5;
    }

    .bg-orange {
        background-color: #F9A825;
    }

    .bg-green {
        background-color: #43A047;
    }

</style>
@endsection

<div class="row p-3">

    <div class="row mb-4 justify-content-center">

        {{-- First Row: 5 Cards --}}
        <div class="col-12 d-flex flex-wrap justify-content-center gap-4 mb-4">
            <div class="card shadow-sm p-3 rounded-4 text-center" style="width: 8rem;">
                <div class="mx-auto mb-3 d-flex justify-content-center align-items-center rounded-circle" style="background-color: #FFEB3B; width: 40px; height: 40px;">
                    <i class="bi bi-person-fill" style="font-size: 1.5rem; color: black;"></i>
                </div>
                <h5 class="mb-0">{{ $totalCasesCount }}</h5>
                <p class="text-muted mb-1">Total Cases</p>
            </div>
            @foreach (array_slice($statuses, 0, 4) as $status)
            <div class="card shadow-sm p-3 rounded-4 text-center" style="width: 8rem;">
                <div class="mx-auto mb-3 d-flex justify-content-center align-items-center rounded-circle" style="background-color: {{ $status['color'] }}; width: 40px; height: 40px;">
                    <i class="bi bi-person-fill" style="font-size: 1.5rem; color: #fff;"></i>
                </div>
                <h5 class="mb-0">{{ $status['count'] }}</h5>
                <p class="text-muted mb-1">{{ $status['label'] }}</p>
                <p class="text-primary mb-0">{{ $status['change'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- Second Row: 5 Cards --}}
        <div class="col-12 d-flex flex-wrap justify-content-center gap-4">
            @foreach (array_slice($statuses, 4, 5) as $status)
            <div class="card shadow-sm p-3 rounded-4 text-center" style="width: 8rem;">
                <div class="mx-auto mb-3 d-flex justify-content-center align-items-center rounded-circle" style="background-color: {{ $status['color'] }}; width: 40px; height: 40px;">
                    <i class="bi bi-person-fill" style="font-size: 1.5rem; color: #fff;"></i>
                </div>
                <h5 class="mb-0">{{ $status['count'] }}</h5>
                <p class="text-muted mb-1">{{ $status['label'] }}</p>
                <p class="text-primary mb-0">{{ $status['change'] }}</p>
            </div>
            @endforeach
        </div>

    </div>


    {{-- <div class="row mb-4 justify-content-center">

        <div class="col-12 d-flex flex-wrap justify-content-center gap-4 mb-4">
            <div class="card shadow-sm p-3 rounded-4 text-center" style="width: 8rem;">
                <div class="mx-auto mb-3 d-flex justify-content-center align-items-center rounded-circle"
                    style="background-color: #FFEB3B; width: 40px; height: 40px;">
                    <i class="bi bi-person-fill" style="font-size: 1.5rem; color: black;"></i>
                </div>
                <h5 class="mb-0">{{ $totalCasesCount }}</h5>
    <p class="text-muted mb-1">Total Cases</p>
</div>
@foreach (array_slice($statuses, 0, 4) as $status)
<div class="card shadow-sm p-3 rounded-4 text-center" style="width: 8rem;">
    <div class="mx-auto mb-3 d-flex justify-content-center align-items-center rounded-circle" style="background-color: {{ $status['color'] }}; width: 40px; height: 40px;">
        <i class="bi bi-person-fill" style="font-size: 1.5rem; color: #fff;"></i>
    </div>
    <h5 class="mb-0">{{ $status['count'] }}</h5>
    <p class="text-muted mb-1">{{ $status['label'] }}</p>
    <p class="text-primary mb-0">{{ $status['change'] }}</p>
</div>
@endforeach
</div>

<div class="col-12 d-flex flex-wrap justify-content-center gap-4">
    @foreach (array_slice($statuses, 4, 3) as $status)
    <div class="card shadow-sm p-3 rounded-4 text-center" style="width: 8rem;">
        <div class="mx-auto mb-3 d-flex justify-content-center align-items-center rounded-circle" style="background-color: {{ $status['color'] }}; width: 40px; height: 40px;">
            <i class="bi bi-person-fill" style="font-size: 1.5rem; color: #fff;"></i>
        </div>
        <h5 class="mb-0">{{ $status['count'] }}</h5>
        <p class="text-muted mb-1">{{ $status['label'] }}</p>
        <p class="text-primary mb-0">{{ $status['change'] }}</p>
    </div>
    @endforeach
</div>

</div> --}}

<div class="col-md-6">
    <div class="card">
        <div class="card-body" style="height: 275px">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title">Case Table</h5>
                <a href="{{ route('case.index') }}" class="text-decoration-none card-title">View All</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>DAP ID</th>
                            <th>Case Name</th>
                            <th>Case Type</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cases as $case)
                        <tr>
                            <td>{{ $case->auto_id }}</td>
                            <td>{{ $case->case_name }}</td>
                            <td>{{ $case->case_type }}</td>
                            <td>{{ $case->start_date }}</td>
                            <td class="text-success">
                                @if ($case->status == 'Pending Approval')
                                <span class="text-warning"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $case->status }}</span>
                                @elseif($case->status == 'In Progress')
                                <span class="text-primary"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $case->status }}</span>
                                @elseif($case->status == 'Approved')
                                <span class="text-success"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $case->status }}</span>
                                @elseif($case->status == 'Closed(Completed)')
                                <span class="text-danger">{{ $case->status }}</span>
                                @elseif($case->status == 'High-Risk-case')
                                <span class="text-orange"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $case->status }}</span>
                                @elseif($case->status == 'Reopened Cases')
                                <span class="text-info"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $case->status }}</span>
                                @elseif($case->status == 'Rejected')
                                <span class="text-danger"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $case->status }}</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<div class="col-md-6">
    <div class="card">
        <div class="card-body d-flex justify-content-end">
            {{-- <div class="row">
                    <div class="col-7 d-flex flex-column ">
                        <h5 class="card-title">Case Breakdown</h5>
                        <ul class="list-unstyled small mt-5">
                            <li><span class="text-success">■</span> Market Investigations</li>
                            <li><span class="text-primary">■</span> Customs Enforcement</li>
                            <li><span class="text-warning">■</span> Legal Investigations</li>
                        </ul>

                    </div>
                    <div class="col-5">

                        <img src="{{ asset('admin/images/map.svg') }}" class="img-fluid" alt="Case Breakdown">
        </div>
    </div> --}}


    <div class="row">
        <div class="col-7 d-flex flex-column ">
            <h5 class="card-title">Case Breakdown</h5>

        </div>

        <div style="display: flex; align-items: center; gap: 30px;">
            <div id="chartLegend" style="flex: 2;"></div>
            <canvas id="myPieChart" width="300" height="300" style="flex: 1;"></canvas>
        </div>

    </div>



</div>
</div>
</div>


{{-- <div class="row mb-4"> --}}
{{-- <div class="card p-3">
    <div class="row g-3">

        <div class="col-12 col-sm-6 col-md-3 col-lg-2">
            <div class="card shadow-sm p-3 rounded-4">
                <div class="mb-3 d-flex justify-content-center align-items-center rounded-circle" style="background-color: green; width: 40px; height: 40px;">
                    <i class="bi bi-person-fill" style="font-size: 1.5rem; color: black;"></i>
                </div>
                <h5 class="mb-0">320</h5>
                <p class="text-muted mb-1">Active Investigation</p>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3 col-lg-2">
            <div class="card shadow-sm p-3 rounded-4">
                <div class="mb-3 d-flex justify-content-center align-items-center rounded-circle" style="background-color: orange; width: 40px; height: 40px;">
                    <i class="bi bi-person-fill" style="font-size: 1.5rem; color: black;"></i>
                </div>
                <h5 class="mb-0">76</h5>
                <p class="text-muted mb-1">Scheduled Investigations</p>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3 col-lg-2">
            <div class="card shadow-sm p-3 rounded-4">
                <div class="mb-3 d-flex justify-content-center align-items-center rounded-circle" style="background-color: rgb(184, 0, 221); width: 40px; height: 40px;">
                    <i class="bi bi-person-fill" style="font-size: 1.5rem; color: black;"></i>
                </div>
                <h5 class="mb-0">182</h5>
                <p class="text-muted mb-1">In-Market Investigations</p>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3 col-lg-2">
            <div class="card shadow-sm p-3 rounded-4">
                <div class="mb-3 d-flex justify-content-center align-items-center rounded-circle" style="background-color: red; width: 40px; height: 40px;">
                    <i class="bi bi-person-fill" style="font-size: 1.5rem; color: black;"></i>
                </div>
                <h5 class="mb-0">52</h5>
                <p class="text-muted mb-1 text-nowrap">Pakistan Customs Investigations</p>
            </div>
        </div>

        <!-- Add more cards like above as needed -->

    </div>
</div> --}}
{{-- </div> --}}

{{-- <div class="container">
        <div class="card p-4 rounded-4 mb-4 col-8">
            <h5 class="card-title">Investigations</h5>
            <div class="row g-3">

                <div class="col-12 col-sm-6 col-md-3 col-lg-2" style="width: 10rem;">
                    <div class="card shadow-sm p-3 rounded-4 border-0">
                        <div class=" mb-3 d-flex justify-content-center align-items-center rounded-circle" style="background-color: #4CAF50; width: 40px; height: 40px;">
                            <i class="bi bi-person-fill text-white" style="font-size: 1.5rem;"></i>
                        </div>
                        <h5 class="mb-0">320</h5>
                        <p class="text-muted small mb-0">Active Investigations</p>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3 col-lg-2" style="width: 10rem;">
                    <div class="card shadow-sm p-3 rounded-4 border-0">
                        <div class=" mb-3 d-flex justify-content-center align-items-center rounded-circle" style="background-color: #FF9800; width: 40px; height: 40px;">
                            <i class="bi bi-person-fill text-white" style="font-size: 1.5rem;"></i>
                        </div>
                        <h5 class="mb-0">76</h5>
                        <p class="text-muted small mb-0">Scheduled Investigations</p>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3 col-lg-2" style="width: 10rem;">
                    <div class="card shadow-sm p-3 rounded-4 border-0">
                        <div class=" mb-3 d-flex justify-content-center align-items-center rounded-circle" style="background-color: #BA68C8; width: 40px; height: 40px;">
                            <i class="bi bi-person-fill text-white" style="font-size: 1.5rem;"></i>
                        </div>
                        <h5 class="mb-0">182</h5>
                        <p class="text-muted small mb-0">In-Market Investigations</p>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3 col-lg-2" style="width: 10rem;">
                    <div class="card shadow-sm p-3 rounded-4 border-0">
                        <div class=" mb-3 d-flex justify-content-center align-items-center rounded-circle" style="background-color: #F44336; width: 40px; height: 40px;">
                            <i class="bi bi-person-fill text-white" style="font-size: 1.5rem;"></i>
                        </div>
                        <h5 class="mb-0">52</h5>
                        <p class="text-muted small mb-0">Pakistan Customs Investigations</p>
                    </div>
                </div>

            </div>
        </div>


        <div class="card p-4 rounded-4 mb-4 col-4">
            <h5 class="card-title">Department Performance</h5>
            <div class="row g-3">

            </div>
        </div>
    </div> --}}

<div class="container">

    <div class="row">
        <div class="col-7">
            <div class="card p-4 rounded-4 mb-4">
                <h5 class="card-title">Investigations</h5>
                <div class="row d-flex justify-content-between">
                    <div class="col-12 col-sm-6 col-md-4 col-lg-2" style="width: 9rem;">
                        <div class="card shadow-sm p-3 rounded-4 border-0">
                            <div class=" mb-3 d-flex justify-content-center align-items-center rounded-circle" style="background-color: #4CAF50; width: 40px; height: 40px;">
                                <i class="bi bi-person-fill text-white" style="font-size: 1.5rem;"></i>
                            </div>
                            <h5 class="mb-0">320</h5>
                            <p class="text-muted small mb-0">Active Investigations</p>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 col-lg-2" style="width: 9rem;">
                        <div class="card shadow-sm p-3 rounded-4 border-0">
                            <div class=" mb-3 d-flex justify-content-center align-items-center rounded-circle" style="background-color: #FF9800; width: 40px; height: 40px;">
                                <i class="bi bi-person-fill text-white" style="font-size: 1.5rem;"></i>
                            </div>
                            <h5 class="mb-0">76</h5>
                            <p class="text-muted small mb-0">Scheduled Investigations</p>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 col-lg-2" style="width: 9rem;">
                        <div class="card shadow-sm p-3 rounded-4 border-0">
                            <div class=" mb-3 d-flex justify-content-center align-items-center rounded-circle" style="background-color: #BA68C8; width: 40px; height: 40px;">
                                <i class="bi bi-person-fill text-white" style="font-size: 1.5rem;"></i>
                            </div>
                            <h5 class="mb-0">182</h5>
                            <p class="text-muted small mb-0">In-Market Investigations</p>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 col-lg-2" style="width: 9rem;">
                        <div class="card shadow-sm p-3 rounded-4 border-0">
                            <div class=" mb-3 d-flex justify-content-center align-items-center rounded-circle" style="background-color: #F44336; width: 40px; height: 40px;">
                                <i class="bi bi-person-fill text-white" style="font-size: 1.5rem;"></i>
                            </div>
                            <h5 class="mb-0">52</h5>
                            <p class="text-muted small mb-0">Pakistan Customs Investigations</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5 col-sm-6">
            <div class="card p-4 rounded-4 mb-4">
                <h5 class="card-title mb-4">Enforcement</h5>
                <div class="enforcement-wrapper">
                    <div class="enforcement-card">
                        <canvas id="chart1"></canvas>
                        <div class="number">05</div>
                        <div class="label">Total Enforcement</div>
                    </div>
                    <div class="enforcement-card">
                        <canvas id="chart2"></canvas>
                        <div class="number">02</div>
                        <div class="label">Market</div>
                    </div>
                    <div class="enforcement-card">
                        <canvas id="chart3"></canvas>
                        <div class="number">01</div>
                        <div class="label">Custom</div>
                    </div>
                    <div class="enforcement-card">
                        <canvas id="chart4"></canvas>
                        <div class="number">01</div>
                        <div class="label">Scheduled Enforcement</div>
                    </div>
                    <div class="enforcement-card">
                        <canvas id="chart5"></canvas>
                        <div class="number">01</div>
                        <div class="label">Completed</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- Enforcement Card - Total Enforement , Market , Custom , Scheduled Enforcement , Completed --}}



    <div class="row">
        {{-- <div class="col-6">
                <div class="card p-4 rounded-4 mb-4">
                    <h5 class="card-title">Department Performance</h5>
                    <div class="row g-3 mb-3">
                        <img src="{{ asset('admin/images/Destruction.svg') }}" height="180" alt="">
    </div>
</div>
</div> --}}
<div class="col-6">
    <div class="card p-4 rounded-4 mb-4">
        <h5 class="card-title">Department Performance</h5>
        <div class="row g-3 mb-3">

            <div class="performance-box">
                {{-- <h4>Department Performance</h4> --}}

                <div class="progress-row">
                    <div class="label-row">
                        <span>Total Destruction</span>
                        <span>10</span>
                    </div>
                    <div class="progress-container">
                        <div class="progress-bar bg-blue" style="width: 100%"></div>
                    </div>
                </div>

                <div class="progress-row">
                    <div class="label-row">
                        <span>Destruction Pending</span>
                        <span>5</span>
                    </div>
                    <div class="progress-container">
                        <div class="progress-bar bg-cyan" style="width: 50%"></div>
                    </div>
                </div>

                <div class="progress-row">
                    <div class="label-row">
                        <span>Destruction Schedule</span>
                        <span>3</span>
                    </div>
                    <div class="progress-container">
                        <div class="progress-bar bg-orange" style="width: 30%"></div>
                    </div>
                </div>

                <div class="progress-row">
                    <div class="label-row">
                        <span>Destruction Completed</span>
                        <span>2</span>
                    </div>
                    <div class="progress-container">
                        <div class="progress-bar bg-green" style="width: 20%"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="col-6">
    <div class="card p-4 rounded-4 mb-4">
        <h5 class="card-title">Destruction</h5>
        <div class="row g-3">
            <canvas id="departmentPerformanceChart" height="200"></canvas>
        </div>
    </div>

</div>
</div>
</div>






<div class="col-md-8">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Invoices</h5>
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Case ID</th>
                            <th>Case Name</th>
                            <th>Product Name</th>
                            <th>Invoice Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>8311</td>
                            <td>XYZ Holdings</td>
                            <td>Monitoring Suite</td>
                            <td>12-01-2025</td>
                        </tr>
                        <tr>
                            <td>8312</td>
                            <td>Nova Corp</td>
                            <td>Analytics Pro</td>
                            <td>13-01-2025</td>
                        </tr>
                        <tr>
                            <td>8313</td>
                            <td>Lambda Tech</td>
                            <td>Compliance Kit</td>
                            <td>14-01-2025</td>
                        </tr>
                        <tr>
                            <td>8314</td>
                            <td>Omega Inc</td>
                            <td>Case Manager</td>
                            <td>15-01-2025</td>
                        </tr>
                        <tr>
                            <td>8315</td>
                            <td>Delta Systems</td>
                            <td>Risk Assessment</td>
                            <td>16-01-2025</td>
                        </tr>
                        <tr>
                            <td>8315</td>
                            <td>Delta Systems</td>
                            <td>Risk Assessment</td>
                            <td>16-01-2025</td>
                        </tr>
                        <tr>
                            <td>8315</td>
                            <td>Delta Systems</td>
                            <td>Risk Assessment</td>
                            <td>16-01-2025</td>
                        </tr>


                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <div class="row">
                {{-- <div class="col-6 d-flex flex-column justify-content-between">
                        <h5 class="card-title">Financial Snapshot</h5>
                        <ul class="list-unstyled small mt-auto">
                            <li><span class="text-success">■</span> Expenses</li>
                            <li><span class="text-primary">■</span> Overdue Payments</li>
                        </ul>
                    </div> --}}
                {{-- <div class="col-6 ps-0">

                        <img src="{{ asset('admin/images/map-3 (3).svg') }}" class="img-fluid" width="1000px"
                alt="Case Breakdown">
            </div> --}}


            <div class="col-12 d-flex flex-column justify-content-between">
                {{-- <div class="card p-3" style="max-width: 400px;"> --}}
                <h5 class="card-title">Financial Snapshot</h5>
                <div class="d-flex align-items-center gap-3">
                    <!-- Legend -->
                    <div>
                        <p class="mb-1"><span class="badge bg-success me-1">&nbsp;</span>Expenses</p>
                        <p class="mb-0"><span class="badge bg-primary me-1 text-nowrap">&nbsp;</span>Overdue Payments</p>
                    </div>

                    <!-- Charts -->
                    <div class="d-flex gap-3" style="margin-left: 60px">
                        <div class="position-relative">
                            <canvas id="expensesChart" width="80" height="80"></canvas>
                            <div class="position-absolute top-50 start-50 translate-middle text-success text-center">
                                <i class="bi bi-graph-up-arrow"></i><br>
                                <small>$245</small>
                            </div>
                        </div>

                        <div class="position-relative">
                            <canvas id="overdueChart" width="80" height="80"></canvas>
                            <div class="position-absolute top-50 start-50 translate-middle text-primary text-center">
                                <i class="bi bi-graph-up-arrow"></i><br>
                                <small>$101</small>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body" style="height: 310px;">
        <h5 class="card-title">Overdue Payments</h5>
        <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th>Case ID</th>
                        <th>Case Name</th>
                        <th>Invoice Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>8311</td>
                        <td>ABC Company</td>
                        <td class="text-red">12-01-2025</td>
                    </tr>
                    <tr>
                        <td>8312</td>
                        <td>Nova Corp</td>
                        <td class="text-red">13-01-2025</td>
                    </tr>
                    <tr>
                        <td>8313</td>
                        <td>Lambda Tech</td>
                        <td class="text-red">14-01-2025</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>

</div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('departmentPerformanceChart').getContext('2d');

    const departmentPerformanceChart = new Chart(ctx, {
        type: 'bar', // Change to 'pie' or 'doughnut' if you prefer
        data: {
            labels: ['Total Destruction', 'Destruction Pending', 'Destruction Scheduled'
                , 'Destruction Completed'
            ]
            , datasets: [{
                label: 'Performance'
                , data: [120, 80, 50, 70, 90], // <-- Replace with your dynamic values
                backgroundColor: [
                    'rgba(75, 192, 192, 0.6)'
                    , 'rgba(153, 102, 255, 0.6)'
                    , 'rgba(255, 159, 64, 0.6)'
                    , 'rgba(255, 205, 86, 0.6)'
                    , 'rgba(54, 162, 235, 0.6)'
                ]
                , borderColor: [
                    'rgba(75, 192, 192, 1)'
                    , 'rgba(153, 102, 255, 1)'
                    , 'rgba(255, 159, 64, 1)'
                    , 'rgba(255, 205, 86, 1)'
                    , 'rgba(54, 162, 235, 1)'
                ]
                , borderWidth: 1
            }]
        }
        , options: {
            responsive: true
            , scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

</script>

{{-- Case Breakdown --}}
<script>
    const ctxs = document.getElementById('myPieChart').getContext('2d');

    const data = {
        labels: ['Market Investigation', 'Custom Enforcement', 'Legal Investigation']
        , datasets: [{
            label: 'My Dataset'
            , data: [25, 40, 35]
            , backgroundColor: ['green', 'red', 'blue']
            , backgroundColor: ['green', 'red', 'blue']
            , borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)']
            , borderWidth: 1
        }]
    };

    const config = {
        type: 'pie'
        , data: data
        , options: {
            responsive: true
            , plugins: {
                legend: {
                    display: false // Hide default legend
                }
            }
        }
    };

    const myPieChart = new Chart(ctxs, config);

    // Generate custom legend manually
    const legendContainer = document.getElementById('chartLegend');
    data.labels.forEach((label, i) => {
        const color = data.datasets[0].backgroundColor[i];
        const item = document.createElement('div');
        item.style.display = 'flex';
        // item.style.justifyContent = 'space-between';
        item.style.alignItems = 'center';
        item.style.marginBottom = '8px';

        item.innerHTML = `
            <div style="width: 15px; height: 15px; background-color: ${color}; margin-right: 10px; border-radius: 3px;"></div>
            <span>${label}</span>
        `;
        legendContainer.appendChild(item);
    });

</script>

{{-- Enforcement --}}
<script>
    function createDonutChart(ctxId, value, color) {
        const ctx = document.getElementById(ctxId).getContext('2d');
        new Chart(ctx, {
            type: 'doughnut'
            , data: {
                datasets: [{
                    data: [value, 5 - value]
                    , backgroundColor: [color, '#e0e0e0']
                    , borderWidth: 0
                }]
            }
            , options: {
                cutout: '75%'
                , responsive: false
                , plugins: {
                    legend: {
                        display: false
                    }
                    , tooltip: {
                        enabled: false
                    }
                }
            }
        });
    }

    createDonutChart('chart1', 5, '#0057B7'); // Blue
    createDonutChart('chart2', 2, '#00AEEF'); // Light Blue
    createDonutChart('chart3', 1, '#00C853'); // Green
    createDonutChart('chart4', 1, '#FFA000'); // Orange
    createDonutChart('chart5', 1, '#616161'); // Gray

</script>


{{-- department performance --}}
<script>
    const values = {
        'Total Destruction': 10
        , 'Destruction Pending': 5
        , 'Destruction Schedule': 3
        , 'Destruction Completed': 2
    };
    const max = values['Total Destruction'];

    document.querySelectorAll('.progress-row').forEach(row => {
        const label = row.querySelector('.label-row span').textContent.trim();
        const bar = row.querySelector('.progress-bar');
        if (bar && values[label]) {
            const percent = (values[label] / max) * 100;
            bar.style.width = percent + '%';
        }
    });

</script>


{{-- Financial --}}
<script>
    // Expenses Chart (Green)
    new Chart(document.getElementById('expensesChart'), {
        type: 'doughnut'
        , data: {
            datasets: [{
                data: [75, 25], // 75% filled
                backgroundColor: ['#28a745', '#e0e0e0']
                , borderWidth: 0
            }]
        }
        , options: {
            cutout: '70%'
            , plugins: {
                legend: {
                    display: false
                }
                , tooltip: {
                    enabled: false
                }
            }
        }
    });

    // Overdue Payments Chart (Blue)
    new Chart(document.getElementById('overdueChart'), {
        type: 'doughnut'
        , data: {
            datasets: [{
                data: [45, 55], // 45% filled
                backgroundColor: ['#0d6efd', '#e0e0e0']
                , borderWidth: 0
            }]
        }
        , options: {
            cutout: '70%'
            , plugins: {
                legend: {
                    display: false
                }
                , tooltip: {
                    enabled: false
                }
            }
        }
    });

</script>

@endsection
