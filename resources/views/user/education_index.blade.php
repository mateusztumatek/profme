
<div id="education_content">
    <div class="col-sm-12">
        @if($user->id == \Illuminate\Support\Facades\Auth::id())
            <a href="#education_create" data-toggle="modal" class="hvr-sweep-to-right my-button blue_button">Dodaj placówke do której uczęszczałeś</a>
        @endif
        @if($educations->isEmpty())
            <div class="text-center mt-3 p-5">
                <p>ten użytkownik nie ma dodanej żadnej edukacji</p>
            </div>

            @endif
        <div class="photos mt-3 education_photos">
            @foreach($educations as $education)
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
                        @if(\Illuminate\Support\Facades\Auth::id() == $education->user_id)
                        <form onsubmit="delete_education(this, event)" class="mb-2" method="POST" action="{{route('education.delete', ['education' => $education])}}">
                            @CSRF
                            <button type="submit" class="btn my-button "> usuń element </button>
                        </form>

                        <form onsubmit="education_edit(this, event)" method="GET" action="{{route('education.edit', ['education' => $education])}}">
                            <button type="submit" class="btn my-button "> edytuj element </button>
                        </form>
                            @endif




                    </div>


                        @if(!\App\Report::checkIfReported('education', $education->id, \Illuminate\Support\Facades\Auth::id()))
                            <div class="report">
                                <a class="my_tooltip" onclick="openReportModal('education', '{{$education->id}}', '{{$education->institute . $education->description}}', '{{\Illuminate\Support\Facades\Auth::id()}}' )"> <i class="fa fa-warning"></i></a>
                            </div>
                        @endif


                </div>

                @endforeach
        </div>


    </div>

</div>