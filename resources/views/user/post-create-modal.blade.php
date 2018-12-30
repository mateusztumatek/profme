<div class="modal fade" tabindex="-1" role="dialog" id="post-create">
    <div class="modal-dialog" role="document">

        <div class="modal-content" id="post-create-content">
            <div class="post-site">
                <div class="container mt-5">
                    <button onclick="$('#post-create').modal('hide')" class="my-button" id="close-button" style="position: absolute; top: 20px; "><i class="fa fa-close"></i></button>

                    <div class="row justify-content-center">
                        <div class="col-md-4 row justify-content-center">
                            <div id="user-photo" class="user-image">
                                <img  src="{{url('img/profile1.jpg')}}">
                            </div>

                        </div>

                    </div>
                    <div class="post-create-content">
                        <div  class="col-md-12 text-center mt-5">
                            <p  style=" color: white ;font-size: 60px; font-family: 'Freestyle Script'">Witaj Mateusz Bielak</p>
                        </div>

                        <div  class="col-md-12 text-center mt-5">
                            <p  style=" color: black ;font-size: 20px; font-family: 'muli'; font-weight: 200; text-shadow: none !important;">co chcesz zrobić?</p>
                        </div>
                        <div  class="row justify-content-center">

                            <a onclick="showform($('#post-create-form'))" class="my-button" style="text-align:center; color: black; padding: 15px 20px 15px 20px; margin: 5px; font-size: 15px; width:200px"><i class="fa fa-pencil-square"></i> Dodaj post</a>
                            <a onclick="$('#add_photo').modal()" class="my-button" style="text-align:center; color: black; padding: 15px 20px 15px 20px; margin: 5px; font-size: 15px; width: 200px"><i class="fa fa-photo"></i> Dodaj zdjęcie</a>





                        </div>
                    </div>


                    <div id="post-create-form" style="display: none">
                        <form enctype="multipart/form-data" action="{{route('post.store')}}" method="POST" onkeypress="return event.keyCode != 13;">
                            @CSRF
                            <div class="form-group">
                                <label for="title">Tytuł:</label>
                                <input type="text" class="form-control"  name="title" placeholder="Tytuł posta">
                            </div>
                            <div class="form-group form-inline">
                                <label class="mr-2" for="title">Tagi:</label>
                                <select multiple id="tag-input" data-role="tagsinput" name="tags[]">

                                </select>

                                <button onclick="$('#post-image-holder').click()" type="button" class="my-button ml-5"> dodaj zdjęcie</button>
                                <input id="post-image-holder" type="file" name="image" class="d-none"  >
                            </div>
                            <div class="img-holder">
                                <img id="post-image" src="">
                                <button id="delete-post-image" type="button" class="my-button">usun zdjecie</button>
                            </div>
                            <div class="form-group">
                                <label for="description">więcej informacji:</label>
                                <textarea class="form-control" name="description" placeholder="opis postu"></textarea>
                            </div>


                            <button  class="my-button" type="submit" > dodaj post</button>

                        </form>
                    </div>




                </div>
            </div>
        </div>

    </div>
</div>