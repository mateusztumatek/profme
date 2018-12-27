<div class="modal fade" @if(!isset($privilege)) id="privilege_create"@else id="privilege_edit" @endif tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@if(!isset($privilege))Dodaj @else Edytuj @endif przywilej </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body row">
                <div class="col-md-8">
                    <form enctype="multipart/form-data" action=" @if(!isset($privilege)) {{route('privilege.store')}} @else {{route('privilege.update', ['privilege' => $privilege])}} @endif" @if(isset($privilege)) id="privilege_edit_form" @else id="privilege_create_form" @endif method="POST" >
                        @CSRF
                        <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::id()}}" >
                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="name">Nazwa przywileju: </label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="name" name="name" placeholder="Nazwa przywileju" @if(isset($privilege)) value="{{$privilege->name}}" @endif required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="icon">ikona</label>
                            <div class="col-10">
                                <input onchange="change_image(this)" class="form-control" @if(!isset($privilege)) data-target="#privilege_create_photo" @else data-target="#privilege_edit_photo" @endif type="file" id="icon" name="image">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="description"> minimalna ilość ocen: </label>
                            <div class="col-10">
                                <input type="number" class="form-control" name="count"@if(!isset($privilege)) value="1" @else value="{{$privilege->count}}" @endif  min="0">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="description">minimalna ocena ogólna: </label>
                            <div class="col-10">
                                <input type="number" class="form-control" name="rate" @if(!isset($privilege)) value="3" @else value="{{$privilege->rate}}" @endif  max="4.9" min="0" step="0.1">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="since">minimalna ilość ocen pracowitości: </label>
                            <div class="col-10">
                                <input class="form-control" type="number" id="diligence_count" @if(!isset($privilege)) value="0" @else value="{{$privilege->diligence_count}}" @endif name="diligence_count" min="0">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="since">minimalna ocena pracowitości </label>
                            <div class="col-10">
                                <input class="form-control" type="number" id="diligence" step="0.1" name="diligence" @if(!isset($privilege)) value="0" @else value="{{$privilege->diligence}}" @endif max="4.9" min="0">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="since">minimalna ilość ocen wiedzy: </label>
                            <div class="col-10">
                                <input class="form-control" type="number" id="knowledge_count" name="knowledge_count" min="0" @if(!isset($privilege)) value="0" @else value="{{$privilege->knowledge_count}}" @endif>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="since">minimalna ocena wiedzy: </label>
                            <div class="col-10">
                                <input class="form-control" type="number" id="knowledge"step="0.1" name="knowledge" @if(!isset($privilege)) value="0" @else value="{{$privilege->knowledge}}" @endif max="4.9" min="0">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="since">minimalna ilość ocen punktualności: </label>
                            <div class="col-10">
                                <input class="form-control" type="number" id="punctuality_count" name="punctuality_count" @if(!isset($privilege)) value="0" @else value="{{$privilege->punctuality_count}}" @endif min="0">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="since">minimalna ocena punktualności: </label>
                            <div class="col-10">
                                <input class="form-control" type="number" id="punctiality"step="0.1" name="punctuality" @if(!isset($privilege)) value="0" @else value="{{$privilege->punctuality}}" @endif max="4.9" min="0">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="untill">płeć</label>
                            <div class="col-10">
                                <div class="d-flex">
                                    <p>wszyscy</p>
                                    <input type="radio" class="form-control" name="sex" value="both" @if(!isset($privilege)) checked @else @if($privilege->sex == 'both') checked @endif @endif>
                                </div>
                                <div class="d-flex">
                                    <p>mężczyźni</p>

                                    <input type="radio" class="form-control" name="sex" value="male" @if(isset($privilege)) @if($privilege->sex == 'male') checked @endif @endif>
                                </div>
                                <div class="d-flex">
                                    <p>kobiety</p>

                                    <input type="radio" class="form-control" name="sex" value="female" @if(isset($privilege)) @if($privilege->sex == 'female') checked @endif @endif>
                                </div>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="since">aktywna: </label>
                            <div class="col-10">
                                <input class="form-control" type="checkbox" id="active" name="active" @if(!isset($privilege)) checked @else @if($privilege->active == 1) checked @endif @endif>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="since">grupa: </label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="group" name="group" @if(isset($privilege)) value="{{$privilege->group}}" @endif required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label" for="since">opis przywileju: </label>
                            <div class="col-10">
                                <textarea class="form-control" name="description">@if(isset($privilege)) {{$privilege->description}} @endif</textarea>
                            </div>
                        </div>

                    </form>
                    <div style="display: none;" class="warning" id="form_errors"></div>
                </div>
                <div class="col-md-4">
                    <img src="@if(isset($privilege)) @if($privilege->icon != null) {{$privilege->getIcon()}} @endif @endif" style="@if(!isset($privilege)) display: none; @endif  max-width: 100%; max-height: 100%" @if(!isset($privilege)) id="privilege_create_photo" @else id="privilege_edit_photo" @endif>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" @if(isset($privilege)) onclick="$('#privilege_edit_form').submit()" @else onclick="$('#privilege_create_form').submit()" @endif class="btn btn-primary">@if(isset($privilege)) Edytuj @else Dodaj @endif</button>
            </div>
        </div>
    </div>
</div>