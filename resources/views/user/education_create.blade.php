<div class="modal fade" id="education_create" tabindex="-1" role="dialog" aria-labelledby="company_modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dodaj placówke w któej się uczyłeś </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            @php
                $directions = DB::table('study_directions')->get();
            @endphp
            <div class="modal-body row">
                <div class="col-md-8">
                    <form enctype="multipart/form-data" action="{{route('education.store', ['user' => \Illuminate\Support\Facades\Auth::user()])}}" id="education_create_form" method="POST" >
                        @CSRF
                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="institution">Nazwa placówki: </label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="institution" name="institution" placeholder="Nazwa placówki" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="description"> Wybierz kierunek: </label>
                            <div class="col-10">

                                <select class="form-control" id="direction" name="direction">
                                    @foreach($directions as $direction)
                                    <option value="{{$direction->id}}">{{$direction->name}}</option>
                                        @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="description">opis edukacji: </label>
                            <div class="col-10">
                                <textarea class="form-control" id="description" name="description" placeholder="Krótki opis"> </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="since">od</label>
                            <div class="col-10">
                                <input class="form-control" type="date" id="since" name="since" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="untill">do</label>
                            <div class="col-10">
                                <input class="form-control" type="date" id="untill" name="untill" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="image">skan dokumentu ukończenia</label>
                            <div class="col-10">
                                <input class="form-control" type="file" id="image" name="image">
                            </div>
                            <img style="max-width: 50px; max-height: 50px; display: none" id="education_image_placeholder">
                        </div>

                    </form>
                    <div style="display: none;" class="warning" id="form_errors"></div>
                </div>
                <div class="col-sm-4">
                    <img src="" style="display: none; max-width: 100%; max-height: 100%" id="education_photo">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="$('#education_create_form').submit()"  class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>