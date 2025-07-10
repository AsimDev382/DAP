@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">

    <div class="row p-3">
        <div class="col-12 mb-4 case-bar ">
            <div class="row d-flex align-items-center justify-content-between flex-nowrap gap-3">

                <!-- Title -->
                <div class="col-1 text-nowrap">
                    <p class="fw-bold fs-5 me-0 m-0">Finance</p>
                </div>

                <!-- Search -->
                <div class="col-6">
                    <div class="case-search flex-grow-1">
                        <i class="fas fa-search"></i>
                        <input type="text" class="form-control" placeholder="Search here..." />
                    </div>
                </div>

                <!-- Icons -->
                <div class="col-3 d-flex justify-content-end">
                    <div class="d-flex gap-3 align-items-center ">
                        <i class="bi bi-filter fs-3 text-dark" role="button"></i>
                        <i class="bi bi-arrow-down-up fs-5 text-dark" role="button"></i>
                        {{-- <a href="#" type="submit" class="btn btn-primary px-5 py-2">Finance</a> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table align-middle text-center">
                  <thead class="table-light">
                    <tr>
                      <th>Sr #</th>
                      <th>User ID</th>
                      <th>Mobile/Phone</th>
                      <th>Email</th>
                      <th>Location</th>
                      <th>Invoice Date</th>
                      <th>Amount</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>01</td>
                      <td>DP0123</td>
                      <td>+92 312 345 6789</td>
                      <td>katemorrison@gmail.com</td>
                      <td>Islamabad</td>
                      <td>12/01/2025</td>
                      <td>$10,000</td>
                      <td>
                        <span class="status-badge status-pending">
                          <span class="status-dot"></span> Pending
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td>01</td>
                      <td>DP0123</td>
                      <td>+92 312 345 6789</td>
                      <td>katemorrison@gmail.com</td>
                      <td>Islamabad</td>
                      <td>12/01/2025</td>
                      <td>$10,000</td>
                      <td>
                        <span class="status-badge status-approved">
                          <span class="status-dot"></span> Approved
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td>01</td>
                      <td>DP0123</td>
                      <td>+92 312 345 6789</td>
                      <td>katemorrison@gmail.com</td>
                      <td>Islamabad</td>
                      <td>12/01/2025</td>
                      <td>$10,000</td>
                      <td>
                        <span class="status-badge status-rejected">
                          <span class="status-dot"></span> Rejected
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td>01</td>
                      <td>DP0123</td>
                      <td>+92 312 345 6789</td>
                      <td>katemorrison@gmail.com</td>
                      <td>Islamabad</td>
                      <td>12/01/2025</td>
                      <td>$10,000</td>
                      <td>
                        <span class="status-badge status-approved">
                          <span class="status-dot"></span> Approved
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td>01</td>
                      <td>DP0123</td>
                      <td>+92 312 345 6789</td>
                      <td>katemorrison@gmail.com</td>
                      <td>Islamabad</td>
                      <td>12/01/2025</td>
                      <td>$10,000</td>
                      <td>
                        <span class="status-badge status-approved">
                          <span class="status-dot"></span> Approved
                        </span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
        </div>
    </div>
</div>

@endsection
