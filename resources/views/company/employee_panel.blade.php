<div id="employee-panel" class="row justify-content-center">
    @foreach($employees as $employee)
        <div class="col-md-4 col-sm-6">
            <div class="employee_card" @if($employee->active) style="border: #055e60 2px solid" @else  style="border: #FF2635 2px solid" @endif>
                <div class="header mb-3">
                    <div class="row justify-content-between">
                        <div class="col-md-8 d-flex align-items-center ">
                            <div class="profile-img">
                                <a href="{{url('user/'. $employee->user_id)}}"><img src="{{$employee->getUser()->getProfileURL()}}"></a>
                            </div>
                            <h2 class="ml-2 mb-0"> {{$employee->getUser()->name}}  <span style="font-size: 0.9rem"> {{$employee->getUser()->city}}</span></h2>
                        </div>
                        <div class="col-sm-4 d-flex align-items-center">
                            @if(!$employee->active)
                            <form onsubmit="confirmEmployee(this, event)" method="POST" class="employee-confirm-form" action="{{route('confirm.employee', ['employee' => $employee])}}">
                                @CSRF
                                <div  onclick="$(this).parent().submit()" class="icon mr-1">
                                    <a title="zatwierdź pracownika"><span class="fa fa-check"></span></a>
                                </div>
                            </form>
                            @else
                                <div class="info mr-2"><p>zatwierdzony</p></div>
                                @endif
                            <div  class="icon mr-1">
                                <form onsubmit="submitFormEmployee(this, event)" method="POST" action="{{route('delete.employee', ["employee" => $employee])}}">
                                    @CSRF
                                    <a onclick="$(this).parent().submit()" title="odrzuć pracownika" ><span class="fa fa-times"></span></a>
                                </form>

                            </div>

                        </div>
                    </div>


                </div>
                <div class="position-relative w-100">
                    <span class="since_icon timeline_icon"></span>
                    <span class="axis"></span>
                    <span class="untill_icon timeline_icon"></span>

                    <div class="row justify-content-between pt-3">
                        <p> {{$employee->since}}</p>
                        <p> {{$employee->untill}}</p>
                    </div>
                </div>
                <h3 >Stanowisko: <strong>{{$employee->position}}</strong></h3>
                <p> {{$employee->description}}</p>

                <div class="footer">
                    @if($employee->active)
                    <h3 class="text-center">oceń pracownika</h3>
                    <div class="row justify-content-center">
                        <div class="col-3">
                            <h3> pracowitość: </h3>
                        </div>
                        <div class="col-9 rate-block mb-1 text-center ">
                            @if(!empty($rate = $employee->getRateDiligence()))
                                <div class="d-flex">
                                    <h3> Oceniłeś na {{$rate->rate}}</h3>
                                    <form method="POST" onsubmit="submitFormEmployee(this, event)" action="{{route('delete.rate.diligence', ['rate' => $rate, 'employee' => $employee])}}">
                                        @CSRF
                                        <a onclick="$(this).parent().submit()" class="info ml-2 btn"> usuń ocenę  </a>
                                    </form>

                                </div>

                            @else


                            <form onsubmit="submitFormEmployee(this, event)" action="{{route('rate.diligence', ['employee' => $employee])}}" method="POST">
                                @CSRF
                                <div class="form-inline w-75 m-auto row justify-content-between">

                                    <input type="hidden" name="elem_type" value="diligence">
                                    <input onchange="$(this).parent().parent().submit()" class="form-control d-none" type="radio" name="rate" value="1">
                                    <span onclick="$(this).prev().click()" class="fa fa-star rate-icon"><div class="description des-1"></div></span>
                                    <input onchange="$(this).parent().parent().submit()" class="form-control d-none" type="radio" name="rate" value="2">
                                    <span onclick="$(this).prev().click()" class="fa fa-star rate-icon"><div class="description des-2"></div></span>
                                    <input onchange="$(this).parent().parent().submit()" class="form-control d-none" type="radio" name="rate" value="3">
                                    <span onclick="$(this).prev().click()" class="fa fa-star rate-icon"><div class="description des-3"></div></span>
                                    <input onchange="$(this).parent().parent().submit()" class="form-control d-none" type="radio" name="rate" value="4">
                                    <span onclick="$(this).prev().click()" class="fa fa-star rate-icon"><div class="description des-4"></div></span>
                                    <input onchange="$(this).parent().parent().submit()" class="form-control d-none" type="radio" name="rate" value="5">
                                    <span onclick="$(this).prev().click()" class="fa fa-star rate-icon"><div class="description des-5"></div></span>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-3">
                            <h3> wiedza: </h3>
                        </div>
                        <div class="col-9 rate-block mb-1 text-center ">
                            @if(!empty($rate = $employee->getRateKnowledge()))
                                <div class="d-flex">
                                    <h3> Oceniłeś na {{$rate->rate}}</h3>
                                    <form method="POST" onsubmit="submitFormEmployee(this, event)" action="{{route('delete.rate.diligence', ['rate' => $rate, 'employee' => $employee])}}">
                                        @CSRF
                                        <a onclick="$(this).parent().submit()" class="info ml-2 btn"> usuń ocenę  </a>
                                    </form>

                                </div>

                            @else


                                <form onsubmit="submitFormEmployee(this, event)" action="{{route('rate.diligence', ['employee' => $employee])}}" method="POST">
                                    @CSRF
                                    <div class="form-inline w-75 m-auto row justify-content-between">

                                        <input type="hidden" name="elem_type" value="knowledge">
                                        <input onchange="$(this).parent().parent().submit()" class="form-control d-none" type="radio" name="rate" value="1">
                                        <span onclick="$(this).prev().click()" class="fa fa-star rate-icon"><div class="description des-1"></div></span>
                                        <input onchange="$(this).parent().parent().submit()" class="form-control d-none" type="radio" name="rate" value="2">
                                        <span onclick="$(this).prev().click()" class="fa fa-star rate-icon"><div class="description des-2"></div></span>
                                        <input onchange="$(this).parent().parent().submit()" class="form-control d-none" type="radio" name="rate" value="3">
                                        <span onclick="$(this).prev().click()" class="fa fa-star rate-icon"><div class="description des-3"></div></span>
                                        <input onchange="$(this).parent().parent().submit()" class="form-control d-none" type="radio" name="rate" value="4">
                                        <span onclick="$(this).prev().click()" class="fa fa-star rate-icon"><div class="description des-4"></div></span>
                                        <input onchange="$(this).parent().parent().submit()" class="form-control d-none" type="radio" name="rate" value="5">
                                        <span onclick="$(this).prev().click()" class="fa fa-star rate-icon"><div class="description des-5"></div></span>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-3">
                            <h3> Terminowość: </h3>
                        </div>
                        <div class="col-9 rate-block mb-1 text-center ">
                            @if(!empty($rate = $employee->getRatePunctuality()))
                                <div class="d-flex">
                                    <h3> Oceniłeś na {{$rate->rate}}</h3>
                                    <form method="POST" onsubmit="submitFormEmployee(this, event)" action="{{route('delete.rate.diligence', ['rate' => $rate, 'employee' => $employee])}}">
                                        @CSRF
                                        <a onclick="$(this).parent().submit()" class="info ml-2 btn"> usuń ocenę  </a>
                                    </form>

                                </div>

                            @else


                                <form onsubmit="submitFormEmployee(this, event)" action="{{route('rate.diligence', ['employee' => $employee])}}" method="POST">
                                    @CSRF
                                    <div class="form-inline w-75 m-auto row justify-content-between">

                                        <input type="hidden" name="elem_type" value="punctuality">
                                        <input onchange="$(this).parent().parent().submit()" class="form-control d-none" type="radio" name="rate" value="1">
                                        <span onclick="$(this).prev().click()" class="fa fa-star rate-icon"><div class="description des-1"></div></span>
                                        <input onchange="$(this).parent().parent().submit()" class="form-control d-none" type="radio" name="rate" value="2">
                                        <span onclick="$(this).prev().click()" class="fa fa-star rate-icon"><div class="description des-2"></div></span>
                                        <input onchange="$(this).parent().parent().submit()" class="form-control d-none" type="radio" name="rate" value="3">
                                        <span onclick="$(this).prev().click()" class="fa fa-star rate-icon"><div class="description des-3"></div></span>
                                        <input onchange="$(this).parent().parent().submit()" class="form-control d-none" type="radio" name="rate" value="4">
                                        <span onclick="$(this).prev().click()" class="fa fa-star rate-icon"><div class="description des-4"></div></span>
                                        <input onchange="$(this).parent().parent().submit()" class="form-control d-none" type="radio" name="rate" value="5">
                                        <span onclick="$(this).prev().click()" class="fa fa-star rate-icon"><div class="description des-5"></div></span>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                    @else

                        <p>Żeby ocenić pracownika musisz najpierw zatwierdźić jego zgłoszenie</p>
                    @endif
                </div>
            </div>
        </div>
    @endforeach

</div>