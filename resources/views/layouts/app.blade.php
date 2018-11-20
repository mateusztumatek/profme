<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->


    <!-- Fonts -->
    <link rel="stylesheet" href="{{asset('css/css.css')}}">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Muli:200,400,700,900" rel="stylesheet">


    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/errors.css') }}" rel="stylesheet">
    <link href="{{ asset('css/post.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user.css') }}" rel="stylesheet">
    <link href="{{asset('css/loader.css')}}" rel="stylesheet">
    <link href="{{asset('css/circle.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('css/hover-min.css')}}">
    <link rel="stylesheet" href="{{asset('css/chart.css')}}">
    <link rel="stylesheet" href="{{asset('css/timeline.css')}}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

</head>
<body>
    <div id="app">

                @auth
                @include('layouts.sidebar')

                @include('layouts.topbar')

                    @include ('user.notifications')
                @endauth
                <main class="content mb-5">
                    @include('layouts.errors')
                    @yield('content')


                </main>
                @yield('login-form')
            </div>

        </div>

    </div>

    @auth
        <div class="modal fade" id="add_photo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{route('add_photo.user', ['user' => \Illuminate\Support\Facades\Auth::user()])}}" method="POST" enctype="multipart/form-data">
                    @CSRF

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Dodaj Zdjęcie</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input id="photo_input" type="file" name="photo_input" class="form-control " multiple>
                            <div class="row" style="display: none" id="photo-content">

                                <div class="col-5">
                                    <img src="#" id="photo">
                                </div>

                                <div class="col-5 m-5">
                                    <div class="form-group">
                                        <label for="tags"> Tagi </label>
                                        <input class="form-control" type="text" name="tags" >
                                    </div>

                                    <div class="form-check form-check-inline">

                                        <input class="form-check-input" name="active" type="radio" id="active" value="1" checked>
                                        <label class="form-check-label" for="inlineCheckbox1">Widoczne</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="active" type="radio" id="active" value="0">
                                        <label class="form-check-label" for="inlineCheckbox2">Nie widoczne</label>
                                    </div>

                                    <div class="form-check mt-2">

                                        <input class="form-check-input" type="checkbox" name="profile"  >
                                        <label class="form-check-label" for="tags"> profilowe </label>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                            <button type="submit" class="btn btn-primary">Dodaj Zdjęcie</button>
                        </div>
                    </div>
            </div>
            </form>
        </div>
            @include('user.education_create')
            @include('user.post-create-modal')
            @include('company.employee-create-modal')
                    <div id="edit_education_modal" style="display: none">
                    </div>
            @endauth
    </div>
    <div class="modal fade" id="photos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">


            <img id = "modal-photo" src="{{url('img/klub1.jpg')}}">



        </div>
        <button id="modal-button" id="modal-button" type="button" class="btn btn-secondary" data-dismiss="modal">X</button>

    </div>

    <div class="modal fade" id="photos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">


            <img id = "modal-photo" src="{{url('img/klub1.jpg')}}">



        </div>
        <button id="modal-button" id="modal-button" type="button" class="btn btn-secondary" data-dismiss="modal">X</button>

    </div>



</body>

<script>

</script>
<script>
    var base_url = '{{\Illuminate\Support\Facades\URL::to('/')}}';
    var csrf = '@CSRF';
    @if(\Illuminate\Support\Facades\Auth::check())
        var auth_id = '{{\Illuminate\Support\Facades\Auth::id()}}';
        @endif

</script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript" src="{{asset('js/bootstrap-tagsinput.js')}}"></script>
<script type="text/javascript" src="{{asset('js/custom.js')}}"></script>
<script type="text/javascript" src="{{asset('js/company.js')}}"></script>
<script type="text/javascript" src="{{asset('js/education.js')}}"></script>
<script type="text/javascript" src="{{asset('js/friends.js')}}"></script>

<script type="text/javascript" src="{{ asset('js/app.js') }}" defer></script>
<script type="text/javascript" src="{{asset('js/chart.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugin.js')}}"></script>
<script type="text/javascript" src="{{asset('js/timeline.js')}}"></script>



</html>
