@if(!$unaccept_friends->isEmpty())

<div id="unaccept_friends">
    <div class="col-sm-12">


        <h3> Lista niezaakceptowanych zaproszeń: </h3>
        <hr>
        <div class="row friends">
            @foreach(\App\Friend::getUserFriends(\Illuminate\Support\Facades\Auth::user(), $unaccept_friends) as $user)

                <div class="col-sm-3" style="padding: 10px;" >
                    <div class="friend d-flex">
                        <div class="col-sm-11 d-flex align-items-center ">
                            <div class="profile-img">
                                <img src="{{$user->getProfileURL()}}">

                            </div>
                            <div class="ml-3">
                                <h2>{{$user->name}}</h2>
                                @if($user->city)    <p> miasto: {{$user->city}}</p> @endif

                            </div>

                        </div>
                        <div class="col-sm-1">
                            <form onsubmit="accept_friend(this, event)" action="{{route('friends.accept')}}">
                                @CSRF
                                <input type="hidden" name="user_1" value="{{$user->id}}">
                                <input type="hidden" name="user_2" value="{{\Illuminate\Support\Facades\Auth::id()}}">
                                <a onclick="$(this).parent().submit()"><i class="fa fa-check"></i></a>
                            </form>
                            <form onsubmit="accept_friend(this, event)" action="{{route('friends.decline')}}">
                                @CSRF
                                <input type="hidden" name="user_1" value="{{$user->id}}">
                                <input type="hidden" name="user_2" value="{{\Illuminate\Support\Facades\Auth::id()}}">
                                <a onclick="$(this).parent().submit()"><i class="fa fa-trash"></i></a>
                            </form>

                        </div>
                    </div>

                </div>

            @endforeach

        </div>

        <hr>

    </div>
</div>

    @endif