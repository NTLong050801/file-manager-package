<div class="d-flex flex-stack mb-5">
    <!--begin::Folder path-->
    <div class="badge badge-lg badge-light-primary">
        <div class="d-flex align-items-center flex-wrap" id="path_folder_move_modal">
            {!! $finalPath !!}
        </div>
    </div>
    <!--end::Folder path-->
    <!--begin::Folder Stats-->
    <div class="badge badge-lg badge-primary">
        <span id="kt_file_manager_items_counter">{{$folders->count()}} items</span>
    </div>
    <!--end::Folder Stats-->
</div>
<!--begin::Item-->
<div class="d-flex opacity-50">
    <!--begin::Checkbox-->
    <div class="form-check form-check-custom form-check-solid">
        <!--begin::Label-->
        <label class="form-check-label" for="kt_modal_move_to_folder">
            <div class="fw-bold">
                @switch($file->file_type)
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
                    @case(null)
                        <span class="svg-icon svg-icon-2 svg-icon-primary me-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor"></path>
                                <path
                                    d="M9.2 3H3C2.4 3 2 3.4 2 4V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V7C22 6.4 21.6 6 21 6H12L10.4 3.60001C10.2 3.20001 9.7 3 9.2 3Z"
                                    fill="currentColor"></path>
                            </svg>
                        </span>
                    @break
                    @default
                        <!--begin::Svg Icon | path: icons/duotune/files/fil003.svg-->
                        <span class="svg-icon svg-icon-2x svg-icon-primary me-4">
                                    <img src="{{asset('vendor/file-manager/icons/fil003.svg')}}" alt="">
                                </span>
                        <!--end::Svg Icon-->
                        @break
                @endswitch
                <!--end::Svg Icon-->{{$file->name}}
            </div>
        </label>
        <!--end::Label-->
    </div>
    <!--end::Checkbox-->
</div>
<!--end::Item-->
<div class="separator separator-dashed my-5"></div>
@foreach($folders as $folder)
<!--begin::Item-->
<div class="d-flex folder-move" data-id="{{$folder->id}}">
    <!--begin::Checkbox-->
    <div class="form-check form-check-custom form-check-solid">
        <!--begin::Label-->
        <label class="form-check-label" for="kt_modal_move_to_folder">
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
                <!--end::Svg Icon-->{{$folder->name}}
            </div>
        </label>
        <!--end::Label-->
    </div>
    <!--end::Checkbox-->
</div>
<!--end::Item-->
<div class="separator separator-dashed my-5"></div>
@endforeach
