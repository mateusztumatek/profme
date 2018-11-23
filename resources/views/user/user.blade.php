@extends('layouts.app')

@section('content')
    <div class="col-sm-12">
        <div  id="tabs">
            <ul class="tabs-label">
                <li class="tab-label"><a href="#tabs-1">Profil ogólny</a></li>
                @if(\App\Friend::isFriends($user, \Illuminate\Support\Facades\Auth::user()) || \Illuminate\Support\Facades\Auth::id() == $user->id)
                <li class="tab-label"><a href="#tabs-2">Praca</a></li>
                <li class="tab-label"><a href="#tabs-3">Wykształcenie</a></li>
                <li class="tab-label"><a href="#tabs-4">Aktywność</a></li>
                @endif
                @if(\Illuminate\Support\Facades\Auth::id() == $user->id)
                <li class="tab-label"><a href="#tabs-5">Dodatkowe informacje</a></li>
                    @endif
            </ul>
            <div class="tab" id="tabs-1">
                <div class="tab-content">
                    <div class="row justify-content-center">
                        <div class="col-sm-4 row">
                            <div class="user-image" style="margin: unset !important; margin-left: auto; margin-right: auto">
                                <img src="{{$user->getProfileURL()}}">
                            </div>
                            <div class="divider"></div>
                        </div>

                        <div class="mt-3 col-sm-8">
                            @if(\Illuminate\Support\Facades\Auth::id() != $user->id)
                                @if(!\App\Friend::isFriends($user, \Illuminate\Support\Facades\Auth::user()))
                                    @if(\App\Friend::isUnacceptFriends($user, \Illuminate\Support\Facades\Auth::user()))
                                        <div class="float-right">
                                            <p>wysłałeś zaproszenie temu użytkownikowi</p>
                                        </div>
                                        @else
                                            <form class="float-right" action="{{route('friends.store')}}" method="POST">
                                                @CSRF
                                                <input type="hidden" name="user_1" value="{{\Illuminate\Support\Facades\Auth::id()}}">
                                                <input type="hidden" name="user_2" value="{{$user->id}}">
                                                <button class="btn my-button" type="submit"> Dodaj znajomego </button>
                                            </form>
                                        @endif
                                @else
                                    <form class="float-right" action="{{route('friends.delete')}}" method="POST">
                                        @CSRF
                                        <input type="hidden" name="user_1" value="{{\Illuminate\Support\Facades\Auth::id()}}">
                                        <input type="hidden" name="user_2" value="{{$user->id}}">
                                        <button class="btn my-button" type="submit"> usuń znajomego </button>
                                    </form>

                                    @endif
                            @endif


                            <h2 class="text-left"><span style="font-size: 80%; color: #4e555b">Imię i nazwisko:</span> <strong>{{$user->name}} </strong></h2>

                            <h2><span style="font-size: 80%; color: #4e555b">Płeć:</span> <strong> {{$user->getSex()}} </strong></h2>

                            <h2><span style="font-size: 80%; color: #4e555b">Data urodzenia:</span> <strong> {{$user->date_of_birth}} </strong></h2>

                            <h2><span style="font-size: 80%; color: #4e555b">Miasto:</span><strong>{{$user->city}}</strong></h2>

                            <div class="rate-panel d-flex mt-5" >
                                <div class="col-sm-4" style="z-index: 1000">
                                    <div class="c100 p{{number_format(\App\Rate::getPercentageRate(\App\Rate::getRate($user), 2), 0)}} big orange circle">
                                        <div class="description">
                                            <div class="d-block">
                                                <p >ogólna ocena:</p>
                                                <p class="rate">{{number_format(\App\Rate::getRate($user), 2)}}</p>
                                            </div>
                                        </div>
                                        <div class="slice">
                                            <div class="bar"></div>
                                            <div class="fill"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-8">

                                    <svg class="svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1381px" height="219px" viewBox="30 1 864 137" preserveAspectRatio="xMidYMid meet" ><rect id="svgEditorBackground" x="0" y="0" width="1380" height="840" style="fill: none; stroke: none;"/><polyline style="stroke:#055e60;fill:none;stroke-width:1px;" id="e1_polyline" points="11 139 136 13 852 11"/><polyline style="stroke:black;fill:none;" stroke-width="0.6256335988414193" id="e2_polyline" points="159.285 11.0033"/></svg>
                                    <div class="c100 p{{number_format(\App\Rate::getPercentageRate(\App\Rate::getUserEmployeeRate($user, 'diligence'), 2), 0)}} big orange circle small-circle">
                                        <div class="description">
                                            <div class="d-block">
                                                <p >Pracowitość:</p>
                                                <p class="rate">{{number_format(\App\Rate::getUserEmployeeRate($user, 'diligence'), 2)}}</p>
                                            </div>
                                        </div>
                                        <div class="slice">
                                            <div class="bar"></div>
                                            <div class="fill"></div>
                                        </div>
                                    </div>
                                    <div class="c100 p{{number_format(\App\Rate::getPercentageRate(\App\Rate::getUserEmployeeRate($user, 'knowledge'), 2), 0)}} big orange circle small-circle">
                                        <div class="description">
                                            <div class="d-block">
                                                <p >Wiedza:</p>
                                                <p class="rate">{{number_format(\App\Rate::getUserEmployeeRate($user, 'knowledge'), 2)}}</p>
                                            </div>
                                        </div>
                                        <div class="slice">
                                            <div class="bar"></div>
                                            <div class="fill"></div>
                                        </div>
                                    </div>
                                    <div class="c100 p{{number_format(\App\Rate::getPercentageRate(\App\Rate::getUserEmployeeRate($user, 'punctuality'), 2), 0)}} big orange circle small-circle">
                                        <div class="description">
                                            <div class="d-block">
                                                <p >Punktualność:</p>
                                                <p class="rate">{{number_format(\App\Rate::getUserEmployeeRate($user, 'punctuality'), 2)}}</p>
                                            </div>
                                        </div>
                                        <div class="slice">
                                            <div class="bar"></div>
                                            <div class="fill"></div>
                                        </div>
                                    </div>
                                    <h2 class="text-center">łączna liczba ocen: {{\App\Rate::getCountUserRates($user)}}</h2>
                                </div>

                            </div>








                            </div>


                    </div>
                    @if(\Illuminate\Support\Facades\Auth::user() == $user)
                        <div class="p-2 text-center">
                            <button  data-toggle="modal" data-target="#add_photo" style="background-color: black" class="my-button text-center ">Dodaj zdjęcie</button>

                        </div>
                    @endif
                    <div class="photos">

                        @foreach($user->getActiveImages() as $image)
                        <div class="photo">
                            <img onclick="loadGallery(this)" src="{{url('public/users/'.$user->id.'/'.$image->path)}}">
                            <div class="footer d-flex justify-content-center align-items-center">
                                <p>{{$image->tags}}</p>
                            </div>
                        </div>

                            @endforeach
                    </div>
                </div>
            </div>
            @if(\App\Friend::isFriends($user, \Illuminate\Support\Facades\Auth::user()) || $user->id == \Illuminate\Support\Facades\Auth::id())
            <div class="tab" id="tabs-2">
                @if($user->id == \Illuminate\Support\Facades\Auth::id())
                 <a href="#employee-create" data-toggle="modal" class="hvr-sweep-to-right my-button blue_button">Dodaj firmę w której pracowałeś lub pracujesz</a>
                @endif
                @include('user.partials.timeline')
            </div>
            @endif
            @if(\App\Friend::isFriends($user, \Illuminate\Support\Facades\Auth::user()) || $user->id == \Illuminate\Support\Facades\Auth::id())
            <div class="tab" id="tabs-3">

                @include('user.education_index')
            </div>
            @endif
            @if(\App\Friend::isFriends($user, \Illuminate\Support\Facades\Auth::user()) || $user->id == \Illuminate\Support\Facades\Auth::id())
            <div class="tab" id="tabs-4">
                <div class="tab-content">
                @include('post.user_posts')
                </div>
            </div>
            @endif
            @if(\Illuminate\Support\Facades\Auth::id() == $user->id)
            <div class="tab" id="tabs-5">
                <div class="tab-content">

                    <a href="{{route('user.company.create')}}" class="my-button text-center"> Dodaj swoją firmę</a>


                </div>

            </div>
                @endif
        </div>

    </div>

    @endsection