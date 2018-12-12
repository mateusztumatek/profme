 <div id="friend_search_result">
    <div class="friends_search">
        <h3> Lista znalezionych użytkowników: </h3>
        <hr>
        <div class="row friends">
            @foreach($users as $user)

                <div class="col-sm-3" style="padding: 10px;" >
                    <div class="friend d-flex">
                        <div class="col-sm-11 d-flex align-items-center ">
                            <div class="profile-img">
                                <img src="{{$user->getProfileURL()}}">

                            </div>
                            <div class="ml-3">
                                <h2><a href="{{url('user/'. $user->id)}}">{{$user->name}}</a></h2>
                                @if($user->city)    <p> miasto: {{$user->city}}</p> @endif

                            </div>

                        </div>
                        <div class="col-sm-1">
                            <form onsubmit="add_friend(this, event)" action="{{route('friends.store')}}">
                                @CSRF
                                <input type="hidden" name="user_1" value="{{\Illuminate\Support\Facades\Auth::id()}}">
                                <input type="hidden" name="user_2" value="{{$user->id}}">
                                <a onclick="$(this).parent().submit()"><i class="fa fa-plus"></i></a>
                            </form>

                        </div>
                    </div>

                </div>

            @endforeach

        </div>

        <hr>
    </div>

</div>