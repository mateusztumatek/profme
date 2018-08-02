@extends('layouts/app')


@section('content')
    <div class="alert alert-info mt-2">
        <strong>Twoje konto jest nie zweryfikowane sprawdź swój email {{\Illuminate\Support\Facades\Auth::user()->email}}</strong>
    </div>

    @endsection