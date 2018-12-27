<div class="modal fade bd-example-modal-lg" id="post_comments" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content w-50 m-auto">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Komentarze postu: {{$post->title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @foreach($post->comments() as $comment)
                    <form method="POST" action="{{route('comment.update', ['comment' => $comment])}}">
                        @CSRF
                    <div class="row justify-content-center p-2" >
                        <div class="col-md-4 d-flex align-items-center ">
                            <div class="profile-img">
                                <img src="{{$comment->getUser()->getProfileUrl()}}">
                            </div>
                            <p class="ml-1">{{$comment->getUser()->name}}</p>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="content" value="{{$comment->content}}" required>
                        </div>
                        <div class="col-sm-2 d-flex">
                            <form method="POST" action="{{route('comment.delete', ['comment' => $comment])}}">
                                @CSRF
                                <button class="btn btn-primary" type="submit"><i class="fa fa-trash"></i></button>
                            </form>
                            <button id="edit_comment_trigger" class="btn btn-primary ml-2"><i class="fa fa-save"></i></button>
                        </div>
                    </div>
                    </form>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>