<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@300;500;700">
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{asset('vendor/file-manager/css/plugins.bundle.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('vendor/file-manager/css/style.bundle.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('vendor/file-manager/css/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
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
                    <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#create_folder_modal">
                        <!--begin::Svg Icon | path: icons/duotune/files/fil013.svg-->
                        <span class="svg-icon svg-icon-2">
								<img src="{{asset('assets/media/icons/duotune/files/fil013.svg')}}" alt="">
							</span>
                        <!--end::Svg Icon-->Tạo thư mục
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="create_folder_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tạo mới thư mục</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <label class="form-label mb-2" for="value">
                                        <span class="required">Tên thư mục</span>
                                    </label>
                                    <input class="form-control" id="name_folder" placeholder="Nhập tên thư mục" name="name" required/>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                    <button type="button" class="btn btn-primary" id="btn_store_folder">Tạo mới</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Export-->
                    <!--begin::Add customer-->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_upload">
                        <!--begin::Svg Icon | path: icons/duotune/files/fil018.svg-->
                        <span class="svg-icon svg-icon-2">
                                <img src="{{asset('assets/media/icons/duotune/files/fil018.svg')}}" alt="">
							</span>
                        <!--end::Svg Icon-->Upload Files
                    </button>
                    <!--end::Add customer-->
                </div>
                <!--end::Toolbar-->
                <!--begin::Group actions-->
                <div class="d-flex justify-content-end align-items-center d-none" id="selected_checkbox">
                    <div class="fw-bold me-5">
                        <span class="me-2" id="selected_count"></span>đã chọn
                    </div>
                    <button type="button" class="btn btn-danger" id="btn_delete_selected">Xoá đã chọn</button>
                </div>
                <!--end::Group actions-->
                <div class="d-flex justify-content-end align-items-center ms-5 d-none" id="selected_checkbox_restore">
                    <button type="button" class="btn btn-success" id="btn_restore_selected">Khôi phục</button>
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
                    <div class="dataTables_scroll">
                        <div class="dataTables_scrollHead">
                            <div class="dataTables_scrollHeadInner">
                                <table data-kt-filemanager-table="folders" class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer">
                                    <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="w-10px pe-2 sorting_disabled" rowspan="1" colspan="1">
                                            <div class="form-check me-3">
                                                <input class="form-check-input border-black checkbox-all" type="checkbox" data-kt-check="true"
                                                       data-kt-check-target="#kt_file_manager_list .form-check-input" value="1">
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
                    <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start"></div>
                    <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end"></div>
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
                        <h2 class="fw-bold">Upload files</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1">
                                    <img src="{{asset('assets/media/icons/duotune/arrows/arr061.svg')}}" alt="">
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
                                <!--begin::Items-->
                                <div class="dropzone-items wm-200px">
                                    <div class="mb-3">
                                        <label for="formFileMultiple" class="form-label">Chọn file</label>
                                        <input class="form-control" type="file" id="formFileMultiple" name="files[]" multiple
                                               accept="image/*, .doc,.docx,.pdf"
                                        >
                                    </div>
                                </div>
                            </div>
                            <!--end::Dropzone-->
                            <!--begin::Hint-->
                            <span class="form-text fs-6 text-muted">Max file size is 1MB per file.</span>
                            <!--end::Hint-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Modal body-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-primary" id="btn_upload_file">Upload</button>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
    <!--end::Modal - Upload File-->
    <!--begin::Modal - New Product-->
    <div class="modal fade" id="kt_modal_move_to_folder" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#" id="kt_modal_move_to_folder_form">
                    <!--begin::Modal header-->
                    <div class="modal-header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bold">Move to folder</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1">
                                    <img src="{{asset('assets/media/icons/duotune/arrows/arr061.svg')}}" alt="">
                                </span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--end::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body pt-10 pb-15 px-lg-17">
                        <!--begin::Input group-->
                        <div class="form-group fv-row fv-plugins-icon-container">
                            <!--begin::Item-->
                            <div class="d-flex">
                                <!--begin::Checkbox-->
                                <div class="form-check form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input me-3" name="move_to_folder" type="radio" value="0" id="kt_modal_move_to_folder_0">
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <label class="form-check-label" for="kt_modal_move_to_folder_0">
                                        <div class="fw-bold">
                                            <!--begin::Svg Icon | path: icons/duotune/files/fil012.svg-->
                                            <span class="svg-icon svg-icon-2 svg-icon-primary me-2">
                                                    <img src="{{asset('assets/media/icons/duotune/files/fil012.svg')}}" alt="">
                                                </span>
                                            <!--end::Svg Icon-->account
                                        </div>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Checkbox-->
                            </div>
                            <!--end::Item-->
                            <div class="separator separator-dashed my-5"></div>
                            <!--begin::Item-->
                            <div class="d-flex">
                                <!--begin::Checkbox-->
                                <div class="form-check form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input me-3" name="move_to_folder" type="radio" value="1" id="kt_modal_move_to_folder_1">
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <label class="form-check-label" for="kt_modal_move_to_folder_1">
                                        <div class="fw-bold">
                                            <!--begin::Svg Icon | path: icons/duotune/files/fil012.svg-->
                                            <span class="svg-icon svg-icon-2 svg-icon-primary me-2">
                                                    <img src="{{asset('assets/media/icons/duotune/files/fil012.svg')}}" alt="">
                                                </span>
                                            <!--end::Svg Icon-->apps
                                        </div>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Checkbox-->
                            </div>
                            <!--end::Item-->
                            <div class="separator separator-dashed my-5"></div>
                            <!--begin::Item-->
                            <div class="d-flex">
                                <!--begin::Checkbox-->
                                <div class="form-check form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input me-3" name="move_to_folder" type="radio" value="2" id="kt_modal_move_to_folder_2">
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <label class="form-check-label" for="kt_modal_move_to_folder_2">
                                        <div class="fw-bold">
                                            <!--begin::Svg Icon | path: icons/duotune/files/fil012.svg-->
                                            <span class="svg-icon svg-icon-2 svg-icon-primary me-2">
                                                    <img src="{{asset('assets/media/icons/duotune/files/fil012.svg')}}" alt="">
                                                </span>
                                            <!--end::Svg Icon-->widgets
                                        </div>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Checkbox-->
                            </div>

                        </div>
                        <!--end::Input group-->
                        <!--begin::Action buttons-->
                        <div class="d-flex flex-center mt-12">
                            <!--begin::Button-->
                            <button type="button" class="btn btn-primary" id="kt_modal_move_to_folder_submit">
                                <span class="indicator-label">Save</span>
                                <span class="indicator-progress">Please wait...
																<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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
    <!--end::Card-->
    <!--begin::Rename modal-->
    <!-- Modal -->
    <div class="modal fade" id="rename_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Đổi tên thư mục/ tệp</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label mb-2" for="value">
                        <span class="required">Tên thư mục/ tệp</span>
                    </label>
                    <input class="form-control" id="name_folder_rename" placeholder="Nhập tên thư mục" name="name" required/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="btn_update_folder">Đổi tên</button>
                </div>
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
                <form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#" id="kt_modal_move_to_folder_form">
                    <!--begin::Modal header-->
                    <div class="modal-header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bold">Move to folder</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1">
																<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
																	<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
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
                        <div class="form-group fv-row fv-plugins-icon-container">
                            <!--begin::Item-->
                            <div class="d-flex">
                                <!--begin::Checkbox-->
                                <div class="form-check form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input me-3" name="move_to_folder" type="radio" value="0" id="kt_modal_move_to_folder_0">
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <label class="form-check-label" for="kt_modal_move_to_folder_0">
                                        <div class="fw-bold">
                                            <!--begin::Svg Icon | path: icons/duotune/files/fil012.svg-->
                                            <span class="svg-icon svg-icon-2 svg-icon-primary me-2">
																			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																				<path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor"></path>
																				<path
                                                                                    d="M9.2 3H3C2.4 3 2 3.4 2 4V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V7C22 6.4 21.6 6 21 6H12L10.4 3.60001C10.2 3.20001 9.7 3 9.2 3Z"
                                                                                    fill="currentColor"></path>
																			</svg>
																		</span>
                                            <!--end::Svg Icon-->account
                                        </div>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Checkbox-->
                            </div>
                            <!--end::Item-->
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                            <!--begin::Item-->
                            <div class="d-flex">
                                <!--begin::Checkbox-->
                                <div class="form-check form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input me-3" name="move_to_folder" type="radio" value="9" id="kt_modal_move_to_folder_9">
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <label class="form-check-label" for="kt_modal_move_to_folder_9">
                                        <div class="fw-bold">
                                            <!--begin::Svg Icon | path: icons/duotune/files/fil012.svg-->
                                            <span class="svg-icon svg-icon-2 svg-icon-primary me-2">
																			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																				<path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor"></path>
																				<path
                                                                                    d="M9.2 3H3C2.4 3 2 3.4 2 4V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V7C22 6.4 21.6 6 21 6H12L10.4 3.60001C10.2 3.20001 9.7 3 9.2 3Z"
                                                                                    fill="currentColor"></path>
																			</svg>
																		</span>
                                            <!--end::Svg Icon-->pages
                                        </div>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Checkbox-->
                            </div>
                            <!--end::Item-->
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Action buttons-->
                        <div class="d-flex flex-center mt-12">
                            <!--begin::Button-->
                            <button type="button" class="btn btn-primary" id="kt_modal_move_to_folder_submit">
                                <span class="indicator-label">Save</span>
                                <span class="indicator-progress">Please wait...
																<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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

</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
{{--<script src="{{asset('vendor/file-manager/js/common.js')}}"></script>--}}
{{--<script src="{{asset('vendor/file-manager/js/scripts.bundle.js')}}"></script>--}}
<script>
    $(document).ready(function () {
        let parentId = {{$parent->id}};
        {{--let csrfToken = "{{ csrf_token() }}";--}}
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        let userId = {{auth()->id()}};
        let rowId;
        let tr;
        let navItemType = "all-folder";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        $('#btn_store_folder').on('click', function () {
            const name = $('#name_folder').val();
            if (!name) {
                showToast("Không để trống tên thư mục!", null, 'error')
            } else {
                let formData = new FormData();
                formData.append('name', name)
                formData.append('parent_id', parentId)
                formData.append('user_id', userId)
                createFolder(formData)
            }

        })

        $(document).on('click', '.show-children', function (e) {
            e.preventDefault();
            parentId = $(this).data('id');
            // navItemType = $(this).data('type');
            loadFolder(parentId)
        })

        $('#type_folder').on('change', function () {

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

        $('.checkbox-all').on('change', function () {
            const isChecked = $(this).prop("checked");
            $(".checkbox-item").prop("checked", isChecked);
            showDeleteButton()
            showRestoreButton()
        })
        $(document).on('change', '.checkbox-item', function () {
            const allChecked = $(".checkbox-item:checked").length === $('.checkbox-item').length/2;
            $(".checkbox-all").prop("checked", allChecked);
            showDeleteButton()
            showRestoreButton()
        })

        $(document).on('click', '.menu-toggle, .add-permission', function () {
            // Find the closest ancestor with the class 'ms-2' (or adjust the selector accordingly)
            tr = $(this).closest('tr');
            rowId = tr.data('id');

            if ($(this).hasClass('menu-toggle')) {
                const closest = $(this).closest('.more');
                const targetMenu = closest.find('.menu');

                $('.menu-sub-dropdown').not(targetMenu).removeClass('show');
                if (targetMenu.hasClass('menu-sub-dropdown')) {
                    targetMenu.toggleClass('show');
                }
            }
        });

        $(document).on('click', '.rename', function () {
            const name = tr.find('.name-file').text()
            $('#name_folder_rename').val(name);
            $('#rename_modal').modal('show')
        })

        $('#btn_update_folder').on('click', function () {
            const name = $('#name_folder_rename').val();
            if (!name) {
                showToast("Không để trống trường tên!", null, 'error')
            } else {
                let formData = new FormData();
                formData.append('name', name)
                formData.append('id', rowId)
                formData.append('_method', 'PATCH')
                renameFile(formData)
                tr.find('.name-file').text(name)
            }
        })

        $('#btn_upload_file').on('click', function () {
            const input = $('#formFileMultiple')[0];
            // Check if files are selected
            if (input.files.length > 0) {
                // Loop through each selected file
                for (let i = 0; i < input.files.length; i++) {
                    const file = input.files[i];
                    if (file.size > 1024 * 1024) {
                        showToast('Kích thước tệp vượt quá giới hạn (1MB). Vui lòng chọn tệp nhỏ hơn', null, 'error')
                        return;
                    }
                }

                const formData = new FormData($('#modal_upload_form')[0]);
                formData.append('parent_id', parentId)
                formData.append('user_id', userId)
                uploadFile(formData)
            } else {
                showToast('Vui lòng chọn ít nhất một tệp', null, 'error')
            }
        });
        $(document).on('click', '.download', function () {
            const id = $(this).closest('tr').data('id');
            let downloadUrl = "/ajax/download-file?id=" + id + "&type=" + navItemType;
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
                    showToast('Thành công', 'Đã cập nhật thành công', 'success')
                },
                error: function (xhr, status, error) {
                    showToast(xhr.responseJSON.message, null, 'error')
                }
            });
        })

        $('#btn_delete_selected').on('click', function () {
            let listIds = [];
            let text = 'Bạn có chắc muốn xoá các file đã chọn?';
            $('.checkbox-item').each(function () {
                if ($(this).prop("checked")){
                    listIds.push($(this).closest('tr').data('id'))
                }
            })
            if (navItemType === 'deleted-folder'){
                text = "Bạn có chắc chắn muốn xoá vĩnh viễn không?"
            }
            if (listIds.length > 0){
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
                        if (navItemType === 'deleted-folder'){
                            formData.append('_method', 'DELETE');
                            destroyFolder(formData)
                        }else{
                            formData.append('value', 1);
                            formData.append('is_direct_deleted', 1);
                            formData.append('_method', 'PATCH');
                            putTrashFolder(formData)
                        }

                    }
                });
            }
        })
        $('#btn_restore_selected').on('click',function () {
            let listIds = [];
            $('.checkbox-item').each(function () {
                if ($(this).prop("checked")){
                    listIds.push($(this).closest('tr').data('id'))
                }
            })
            if (listIds.length > 0){
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
        const showDeleteButton = () => {
            let countItemCheckbox = $(".checkbox-item:checked").length;
            if (countItemCheckbox > 0) {
                $('#selected_checkbox').removeClass('d-none');
                $('#toolbar_upload').addClass('d-none');
                $('#selected_count').text(countItemCheckbox);
            } else {
                $('#selected_checkbox').addClass('d-none');
                if (navItemType !== "deleted-folder" && navItemType !== "share-folder") {
                    $('#toolbar_upload').removeClass('d-none');
                }
                $('.checkbox-all').prop('checked', false);
            }
        }
        const showRestoreButton = () => {
            let selectedValue = $('#type_folder').val();
            if (selectedValue === "deleted-folder" && $(".checkbox-item:checked").length > 0) {
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
            $.ajax({
                url: "/ajax/children",
                method: "GET",
                data: {
                    'parent_id': parentId,
                    'type': navItemType,
                },
                success: function (response) {
                    $('tbody').html(response.view)
                    $('#folder_path').html(response.folder_path)
                    $('#count_item').html(response.count_children.toString() + ' items')
                    $('[data-bs-toggle="tooltip"]').tooltip();
                    showDeleteButton();
                },
                error: function (xhr, status, error) {
                    showToast(xhr.responseJSON.message, null, 'error')
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
        const uploadFile = (formData) => {
            $.ajax({
                url: '{{route('ajax.upload-file')}}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function () {
                    loadFolder()
                    showToast("Tải file thành công", null, 'success')
                    $('#kt_modal_upload').modal('hide')
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
                },
                error: function (xhr, status, error) {
                    showToast(xhr.responseJSON.message, null, 'error')
                }
            });
        }

        loadFolder()
    })
</script>
