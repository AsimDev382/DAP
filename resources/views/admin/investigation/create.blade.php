@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">
    @section('style')
    <link rel="stylesheet" href="{{ url('admin/css/style.css') }}">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <style>
        .datepickerdesign ::placeholder {
            color: #c9c9c9;

        }

    </style>
    @endsection
    <!-- Form -->
    <form id="mainForm" action="{{ route('investigation.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row px-4">
            <div class="col-12 mb-4 ">
                <!-- Title -->
                <div class="fw-bold fs-4 me-3">Assign Case’s Investigation</div>
            </div>
            @php
            $latestUser = \App\Models\Investigation::orderBy('id', 'desc')->first();
            $nextNumber = $latestUser ? $latestUser->id + 1 : 1;
            $code = 'DP-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
            @endphp
            <div class="col-md-10">
                <div class="row d-flex align-items-baseline">
                    <div class="col-md-4">
                        <div class="my-3">
                            <label class="eighteenblack mb-2">DAP ID</label>
                            <input type="text" name="auto_id" class="form-control" value="{{ $code }}" readonly id="name" placeholder="Enter Department Name">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="my-3">
                            <label class="eighteenblack mb-2">Investigation Name*</label>
                            <input type="text" name="invest_name" value="{{ old('invest_name') }}" class="form-control" placeholder="Enter Investigation Name">
                        </div>
                    </div>
                    {{-- <div class="col-md-4">
                        <div class="my-3">
                            <label class="eighteenblack ">Client ID</label>
                            <input type="text" name="client_id" name="client_id" value="{{ $code.'-'.'client' }}" readonly class="form-control">
                        </div>
                    </div> --}}
                    <div class="col-md-4">
                        <div class="my-3">
                            <label class="eighteenblack mb-2">Case Name*</label>
                            <select name="case_id" id="case_id" class="form-control">
                                <option selected disabled>Select Case</option>
                                @foreach ($cases as $case)
                                <option value="{{ $case->id }}" {{ old('case_id') == $case->id ? 'selected' : '' }}>{{ $case->case_name }}</option>
                                @endforeach
                            </select>
                            @error('case_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            {{-- <input type="text" name="case_name" class="form-control" id="name"> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="container d-flex justify-content-center">
                    <label class="dropzone" style="   height: 120px;" id="dropzoneImg">
                        <input type="file" name="document" id="logoInput" accept="image/*">
                        <div id="placeholderImg">
                            <img src="{{ asset('admin/images/Icon.svg') }}" alt="Upload Icon" class="dropzone-icon">
                            <div class="label_title">Upload Investigation <br>Logo here</div>
                        </div>
                        <img id="previewImg" style="display: none;" />
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div>
                    <label class="eighteenblack mb-2">Case Type*</label>
                    <input type="text" name="case_type" id="case_type" value="{{ old('case_type') }}" class="form-control" readonly placeholder="Auto Pick">
                </div>
            </div>
            <div class="col-md-3">
                <div class="">
                    <label class="eighteenblack mb-2">Company*</label>
                    <input type="text" id="company_id" value="{{ old('company_id') }}" class="form-control" readonly placeholder="Auto Pick">
                    <input type="hidden" name="company_id" id="hideCompany_id">
                    {{-- <select name="company_id" class="form-control">
                    <option selected disabled>Select Company</option>
                    @foreach ($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                    @endforeach
                    </select> --}}
                    @error('company_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="">
                    <label class="eighteenblack mb-2">Brand*</label>
                    <input type="text" id="brand_id" value="{{ old('brand_id') }}" class="form-control" readonly placeholder="Auto Pick">
                    <input type="hidden" name="brand_id" id="hideBrand_id">
                    {{-- <select name="brand_id" class="form-select" aria-label="Default select example">
                    <option selected disabled>Select Brand</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                    @endforeach
                    </select> --}}
                    @error('brand_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="">
                    <label class="eighteenblack mb-2">Products*</label>
                    <input type="text" id="product_id" value="{{ old('product_id') }}" class="form-control" readonly placeholder="Auto Pick">
                    <input type="hidden" name="product_id" id="hideProduct_id">
                    {{-- <select name="product_id" class="form-select" aria-label="Default select example">
                    <option selected disabled>Select Product</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                    @endforeach
                    </select> --}}
                    @error('product_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="my-3">
                    <label class="eighteenblack mb-2">Current Status*</label>
                    <select name="current_status" class="form-select" aria-label="Default select example">
                        <option disabled {{ old('current_status') ? '' : 'selected' }}>Select Status</option>
                        <option value="Pending Approval" {{ old('current_status') == 'Pending Approval' ? 'selected' : '' }}>Pending Approval</option>
                        <option value="In Progress" {{ old('current_status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Approved" {{ old('current_status') == 'Approved' ? 'selected' : '' }}>Approved</option>
                        <option value="Closed(Completed)" {{ old('current_status') == 'Closed(Completed)' ? 'selected' : '' }}>Closed(Completed)</option>
                        <option value="High-Risk-case" {{ old('current_status') == 'High-Risk-case' ? 'selected' : '' }}>High-Risk-case</option>
                        <option value="Reopened Cases" {{ old('current_status') == 'Reopened Cases' ? 'selected' : '' }}>Reopened Cases</option>
                    </select>
                    @error('current_status')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="my-3">
                    <label class="eighteenblack mb-2">Location*</label>
                    <input type="text" name="location" value="{{ old('location') }}" class="form-control" id="name" placeholder="Enter Location">
                    @error('location')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="my-3">
                    <label class="eighteenblack mb-2">Assign Case*</label>
                    <select name="user_id" class="form-select" aria-label="Default select example">
                        <option selected disabled>Select User</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                    {{-- <select name="assign_case" class="form-select" aria-label="Default select example">
                        <option selected>Nutella</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select> --}}
                    @error('assign_case')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="">
                    <label class="eighteenblack mb-2">Task Start Date*</label>
                    <input type="text" name="task_start_date" value="{{ old('task_start_date') }}" class="form-control datepickerdesign" placeholder="Enter Start Date">
                    @error('task_start_date')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="">
                    <label class="eighteenblack mb-2">Task Deadline*</label>
                    <input type="text" name="task_deadline" value="{{ old('task_deadline') }}" class="form-control datepickerdesign" placeholder="Enter Task Deadline">
                    @error('task_deadline')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3 mt-3">
                    <label for="userDetail" class="eighteenblack mb-2">Investigation Description (optional)</label>
                    <textarea name="investigation_description" class="form-control" id="companydetail" rows="Investigation Details (optional)5" placeholder="Type Investigation details..."></textarea>
                </div>
            </div>



            <div class="col-md-12 mb-3 d-flex justify-content-between">
                <div>
                    <a href="#" class="btn btn-cancel" data-bs-toggle="modal" data-bs-target="#confirmRedirectModal"
                        data-url="{{ route('raid.plaining.create') }}">
                        <img src="{{ asset('admin/images/add.svg') }}" alt="Icon" class="img-fluid me-3">
                        Add Raid
                    </a>
                </div>
                <div> <a href="{{ route('investigation.index') }}" class="btn btn-cancel me-2">Cancel</a>
                    <button type="button" class="btn btn-primary px-5 py-2" data-bs-toggle="modal" data-bs-target="#confirmSubmitModal">
                        Submit
                    </button>
                </div>
            </div>
        </div>

        <div class="modal fade" id="confirmRedirectModal" tabindex="-1" aria-labelledby="confirmRedirectModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmRedirectModalLabel">Confirm Submission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure want to submit this data?
                </div>
                <div class="modal-footer">

                    <a href="{{ route('raid.plaining.create') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary" name="action" value="Raid">Confirm</button>
                </div>
                </div>
            </div>
        </div>

    </form>
</div>

<div class="modal fade" id="confirmSubmitModal" tabindex="-1" aria-labelledby="confirmSubmitModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <h6 class="modal-title" id="confirmSubmitModalLabel" style="color: #161616;">Are you sure want to submit this form?</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <a href="#" class="btn btn-cancel" data-bs-toggle="modal" data-bs-target="#confirmRedirectModal"
                    data-url="{{ route('raid.plaining.create') }}">
                    <img src="{{ asset('admin/images/add.svg') }}" alt="Icon" class="img-fluid me-3">
                    Add Raid
                </a>
            </div>

            <div class="modal-footer justify-content-between">
                <div class="float-left">
                    <input type="checkbox"> Don't show again
                </div>

                <div class="float-left">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmSubmitBtn">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
    $(document).ready(function() {
        $('#case_id').change(function() {
            var caseId = $(this).val();

            if (caseId) {
                $.ajax({
                    url: '/get-case-data/' + caseId, // The route you'll create
                    type: 'GET'
                    , success: function(response) {
                        console.log(response.company_id);

                        $('#case_type').val(response.case_type);
                        $('#brand_id').val(response.brand_id.brand_name);
                        $('#product_id').val(response.product_id.product_name);
                        $('#company_id').val(response.company_id.company_name);

                        $('#hideBrand_id').val(response.brand_id.id);
                        $('#hideProduct_id').val(response.product_id.id);
                        $('#hideCompany_id').val(response.company_id.id);
                    }
                    , error: function() {
                        alert('Error fetching case type.');
                    }
                });
            } else {
                $('#case_type, #brand_id, #product_id, #company_id').val('');
            }
        });
    });

</script>
@endsection
