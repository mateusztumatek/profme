@extends('layouts.app')

@section('content')
        <div class="col-sm-12 container">
            <h2 class="text-center">Przywileje użytkownika {{$user->name}}</h2>

        </div>
        <div class="col-12-sm row">
            @if(empty($privileges))
                <div class="col-sm-12 text-center mt-3">
                    <p class="text-center"><strong>Nie masz żadnych przywilejów</strong></p>
                </div>
                @else
            @foreach($privileges as $privilege)
                <div onclick="ShowOrHide($(this).children('.card-footer'))" class="col-sm-6 card-privilege">
                    <div class="img-background">
                        <img src="{{$privilege->getIcon()}}">
                    </div>
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3>{{$privilege->name}}</h3>
                            <div class="tag">
                                <p class="float-right">{{$privilege->group}}</p>

                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="description d-block mb-2">
                            <p>{{$privilege->description}}</p>
                        </div>
                        <p>dla: <strong>{{$privilege->getSex()}}</strong></p>
                    </div>
                    <div class="card-footer" style="display: none">
                        <div class="privilege-settings">
                            @foreach($privilege->getSettings() as $setting)
                                @switch(key($setting))
                                    @case('rate')
                                        <div>
                                            <p>ogólna ocena:</p>
                                            <p class="settings-rate">{{$setting[key($setting)]}}</p>
                                        </div>
                                    @break
                                    @case('count')
                                        <div>
                                            <p>ilość ogólnych ocen:</p>
                                            <p class="settings-rate">{{$setting[key($setting)]}}</p>
                                        </div>
                                    @break
                                    @case('diligence_count')
                                        <div>
                                            <p>ilość ocen pracowitości:</p>
                                            <p class="settings-rate">{{$setting[key($setting)]}}</p>
                                        </div>
                                    @break
                                    @case('diligence')
                                    <div>
                                        <p>ocena pracowitości:</p>
                                        <p class="settings-rate">{{$setting[key($setting)]}}</p>
                                    </div>
                                    @break
                                    @case('knowledge_count')
                                    <div>
                                        <p>ilość ocen wiedzy:</p>
                                        <p class="settings-rate">{{$setting[key($setting)]}}</p>
                                    </div>
                                    @break
                                    @case('knowledge')
                                    <div>
                                        <p>ocena wiedzy:</p>
                                        <p class="settings-rate">{{$setting[key($setting)]}}</p>
                                    </div>
                                    @break
                                    @case('punctuality_count')
                                    <div>
                                        <p>ilość ocen punktualności:</p>
                                        <p class="settings-rate">{{$setting[key($setting)]}}</p>
                                    </div>
                                    @break
                                    @case('punctuality')
                                    <div>
                                        <p>ocena punktualności:</p>
                                        <p class="settings-rate">{{$setting[key($setting)]}}</p>
                                    </div>
                                    @break
                                    @endswitch
                                @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
        </div>

    @endsection

