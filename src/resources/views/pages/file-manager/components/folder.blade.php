@if(!empty($children) && $children->count() > 0 )
    @foreach($children as $child)
        <tr class="even" data-id="{{$child->id}}">
            <!--begin::Checkbox-->
            <td>
                @if($child->user_id == $userId)
                    <div class="form-check">
                        <input class="form-check-input border-black checkbox-item-file" type="checkbox">
                    </div>
                @endif
            </td>
            <!--end::Checkbox-->
            <td>{{$loop->iteration}}</td>
            <!--begin::Name=-->
            <td data-order="landing.html">
                <div class="d-flex align-items-center">

                    <a href="javascript:void(0)"
                       class="text-gray-800 text-hover-primary ms-5 name-file @switch($child->file_type) @case('pdf')  preview-pdf  @break
                        @case('jpeg')
                        @case('png')
                        @case('jpg')
                        @case('gif') preview-image @break @case(null) show-children @break @default @endswitch"
                       @if(in_array($child->file_type,['png','jpg','jpeg'])) data-src="{{route('file-manager.show-image-from-storage',$child->file_path)}}" @endif
                       data-type="{{$child->users->where('pivot.user_id',$userId)->count() > 0 ? 'share-folder' : 'private-folder'}}" data-id="{{$child->id}}">
                        @if(empty($child->file_type))
                            {{--                    <img src="{{asset('assets/media/icons/duotune/files/fil012.svg')}}" alt="">--}}
                            <span class="svg-icon svg-icon-2x svg-icon-primary me-4">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor"></path>
                            <path d="M9.2 3H3C2.4 3 2 3.4 2 4V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V7C22 6.4 21.6 6 21 6H12L10.4 3.60001C10.2 3.20001 9.7 3 9.2 3Z" fill="currentColor"></path>
                        </svg>
                        </span>
                        @else
                            @switch($child->file_type)
                                @case('doc')
                                @case('docx')
                                    <img src="{{asset('vendor/file-manager/images/word.svg')}}" width="35" height="30" alt="">
                                    @break
                                @case('xlsx')
                                @case('xls')
                                    <img src="{{asset('vendor/file-manager/images/excel.svg')}}" width="35" height="30" alt="">
                                    @break
                                @case('pdf')
                                    <img src="{{asset('vendor/file-manager/images/pdf.svg')}}" width="35" height="30" alt="">
                                    @break
                                @case('jpeg')
                                @case('png')
                                @case('jpg')
                                @case('gif')
                                    <img src="{{asset('vendor/file-manager/images/image_thumb.svg')}}" width="35" height="30" alt="">
                                    @break
                                @default
                                    <!--begin::Svg Icon | path: icons/duotune/files/fil003.svg-->
                                    <span class="svg-icon svg-icon-2x svg-icon-primary me-4">
                                    <img src="{{asset('vendor/file-manager/icons/fil003.svg')}}" alt="">
                                </span>
                                    <!--end::Svg Icon-->
                                    @break
                            @endswitch

                        @endif
                        <span class="sp-name-file">{{$child->name}}</span>
                    </a>
                </div>
            </td>
            <!--end::Name=-->
            <td>
                <div>
                    <img src="{{$child->user->avatar}}" width="30" height="30" class="rounded-circle" alt=""
                         data-bs-toggle="tooltip" data-bs-placement="top" title="{{$child->user->name}}"
                    >
                </div>
            </td>
            <!--begin::Size-->
            <td>{{empty($child->file_type) ? null : $child->file_size}}</td>
            <!--end::Size-->
            <td>
                @if($child->user_id == $userId && !$child->is_trash)
                    {{--                    <button class="btn btn-sm btn-primary rounded-5 add-permission" data-bs-toggle="modal" data-bs-target="#permission_modal_{{$children->id}}"><i class="fa-solid fa-user-plus"></i></button>--}}
                    <div class="d-flex">
                        @foreach($child->users->take(3) as $userFile)
                            <div>
                                <img src="{{$userFile->avatar}}" width="30" height="30" class="rounded-circle" alt=""
                                     data-bs-toggle="tooltip" data-bs-placement="top" title="{{$userFile->name}}"
                                >
                            </div>
                        @endforeach
                        <a href="#" class="d-flex justify-content-center align-items-center bg-secondary rounded-circle ms-1 add-permission w-30px h-30px" data-bs-toggle="modal"
                           data-bs-target="#permission_modal_{{$child->id}}" data-bs-placement="top" title="Thêm quyền">
                            <svg class=" svg-inline--fa fa-plus fa-w-14" aria-hidden="true" data-prefix="fa" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 448 512" data-fa-i2svg=""
                                 style="display: inline-block; font-size: inherit;height: 1em;overflow: visible;vertical-align: -0.125em;"
                            >
                                <path fill="currentColor"
                                      d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="modal fade modal-permission" id="permission_modal_{{$child->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="card-title">
                                        <h3 class="modal-title" style="color: #242C8A">Thêm quyền cho tệp "{{$child->name}}"</h3>
                                    </div>
                                    <div class="card-toolbar">
                                        <div class="position-relative">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                            <span class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6">
                                            <img src="{{asset('vendor/file-manager/icons/gen021.svg')}}" alt="">
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
                                                               name="receiver[]" @if(in_array($user->id,$child->users->pluck('id')->toArray())) checked @endif >
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
            <td>{{\Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s',$child->created_at)->format('d/m/Y')}}</td>
            <!--end::Last modified-->
            <td>
                @if(sizeof($child->getPathFileIsTrash($child,$userId, $isTrash, $isShare)) > 0 || !empty($child->file_type))
                    {{--                    <button class="btn btn-sm btn-success download"><i class="fa-regular fa-circle-down fa-2xl"></i></button>--}}
                    <i class="fa-regular fa-circle-down text-success fs-2x download" data-bs-toggle="tooltip" data-bs-placement="top" title="Tải xuống"></i>
                @endif
            </td>
            <!--begin::Actions-->
            <td class="text-end" data-kt-filemanager-table="action_dropdown" style="position: relative">
                @if($child->user_id == $userId)
                    <div class="d-flex justify-content-end">
                        <!--begin::More-->
                        <div class="ms-2 more" data-id="{{$child->id}}" style="position: relative">
                            <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary me-2 menu-toggle" data-kt-menu-trigger="click"
                                    data-kt-menu-placement="bottom-end">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen052.svg-->
                                <span class="svg-icon svg-icon-5 m-0">
                                    <img src="{{asset('vendor/file-manager/icons/gen052.svg')}}" alt="">
                                </span>
                                <!--end::Svg Icon-->
                            </button>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4"
                                 data-kt-menu="true">
                                @if(!$child->is_direct_deleted)
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3 pt-0 pb-0">
                                        <a href="#" class="menu-link px-3 rename" data-kt-filemanager-table="rename">Đổi tên</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3 move-file" data-kt-filemanager-table-filter="move_row" data-bs-toggle="modal"
                                           data-bs-target="#kt_modal_move_to_folder">Di chuyển</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3 pt-0 pb-0">
                                        <a href="#" class="menu-link text-danger px-3 delete" data-kt-filemanager-table-filter="delete_row">Xoá</a>
                                    </div>
                                    <!--end::Menu item-->
                                @else
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3 pt-0 pb-0">
                                        <a href="#" class="menu-link px-3 restore">Khôi phục</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3 pt-0 pb-0">
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
                <img src="{{asset('vendor/file-manager/images/not-found-item.png')}}" class="mw-400px">
                <div class="fs-1 fw-bolder text-dark">Không tìm thấy.</div>
                <div class="fs-6">Bắt đầu tạo thư mục mới hoặc tải lên tệp mới!</div>
            </div>
        </td>x
    </tr>
@endif

