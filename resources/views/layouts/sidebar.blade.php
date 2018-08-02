<div class="col-md-2 side-bar" style="" >
    <div class="logo">

       <a href="{{route('home')}}"><img src="{{url('img/logo.png')}}"></a>
    </div>
    <div class="user-profile">
        <div class="user-image">
            <img src="@if(\Illuminate\Support\Facades\Auth::user()->getProfileImage() != null) {{url('public/users/'. \Illuminate\Support\Facades\Auth::user()->id.'/'.\Illuminate\Support\Facades\Auth::user()->getProfileImage()->path)}} @else{{url('img/profile1.jpg')}} @endif">
            <a href="#" class="my-button">Zmień</a>
        </div>
        <h4 class="mt-3 mb-3">{{\Illuminate\Support\Facades\Auth::user()->name}}</h4>
    </div>

    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical" >
        <ul style="padding: 0px;">
            <li><a style="border-top: 1px solid rgba(255,255,255,0.3);" class="nav-link "  href="#v-pills-home">Oceny</a></li>
            <li><a class="nav-link" id="v-pills-profile-tab" data-toggle="pill"  href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Przwileje</a></li>
            <li><a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages"  aria-controls="v-pills-messages" aria-selected="false">Posty</a></li>
            <li   class="dropdown" >
                <a  id="settings" href="#" class=" nav-link" >Ustawienia</a>
                <ul   class="dropdown-menu">

                    <li><a  class="nav-link" href="{{route('edit.user', ['user' => \Illuminate\Support\Facades\Auth::user()])}}">Ustawienia Konta</a></li>
                    <li><a  class="nav-link" href="#post-create" data-toggle="modal">Dodaj Post</a></li>
                    <li><a  class="nav-link"href="{{url('posts', ['user' => \Illuminate\Support\Facades\Auth::user()])}}">Twoje posty</a></li>
                    <li><a  class="nav-link"href="#">Something else here</a></li>
                    <li><a  class="nav-link" href="#">One more separated link</a></li>
                </ul>
            </li>

        </ul>

    </div>
    <div class="last-events ml-2 mr-2">
        <div class="last-events-header">
            <h4>
                Ostatnie oceny twoich znajomych
            </h4>
        </div>
        <div class="last-events-content">
            <div class="row item " style="margin: 0px;">
                <div class="col-md-8">
                    <h4>
                        Adam Warchol
                    </h4>
                    <p> Za: <span> #Post </span></p>
                </div>
                <div class="col-md-4">
                    <div class="my-progress-bar"></div>

                </div>
            </div>
            <div class="row item " style="margin: 0px;">
                <img src="{{url('img/foto1.jpg')}}">
                <div class="col-md-8">

                    <h4>
                        Angelika Marko
                    </h4>
                    <p> Za: <span> #Fotografia </span></p>
                </div>
                <div class="col-md-4">
                    <div class="my-progress-bar"></div>

                </div>
            </div>
            <div class="row item " style="margin: 0px;">
                <div class="col-md-8">
                    <h4>
                        Adam Warchol
                    </h4>
                    <p> Za: <span> #Post </span></p>
                </div>
                <div class="col-md-4">
                    <div class="my-progress-bar"></div>

                </div>
            </div>
        </div>
    </div>

</div>