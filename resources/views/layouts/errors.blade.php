<div class="errors @if(\Illuminate\Support\Facades\Session::has('errors')) active @elseif(\Illuminate\Support\Facades\Session::has('message')) active  @endif">


    @if(\Illuminate\Support\Facades\Session::has('message'))
        <p>{{\Illuminate\Support\Facades\Session::get('message')}}</p>
        @endif


    @if(\Illuminate\Support\Facades\Session::has('errors'))
        @foreach(\Illuminate\Support\Facades\Session::get('errors') as $error)
        <p>
            {{$error}}
        </p>

            @endforeach
        @endif
</div>