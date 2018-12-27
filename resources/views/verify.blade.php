@extends('layouts/app')


@section('content')
    @if(\Illuminate\Support\Facades\Auth::user()->isBanned())
        <div class="alert alert-info mt-2">
            <strong>Zostałeś zbanowany do dnia: {{\Illuminate\Support\Facades\Auth::user()->banned_to}}</strong>
        </div>
        @else
    <div class="alert alert-info mt-2">
        <strong>Twoje konto jest nie zweryfikowane sprawdź swój email {{\Illuminate\Support\Facades\Auth::user()->email}}</strong>
    </div>
    @endif

    @endsection