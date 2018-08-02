@extends('layouts.app')

@section('content')

        <div class="col-md-12 justify-content-center edit-profile">
            <h3 class="text-center">Edytuj swój profil {{$user->name}}</h3>
            <hr class="text-center w-75">
            <form action="{{route('update.user', ['user'=>$user])}}" method="POST">
                @CSRF

            <div class="row justify-content-center">
                <div class="col-md-4 pr-5 pl-5">

                    <img class="" src="@if($user->getProfileImage() != null) {{url('public/users/'. $user->id.'/'.$user->getProfileImage()->path)}} @else{{url('img/profile1.jpg')}} @endif">
                </div>
                @if(\Illuminate\Support\Facades\Session::has('errors'))
                    @foreach($errors as $error)
                        <p style="color: red">{{ $error}}</p>
                        @endforeach
                    @endif
                <div class="col-md-8">
                    <div class="form-group row position-relative">
                        <label class="col-2 col-form-label" for="name"> Imię i Nazwisko </label>
                        <input class="col-9 form-control" name="name" type="text" value="{{$user->name}}" required>
                    </div>

                    <div class="form-group row position-relative">
                        <label class="col-2 col-form-label" for="date"> Data urodzenia </label>
                        <input class="col-9 form-control" name="date" value="{{$user->date_of_birth}}" type="date" required>
                    </div>
                    <div class="form-group row position-relative">
                        <label class="col-2 col-form-label" for="city"> Miejsce pochodzenia </label>
                        <input class="col-5 form-control" name="city" type="text" @if( $user->city != null) value="{{$user->city}}" @endif placeholder="Misto" required>
                    </div>
                    <div class="form-group row position-relative">
                        <label class="col-2 col-form-label" for="city"> Numer telefonu </label>
                        <input class="col-5 form-control" name="phone" type="tel" title="format numeru telefonu: 000 000 000" placeholder="numer telefonu" pattern="[0-9]{9}" value="{{$user->phone}}" required>
                    </div>

                    <button class="my-button" style="background-color: black" type="submit"> Aktualizuj </button>
                </div>
            </div>

            </form>
            <h3 class="text-center">Zdjęcia</h3>
            <hr class="w-75 text-center">
                <div class="row justify-content-center">



                        @if(\Illuminate\Support\Facades\Auth::user()->getImages()->isEmpty())

                            <p style="opacity: 0.8; color: black" class="text-center font-weight-bold"> Nie masz jeszcze żadnych zdjęć</p>
                        @else
                            @foreach(\Illuminate\Support\Facades\Auth::user()->getImages() as $image)
                            <div class="col-md-3 mt-1 mb-1">

                                <img  style="max-width: 100%; max-height: 400px;" src="{{url('public/users/'.$user->id.'/'.$image->path)}}">
                                <div class="image-add row">
                                    <form action="{{route('change_Active_Image.user', ['image' => $image])}}" method="POST">
                                        @CSRF
                                        <a   onclick="this.closest('form').submit()" class="my_tooltip"><i  class="ml-1 fa fa-eye @if($image->getOriginal()['active']== true) active @endif"></i><span>zmien widocznosc</span> </a>

                                    </form>

                                    <form action="{{route('update_profile_image.user', ['image' => $image])}}" method="POST">
                                        @CSRF
                                        <a onclick="this.closest('form').submit()" class="my_tooltip"><i  class="ml-1 fa fa-user-circle  @if($image->getOriginal()['avatar']== 1) active @endif"></i><span>Ustaw zdjęcie profilowe</span> </a>
                                    </form>

                                    <form action="{{route('delete_image.user', ['image' => $image])}}" method="POST">
                                        @CSRF
                                        <a onclick="this.closest('form').submit()" class="my_tooltip" ><i class="ml-1 fa fa-trash active "></i> <span> Usuń ten element</span> </a>
                                    </form>


                                </div>
                            </div>

                             @endforeach
                        @endif
                    <div class="col-md-12 mt-2 text-center">
                        <button  data-toggle="modal" data-target="#add_photo" style="background-color: black" class="my-button ">Dodaj zdjęcie</button>

                    </div>
                </div>





        </div>

        <div class="modal fade" id="add_photo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{route('add_photo.user', ['user' => $user])}}" method="POST" enctype="multipart/form-data">
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

    @endsection