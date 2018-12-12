<div class="col-sm-12 friends-list">

        <h3> Lista twoich znajomych: </h3>
        <hr>
        <div class="row friends">
            @if($friends->isEmpty())
                <div class="col-sm-12 text-center p-5">
                    <p>Nie masz jeszcze żadnych znajomych</p>
                </div>
                @endif
            @foreach($friends as $friend)

                <div class="col-sm-3" style="padding: 10px;" >
                    <div class="friend d-flex">
                        <div class="col-sm-11 d-flex align-items-center ">
                            <div class="profile-img">
                                <img onclick="loadGallery(this)" src="{{$friend->getUser(\Illuminate\Support\Facades\Auth::user())->getProfileURL()}}">

                            </div>
                            <div class="ml-3">
                                <h2><a href="{{url('/user/'. $friend->getUser(\Illuminate\Support\Facades\Auth::user())->id)}}">{{$friend->getUser(\Illuminate\Support\Facades\Auth::user())->name}}</a></h2>
                                @if($friend->getUser(\Illuminate\Support\Facades\Auth::user())->city)    <p> miasto: {{$friend->getUser(\Illuminate\Support\Facades\Auth::user())->city}}</p> @endif
                                @if($friend->updated_at)
                                <p>znajomi od: {{ \Carbon\Carbon::parse($friend->updated_at)->format('d/m/Y')}}
                                </p>
                                    @endif
                            </div>


                        </div>
                        <div class="col-sm-1">
                            <form method="POST" onsubmit="delete_friend(this, event)" action="{{route('friends.delete')}}">
                                @CSRF
                                <input type="hidden" name="user_1" value="{{\Illuminate\Support\Facades\Auth::id()}}">
                                <input type="hidden" name="user_2" value="{{$friend->getUser(\Illuminate\Support\Facades\Auth::user())->id}}">
                                <a onclick="$(this).parent().submit()" style="font-size: 20px"><i class="fa fa-trash"></i></a>
                            </form>

                        </div>
                    </div>

                </div>

            @endforeach

        </div>
        <div class="col-sm-12 justify-content-center">
            @if($friends instanceof \Illuminate\Pagination\LengthAwarePaginator)
            {{$friends->links()}}
                @endif
        </div>
        <hr>

    <div class="col-sm-6 m-auto">


        <div class="input-group stylish-search">


            <input onclick="" id="search_friends_input" type="text" class="form-control"  placeholder="Search" >
            <span class="input-group-addon">
                            <button onclick="search_friends()" type="button">
                                <span class="fa fa-search"></span>
                            </button>
                </span>
        </div>

    </div>
    <div id="friend_search_result"></div>
</div>
