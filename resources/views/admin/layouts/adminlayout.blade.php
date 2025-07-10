<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.component.style')
    @yield('style')
    <style>
        /* dropzone */
        .dropzone {
            border: 2px dashed #000;
            border-radius: 10px;
            height: 110px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            cursor: pointer;
            transition: 0.3s;
            background-color: #fff;
            position: relative;
        }

        .dropzone.dragover {
            background-color: #f8f9fa;
            border-color: #6c757d;
        }

        .dropzone input {
            display: none;
        }

        .dropzone .placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .dropzone-icon {
            width: 64px;
            margin-bottom: 10px;
        }

        .dropzone img#previewImg {
            height: 100%;
            width: 100%;
            object-fit: contain; /* or use cover if you prefer filling */
            border-radius: 10px;
        }

    </style>
</head>
<body>


    <div class="container-fluid d-flex g-0" style="height: 100%">
        @include('admin.component.sidebar')

        <div class="main-content">
            @include('admin.component.navbar')

            @yield('main-content')

            {{-- Submit button --}}

            {{-- <div class="modal fade" id="confirmSubmitModal" tabindex="-1" aria-labelledby="confirmSubmitModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-4">
                    <div class="modal-header">
                        <h6 class="modal-title" id="confirmSubmitModalLabel" style="color: #161616;">Successfully Added</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <a href="#" class="btn btn-cancel" data-bs-toggle="modal" data-bs-target="#confirmRedirectModal"
                            data-url="{{ route('brand.create') }}">
                            <img src="{{ asset('admin/images/add.svg') }}" alt="Icon" class="img-fluid me-3">
                            Add Brand
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
            </div> --}}

            {{-- <div class="modal fade" id="confirmSubmitModal" tabindex="-1" aria-labelledby="confirmSubmitModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-4">
                        <div class="modal-header">
                            <h6 class="modal-title" id="confirmSubmitModalLabel" style="color: #161616;">Successfully Added</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div id="addBrandBtnWrapper" style="display: none;">
                                <a href="#" class="btn btn-cancel" data-bs-toggle="modal" data-bs-target="#confirmRedirectModal"
                                data-url="{{ route('brand.create') }}">
                                    <img src="{{ asset('admin/images/add.svg') }}" alt="Icon" class="img-fluid me-3">
                                    Add Brand
                                </a>
                            </div>
                            <div id="addProductBtnWrapper" style="display: none;">
                                <a href="#" class="btn btn-cancel" data-bs-toggle="modal" data-bs-target="#confirmRedirectModal"
                                data-url="{{ route('brand.create') }}">
                                    <img src="{{ asset('admin/images/add.svg') }}" alt="Icon" class="img-fluid me-3">
                                    Add Brand
                                </a>
                            </div>
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
            </div> --}}




            {{-- <div class="modal fade" id="confirmRedirectModal" tabindex="-1" aria-labelledby="confirmRedirectModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-4">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmRedirectModalLabel">Successfuly Added</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure want to add Data?
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="confirmRedirectBtn">Confirm</button>
                    </div>
                    </div>
                </div>
            </div> --}}

            {{-- Modal for Edit --}}
            <div class="modal fade" id="confirmEditModal" tabindex="-1" aria-labelledby="confirmEditModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-4">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmEditModalLabel">Confirm Edit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to edit?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="confirmEditBtn">Confirm</button>
                    </div>
                    </div>
                </div>
            </div>


        </div>
    </div>


    <!-- javascript -->

    @include('admin.component.javascript')
    @yield('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const confirmModal = document.getElementById('confirmSubmitModal');

            confirmModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const hasBrand = button.getAttribute('data-brand'); // "brand" or null

                const brandWrapper = document.getElementById('addBrandBtnWrapper');

                if (hasBrand === 'brand') {
                    brandWrapper.style.display = 'block';
                }
                else if (hasBrand === 'product') {
                    brandWrapper.style.display = 'block';
                }
                else {
                    brandWrapper.style.display = 'none';
                }
            });
        });
</script>

    <script>

        document.addEventListener("DOMContentLoaded", function() {
            const hamburger = document.getElementById("hamburger");
            const sidebar = document.getElementById("sidebar");
            const closeBtn = document.getElementById("closeBtn");

            hamburger.addEventListener("click", function() {
                sidebar.classList.add("active");
            });

            closeBtn.addEventListener("click", function() {
                sidebar.classList.remove("active");
            });
        });

        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function() {
                // Remove active from all nav-links
                document.querySelectorAll('.nav-link').forEach(el => el.classList.remove('active'));
                // Add active to clicked link
                this.classList.add('active');
            });
        });

    </script>
    <script>

        // Image preview
        document.getElementById('logoInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('previewImg');
            const placeholder = document.getElementById('placeholderImg');

            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    placeholder.style.display = 'none'; // now hide the text and icon
                };
                reader.readAsDataURL(file);
            }
        });

        // PDF filename
        document.getElementById('logoInput2').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const filenameEl = document.getElementById('pdfFilename');
            const placeholder = document.getElementById('placeholderPdf');

            if (file && file.type === "application/pdf") {
                filenameEl.textContent = file.name;
                filenameEl.style.display = 'block';
                placeholder.style.display = 'none';
            }
        });

        // Drag and drop effects
        ['dropzoneImg', 'dropzonePdf'].forEach(id => {
            const dropzone = document.getElementById(id);

            dropzone.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropzone.classList.add('dragover');
            });

            dropzone.addEventListener('dragleave', () => {
                dropzone.classList.remove('dragover');
            });

            dropzone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropzone.classList.remove('dragover');
                const input = dropzone.querySelector('input');
                input.files = e.dataTransfer.files;
                input.dispatchEvent(new Event('change'));
            });
        });

</script>
<script>
    // submit form
    document.getElementById('confirmSubmitBtn').addEventListener('click', function () {
        document.getElementById('mainForm').submit();
    });
</script>
<script>
    let redirectUrl = '';
    // When modal is triggered, get the button's data-url
    document.querySelectorAll('[data-bs-target="#confirmRedirectModal"]').forEach(button => {
        button.addEventListener('click', function () {
            redirectUrl = this.getAttribute('data-url');
        });
    });

    // When "Yes, Go" is clicked in the modal
    document.getElementById('confirmRedirectBtn').addEventListener('click', function () {
        if (redirectUrl) {
            window.location.href = redirectUrl;
        }
    });
</script>
{{-- Edit script --}}
<script>
    let editUrl = '';

    document.querySelectorAll('[data-bs-target="#confirmEditModal"]').forEach(button => {
        button.addEventListener('click', function () {
            editUrl = this.getAttribute('data-url');
        });
    });

    document.getElementById('confirmEditBtn').addEventListener('click', function () {
        if (editUrl) {
            window.location.href = editUrl;
        }
    });
</script>
<script>
    $(function () {
        $('.datepickerdesign').datepicker({
            dateFormat: "yy-mm-dd",
            changeYear: true,            // Enable year dropdown
            changeMonth: true,            // Enable year dropdown
            yearRange: "c-100:c+10"      // Optional: last 100 years to 10 years from now
        });
    });
</script>

</body>
</html>
