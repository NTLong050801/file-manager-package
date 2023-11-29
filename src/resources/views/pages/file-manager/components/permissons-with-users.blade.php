<div class="symbol-group symbol-hover">
    @foreach($users as $key => $userPermission)
        @if($key < 2)
            <div class="symbol symbol-30px symbol-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$userPermission->name}}">
                <div class="symbol-label" style="background-image:url({{$userPermission->avatar}})"></div>
            </div>
        @else
            <div class="symbol symbol-circle symbol-30px btn-show-permission-user"
                 data-bs-toggle="tooltip" data-bs-placement="top" title="và {{ $users->count()-2 }} người khác">
                <div class="symbol-label fs-2 fw-semibold bg-success text-inverse-success">  +{{ $users->count()-2 }}</div>
            </div>
            @break
        @endif
    @endforeach
</div>
