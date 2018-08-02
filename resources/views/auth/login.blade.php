@extends('layouts.app')

@section('login-form')
<div class="container" style="max-width: 90%; padding: 20px; ">
    <div class="row justify-content-center" style="padding: 30px;">
        <div class="col-md-8 login-form" style="max-width: 80%;">
            <div class="card" style="max-width: 80%; margin: auto">



                <div class="card-body p-5" style="margin: 0px;" >

                        <div class="row p-2" style="margin: 0px;">
                            <h2 style="opacity: 0.5;" onclick="change(this, this.nextElementSibling)" id="active" class="text-center mr-2">Zaloguj się</h2>
                            <h2 style="opacity: 0.5;"  onclick="change(this, this.previousElementSibling)" class="text-center ml-2">Zarejestruj się</h2>
                        </div>
                    <div id="login">

                    <form method="POST" action="{{ route('login') }}" name="login">
                        @csrf
                            <div class="justify-content-center text-center p-2" >



                                <label for="email" class="text-center">{{ __('E-Mail Address') }}</label>

                                <div  style="margin: auto">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email')  ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email') && !$errors->has('form'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="justify-content-center text-center p-2">
                                <label for="password" class=" text-center">{{ __('Password') }}</label>

                                <div class="">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password') && !$errors->has('form'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>




                            <div class="col-md-6 offset-md-4 text-center" style="margin:auto;">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>


                        <div class="form-group row mb-0 ">
                            <div class="col-md-12  text-center">
                                <button type="submit" class="my-button" style="width: 80%">
                                   {{ __('Login') }}
                                </button>

                                <a style="color: #055e60" class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                    </div>

                    <div id="register">

                        <form method="POST" action="{{route('register')}}" name="register">
                            @csrf

                            <div class="justify-content-center text-center p-2" >


                                <label for="register-name" class="text-center">{{ __('Twoje Imię i nazwisko') }}</label>

                                <div  style="margin: auto">
                                    <input id="register-name" type="text" class="form-control{{ $errors->has('register-name') ? ' is-invalid' : '' }}" name="register-name" value="{{ old('register-name') }}" required autofocus>

                                    @if ($errors->has('register-name') && $errors->first('form') == 'register')
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('register-name') }}</strong>
                                        </span>
                                    @endif


                                </div>
                                <div class=" justify-content-center mt-2 mb-2">
                                    <p class="mb-0">płeć:</p>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="register-sex" type="radio" id="register-sex" value="female">
                                        <label class="form-check-label" for="inlineCheckbox1">Kobieta</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="register-sex" type="radio" id="register-sex" value="male" required>
                                        <label class="form-check-label" for="inlineCheckbox2">Mężczyzna</label>
                                    </div>

                                </div>
                                <div class="justify-content-center mt-2 mb-2">
                                    <label for="date-of-birth"> Data urodzin</label>
                                    <input class="form-control" type="date" class="date" name="register-date-of-birth" required>
                                </div>
                                <div class="justify-content-center mt-2 mb-2">
                                    <label for="email"> E-mail</label>
                                    <input class="form-control" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" value="{{old('register-email')}}" required autofocus>
                                </div>
                                @if ($errors->has('email') && $errors->first('form') == 'register')

                                    <span class="invalid-feedback" style="display: block;">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>

                                @endif

                                <div class="justify-content-center mt-2 mb-2">
                                    <label for="register-password"> Hasło</label>
                                    <input class="form-control" type="password" name="password" required>
                                </div>
                                @if ($errors->has('password') && $errors->first('form') == 'register')

                                    <span class="invalid-feedback" style="display: block;">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>

                                @endif
                                <div class="justify-content-center mt-2 mb-2">
                                    <label for="register-confirm-email"> Powtórz Hasło</label>
                                    <input class="form-control" type="password" name="password_confirmation" required>
                                </div>
                                <div class="form-group row mb-0 ">
                                    <div class="col-md-12  text-center">
                                        <button type="submit" class="my-button" style="width: 80%">
                                            {{ __('Register') }}
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>



        </div>
    </div>
</div>
@endsection
