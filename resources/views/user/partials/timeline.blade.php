<div class="container">
    <div class="page-header">
        <h1 id="timeline" class="text-center">Oś czasu użytkownika {{$user->name}}</h1>
    </div>
    <ul class="timeline">
        @if(!empty($employees))
        @foreach($employees as $key=>$employee)

                    <li @if($key % 2 == 0)class="timeline-inverted" @endif>
                        <div class="timeline-badge "><i class="glyphicon glyphicon-check"></i></div>

                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <div class="row justify-content-between align-items-center m-0">
                                    <a href="{{url('/company/'.$employee->getCompany()->id)}}" style="font-weight: 500; font-size: 1.3rem; text-decoration: none" class="timeline-title">{{$employee->getCompany()->official_name}}</a>
                                    @if($employee->active)
                                    <div class="job-check">zatwierdzone</div>
                                        @endif
                                </div>

                                <p class="text-muted m-0"><i class="fa fa-clock-o"></i>  od {{$employee->since}} @if($employee->untill != null) do {{$employee->untill}} @endif</p>
                                <p class="text-muted"><i class="fa fa-user"></i>  stanowisko: {{$employee->position}}</p>
                            </div>
                            <div class="timeline-body">
                                <p>{{$employee->description}}</p>
                            </div>
                            @if(\Illuminate\Support\Facades\Auth::id() == $user->id)
                            <div class="timeline-footer">
                                @if(!empty($employee->getRateDiligence()))
                                <div class="d-flex">
                                  <p>pracowitość:
                                        @for($i=0; $i<$employee->getRateDiligence()->rate; $i++)
                                          <span class="fa fa-star rate-icon"> </span>
                                            @endfor
                                    </div>
                                    @endif
                                @if(!empty($employee->getRateKnowledge()))
                                        <div class="d-flex">
                                            <p>wiedza:
                                                @for($i=0; $i<$employee->getRateKnowledge()->rate; $i++)
                                                    <span class="fa fa-star rate-icon"> </span>
                                            @endfor
                                        </div>                        @endif
                                @if(!empty($employee->getRatePunctuality()))
                                        <div class="d-flex">
                                            <p>punktualność:
                                                @for($i=0; $i<$employee->getRatePunctuality()->rate; $i++)
                                                    <span class="fa fa-star rate-icon"> </span>
                                            @endfor
                                        </div>
                                    @endif

                            </div>
                                @endif
                        </div>
                    </li>

        @endforeach
            @else
            <div class="text-center">
                <p>Ten użytkownik nie ma dodanej żadnej pracy</p>

            </div>
        @endif
    </ul>
</div>