@foreach($childrens as $children)
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
                    <img src="{{asset('assets/media/icons/duotune/files/fil003.svg')}}" alt="">
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

@endforeach
