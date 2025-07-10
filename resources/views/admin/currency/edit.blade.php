@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">

    <form id="mainForm" action="{{ route('currency.update', $currn->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row px-4">
            <div class="col-12 mb-3 ">
                <!-- Title -->
                <div class="fw-bold fs-4 me-3">Edit Currency</div>
            </div>
            <div class="col-md-10 p-3">
                <div class="row">
                    <div class="col-md-10">
                        <div class="mt-3">
                            <label class="eighteenblack mb-2">Currency*</label>
                            <select name="currency_name" id="currency" class="form-control">
                                <option value="">-- Select Currency --</option>
                                @foreach ($currencies as $currency)
                                    <option value="{{ $currency['code'] }}"
                                       {{ $currn->currency_name == $currency['code'] ? 'selected' : '' }} >
                                        {{ $currency['name'] }} ({{ $currency['code'] }}) - {{ $currency['symbol'] }}
                                    </option>
                                    {{-- {{ $currency->currency_name == $currencies['code'] ? 'selected' : '' }} --}}
                                @endforeach
                            </select>
                            @error('currency_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
{{-- {{ dd($currn) }} --}}
                    <div class="col-md-2">
                        <div class="container d-flex justify-content-center">
                            <label class="dropzone" id="dropzoneImg" style="height:100px">
                                <input type="file" name="symbol" id="logoInput" accept="image/*">
                                <div id="placeholderImg">
                                    @if($currn->symbol)
                                        <img src="{{ asset('storage/'.$currn->symbol) }}" alt="Upload Icon" class="dropzone-icon">
                                    @else
                                        <img src="{{ asset('admin/images/Icon.svg') }}" alt="Upload Icon" class="dropzone-icon">
                                    @endif
                                    <div class="label_title">Upload Symbol</div>
                                </div>
                                <img id="previewImg" style="display: none;" />
                            </label>
                        </div>
                    </div>
                </div>


                <div class="row">

                    <div class="col-md-6">
                        <div>
                            <label class="eighteenblack mb-2">Country Name*</label>
                            <select name="country_name" id="country_name" class="form-control">
                                <option value="">-- Select Country --</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country['name'] }}" data-code="{{ $country['dial_code'] }}"
                                        {{ $currn->country_name == $country['name'] ? 'selected' : '' }}>
                                        {{ $country['name'] }}
                                    </option>
                                @endforeach
                            </select>
                            @error('country_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="">
                            <label class="eighteenblack mb-2">Country Code*</label>
                            <input type="text" name="country_code" id="country_code" class="form-control" value="{{ old('country_code') }}" readonly>
                            @error('country_code')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-12 mb-3 d-flex justify-content-between">
                <div>
                </div>
                <div>
                    <a href="{{ route('currency.index') }}" type="button" class="btn btn-cancel me-2">Cancel</a>
                    <button type="button" class="btn btn-primary px-5 py-2" data-bs-toggle="modal" data-bs-target="#confirmSubmitModal">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>


<div class="modal fade" id="confirmSubmitModal" tabindex="-1" aria-labelledby="confirmSubmitModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <h6 class="modal-title" id="confirmSubmitModalLabel" style="color: #161616;">Confirm Submision</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <span style="font-size: 18px;">Are you sure want to submit this form?</span>
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const countrySelect = document.getElementById('country_name');
        const codeInput = document.getElementById('country_code');

        countrySelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const code = selectedOption.getAttribute('data-code');
            codeInput.value = code || '';
        });

        // Trigger change if old value exists
        if (countrySelect.value) {
            countrySelect.dispatchEvent(new Event('change'));
        }
    });

</script>
@endsection
