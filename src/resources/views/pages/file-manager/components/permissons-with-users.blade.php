@foreach($users as $key => $userPermission)
    @if($key < 2)
        <div>
            <img src="{{$userPermission->avatar}}" width="30" height="30" class="rounded-circle" alt=""
                 data-bs-toggle="tooltip" data-bs-placement="top" title="{{$userPermission->name}}"
            >
        </div>
    @else
        <div class="rounded-circle overflow-hidden bg-primary text-white" style="width: 30px; height: 30px; line-height: 30px; text-align: center; position: relative;">
            +{{ $users->count()-2 }}
        </div>
        @break
    @endif
@endforeach
