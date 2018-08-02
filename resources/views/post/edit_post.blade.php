@extends('layouts.app')

@section('content')

    <div class="col-md-12 justify-content-center edit-profile">
        <h3 class="text-center mb-3">{{$post->title}}</h3>
        <div class="row justify-content-center">
            <div class="col-md-3">
                <img class="mb-2" src="{{$post->getImageURL()}}">
            </div>
            <div class="col-md-9">
                <form id="edit-post-form" action="{{route('post_update', ['post' => $post->id])}}" method="POST" enctype="multipart/form-data">
                    @CSRF
                    <div class="col-md-10 col-sm-12 m-auto">
                        <div class="form-group w-75">
                            <label for="title"> Tytuł posta: </label>
                            <input maxlength="45" class="form-control" name="title" value="{{$post->title}}" required>
                        </div>
                        <div class="form-group form-inline">
                            <label class="mr-2" for="title">Tagi:</label>
                            <select multiple id="tag-edit-input" data-role="tagsinput" name="tags[]">
                                @foreach($post->Tags() as $tag)
                                    <option value="{{$tag->tag}}">{{$tag->tag}}</option>
                                @endforeach
                            </select>

                            <button onclick="$('#edit-post-image-holder').click()" type="button" class="my-button ml-5"> zmień zdjęcie</button>
                            <input id="edit-post-image-holder" type="file" name="image-edit" class="d-none"  >
                        </div>
                        <div class="img-holder mt-2 mb-2" style="display: block">
                            <img id="edit-post-image" src="{{$post->getImageURL()}}">
                            <button id="edit-delete-post-image" type="button" class="my-button">usun zdjecie</button>
                        </div>
                        <div class="form-group">
                            <label for="description">więcej informacji:</label>
                            <textarea class="form-control" name="description" placeholder="opis postu">{{$post->description}}</textarea>
                        </div>
                        <button onclick="$('#edit-post-form').submit()" class="my-button" type="button" >edytuj post</button>
                    </div>


                </form>
            </div>
        </div>

    </div>


    @endsection