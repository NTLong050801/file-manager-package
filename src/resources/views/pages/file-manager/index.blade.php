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
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
							<img src="{{asset('assets/media/icons/duotune/general/gen021.svg')}}" alt="">
						</span>
                    <!--end::Svg Icon-->
                    <input type="text" data-kt-filemanager-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Files &amp; Folders">
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-filemanager-table-toolbar="base">
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
                <div class="d-flex justify-content-end align-items-center d-none" data-kt-filemanager-table-toolbar="selected">
                    <div class="fw-bold me-5">
                        <span class="me-2" data-kt-filemanager-table-select="selected_count"></span>Selected
                    </div>
                    <button type="button" class="btn btn-danger" data-kt-filemanager-table-select="delete_selected">Delete Selected</button>
                </div>
                <!--end::Group actions-->
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
                                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_file_manager_list .form-check-input" value="1">
                                            </div>
                                        </th>
                                        <th class="min-w-250px sorting_disabled" rowspan="1" colspan="1">Tên</th>
                                        <th class="min-w-10px sorting_disabled" rowspan="1" colspan="1">Kích thước</th>
                                        <th class="min-w-125px sorting_disabled" rowspan="1" colspan="1">Cập nhật</th>
                                        <th class="w-125px sorting_disabled" rowspan="1" colspan="1"></th>
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
    <!--begin::Upload template-->
    <table class="d-none">
        <tbody>
        <tr id="kt_file_manager_new_folder_row" data-kt-filemanager-template="upload">
            <td></td>
            <td id="kt_file_manager_add_folder_form" class="fv-row">
                <div class="d-flex align-items-center">
                    <!--begin::Folder icon-->
                    <!--begin::Svg Icon | path: icons/duotune/files/fil012.svg-->
                    <span class="svg-icon svg-icon-2x svg-icon-primary me-4">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor"></path>
															<path
                                                                d="M9.2 3H3C2.4 3 2 3.4 2 4V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V7C22 6.4 21.6 6 21 6H12L10.4 3.60001C10.2 3.20001 9.7 3 9.2 3Z"
                                                                fill="currentColor"></path>
														</svg>
													</span>
                    <!--end::Svg Icon-->
                    <!--end::Folder icon-->
                    <!--begin:Input-->
                    <input type="text" name="new_folder_name" placeholder="Enter the folder name" class="form-control mw-250px me-3">
                    <!--end:Input-->
                    <!--begin:Submit button-->
                    <button class="btn btn-icon btn-light-primary me-3" id="kt_file_manager_add_folder">
														<span class="indicator-label">
															<!--begin::Svg Icon | path: icons/duotune/arrows/arr085.svg-->
															<span class="svg-icon svg-icon-1">
																<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<path
                                                                        d="M9.89557 13.4982L7.79487 11.2651C7.26967 10.7068 6.38251 10.7068 5.85731 11.2651C5.37559 11.7772 5.37559 12.5757 5.85731 13.0878L9.74989 17.2257C10.1448 17.6455 10.8118 17.6455 11.2066 17.2257L18.1427 9.85252C18.6244 9.34044 18.6244 8.54191 18.1427 8.02984C17.6175 7.47154 16.7303 7.47154 16.2051 8.02984L11.061 13.4982C10.7451 13.834 10.2115 13.834 9.89557 13.4982Z"
                                                                        fill="currentColor"></path>
																</svg>
															</span>
                                                            <!--end::Svg Icon-->
														</span>
                        <span class="indicator-progress">
															<span class="spinner-border spinner-border-sm align-middle"></span>
														</span>
                    </button>
                    <!--end:Submit button-->
                    <!--begin:Cancel button-->
                    <button class="btn btn-icon btn-light-danger" id="kt_file_manager_cancel_folder">
														<span class="indicator-label">
															<!--begin::Svg Icon | path: icons/duotune/arrows/arr088.svg-->
															<span class="svg-icon svg-icon-1">
																<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)"
                                                                          fill="currentColor"></rect>
																	<rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="currentColor"></rect>
																</svg>
															</span>
                                                            <!--end::Svg Icon-->
														</span>
                        <span class="indicator-progress">
															<span class="spinner-border spinner-border-sm align-middle"></span>
														</span>
                    </button>
                    <!--end:Cancel button-->
                </div>
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        </tbody>
    </table>
    <!--end::Upload template-->

    <!--begin::Action template-->
    <div class="d-none" data-kt-filemanager-template="action">
        <div class="d-flex justify-content-end">
            <!--begin::Share link-->
            <div class="ms-2" data-kt-filemanger-table="copy_link">
                <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <!--begin::Svg Icon | path: icons/duotune/coding/cod007.svg-->
                    <span class="svg-icon svg-icon-5 m-0">
                            <img src="{{asset('assets/media/icons/duotune/coding/cod007.svg')}}" alt="">
                        </span>
                    <!--end::Svg Icon-->
                </button>
                <!--begin::Menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-300px" data-kt-menu="true">
                    <!--begin::Card-->
                    <div class="card card-flush">
                        <div class="card-body p-5">
                            <!--begin::Loader-->
                            <div class="d-flex" data-kt-filemanger-table="copy_link_generator">
                                <!--begin::Spinner-->
                                <div class="me-5" data-kt-indicator="on">
                                        <span class="indicator-progress">
												<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
										</span>
                                </div>
                                <!--end::Spinner-->
                                <!--begin::Label-->
                                <div class="fs-6 text-dark">Generating Share Link...</div>
                                <!--end::Label-->
                            </div>
                            <!--end::Loader-->
                            <!--begin::Link-->
                            <div class="d-flex flex-column text-start d-none" data-kt-filemanger-table="copy_link_result">
                                <div class="d-flex mb-3">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr085.svg-->
                                    <span class="svg-icon svg-icon-2 svg-icon-success me-3">
                                            <img src="{{asset('assets/media/icons/duotune/arrows/arr085.svg')}}" alt="">
										</span>
                                    <!--end::Svg Icon-->
                                    <div class="fs-6 text-dark">Share Link Generated</div>
                                </div>
                                <input type="text" class="form-control form-control-sm" value="https://path/to/file/or/folder/">
                                <div class="text-muted fw-normal mt-2 fs-8 px-3">Read only.
                                    <a href="#" class="ms-2">Change permissions</a></div>
                            </div>
                            <!--end::Link-->
                        </div>
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Share link-->
            <!--begin::More-->
            <div class="ms-2">
                <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen052.svg-->
                    <span class="svg-icon svg-icon-5 m-0">
                            <img src="{{asset('assets/media/icons/duotune/general/gen052.svg')}}" alt="">
                        </span>
                    <!--end::Svg Icon-->
                </button>
                <!--begin::Menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4" data-kt-menu="true">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link px-3">Download File</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link px-3" data-kt-filemanager-table="rename">Rename</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link px-3" data-kt-filemanager-table-filter="move_row" data-bs-toggle="modal" data-bs-target="#kt_modal_move_to_folder">Move to folder</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link text-danger px-3" data-kt-filemanager-table-filter="delete_row">Delete</a>
                    </div>
                    <!--end::Menu item-->
                </div>
                <!--end::Menu-->
            </div>
            <!--end::More-->
        </div>
    </div>
    <!--end::Action template-->
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
                                        <input class="form-control" type="file" id="formFileMultiple" name="files[]" multiple>
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
    <!--begin::Upload template-->
    <table class="d-none">
        <tbody>
        <tr id="kt_file_manager_new_folder_row" data-kt-filemanager-template="upload">
            <td></td>
            <td id="kt_file_manager_add_folder_form" class="fv-row">
                <div class="d-flex align-items-center">
                    <!--begin::Folder icon-->
                    <!--begin::Svg Icon | path: icons/duotune/files/fil012.svg-->
                    <span class="svg-icon svg-icon-2x svg-icon-primary me-4">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor"></path>
															<path
                                                                d="M9.2 3H3C2.4 3 2 3.4 2 4V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V7C22 6.4 21.6 6 21 6H12L10.4 3.60001C10.2 3.20001 9.7 3 9.2 3Z"
                                                                fill="currentColor"></path>
														</svg>
													</span>
                    <!--end::Svg Icon-->
                    <!--end::Folder icon-->
                    <!--begin:Input-->
                    <input type="text" name="new_folder_name" placeholder="Enter the folder name" class="form-control mw-250px me-3">
                    <!--end:Input-->
                    <!--begin:Submit button-->
                    <button class="btn btn-icon btn-light-primary me-3" id="kt_file_manager_add_folder">
														<span class="indicator-label">
															<!--begin::Svg Icon | path: icons/duotune/arrows/arr085.svg-->
															<span class="svg-icon svg-icon-1">
																<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<path
                                                                        d="M9.89557 13.4982L7.79487 11.2651C7.26967 10.7068 6.38251 10.7068 5.85731 11.2651C5.37559 11.7772 5.37559 12.5757 5.85731 13.0878L9.74989 17.2257C10.1448 17.6455 10.8118 17.6455 11.2066 17.2257L18.1427 9.85252C18.6244 9.34044 18.6244 8.54191 18.1427 8.02984C17.6175 7.47154 16.7303 7.47154 16.2051 8.02984L11.061 13.4982C10.7451 13.834 10.2115 13.834 9.89557 13.4982Z"
                                                                        fill="currentColor"></path>
																</svg>
															</span>
                                                            <!--end::Svg Icon-->
														</span>
                        <span class="indicator-progress">
															<span class="spinner-border spinner-border-sm align-middle"></span>
														</span>
                    </button>
                    <!--end:Submit button-->
                    <!--begin:Cancel button-->
                    <button class="btn btn-icon btn-light-danger" id="kt_file_manager_cancel_folder">
														<span class="indicator-label">
															<!--begin::Svg Icon | path: icons/duotune/arrows/arr088.svg-->
															<span class="svg-icon svg-icon-1">
																<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)"
                                                                          fill="currentColor"></rect>
																	<rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="currentColor"></rect>
																</svg>
															</span>
                                                            <!--end::Svg Icon-->
														</span>
                        <span class="indicator-progress">
															<span class="spinner-border spinner-border-sm align-middle"></span>
														</span>
                    </button>
                    <!--end:Cancel button-->
                </div>
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        </tbody>
    </table>
    <!--end::Upload template-->
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
    <!--begin::Action template-->
    <div class="d-none" data-kt-filemanager-template="action">
        <div class="d-flex justify-content-end">
            <!--begin::Share link-->
            <div class="ms-2" data-kt-filemanger-table="copy_link">
                <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <!--begin::Svg Icon | path: icons/duotune/coding/cod007.svg-->
                    <span class="svg-icon svg-icon-5 m-0">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path opacity="0.3"
                                                                  d="M18.4 5.59998C18.7766 5.9772 18.9881 6.48846 18.9881 7.02148C18.9881 7.55451 18.7766 8.06577 18.4 8.44299L14.843 12C14.466 12.377 13.9547 12.5887 13.4215 12.5887C12.8883 12.5887 12.377 12.377 12 12C11.623 11.623 11.4112 11.1117 11.4112 10.5785C11.4112 10.0453 11.623 9.53399 12 9.15698L15.553 5.604C15.9302 5.22741 16.4415 5.01587 16.9745 5.01587C17.5075 5.01587 18.0188 5.22741 18.396 5.604L18.4 5.59998ZM20.528 3.47205C20.0614 3.00535 19.5074 2.63503 18.8977 2.38245C18.288 2.12987 17.6344 1.99988 16.9745 1.99988C16.3145 1.99988 15.661 2.12987 15.0513 2.38245C14.4416 2.63503 13.8876 3.00535 13.421 3.47205L9.86801 7.02502C9.40136 7.49168 9.03118 8.04568 8.77863 8.6554C8.52608 9.26511 8.39609 9.91855 8.39609 10.5785C8.39609 11.2384 8.52608 11.8919 8.77863 12.5016C9.03118 13.1113 9.40136 13.6653 9.86801 14.132C10.3347 14.5986 10.8886 14.9688 11.4984 15.2213C12.1081 15.4739 12.7616 15.6039 13.4215 15.6039C14.0815 15.6039 14.7349 15.4739 15.3446 15.2213C15.9543 14.9688 16.5084 14.5986 16.975 14.132L20.528 10.579C20.9947 10.1124 21.3649 9.55844 21.6175 8.94873C21.8701 8.33902 22.0001 7.68547 22.0001 7.02551C22.0001 6.36555 21.8701 5.71201 21.6175 5.10229C21.3649 4.49258 20.9947 3.93867 20.528 3.47205Z"
                                                                  fill="currentColor"></path>
															<path
                                                                d="M14.132 9.86804C13.6421 9.37931 13.0561 8.99749 12.411 8.74695L12 9.15698C11.6234 9.53421 11.4119 10.0455 11.4119 10.5785C11.4119 11.1115 11.6234 11.6228 12 12C12.3766 12.3772 12.5881 12.8885 12.5881 13.4215C12.5881 13.9545 12.3766 14.4658 12 14.843L8.44699 18.396C8.06999 18.773 7.55868 18.9849 7.02551 18.9849C6.49235 18.9849 5.98101 18.773 5.604 18.396C5.227 18.019 5.0152 17.5077 5.0152 16.9745C5.0152 16.4413 5.227 15.93 5.604 15.553L8.74701 12.411C8.28705 11.233 8.28705 9.92498 8.74701 8.74695C8.10159 8.99737 7.5152 9.37919 7.02499 9.86804L3.47198 13.421C2.52954 14.3635 2.00009 15.6417 2.00009 16.9745C2.00009 18.3073 2.52957 19.5855 3.47202 20.528C4.41446 21.4704 5.69269 21.9999 7.02551 21.9999C8.35833 21.9999 9.63656 21.4704 10.579 20.528L14.132 16.975C14.5987 16.5084 14.9689 15.9544 15.2215 15.3447C15.4741 14.735 15.6041 14.0815 15.6041 13.4215C15.6041 12.7615 15.4741 12.108 15.2215 11.4983C14.9689 10.8886 14.5987 10.3347 14.132 9.86804Z"
                                                                fill="currentColor"></path>
														</svg>
													</span>
                    <!--end::Svg Icon-->
                </button>
                <!--begin::Menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-300px" data-kt-menu="true">
                    <!--begin::Card-->
                    <div class="card card-flush">
                        <div class="card-body p-5">
                            <!--begin::Loader-->
                            <div class="d-flex" data-kt-filemanger-table="copy_link_generator">
                                <!--begin::Spinner-->
                                <div class="me-5" data-kt-indicator="on">
																	<span class="indicator-progress">
																		<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
																	</span>
                                </div>
                                <!--end::Spinner-->
                                <!--begin::Label-->
                                <div class="fs-6 text-dark">Generating Share Link...</div>
                                <!--end::Label-->
                            </div>
                            <!--end::Loader-->
                            <!--begin::Link-->
                            <div class="d-flex flex-column text-start d-none" data-kt-filemanger-table="copy_link_result">
                                <div class="d-flex mb-3">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr085.svg-->
                                    <span class="svg-icon svg-icon-2 svg-icon-success me-3">
																		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																			<path
                                                                                d="M9.89557 13.4982L7.79487 11.2651C7.26967 10.7068 6.38251 10.7068 5.85731 11.2651C5.37559 11.7772 5.37559 12.5757 5.85731 13.0878L9.74989 17.2257C10.1448 17.6455 10.8118 17.6455 11.2066 17.2257L18.1427 9.85252C18.6244 9.34044 18.6244 8.54191 18.1427 8.02984C17.6175 7.47154 16.7303 7.47154 16.2051 8.02984L11.061 13.4982C10.7451 13.834 10.2115 13.834 9.89557 13.4982Z"
                                                                                fill="currentColor"></path>
																		</svg>
																	</span>
                                    <!--end::Svg Icon-->
                                    <div class="fs-6 text-dark">Share Link Generated</div>
                                </div>
                                <input type="text" class="form-control form-control-sm" value="https://path/to/file/or/folder/">
                                <div class="text-muted fw-normal mt-2 fs-8 px-3">Read only.
                                    <a href="../../demo1/dist/apps/file-manager/settings/.html" class="ms-2">Change permissions</a></div>
                            </div>
                            <!--end::Link-->
                        </div>
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Share link-->
            <!--begin::More-->
            <div class="ms-2">
                <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen052.svg-->
                    <span class="svg-icon svg-icon-5 m-0">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<rect x="10" y="10" width="4" height="4" rx="2" fill="currentColor"></rect>
															<rect x="17" y="10" width="4" height="4" rx="2" fill="currentColor"></rect>
															<rect x="3" y="10" width="4" height="4" rx="2" fill="currentColor"></rect>
														</svg>
													</span>
                    <!--end::Svg Icon-->
                </button>
                <!--begin::Menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4" data-kt-menu="true">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link px-3">Download File</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link px-3" data-kt-filemanager-table="rename">Rename</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link px-3" data-kt-filemanager-table-filter="move_row" data-bs-toggle="modal" data-bs-target="#kt_modal_move_to_folder">Move to folder</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link text-danger px-3" data-kt-filemanager-table-filter="delete_row">Delete</a>
                    </div>
                    <!--end::Menu item-->
                </div>
                <!--end::Menu-->
            </div>
            <!--end::More-->
        </div>
    </div>
    <!--end::Action template-->
    <!--begin::Checkbox template-->
    <div class="d-none" data-kt-filemanager-template="checkbox">
        <div class="form-check form-check-sm form-check-custom form-check-solid">
            <input class="form-check-input" type="checkbox" value="1">
        </div>
    </div>
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
        let csrfToken = "{{ csrf_token() }}";
        let userId = {{auth()->id()}};
        let rowId;
        let tr;

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
            // console.log(parentId)
            loadFolder(parentId)
        })

