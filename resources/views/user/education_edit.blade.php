<div class="modal fade" id="edit_education_modal" tabindex="-1" role="dialog" aria-labelledby="company_modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form enctype="multipart/form-data" action="{{route('education.update', ['education' => $education])}}" onsubmit="submitForm(this, event)" id="education_edit_form" method="POST" >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edytuj element {{$education->institution}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            @php
                $directions = DB::table('study_directions')->get();
            @endphp
            <div class="modal-body row">
                <div class="col-md-8">

                        @CSRF
                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="institution">Nazwa placówki: </label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="institution" name="institution" value="{{$education->institution}}" placeholder="Nazwa placówki" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="description"> Wybierz kierunek: </label>
                            <div class="col-10">

                                <select class="form-control" id="direction" name="direction">
                                    @foreach($directions as $direction)
                                        @if($education->direction_id == $direction->id)
                                        <option value="{{$direction->id}}" selected>{{$direction->name}}</option>
                                        @else
                                            <option value="{{$direction->id}}">{{$direction->name}}</option>
                                            @endif
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="description">opis edukacji: </label>
                            <div class="col-10">
                                <textarea class="form-control" id="description" name="description" placeholder="Krótki opis">{{$education->description}} </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="since">od</label>
                            <div class="col-10">
                                <input class="form-control" type="date" id="since" name="since" value="{{$education->since}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="untill">do</label>
                            <div class="col-10">
                                <input class="form-control" type="date" id="untill" name="untill" @if($education->untill != null) value="{{$education->untill}}" @endif>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="image">skan dokumentu ukończenia</label>
                            <div class="col-10">
                                <input class="form-control" type="file" id="image" name="image">
                            </div>

                            <img style="max-width: 50px; max-height: 50px; display: none" id="education_image_placeholder" >

                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="active">Aktywne</label>
                            <div class="col-10">
                                <input class="form-control" type="checkbox" id="active" name="active" @if($education->active == 1) checked @endif >
                            </div>
                        </div>

                    <div style="display: none;" class="warning" id="form_errors"></div>
                </div>
                <div class="col-sm-4">
                    @if($education->image_url != null)
                    <img src="{{$education->getImageUrl()}}" style="max-width: 100%; max-height: 100%" id="education_photo">
                    @else
                        <img src="{{$education->getImageUrl()}}" style="display: none; max-width: 100%; max-height: 100%" id="education_photo">
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button  type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>