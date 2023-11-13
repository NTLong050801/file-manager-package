@extends('layouts.main')
@section('stylesheets')
    <link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <div id="kt_app_content_container" class="app-container container-xxl">
        <!--begin::Card-->
        <div class="card card-flush pb-0 bgi-position-y-center bgi-no-repeat mb-10"
             style="background-size: auto calc(100% + 10rem); background-position-x: 100%; background-image: url('{{asset('assets/media/illustrations/sketchy-1/4.png')}}')">
            <!--begin::Card header-->
            <div class="card-header pt-10">
                <div class="d-flex align-items-center">
                    <!--begin::Icon-->
                    <div class="symbol symbol-circle me-5">
                        <div class="symbol-label bg-transparent text-primary border border-secondary border-dashed">
                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs020.svg-->
                            <span class="svg-icon svg-icon-2x svg-icon-primary">
								<img src="{{asset('assets/media/icons/duotune/abstract/abs020.svg')}}" alt="">
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                    </div>
                    <!--end::Icon-->
                    <!--begin::Title-->
                    <div class="d-flex flex-column">
                        <h2 class="mb-1">File Manager</h2>
                        <div class="text-muted fw-bold">
                            <a href="#">Keenthemes</a>
                            <span class="mx-3">|</span>
                            <a href="#">File Manager</a>
                            <span class="mx-3">|</span>2.6 GB
                            <span class="mx-3">|</span>758 items
                        </div>
                    </div>
                    <!--end::Title-->
                </div>
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pb-0">
                <!--begin::Navs-->
                <div class="d-flex overflow-auto h-55px">
                    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-semibold flex-nowrap">
                        <!--begin::Nav item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary me-6 active" href="#">Files</a>
                        </li>
                        <!--end::Nav item-->
                        <!--begin::Nav item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary me-6" href="#">Settings</a>
                        </li>
                        <!--end::Nav item-->
                    </ul>
                </div>
                <!--begin::Navs-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
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
                        <button type="button" class="btn btn-light-primary me-3" id="kt_file_manager_new_folder">
                            <!--begin::Svg Icon | path: icons/duotune/files/fil013.svg-->
                            <span class="svg-icon svg-icon-2">
								<img src="{{asset('assets/media/icons/duotune/files/fil013.svg')}}" alt="">
							</span>
                            <!--end::Svg Icon-->New Folder
                        </button>
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
                        <div class="d-flex align-items-center flex-wrap">
                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs039.svg-->
                            <span class="svg-icon svg-icon-2 svg-icon-primary me-3">
                                <img src="{{asset('assets/media/icons/duotune/abstract/abs039.svg')}}" alt="">
							</span>
                            <!--end::Svg Icon-->
                            <a href="#">Keenthemes</a>
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr071.svg-->
                            <span class="svg-icon svg-icon-2 svg-icon-primary mx-1">
								<img src="{{asset('assets/media/icons/duotune/arrows/arr071.svg')}}" alt="">
							</span>
                            <!--end::Svg Icon-->
                            <a href="#">themes</a>
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr071.svg-->
                            <span class="svg-icon svg-icon-2 svg-icon-primary mx-1">
								<img src="{{asset('assets/media/icons/duotune/arrows/arr071.svg')}}" alt="">
							</span>
                            <!--end::Svg Icon-->
                            <a href="#">html</a>
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr071.svg-->
                            <span class="svg-icon svg-icon-2 svg-icon-primary mx-1">
								<img src="{{asset('assets/media/icons/duotune/arrows/arr071.svg')}}" alt="">
							</span>
                            <!--end::Svg Icon-->demo1
                        </div>
                    </div>
                    <!--end::Folder path-->
                    <!--begin::Folder Stats-->
                    <div class="badge badge-lg badge-primary">
                        <span id="kt_file_manager_items_counter">82 items</span>
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
                                        <tr class="even">
                                            <!--begin::Checkbox-->
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="1">
                                                </div>
                                            </td>
                                            <!--end::Checkbox-->
                                            <!--begin::Name=-->
                                            <td data-order="landing.html">
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Svg Icon | path: icons/duotune/files/fil003.svg-->
                                                    <span class="svg-icon svg-icon-2x svg-icon-primary me-4">
																	<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																		<path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z"
                                                                              fill="currentColor"></path>
																		<path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"></path>
																	</svg>
													</span>
                                                    <!--end::Svg Icon-->
                                                    <a href="#" class="text-gray-800 text-hover-primary">landing.html</a>
                                                </div>
                                            </td>
                                            <!--end::Name=-->
                                            <!--begin::Size-->
                                            <td>87 KB</td>
                                            <!--end::Size-->
                                            <!--begin::Last modified-->
                                            <td>22 Sep 2023, 5:30 pm</td>
                                            <!--end::Last modified-->
                                            <!--begin::Actions-->
                                            <td class="text-end" data-kt-filemanager-table="action_dropdown">
                                                <div class="d-flex justify-content-end">
                                                    <!--begin::Share link-->
                                                    <div class="ms-2" data-kt-filemanger-table="copy_link">
                                                        <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary" data-kt-menu-trigger="click"
                                                                data-kt-menu-placement="bottom-end">
                                                            <!--begin::Svg Icon | path: icons/duotune/coding/cod007.svg-->
                                                            <span class="svg-icon svg-icon-5 m-0">
                                                                <img src="{{asset('assets/media/icons/duotune/coding/cod007.svg')}}" alt="">
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </button>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-300px"
                                                             data-kt-menu="true">
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
                                                        <!--end::Share link-->
                                                    </div>
                                                    <!--begin::More-->
                                                    <div class="ms-2">
                                                        <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary me-2" data-kt-menu-trigger="click"
                                                                data-kt-menu-placement="bottom-end">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen052.svg-->
                                                            <span class="svg-icon svg-icon-5 m-0">
                                                                <img src="{{asset('assets/media/icons/duotune/general/gen052.svg')}}" alt="">
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </button>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4"
                                                             data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">Xem</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3" data-kt-filemanager-table="rename">Đổi tên</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">Tải về</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3" data-kt-filemanager-table-filter="move_row" data-bs-toggle="modal"
                                                                   data-bs-target="#kt_modal_move_to_folder">Di chuyển</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link text-danger px-3" data-kt-filemanager-table-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                        <!--end::More-->
                                                    </div>
                                                </div>
                                            </td>
                                            <!--end::Actions-->
                                        </tr>
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
        <!--begin::Rename template-->
        <div class="d-none" data-kt-filemanager-template="rename">
            <div class="fv-row">
                <div class="d-flex align-items-center">
                    <span id="kt_file_manager_rename_folder_icon"></span>
                    <input type="text" id="kt_file_manager_rename_input" name="rename_folder_name" placeholder="Enter the new folder name" class="form-control mw-250px me-3" value="">
                    <button class="btn btn-icon btn-light-primary me-3" id="kt_file_manager_rename_folder">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr085.svg-->
                        <span class="svg-icon svg-icon-1">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path
                                                                d="M9.89557 13.4982L7.79487 11.2651C7.26967 10.7068 6.38251 10.7068 5.85731 11.2651C5.37559 11.7772 5.37559 12.5757 5.85731 13.0878L9.74989 17.2257C10.1448 17.6455 10.8118 17.6455 11.2066 17.2257L18.1427 9.85252C18.6244 9.34044 18.6244 8.54191 18.1427 8.02984C17.6175 7.47154 16.7303 7.47154 16.2051 8.02984L11.061 13.4982C10.7451 13.834 10.2115 13.834 9.89557 13.4982Z"
                                                                fill="currentColor"></path>
														</svg>
													</span>
                        <!--end::Svg Icon-->
                    </button>
                    <button class="btn btn-icon btn-light-danger" id="kt_file_manager_rename_folder_cancel">
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
                </div>
            </div>
        </div>
        <!--end::Rename template-->
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
                    <form class="form" action="none" id="kt_modal_upload_form">
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
                        <div class="modal-body pt-10 pb-15 px-lg-17">
                            <!--begin::Input group-->
                            <div class="form-group">
                                <!--begin::Dropzone-->
                                <div class="dropzone dropzone-queue mb-2" id="kt_modal_upload_dropzone">
                                    <!--begin::Controls-->
                                    <div class="dropzone-panel mb-4">
                                        <a class="dropzone-select btn btn-sm btn-primary me-2 dz-clickable">Attach files</a>
                                        <a class="dropzone-upload btn btn-sm btn-light-primary me-2">Upload All</a>
                                        <a class="dropzone-remove-all btn btn-sm btn-light-primary">Remove All</a>
                                    </div>
                                    <!--end::Controls-->
                                    <!--begin::Items-->
                                    <div class="dropzone-items wm-200px">

                                    </div>
                                    <!--end::Items-->
                                    <div class="dz-default dz-message">
                                        <button class="dz-button" type="button">Drop files here to upload</button>
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
    </div>
@endsection
@section('javascript')
    @include('pages.file-manager.components.javascript')
@endsection
