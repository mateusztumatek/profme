@extends('layouts.app')
@section('content')

    <div class="col-sm-12">
        <div  id="tabs">
            <ul class="tabs-label">
                <li class="tab-label"><a href="#tabs-1">Profil ogólny</a></li>
                @if(\Illuminate\Support\Facades\Auth::id() == $company->user_id)

                <li class="tab-label"><a href="#tabs-2">Pracownicy</a></li>
                <li class="tab-label"><a href="#tabs-3">Edytuj profil firmowy</a></li>
                    <li class="tab-label"><a href="#tabs-4"> Porównaj użytkowników </a></li>
                    @endif
            </ul>
            <div class="tab" id="tabs-1">
                <div class="tab-content">
                    <div class="row justify-content-center">
                        <div class="col-sm-4 row">
                            <div class="user-image">
                                <img src="{{$company->getLogo()}}">
                            </div>
                            <div class="divider"></div>
                        </div>

                        <div class="mt-3 col-sm-8">

                            <h2 class="text-left"><span style="font-size: 80%; color: #4e555b">Nazwa firmy:</span> <strong>{{$company->official_name}} </strong><span style="float: right">email: {{$company->email}}</span></h2>

                            <h2><span style="font-size: 80%; color: #4e555b">NIP:</span> <strong> {{$company->nip}} </strong></h2>

                            <h3 class="mt-5"> Dane adresowe: </h3>

                            <div class="row">
                                <div class="col-sm-3">
                                    <h2 class="text-left"><span style="font-size: 80%; color: #4e555b">Państwo:</span> <strong> {{$company->country}}</strong></h2>
                                </div>
                                <div class="col-sm-9">
                                    <h2 class="text-left"><span style="font-size: 80%; color: #4e555b">Miasto:</span> <strong> {{$company->city}}</strong></h2>
                                </div>
                                <div class="col-sm-3">
                                    <h2 class="text-left"><span style="font-size: 80%; color: #4e555b">Ulica:</span> <strong> {{$company->street}}</strong></h2>
                                </div>
                                <div class="col-sm-3">
                                    <h2 class="text-left"><span style="font-size: 80%; color: #4e555b">Numer:</span> <strong> {{$company->street_number}}</strong></h2>
                                </div>
                                <div class="col-sm-3">
                                    <h2 class="text-left"><span style="font-size: 80%; color: #4e555b">Kod pocztowy:</span> <strong> {{$company->postal_code}}</strong></h2>
                                </div>

                            </div>
                            <h3 class="mt-5"> Zatrudnia pracowników na stanowiskach </h3>
                            <div class="d-flex">
                                @foreach($company->getPositions() as $position)
                                    <span>{{$position->position}} ({{$company->getCountPosition($position->position)}}), </span>
                                    @endforeach
                            </div>
                        </div>


                    </div>

                </div>
            </div>
            @if(\Illuminate\Support\Facades\Auth::id() == $company->user_id)

            <div class="tab" id="tabs-2">
                <div class="tab-content">
                    @include('company.employee_panel')
                </div>
            </div>
            <div class="tab" id="tabs-3">
                <div class="tab-content">
                    @include('company.edit')
                </div>
            </div>
            <div class="tab" id="tabs-4">
                @include('company.compare_index')
            </div>
                @endif

        </div>

    </div>

@endsection