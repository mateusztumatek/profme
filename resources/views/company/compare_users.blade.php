<div class="modal fade" tabindex="-1" role="dialog" id="compare_modal">
    <div class="modal-dialog" role="document">

        <div class="modal-content" id="post-create-content">

            <div class="row justify-content-center">
                @foreach($compare->getUsers() as $user)
                <div class="@if(count($compare->getUsers()) == 3) col-sm-4 @else col-sm-6 @endif row justify-content-center align-self-start">
                    <div class="col-sm-12 d-flex justify-content-center compare-header">
                        <div class="col-sm-8 d-flex align-items-center ">
                            <div class="user-image" style="width: 50px !important; height: 50px !important;">
                                <img style="width: 50px; height: 50px; object-fit: cover" src="{{$user->getProfileURL()}}">
                            </div>
                            <h3 class="ml-3"><a class="btn-link" href="{{url('user/'.$user->id)}}"><strong> {{$user->name}}</strong></a></h3>
                        </div>
                        <div class="col-sm-4 align-items-center d-flex">
                            <p>{{$user->date_of_birth}}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="compare-content col-sm-12">
                        <div class="col-sm-12 d-flex">
                            <p>Miasto:</p>
                            <p class="ml-2">{{$user->city}}</p>
                        </div>
                        <div class="col-sm-12 d-flex">
                            <div class="w-15">
                                <p>ogólna ocena:</p>
                            </div>

                            <div class="progress w-85 ml-2">
                                <div class="progress-bar" role="progressbar"
                                     aria-valuenow="{{number_format(\App\Rate::getPercentageRate(\App\Rate::getRate($user), 2), 0)}}" aria-valuemin="0" aria-valuemax="100" style="width:{{number_format(\App\Rate::getPercentageRate(\App\Rate::getRate($user), 2), 0)}}%">
                                    {{number_format(\App\Rate::getRate($user), 2)}}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 d-flex">
                            <div class="w-15">
                                <p>pracowitość:</p>
                            </div>

                            <div class="w-85 progress ml-2">
                                <div class="progress-bar" role="progressbar"
                                     aria-valuenow="{{number_format(\App\Rate::getPercentageRate(\App\Rate::getUserEmployeeRate($user, 'diligence'), 2), 0)}}" aria-valuemin="0" aria-valuemax="100" style="width:{{number_format(\App\Rate::getPercentageRate(\App\Rate::getUserEmployeeRate($user, 'diligence'), 2), 0)}}%">
                                    {{number_format(\App\Rate::getUserEmployeeRate($user, 'diligence'), 2)}}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 d-flex">
                            <div class="w-15">
                                <p>wiedza:</p>
                            </div>
                            <div class="w-85 progress ml-2">
                                <div class="progress-bar" role="progressbar"
                                     aria-valuenow="{{number_format(\App\Rate::getPercentageRate(\App\Rate::getUserEmployeeRate($user, 'knowledge'), 2), 0)}}" aria-valuemin="0" aria-valuemax="100" style="width:{{number_format(\App\Rate::getPercentageRate(\App\Rate::getUserEmployeeRate($user, 'knowledge'), 2), 0)}}%">
                                    {{number_format(\App\Rate::getUserEmployeeRate($user, 'knowledge'), 2)}}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 d-flex">
                            <div class="w-15">
                                <p>punktualność:</p>
                            </div>

                            <div class="progress w-85 ml-2">
                                <div class="progress-bar" role="progressbar"
                                     aria-valuenow="{{number_format(\App\Rate::getPercentageRate(\App\Rate::getUserEmployeeRate($user, 'punctuality'), 2), 0)}}" aria-valuemin="0" aria-valuemax="100" style="width:{{number_format(\App\Rate::getPercentageRate(\App\Rate::getUserEmployeeRate($user, 'punctuality'), 2), 0)}}%">
                                    {{number_format(\App\Rate::getUserEmployeeRate($user, 'punctuality'), 2)}}
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h3> Stanowiska na których pracował {{$user->name}}</h3>
                            <hr>
                            @foreach($user->getUserPositions() as $employee)
                                @if($employee->active == 1)
                                    <div class="timeline-panel w-100 row float-none">
                                        <div class="col-sm-8">
                                            <div class="timeline-heading">
                                                <div class="row justify-content-between align-items-center m-0">
                                                    <h4 class="timeline-title">{{$employee->getCompany()->official_name}}</h4>
                                                </div>
                                                @if(\Illuminate\Support\Facades\Auth::id() == $employee->getCompany()->user_id)
                                                <p class="text-muted m-0"><i class="fa fa-clock-o"></i>  od {{$employee->since}} @if($employee->untill != null) do {{$employee->untill}} @endif</p>
                                                @endif
                                                <p class="text-muted"><i class="fa fa-user"></i>  stanowisko: {{$employee->position}}</p>
                                            </div>
                                            @if(\Illuminate\Support\Facades\Auth::id() == $employee->getCompany()->user_id)
                                                <div class="timeline-body">
                                                    <p>{{$employee->description}}</p>
                                                </div>
                                                @endif
                                        </div>
                                        @if(($rate = $employee->getEmployeeRate()) != null)
                                       <div class="col-sm-4 d-flex justify-content-center align-items-center">
                                           <div class="rate-circle">
                                               <span>{{round($employee->getEmployeeRate(), 1)}}</span>
                                           </div>
                                       </div>
                                            @endif

                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="mt-2">
                            <h3>Wykształcenie {{$user->name}}</h3>
                            <hr>
                                <div class="photos mt-3 education_photos">
                                    @foreach($user->getEducations() as $education)
                                        <div class="photo education">

                                            <img onclick="loadGallery(this)" src="{{$education->getImageUrl()}}">
                                            <div class="footer">

                                                <h3>Nazwa placówki: <strong>{{$education->institution}}</strong></h3>
                                                <h3><strong>{{$education->getDirection()->name}}</strong></h3>
                                                <hr class="text-center w-50">
                                                <p>opis:</p>
                                                <p>{{$education->description}}</p>

                                                <div class="position-relative w-100">
                                                    <span class="since_icon timeline_icon"></span>
                                                    <span class="axis"></span>
                                                    <span class="untill_icon timeline_icon"></span>

                                                    <div class="row justify-content-between pt-3">
                                                        <p> {{$education->since}}</p>
                                                        <p> {{$education->untill}}</p>
                                                    </div>
                                                </div>



                                            </div>



                                        </div>

                                    @endforeach
                                </div>
                        </div>
                    </div>



                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
