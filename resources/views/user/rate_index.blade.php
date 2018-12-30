@extends('layouts.app')
@section('content')

<div class="container">
    <div class="page-header">
        <h1 id="timeline" class="text-center">Oceny użytkownika {{$user->name}}</h1>
    </div>
    @if(!$rates->isEmpty())
    <ul class="timeline">
        @php
            $count = 0;
        @endphp

            @foreach($rates as $rate)

                <li @if($count % 2 == 0)class="timeline-inverted" @endif>
                    <div class="timeline-badge "><i class="glyphicon glyphicon-check"></i></div>

                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <p class="text-muted m-0"><i class="fa fa-clock-o"></i> {{$rate->created_at}}</p>
                        </div>
                        <div class="timeline-body">
                            <div class="row justify-content-center">
                                <div class="col-md-5">
                                    <div class="user-image">
                                        @if($rate->getUser() instanceof \App\User)
                                            <img src="{{$rate->getUser()->getProfileUrl()}}">
                                            @else
                                            <img src="{{$rate->getUser()->getLogo()}}">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <p style="font-weight: bold">
                                        @if($rate->getUser() instanceof \App\User)
                                            {{$rate->getUser()->name}} ocenił twój post
                                            {{$rate->getElement()->title}}
                                            na:
                                        @else
                                            {{$rate->getUser()->official_name}}
                                            ocenił {{$rate->elem_type}} na:
                                            @endif
                                            </p>
                                    <div class="d-flex">
                                            @for($i=0; $i<$rate->rate; $i++)
                                                <span class="fa fa-star rate-icon ml-1"> </span>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @php($count = $count +1)
            @endforeach

    </ul>
    @else
        <div class="text-center">
            <p>Ten użytkownik nie ma dodanej żadnej oceny</p>

        </div>
    @endif
</div>

    @endsection