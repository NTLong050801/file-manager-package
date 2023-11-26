<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@300;500;700">
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{asset('vendor/file-manager/css/plugins.bundle.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('vendor/file-manager/css/style.bundle.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('vendor/file-manager/css/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
    {{--    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />--}}
</head>
<div id="kt_app_content_container" class="app-container container-xxl">
    <!--begin::Card-->
    <div class="card card-flush">
        <!--begin::Card header-->
        <div class="card-header pt-8">
            <div class="card-title">
                <div class="input-group">
                    <select
                        class="form-select w-200px"
                        id="type_folder"
                        name="type_folder"
                        data-tags="false"
                        data-control="select2"
                        data-placeholder="Tất cả"
                    >
                        <option value="all-folder">Tất cả</option>
                        <option value="deleted-folder">Đã xoá</option>
                        <option value="private-folder">Tài liệu cá nhân</option>
                        <option value="share-folder">Tài liệu được chia sẻ</option>
                    </select>
                </div>
            </div>
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-filemanager-table-toolbar="base" id="toolbar_upload">
                    <!--begin::Export-->
                    <button type="button" class="btn btn-sm btn-light-primary me-3" data-bs-toggle="modal"
                            data-bs-target="#create_folder_modal">
                        <!--begin::Svg Icon | path: icons/duotune/files/fil013.svg-->
                        <span class="svg-icon svg-icon-2">
								<img src="{{asset('vendor/file-manager/icons/fil013.svg')}}" alt="">
							</span>
                        <!--end::Svg Icon-->Tạo thư mục
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="create_folder_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="create_folder_form">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tạo mới thư mục</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label class="form-label mb-2" for="value">
                                            <span class="required">Tên thư mục</span>
                                        </label>
                                        <input class="form-control" id="name_folder" placeholder="Nhập tên thư mục"
                                               name="name" required/>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng
                                        </button>
                                        <button type="submit" class="btn btn-primary" id="btn_store_folder">Tạo mới
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end::Export-->
                    <!--begin::Add customer-->
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_upload">
                        <!--begin::Svg Icon | path: icons/duotune/files/fil018.svg-->
                        <span class="svg-icon svg-icon-2">
                                <img src="{{asset('vendor/file-manager/icons/fil018.svg')}}" alt="">
							</span>
                        <!--end::Svg Icon-->Tải file
                    </button>
                    <!--end::Add customer-->
                </div>
                <!--end::Toolbar-->
                <!--begin::Group actions-->
                <div class="d-flex justify-content-end align-items-center d-none" id="selected_checkbox">
                    <div class="fw-bold me-5">
                        <span class="me-2" id="selected_count"></span>đã chọn
                    </div>
                    <button type="button" class="btn btn-sm btn-danger" id="btn_delete_selected">Xoá đã chọn</button>
                    <button type="button" class="btn btn-sm btn-primary ms-3" id="btn_export_selected">Xuất đã chọn
                    </button>
                </div>
                <!--end::Group actions-->
                <div class="d-flex justify-content-end align-items-center ms-5 d-none" id="selected_checkbox_restore">
                    <button type="button" class="btn btn-sm btn-success" id="btn_restore_selected">Khôi phục</button>
                </div>
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body">
            <!--begin::Table header-->
            <div class="d-flex flex-stack">
                <!--begin::Folder path-->
                <div class="badge badge-lg badge-light-primary">
                    <div class="d-flex align-items-center flex-wrap" id="folder_path">

                    </div>
                </div>
                <!--end::Folder path-->
                <!--begin::Folder Stats-->
                <div class="badge badge-lg badge-primary">
                    <span id="count_item"> </span>
                </div>
                <!--end::Folder Stats-->
            </div>
            <!--end::Table header-->
            <!--begin::Table-->
            <div id="kt_file_manager_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="table-responsive">
                    <div class="">
                        <div class="dataTables_scrollHead">
                            <div class="dataTables_scrollHeadInner">
                                <table data-kt-filemanager-table="folders"
                                       class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                                       id="table_data">
                                    <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="w-10px pe-2 sorting_disabled" rowspan="1" colspan="1">
                                            <div class="form-check me-3">
                                                <input class="form-check-input border-black checkbox-all"
                                                       type="checkbox" data-kt-check="true"
                                                       data-kt-check-target="#kt_file_manager_list .form-check-input"
                                                       value="1">
                                            </div>
                                        </th>
                                        <th>STT</th>
                                        <th class="min-w-200px sorting_disabled" rowspan="1" colspan="1">Tên</th>
                                        <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">Người tạo</th>
                                        <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">Kích thước</th>
                                        <th class="min-w-150px sorting_disabled" rowspan="1" colspan="1">Phân quyền</th>
                                        <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">Ngày tạo</th>
                                        <th class="min-w-60px sorting_disabled" rowspan="1" colspan="1">Tải xuống</th>
                                        <th class="w-50px sorting_disabled" rowspan="1" colspan="1"></th>
                                    </tr>
                                    <!--end::Table row-->
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div
                        class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start"></div>
                    <div
                        class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end"></div>
                </div>
            </div>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>


    <!--end::Card-->
    <!--begin::Checkbox template-->
    <div class="d-none" data-kt-filemanager-template="checkbox">
        <div class="form-check form-check-sm form-check-custom form-check-solid">
            <input class="form-check-input" type="checkbox" value="1">
        </div>
    </div>
    <!--end::Checkbox template-->
    <!--begin::Modals-->
    <!--begin::Modal - Upload File-->
    <div class="modal fade" id="kt_modal_upload" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form" action="none" id="modal_upload_form" enctype="multipart/form-data">
                    <!--begin::Modal header-->
                    <div class="modal-header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bold">Tải file</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1">
                                    <img src="{{asset('vendor/file-manager/icons/arr061.svg')}}" alt="">
                                </span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--end::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body pb-15 px-lg-17">
                        <!--begin::Input group-->
                        <div class="form-group">
                            <!--begin::Dropzone-->
                            <div class="dropzone dropzone-queue mb-2" id="kt_modal_upload_dropzone">
                                <!--begin::Controls-->
                                <div class="dropzone-panel mb-4">
                                    <a class="dropzone-select btn btn-sm btn-primary me-2">Đính kèm tập tin</a>
                                    <a class="dropzone-upload btn btn-sm btn-light-primary me-2">Tải tất cả</a>
                                    <a class="dropzone-remove-all btn btn-sm btn-light-primary">Xoá tất cả</a>
                                </div>
                                <!--end::Controls-->
                                <!--begin::Items-->
                                <div class="dropzone-items wm-200px">
                                    <div class="dropzone-item p-5" style="display:none">
                                        <!--begin::File-->
                                        <div class="dropzone-file">
                                            <div class="dropzone-filename text-dark" title="some_image_file_name.jpg">
                                                <span data-dz-name="">some_image_file_name.jpg</span>
                                                <strong>(
                                                    <span data-dz-size="">340kb</span>)</strong>
                                            </div>
                                            <div class="dropzone-error mt-0" data-dz-errormessage=""></div>
                                        </div>
                                        <!--end::File-->
                                        <!--begin::Progress-->
                                        <div class="dropzone-progress">
                                            <div class="progress bg-light-primary">
                                                <div class="progress-bar bg-primary" role="progressbar"
                                                     aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"
                                                     data-dz-uploadprogress=""></div>
                                            </div>
                                        </div>
                                        <!--end::Progress-->
                                        <!--begin::Toolbar-->
                                        <div class="dropzone-toolbar">
                                            <span class="dropzone-start">
                                                <i class="bi bi-play-fill fs-3"></i>
                                            </span>
                                            <span class="dropzone-cancel" data-dz-remove="" style="display: none;">
                                                <i class="bi bi-x fs-3"></i>
                                            </span>
                                            <span class="dropzone-delete" data-dz-remove="">
                                                <i class="bi bi-x fs-1"></i>
                                            </span>
                                        </div>
                                        <!--end::Toolbar-->
                                    </div>
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Dropzone-->
                            <!--begin::Hint-->
                            <span class="form-text fs-6 text-muted">Kích thước tệp tối đa là {{config('file-manager.capacity_max_file_upload
')}}MB mỗi tệp, tối đa {{config('file-manager.number_file_upload_each')}} tệp.</span>
                        </div>
                        <!--end::Input group-->
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
    <!--end::Modal - Upload File-->
    <!--end::Modals-->
    <!-- Modal -->
    <div class="modal fade" id="rename_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="rename_folder_form">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Đổi tên thư mục/ tệp</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label class="form-label mb-2" for="value">
                            <span class="required">Tên thư mục/ tệp</span>
                        </label>
                        <input class="form-control" id="name_folder_rename" placeholder="Nhập tên thư mục" name="name"
                               required/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" id="btn_update_folder">Đổi tên</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Rename modal-->
    <!--end::Checkbox template-->
    <div class="modal fade" id="kt_modal_move_to_folder" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#"
                      id="kt_modal_move_to_folder_form">
                    <!--begin::Modal header-->
                    <div class="modal-header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bold">Chuyển thư mục</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                          transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                          transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--end::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body pt-10 pb-15 px-lg-17">
                        <!--begin::Input group-->
                        <div class="form-group fv-row fv-plugins-icon-container " id="content_modal_move_file">

                        </div>
                        <!--end::Input group-->
                        <!--begin::Action buttons-->
                        <div class="d-flex flex-center mt-12">
                            <!--begin::Button-->
                            <button type="button" class="btn btn-primary" id="kt_modal_move_to_folder_submit">
                                <span class="indicator-label">Lưu</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                            <!--end::Button-->
                        </div>
                        <!--begin::Action buttons-->
                    </div>
                    <!--end::Modal body-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
    <!--end::Modal - Move file-->
    <!--end::Modals-->
    <!-- Modal -->
    <div class="modal fade" id="show_image_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="imageModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body align-self-center">
                    <img src="#" class="img-fluid" alt="...">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary download">Tải</button>
                </div>
            </div>
        </div>
    </div>
    <!--end::Rename modal-->

</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
{{--<script src="{{asset('vendor/file-manager/js/common.js')}}"></script>--}}
{{--<script src="{{asset('vendor/file-manager/js/scripts.bundle.js')}}"></script>--}}
<script>
    $(document).ready(function () {
        const renderHtmlFolder = (htmlId) => {
            let parentId = {{$parent->id}};
            {{--let csrfToken = "{{ csrf_token() }}";--}}
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            let userId = {{auth()->id()}};
            let rowId, tr, folderId = null;
            let navItemType = "all-folder";

            // set the dropzone container id
            const id = "#kt_modal_upload_dropzone";
            const dropzone = document.querySelector(id);

            var previewNode = dropzone.querySelector(".dropzone-item");
            previewNode.id = "";
            var previewTemplate = previewNode.parentNode.innerHTML;
            previewNode.parentNode.removeChild(previewNode);

            var myDropzone = new Dropzone(id, { // Make the whole body a dropzone
                url: "{{route('ajax.upload-file')}}", // Set the url for your upload script location
                parallelUploads: {{config('file-manager.number_file_upload_each')}},
                acceptedFiles: 'application/msword, text/csv, ' +
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel, ' +
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document, ' +
                    'application/pdf, application/vnd.ms-powerpoint, application/vnd.oasis.opendocument.text, ' +
                    'application/vnd.oasis.opendocument.spreadsheet, ' +
                    'application/vnd.oasis.opendocument.presentation, image/jpeg, ' +
                    'image/png, image/jpg, image/gif',
                dictInvalidFileType: "Loại tệp không hợp lệ. Vui lòng tải lên các tập tin thuộc loại .doc, .csv, .xlsx, .xls, .docx, .pdf, .ppt, .odt, .ods, .odp, .jpeg, .png, .jpg, .gif",
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                params: {
                    parent_id: parentId,
                },
                previewTemplate: previewTemplate,
                maxFilesize: {{config('file-manager.capacity_max_file_upload')}}, // Max filesize in MB
                dictFileTooBig: "Tệp quá lớn. Kích thước tối đa là {{config('file-manager.capacity_max_file_upload')}}MB.",
                autoProcessQueue: false, // Stop auto upload
                autoQueue: false, // Make sure the files aren't queued until manually added
                previewsContainer: id + " .dropzone-items", // Define the container to display the previews
                clickable: id + " .dropzone-select", // Define the element that should be used as click trigger to select files.
                init: function () {
                    this.on("error", function (file, errorMessage, xhr) {
                        var errorContainer = file.previewElement.querySelector('.dropzone-error');

                        // If the error container exists, update its content with the error message
                        if (errorContainer) {
                            errorContainer.innerText = errorMessage.message || errorMessage;
                        }
                    });
                    this.on("addedfile", function (file) {
                        if (this.files.length > this.options.parallelUploads) {
                            showToast("Đã vượt quá số lượng tải lên song song tối đa.", null, 'error');
                            this.removeFile(file); // Remove the exceeded file from the queue
                        }
                        const duplicateCount = this.files.reduce((count, f) => (f.name === file.name ? count + 1 : count), 0);
                        if (duplicateCount > 1) {
                            showToast("File đã tồn tại.", null, 'error');
                            this.removeFile(file);
                        }
                    });
                }
            });

            myDropzone.on("addedfile", function (file) {
                updateParentId(parentId);
                // Hook each start button
                file.previewElement.querySelector(id + " .dropzone-start").onclick = function () {
                    // myDropzone.enqueueFile(file);
                    myDropzone.processFile(file);
                    // Process simulation for demo only
                    const progressBar = file.previewElement.querySelector('.progress-bar');
                    progressBar.style.opacity = "1";
                    var width = 1;
                    var timer = setInterval(function () {
                        if (width >= 100) {
                            myDropzone.emit("success", file);
                            myDropzone.emit("complete", file);
                            clearInterval(timer);
                        } else {
                            width++;
                            progressBar.style.width = width + '%';
                        }
                    }, 20);
                };

                const dropzoneItems = dropzone.querySelectorAll('.dropzone-item');
                dropzoneItems.forEach(dropzoneItem => {
                    dropzoneItem.style.display = '';
                });
                dropzone.querySelector('.dropzone-upload').style.display = "inline-block";
                dropzone.querySelector('.dropzone-remove-all').style.display = "inline-block";
            });

            // Hide the total progress bar when nothing's uploading anymore
            myDropzone.on("complete", function (file) {
                const progressBars = dropzone.querySelectorAll('.dz-complete');
                setTimeout(function () {
                    progressBars.forEach(progressBar => {
                        progressBar.querySelector('.progress-bar').style.opacity = "0";
                        progressBar.querySelector('.progress').style.opacity = "0";
                        progressBar.querySelector('.dropzone-start').style.opacity = "0";
                    });
                }, 300);
            });

            // Setup the buttons for all transfers
            dropzone.querySelector(".dropzone-upload").addEventListener('click', function () {
                myDropzone.files.forEach(file => {
                    console.log(file)
                    if (file.status === 'added') {
                        myDropzone.enqueueFile(file);
                        const progressBar = file.previewElement.querySelector('.progress-bar');
                        progressBar.style.opacity = "1";
                        var width = 1;
                        var timer = setInterval(function () {
                            if (width >= 100) {
                                myDropzone.emit("success", file);
                                myDropzone.emit("complete", file);
                                clearInterval(timer);
                            } else {
                                width++;
                                progressBar.style.width = width + '%';
                            }
                        }, 20);
                    }
                });
                myDropzone.processQueue();
            });

            // Setup the button for remove all files
            dropzone.querySelector(".dropzone-remove-all").addEventListener('click', function () {
                Swal.fire({
                    text: "Bạn có chắc chắn muốn xóa tất cả các tập tin?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "OK, xoá!",
                    cancelButtonText: "Không, Huỷ",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-danger"
                    }
                }).then(function (result) {
                    if (result.value) {
                        dropzone.querySelector('.dropzone-upload').style.display = "none";
                        dropzone.querySelector('.dropzone-remove-all').style.display = "none";
                        myDropzone.removeAllFiles(true);
                    }
                });
            });

            // On all files completed upload
            myDropzone.on("queuecomplete", function (progress) {
                const uploadIcons = dropzone.querySelectorAll('.dropzone-upload');
                uploadIcons.forEach(uploadIcon => {
                    uploadIcon.style.display = "none";
                });

            });

            // On all files removed
            myDropzone.on("removedfile", function (file) {
                if (myDropzone.files.length < 1) {
                    dropzone.querySelector('.dropzone-upload').style.display = "none";
                    dropzone.querySelector('.dropzone-remove-all').style.display = "none";
                }
            });

            myDropzone.on("success", function (file, response) {
                if (response) {
                    showToast(response.message, null, 'success');
                    loadFolder();
                }
            });

            myDropzone.on("error", function (file, errorMessage, xhr) {
                if (typeof errorMessage === 'object' && errorMessage.message) {
                    showToast(errorMessage.message, null, 'error');
                } else {
                    showToast(errorMessage, null, 'error');
                }
            });

            function updateParentId(newParentId) {
                myDropzone.options.params.parent_id = newParentId;
            }


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            $(document).on('submit', '#create_folder_form', function (event) {
                event.preventDefault();
                const name = $('#name_folder').val();
                if (!name) {
                    showToast("Không để trống tên thư mục!", null, 'error');
                } else {
                    let formData = new FormData();
                    formData.append('name', name);
                    formData.append('parent_id', parentId);
                    formData.append('user_id', userId);
                    createFolder(formData);
                }
            });

            $(document).on('click', '.show-children', function (e) {
                e.preventDefault();
                const clickedDiv = $(this).closest('div');
                const divId = clickedDiv.attr('id');
                if (divId === 'path_folder_move_modal') {
                    folderId = $(this).data('id');
                    loadFolderRemove()
                } else {
                    parentId = $(this).data('id');
                    // navItemType = $(this).data('type');
                    loadFolder(parentId)
                }
            })

            $(document).on('change', '#type_folder', function () {
                myDropzone.removeAllFiles();
                navItemType = $(this).val()
                if (navItemType === "deleted-folder" || navItemType === "share-folder") {
                    parentId = null;
                    $('#toolbar_upload').addClass('d-none')
                } else {
                    $('#toolbar_upload').removeClass('d-none')
                    $('#selected_checkbox_restore').addClass('d-none')
                    parentId = {{$parent->id}};
                }
                loadFolder();
            })

            $(document).on('change', '.checkbox-all', function () {
                const isChecked = $(this).prop("checked");
                $("#table_data .checkbox-item-file").prop("checked", isChecked);
                showDeleteButton()
                showRestoreButton()
            })
            $(document).on('change', '.checkbox-item-file', function () {
                const allChecked = $("#table_data .checkbox-item-file:checked").length === $('#table_data .checkbox-item-file').length;
                $(".checkbox-all").prop("checked", allChecked);
                showDeleteButton()
                showRestoreButton()
            })

            $(document).on('click', '.menu-toggle, .add-permission, .preview-image', function (event) {
                // Find the closest ancestor with the class 'ms-2' (or adjust the selector accordingly)
                tr = $(this).closest('tr');
                rowId = tr.data('id');

                if ($(this).hasClass('menu-toggle')) {
                    const closest = $(this).closest('.more');
                    const targetMenu = closest.find('.menu');

                    $('.menu-sub-dropdown').not(targetMenu).removeClass('show');
                    if (targetMenu.hasClass('menu-sub-dropdown')) {
                        targetMenu.toggleClass('show');
                        targetMenu.css({
                            position: 'absolute',
                            top: $(this).outerHeight() + 'px',
                            right: '50px',
                        })
                    }
                }
                event.stopPropagation();
            });
            $(document).on('click', function (event) {
                // Check if the clicked element is not a descendant of the menu or the menu toggle
                if (!$(event.target).closest('.menu').length && !$(event.target).hasClass('menu-toggle')) {
                    // Hide all menu-sub-dropdown elements
                    $('.menu-sub-dropdown').removeClass('show');
                }
            });
            $(document).on('click', '.rename', function () {
                const name = tr.find('.name-file').text()
                $('#name_folder_rename').val(name.trim());
                $('#rename_modal').modal('show')
            })

            $(document).on('submit', '#rename_folder_form', function (event) {
                event.preventDefault();
                const name = $('#name_folder_rename').val();
                if (!name) {
                    showToast("Không để trống trường tên!", null, 'error')
                } else {
                    let formData = new FormData();
                    formData.append('name', name)
                    formData.append('id', rowId)
                    formData.append('_method', 'PATCH')
                    renameFile(formData)
                    tr.find('.sp-name-file').text(name)
                }
            })

            $(document).on('click', '.download', function () {
                const id = $(this).closest('tr').data('id') ?? rowId;
                let downloadUrl = "/file-manager/download-file?id=" + id + "&type=" + navItemType;
                window.open(downloadUrl, '_blank');
            })

            $(document).on('click', '.delete', function () {
                Swal.fire({
                    text: `Bạn có chắc muốn xoá thư mục/bản ghi này?`,
                    icon: "warning",
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: "Có",
                    cancelButtonText: "Huỷ",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-danger"
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        let formData = new FormData();
                        formData.append('ids[]', rowId);
                        formData.append('value', 1);
                        formData.append('is_direct_deleted', 1);
                        formData.append('_method', 'PATCH');
                        putTrashFolder(formData)
                    }
                });
            })

            $(document).on('click', '.restore', function () {
                Swal.fire({
                    text: `Bạn có chắc muốn khôi phục?`,
                    icon: "warning",
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: "Có",
                    cancelButtonText: "Huỷ",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-danger"
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        let formData = new FormData();
                        formData.append('ids[]', rowId);
                        formData.append('value', 0);
                        formData.append('is_direct_deleted', 0);
                        formData.append('_method', 'PATCH');
                        putTrashFolder(formData)
                    }
                });
            })

            $(document).on('click', '.destroy', function () {
                Swal.fire({
                    text: `Bạn có chắc muốn xoá vĩnh viễn?`,
                    icon: "warning",
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: "Có",
                    cancelButtonText: "Huỷ",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-danger"
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        let formData = new FormData();
                        formData.append('ids[]', rowId);
                        formData.append('_method', 'DELETE');
                        destroyFolder(formData)
                    }
                });
            })

            $(document).on('keyup', '.input_keyword', function () {
                const searchText = $(this).val().toLowerCase();
                $(this).closest('.modal').find(".block-user").each(function () {
                    const username = $(this).find(".name-user").text().toLowerCase();
                    if (username.includes(searchText)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            })

            $(document).on('change', '.receiver-checkbox', function () {
                let userId = $(this).data('id');
                let is_active = $(this).prop("checked");
                if (is_active === true) {
                    is_active = 1;
                } else is_active = 0;
                $.ajax({
                    url: '{{route('ajax.update-permission')}}',
                    method: 'POST',
                    data: {
                        _token: csrfToken,
                        user_id: userId,
                        file_id: rowId,
                        is_active: is_active,
                    },
                    success: function (response) {
                        showToast('Thành công', 'Đã cập nhật thành công', 'success');
                    },
                    error: function (xhr, status, error) {
                        showToast(xhr.responseJSON.message, null, 'error')
                    }
                });
            })

            $(document).on('click', '.preview-pdf', function () {
                const id = $(this).closest('tr').data('id');
                let downloadUrl = "/file-manager/preview-file?id=" + id;
                window.open(downloadUrl, '_blank');
            })

            $(document).on('click', '.preview-image', function () {
                const src = $(this).data('src');
                $('#show_image_modal img').attr('src', src);
                $('#show_image_modal').modal('show')
            })

            $(document).on('click', '.move-file', function () {
                $('.kt_modal_move_to_folder').modal('show')
                folderId = null
                loadFolderRemove();
            })

            $(document).on('click', '#btn_delete_selected', function () {
                const listIds = getListIdsChecked()
                let text = 'Bạn có chắc muốn xoá các file đã chọn?';
                if (navItemType === 'deleted-folder') {
                    text = "Bạn có chắc chắn muốn xoá vĩnh viễn không?"
                }
                if (listIds.length > 0) {
                    Swal.fire({
                        text: text,
                        icon: "warning",
                        buttonsStyling: false,
                        showCancelButton: true,
                        confirmButtonText: "Có",
                        cancelButtonText: "Huỷ",
                        customClass: {
                            confirmButton: "btn btn-primary",
                            cancelButton: "btn btn-danger"
                        },
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let formData = new FormData();
                            formData.append('ids[]', listIds);
                            if (navItemType === 'deleted-folder') {
                                formData.append('_method', 'DELETE');
                                destroyFolder(formData)
                            } else {
                                formData.append('value', 1);
                                formData.append('is_direct_deleted', 1);
                                formData.append('_method', 'PATCH');
                                putTrashFolder(formData)
                            }

                        }
                    });
                }
            })
            $(document).on('click', '#btn_restore_selected', function () {
                const listIds = getListIdsChecked();
                if (listIds.length > 0) {
                    Swal.fire({
                        text: `Bạn có muốn khôi phục các file đã chọn?`,
                        icon: "warning",
                        buttonsStyling: false,
                        showCancelButton: true,
                        confirmButtonText: "Có",
                        cancelButtonText: "Huỷ",
                        customClass: {
                            confirmButton: "btn btn-primary",
                            cancelButton: "btn btn-danger"
                        },
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let formData = new FormData();
                            formData.append('ids[]', listIds);
                            formData.append('value', 0);
                            formData.append('is_direct_deleted', 0);
                            formData.append('_method', 'PATCH');
                            putTrashFolder(formData)

                        }
                    });
                }
            })
            $(document).on('click', '#btn_export_selected', function () {
                const listIds = getListIdsChecked().join('-');
                let downloadUrl = "/file-manager/download-multiple-files?ids=" + listIds;
                window.open(downloadUrl, '_blank');
            })

            $(document).on('click', '.folder-move', function () {
                folderId = $(this).data('id');
                loadFolderRemove();
            })

            $(document).on('click', '#kt_modal_move_to_folder_submit', function () {
                moveFileToFolder()
            })
            const showDeleteButton = () => {
                let countItemCheckbox = $("#table_data .checkbox-item-file:checked").length;

                if (countItemCheckbox > 0) {
                    $('#selected_checkbox').removeClass('d-none');
                    $('#toolbar_upload').addClass('d-none');
                    $('#selected_count').text(countItemCheckbox);
                } else {
                    $('#selected_checkbox').addClass('d-none');
                    if (navItemType !== "deleted-folder" && navItemType !== "share-folder") {
                        $('#toolbar_upload').removeClass('d-none');

                    }
                    if (navItemType === "deleted-folder" || navItemType === "share-folder") {
                        $('#btn_export_selected').addClass('d-none')
                    } else {
                        $('#btn_export_selected').removeClass('d-none')
                    }
                    // $('#btn_export_selected').removeClass('d-none')
                    $('.checkbox-all').prop('checked', false);
                }
            }
            const showRestoreButton = () => {
                let selectedValue = $('#type_folder').val();
                if (selectedValue === "deleted-folder" && $("#table_data .checkbox-item-file:checked").length > 0) {
                    $('#selected_checkbox_restore').removeClass('d-none');
                } else {
                    $('#selected_checkbox_restore').addClass('d-none');
                }
            };
            const renameFile = (formData) => {
                $.ajax({
                    url: "{{route('ajax.rename')}}",
                    data: formData,
                    method: 'post',
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $('#rename_modal').modal('hide')
                        $('#name_folder_rename').val('')
                        // loadFolder(parentId)
                        showToast('Sửa thành công', null, 'success')
                    },
                    error: function (xhr, status, error) {
                        showToast(xhr.responseJSON.message, null, 'error')
                    }
                });
            }
            const loadFolder = () => {
                KTApp.showPageLoading();
                $.ajax({
                    url: "/ajax/children",
                    method: "GET",
                    data: {
                        'parent_id': parentId,
                        'type': navItemType,
                        'user_id': userId,
                    },
                    success: function (response) {
                        $('tbody').html(response.view)
                        $('#folder_path').html(response.folder_path)
                        $('#count_item').html(response.count_children.toString() + ' items')
                        // $('[data-bs-toggle="tooltip"]').tooltip();
                        showDeleteButton();
                        KTApp.hidePageLoading();

                    },
                    error: function (xhr, status, error) {
                        showToast(xhr.responseJSON.message, null, 'error')
                        KTApp.hidePageLoading();
                    }
                })
            }
            const createFolder = (formData) => {
                $.ajax({
                    url: "{{route('ajax.store-folder')}}",
                    data: formData,
                    method: 'post',
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $('#create_folder_modal').modal('hide')
                        $('#name_folder').val('')
                        loadFolder(parentId)
                        showToast('Tạo thư mục thành công', null, 'success')
                    },
                    error: function (xhr, status, error) {
                        showToast(xhr.responseJSON.message, null, 'error')
                    }
                });
            }
            const putTrashFolder = (formData) => {
                $.ajax({
                    url: '{{route('ajax.put-file-trash')}}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function () {
                        loadFolder()
                        showToast("Xoá thành công", null, 'success')
                    },
                    error: function (xhr, status, error) {
                        showToast(xhr.responseJSON.message, null, 'error')
                    }
                });
            }
            const destroyFolder = (formData) => {
                $.ajax({
                    url: '{{route('ajax.destroy')}}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function () {
                        loadFolder()
                        showToast("Xoá thành công", null, 'success')
                        showRestoreButton();
                    },
                    error: function (xhr, status, error) {
                        showToast(xhr.responseJSON.message, null, 'error')
                    }
                });
            }
            const getListIdsChecked = () => {
                let listIds = [];
                $('.checkbox-item-file').each(function () {
                    if ($(this).prop("checked")) {
                        listIds.push($(this).closest('tr').data('id'));
                    }
                })
                return listIds;
            }
            const loadFolderRemove = () => {
                $.ajax({
                    url: "{{route('ajax.load-folder-remove')}}",
                    method: "GET",
                    data: {
                        'folder_id': folderId,
                        'user_id': userId,
                        'parent_id': parentId,
                        'file_id': rowId
                    },
                    success: function (response) {
                        console.log(response)
                        $('#content_modal_move_file').html(response.view)
                    },
                    error: function (xhr, status, error) {
                        showToast(xhr.responseJSON.message, null, 'error')
                    }
                })
            }
            const moveFileToFolder = () => {
                $.ajax({
                    url: "{{route('ajax.move-file')}}",
                    method: "PATCH",
                    data: {
                        'folder_id': folderId,
                        'user_id': userId,
                        'parent_id': parentId,
                        'file_id': rowId
                    },
                    success: function (response) {
                        loadFolder()
                        showToast("Xoá thành công", null, 'success')
                    },
                    error: function (xhr, status, error) {
                        showToast(xhr.responseJSON.message, null, 'error')
                    }
                })
            }
            loadFolder();

            $.ajax({
                url: "{{route('file-manager.index')}}",
                method: "GET",
                success: function (response) {
                    $(htmlId).html(response.view)
                },
                error: function (xhr, status, error) {
                    showToast(xhr.responseJSON.message, null, 'error')
                }
            })

        }
    })
</script>