//         $(document).on('click', function (event) {
//             // Check if the clicked element is not within the menu or the button
//             if (!$(event.target).closest('.menu-sub-dropdown').length && !$(event.target).hasClass('menu-toggle')) {
//                 // Hide all menus
//                 $('.menu-sub-dropdown').removeClass('show');
//             }
//         });
//
// // Prevent clicks inside the menu from closing it immediately
//         $('.menu-sub-dropdown').on('click', function (event) {
//             event.stopPropagation();
//         });


        $(document).on('click', '.menu-toggle', function () {
            // Find the closest ancestor with the class 'ms-2' (or adjust the selector accordingly)
            const closest = $(this).closest('.more');
            rowId = closest.data('id');
            tr = $(this).closest('tr');
            // Find the menu within the closest ancestor
            const targetMenu = closest.find('.menu');

            // Hide all other menus except the one associated with the clicked button
            $('.menu-sub-dropdown').not(targetMenu).removeClass('show');

            // Toggle the visibility of the menu
            if (targetMenu.hasClass('menu-sub-dropdown')) {
                targetMenu.toggleClass('show');
            }
        });

        $(document).on('click', '.rename', function () {
            const name = tr.find('.show-children').text()
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
                formData.append('file_manager', rowId)
                formData.append('_method', 'PATCH')
                renameFile(formData)
                tr.find('.show-children').text(name)
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

        const renameFile = (formData) => {
            $.ajax({
                url: "{{route('ajax.rename')}}",
                data: formData,
                method: 'post',
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (response) {
                    $('#rename_modal').modal('hide')
                    $('#name_folder_rename').val('')
                    // loadFolder(parentId)
                    showToast('Sửa thành công', null, 'success')
                },
                error: function (error) {
                    console.log(error)
                },
            });
        }

        const loadFolder = () => {
            $.ajax({
                url: "/ajax/children",
                method: "GET",
                data: {
                    'parent_id': parentId,
                    'user_id': userId,
                },
                success: function (response) {
                    // console.log(response.count_children)
                    $('tbody').html(response.view)
                    $('#folder_path').html(response.folder_path)
                    $('#count_item').html(response.count_children.toString() + ' items')
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
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (response) {
                    $('#create_folder_modal').modal('hide')
                    $('#name_folder').val('')
                    loadFolder(parentId)
                    showToast('Tạo thư mục thành công', null, 'success')
                },
                error: function (error) {
                    console.log(error)
                },
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
                error: function (error) {
                    // Handle errors
                    console.log(error);
                }
            });
        }
        loadFolder()
    })
</script>
