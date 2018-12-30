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
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script type="text/javascript" src="{{asset('js/custom.js')}}"></script>
    <!-- Fonts -->

    <link rel="stylesheet" href="{{asset('css/css.css')}}">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Muli:200,400,700,900" rel="stylesheet">


    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/hover-min.css')}}">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">


</head>
<body>
    <div class="post-site">
        <div class="container mt-5">


            <div class="row justify-content-center">
                <div class="col-md-4 row justify-content-center">
                    <div id="user-photo" class="user-image">
                        <img  src="{{url('img/profile1.jpg')}}">
                    </div>

                </div>

            </div>
            <div class="post-create-content">
                <div  class="col-md-12 text-center mt-5">
                    <p  style=" color: white ;font-size: 60px; font-family: 'Freestyle Script'">Witaj Mateusz Bielak</p>
                </div>

                <div  class="col-md-12 text-center mt-5">
                    <p  style=" color: black ;font-size: 20px; font-family: 'muli'; font-weight: 200; text-shadow: none !important;">co chcesz zrobić?</p>
                </div>
                <div  class="row justify-content-center">

                    <a onclick="show_form($('#post-create-form'))" class="my-button" style="text-align:center; color: black; padding: 15px 20px 15px 20px; margin: 5px; font-size: 15px; width:200px"><i class="fa fa-pencil-square"></i> Dodaj post</a>
                    <a class="my-button" style="text-align:center; color: black; padding: 15px 20px 15px 20px; margin: 5px; font-size: 15px; width: 200px"><i class="fa fa-photo"></i> Dodaj zdjęcie</a>

                </div>
            </div>


            <div id="post-create-form" style="display: none">
                <form action="#" method="post">

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Email address</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>


                </form>
            </div>



        </div>
    </div>


<script type="text/javascript" src="{{ asset('js/app.js') }}" defer></script>
<script type="text/javascript" src="{{asset('js/plugin.js')}}"></script>


</body>
</html>
