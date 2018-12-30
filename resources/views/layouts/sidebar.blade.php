<div class="col-md-2 side-bar" style="" >
    <div class="logo">

       <a href="{{route('home')}}"><img src="{{url('img/logo.png')}}"></a>
    </div>
    <div class="user-profile">
        <div class="user-image">
            <img src="@if(\Illuminate\Support\Facades\Auth::user()->getProfileImage() != null) {{url('public/users/'. \Illuminate\Support\Facades\Auth::user()->id.'/'.\Illuminate\Support\Facades\Auth::user()->getProfileImage()->path)}} @else{{url('img/profile1.jpg')}} @endif">
            <a href="#" class="my-button">Zmień</a>
        </div>
        <a href="{{route('user.show', ['user' => \Illuminate\Support\Facades\Auth::id()])}}"><h4 class="mt-3 mb-3">{{\Illuminate\Support\Facades\Auth::user()->name}}</h4></a>
    </div>

    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical" >
        <ul style="padding: 0px;">
            <li><a style="border-top: 1px solid rgba(255,255,255,0.3);" class="nav-link "  href="{{url('rates/'.\Illuminate\Support\Facades\Auth::id())}}">Oceny</a></li>
            <li><a class="nav-link" href="{{url('privileges/'.\Illuminate\Support\Facades\Auth::id())}}" >Przywileje</a></li>
            <li   class="dropdown" >
                <a  id="settings" href="#" class=" nav-link" >Ustawienia</a>
                <ul   id = "settings_menu" class="dropdown-menu">

                    <li><a  class="nav-link" href="{{route('edit.user', ['user' => \Illuminate\Support\Facades\Auth::user()])}}">Ustawienia Konta</a></li>
                    <li><a  class="nav-link" href="#post-create" data-toggle="modal">Dodaj Post</a></li>
                </ul>
            </li>
           @if(!empty(\Illuminate\Support\Facades\Auth::user()->getCompany()))
               <li class="dropdown">
                   @if(count($unConfirmEmployees = \Illuminate\Support\Facades\Auth::user()->getUnconfirmEmployees()) != 0)
                       <a href="#" id="companies" class=" nav-link color_orange" >Twoje Firmy {{count(\Illuminate\Support\Facades\Auth::user()->getUnconfirmEmployees())}}</a>
                   @else
                       <a href="#" id="companies" class=" nav-link" >Twoje Firmy</a>

                   @endif

                   <ul class="dropdown-menu" id="companies_menu">
                    @foreach(\Illuminate\Support\Facades\Auth::user()->getCompany() as $company)
                        @if(count($unconfirmEmployee = $company->getUnconfirmEmployees()) != 0)
                              <li><a  class="nav-link color_orange" href="{{url('company/'.$company->id)}}">{{$company->official_name}}({{count($unconfirmEmployee)}})</a></li>
                        @else
                               <li><a class="nav-link" href="{{url('company/'.$company->id)}}">{{$company->official_name}}</a></li>

                           @endif
                               @endforeach
                   </ul>
               </li>



                @endif
        </ul>

    </div>
    <div class="last-events ml-2 mr-2">
        <div class="last-events-header">
            <h4>
                Ostatnie oceny twoich znajomych
            </h4>
        </div>
        <div class="last-events-content">
            @foreach(\Illuminate\Support\Facades\Auth::user()->getFriendsRates() as $rate)
            <div class="row item " style="margin: 0px;">
                <div class="col-md-8">
                    <h4>
                        {{$rate->getElement()->getUser()->name}}
                    </h4>
                    <p> Za: <span> #{{$rate->elem_type}} </span></p>
                </div>
                <div class="col-md-4">
                    <div class="rate-circle" style="padding: 0px; border: 0px;"><span style="font-size: 1.5rem !important;">{{$rate->rate}}</span></div>

                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>