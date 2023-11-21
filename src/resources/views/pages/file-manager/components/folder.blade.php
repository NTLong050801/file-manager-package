@if(!empty($childrens) && $childrens->count() > 0 )
    @foreach($childrens as $children)
        <tr class="even" data-id="{{$children->id}}">
            <!--begin::Checkbox-->
            <td>
                <div class="form-check">
                    <input class="form-check-input border-black checkbox-item" type="checkbox">
                </div>
            </td>
            <!--end::Checkbox-->
            <td>{{$loop->iteration}}</td>
            <!--begin::Name=-->
            <td data-order="landing.html">
                <div class="d-flex align-items-center">
                    @if(empty($children->file_type))
                        {{--                    <img src="{{asset('assets/media/icons/duotune/files/fil012.svg')}}" alt="">--}}
                        <span class="svg-icon svg-icon-2x svg-icon-primary me-4">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor"></path>
                            <path d="M9.2 3H3C2.4 3 2 3.4 2 4V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V7C22 6.4 21.6 6 21 6H12L10.4 3.60001C10.2 3.20001 9.7 3 9.2 3Z" fill="currentColor"></path>
                        </svg>
                        </span>
                    @else
                        @switch($children->file_type)
                            @case('doc')
                            @case('docx')
                                <img src="{{asset('vendor/file-manager/image/word.svg')}}" width="35" height="30" alt="">
                                @break
                            @case('xlsx')
                            @case('xls')
                                <img src="{{asset('vendor/file-manager/image/excel.svg')}}" width="35" height="30" alt="">
                                @break
                            @case('pdf')
                                <img src="{{asset('vendor/file-manager/image/pdf.svg')}}" width="35" height="30" alt="">
                                @break
                            @case('jpeg')
                            @case('png')
                            @case('jpg')
                            @case('gif')
                                <img src="{{asset('vendor/file-manager/image/image_thumb.svg')}}" width="35" height="30" alt="">
                                @break
                            @default
                                <!--begin::Svg Icon | path: icons/duotune/files/fil003.svg-->
                                <span class="svg-icon svg-icon-2x svg-icon-primary me-4">
                                    <img src="{{asset('assets/media/icons/duotune/files/fil003.svg')}}" alt="">
                                </span>
                                <!--end::Svg Icon-->
                                @break
                        @endswitch

                    @endif

                    <a href="#" class="text-gray-800 text-hover-primary ms-5 name-file @if(empty($children->file_type)) show-children @endif"
                       data-type="{{$children->users->where('pivot.user_id',$userId)->count() > 0 ? 'share-folder' : 'private-folder'}}" data-id="{{$children->id}}">{{$children->name}}</a>
                </div>
            </td>
            <!--end::Name=-->
            <td>
                <div>
                    <img src="{{$children->user->avatar}}" width="30" height="30" class="rounded-circle" alt=""
                         data-bs-toggle="tooltip" data-bs-placement="top" title="{{$children->user->name}}"
                    >
                </div>
            </td>
            <!--begin::Size-->
            <td>{{empty($children->file_type) ? null : $children->file_size}}</td>
            <!--end::Size-->
            <td>
                @if($children->user_id == $userId && !$children->is_trash)
                    <button class="btn btn-sm btn-primary add-permission" data-bs-toggle="modal" data-bs-target="#permission_modal_{{$children->id}}">Thêm</button>
                    <div class="modal fade" id="permission_modal_{{$children->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="card-title">
                                        <h3 class="modal-title" style="color: #242C8A">Thêm quyền cho tệp "{{$children->name}}"</h3>
                                    </div>
                                    <div class="card-toolbar">
                                        <div class="position-relative">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                            <span class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6">
                                            <img src="{{asset('assets/media/icons/duotune/general/gen021.svg')}}" alt="">
                                        </span>
                                            <!--end::Svg Icon-->
                                            <input type="text" class="form-control-sm ps-10 border-black rounded-pill w-300px input_keyword" name="keyword" placeholder="Tên người dùng"
                                                   autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row justify-content-start">
                                        @foreach($users as $user)
                                            <div class="col-lg-4 col-md-6 col-sm-12 mb-4 block-user" style="display: flex">
                                                <div class="col-3 col-md-2 col-sm-4 align-self-center">
                                                    <label for="mail_receiver" class="form-check form-check-custom me-10">
                                                        <input class="form-check-input border-black h-20px w-20px receiver-checkbox" data-id="{{$user->id}}" value="{{$user->id}}" type="checkbox"
                                                               name="receiver[]" @if(in_array($user->id,$children->users->pluck('id')->toArray())) checked @endif >
                                                    </label>
                                                </div>
                                                <div class="col-9 col-md-9 col-sm-9 d-flex align-items-center col-md-10 col-sm-12">
                                                    <a href="#" class="symbol symbol-50px">
                                                        <span class="symbol-label" style="background-image:url({{$user->avatar}});"></span>
                                                    </a>
                                                    <div class="ms-5 d-flex flex-column">
                                                        <a href="#" class="text-gray-600 text-hover-primary name-user">{{$user->name}}</a>
                                                        <a href="#" class="text-gray-600 text-hover-primary name-user">{{$user->username}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </td>
            <!--begin::Last modified-->
            <td>{{\Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s',$children->created_at)->format('d/m/Y')}}</td>
            <!--end::Last modified-->
            <td>
                @if(sizeof($children->getPathFileIsTrash($children,$userId, $isTrash, $isShare)) > 0 || !empty($children->file_type))
                    <button class="btn btn-sm btn-success download">Tải</button>
                @endif
            </td>
            <!--begin::Actions-->
            <td class="text-end" data-kt-filemanager-table="action_dropdown">
                @if($children->user_id == $userId)
                    <div class="d-flex justify-content-end">
                        <!--begin::More-->
                        <div class="ms-2 more" data-id="{{$children->id}}">
                            <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary me-2 menu-toggle" data-kt-menu-trigger="click"
                                    data-kt-menu-placement="bottom-end">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen052.svg-->
                                <span class="svg-icon svg-icon-5 m-0">
                            <img src="{{asset('assets/media/icons/duotune/general/gen052.svg')}}" alt="">
                        </span>
                                <!--end::Svg Icon-->
                            </button>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4"
                                 data-kt-menu="true" style=" position: absolute;z-index: 100;right:50px">
                                @if(!$children->is_direct_deleted)
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3 rename" data-kt-filemanager-table="rename">Đổi tên</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" data-kt-filemanager-table-filter="move_row" data-bs-toggle="modal"
                                           data-bs-target="#kt_modal_move_to_folder">Di chuyển</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3 =">
                                        <a href="#" class="menu-link text-danger px-3 delete" data-kt-filemanager-table-filter="delete_row">Xoá</a>
                                    </div>
                                    <!--end::Menu item-->
                                @else
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3 restore">Khôi phục</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3 text-danger destroy">Xoá vĩnh viễn</a>
                                    </div>
                                    <!--end::Menu item-->
                                @endif

                            </div>
                            <!--end::Menu-->
                            <!--end::More-->
                        </div>
                    </div>
                @endif
            </td>
            <!--end::Actions-->
        </tr>
    @endforeach
@else
    <tr class="odd">
        <td valign="top" colspan="12" class="dataTables_empty">
            <div class="d-flex flex-column flex-center">
                <img src="{{asset('assets/media/illustrations/sketchy-1/5.png')}}" class="mw-400px">
                <div class="fs-1 fw-bolder text-dark">Không tìm thấy.</div>
                <div class="fs-6">Bắt đầu tạo thư mục mới hoặc tải lên tệp mới!</div>
            </div>
        </td>
    </tr>
@endif

