@extends('layouts.app')

@section('content')

    <div class="col-sm-12 user-posts">

        <div class="row justify-content-between">

            @foreach($posts as $post)
                @if($post->status != 'reported')
                <div id="post-{{$post->id}}" class="col-md-6 pr-4 pl-4  mt-3">

                    <div class="single-post mt-2">

                        <div class="header row justify-content-between">
                            <div class="col-md-8 d-flex align-items-center">
                                <div class="profile-img">
                                    <a href="#"><img src="{{$post->getUser()->getProfileURL()}}"></a>
                                </div>

                                <h3 class="ml-2"><a href="{{url('user/'. $post->user_id)}}">{{$post->getUser()->name}}</a> </h3>

                            </div>


                            <div class="col-md-3 d-flex p-1 flex-wrap" style="font-size: 0.7rem;">
                                <div class="col-2 p-0 text-center m-r">
                                    <span class="fa fa-calendar"></span>
                                </div>
                                <div class="col-10 p-0">
                                    <p class="m-0">{{$post->created_at->diffforhumans()}}</p>
                                </div>
                                <div class="col-2 p-0 text-center m-r">
                                    <span class="fa fa-user"></span>
                                </div>
                                <div class="col-10 p-0">
                                    <p class="m-0">publicznie</p>
                                </div>
                            </div>

                        </div>

                        <div class="post-image position-relative">
                            <img class="post-image" onclick="loadGallery(this)" data-toogle = 'modal' data-target="#photos" id="img-gallery" src="{{$post->getImageURL()}}">
                            <!-- blok oceny na zdjęciu <div class="post-rate">
                                 <span class="numberCircle"><span>2</span></span>
                             </div> -->
                        </div>

                        <div class="post-action row justify-content-center">
                            <div class="col-md-6 col-sm-12 pr-0">
                                @if($post->getUserRate(\Illuminate\Support\Facades\Auth::user()) == NULL)
                                    <button onclick="ShowOrHide($(this).parent().siblings('.rate-block'))" class="btn btn-primary w-100">Oceń</button>
                                @else
                                    <button onclick="ShowOrHide($(this).parent().siblings('.rate-block'))" class="btn btn-primary w-100">Zmień ocenę</button>
                                @endif
                            </div>
                            <div class="col-md-6 col-sm-12 pl-0">
                                <button onclick="ShowOrHide($(this).parent().siblings('.comment-block'))" class="btn btn-primary w-100" type="button">Skomentuj</button>
                            </div>
                            <div class="col-12 pt-1 pb-1">
                                <a onclick="ShowOrHide($($(this).parent().parent().siblings()[3]).find('.comments-section'))" class="post-button p-0 pr-1"> <span class="fa fa-comment"></span> {{count($post->comments())}} </a>
                                @if(!$post->getRates()->isEmpty() && $post->user_id == \Illuminate\Support\Facades\Auth::id())
                                    <a onclick="ShowOrHide($($(this).parent().parent().siblings()[3]).find('.post-statistic'))" class="post-button p-0 pl-1"> <span class="fa fa-eye"></span> {{count($post->getRates())}} </a>
                                @endif
                            </div>

                            <div class="col-12 comment-block mb-1 text-center ">
                                <form class="add-comment-form" onsubmit="add_comment_submit(this, event)" action="{{route('comment.store')}}" method="POST">
                                    @CSRF
                                    <input hidden name="user_id" value="{{\Illuminate\Support\Facades\Auth::id()}}">
                                    <input hidden name="post_id" value="{{$post->id}}">
                                    <textarea onload="$(this).autoResize()" name="content"></textarea>
                                    <button type="submit" class="btn btn-primary">zatwierdź</button>
                                </form>
                            </div>
                            <div class="col-12 rate-block mb-1 text-center ">
                                @if($rate = $post->getUserRate(\Illuminate\Support\Facades\Auth::user()))
                                    <form action="{{route('rate.update', ['rate' => $rate->id])}}" method="POST">
                                        <p>oceniłeś ten post na : {{$rate->rate}}</p>
                                        @else
                                            <form action="{{route('rate.store')}}" method="POST">
                                                @endif
                                                <div class="form-inline w-50 m-auto row justify-content-between">
                                                    @CSRF
                                                    <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::id()}}">
                                                    <input type="hidden" name="elem_id" value="{{$post->id}}">
                                                    <input type="hidden" name="elem_type" value="post">
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

                            </div>


                        </div>
                        <hr class="m-0">
                        <div class="post-content pt-3">
                            <h4 class="mb-3" style="font-weight: 800; ">{{$post->title}}</h4>
                            <article>{{$post->description}}</article>
                            <div class="d-flex">
                                @foreach($post->tags() as $tag)
                                    <p class="mt-2 mb-0 ml-1 tags" style="font-size: 85%;"> #{{$tag->tag}}  </p>
                                @endforeach
                            </div>
                            <div class="comments-section">
                                <hr>
                                <h3 class="text-left"> Komentarze: </h3>
                                <div class="comment-content">
                                    @if(!$post->Comments()->isEmpty())




                                        @foreach($post->Comments() as $comment)
                                            <div id="{{$comment->id}}" class="comment row justify-content-between">
                                                <div class="col-md-2">
                                                    <img src="{{$comment->getUser()->getProfileURL()}}">
                                                </div>
                                                <div class="col-md-10 text-left">
                                                    <div class="row justify-content-between m-0 mb-1">
                                                        <h4 class="m-0">{{$comment->getUser()->name}}</h4>
                                                        @if($comment->created_at != $comment->updated_at)
                                                            <span> <span style="font-size: 0.8em;">edit: </span>{{$comment->updated_at->diffForHumans()}}</span>
                                                        @else
                                                            <span>{{$comment->created_at->diffForHumans()}}</span>
                                                        @endif
                                                    </div>

                                                    <p class="comment-description">{{$comment->content}}</p>
                                                    @if(\Illuminate\Support\Facades\Auth::id() == $comment->getUser()->id)
                                                        <form  style="line-height: 1.4" class="float-left" action="{{route('comment.delete', ['comment' => $comment->id])}}" method="POST">
                                                            @CSRF
                                                            <a onclick="if(confirm('czy na pewno chcesz usunac ten element?'))$(this).parent().submit()" class="mr-1"><i class="fa fa-trash"></i></a>
                                                        </form>
                                                        <a onclick="edit_comment(this)" class="ml-1"><i class="fa fa-edit"></i></a>
                                                    @endif
                                                </div>


                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            @if(!$post->getRates()->isEmpty())
                                <div class="post-statistic mt-3">
                                    <div class="title">
                                        <h3>Oceny tego postu</h3>
                                    </div>
                                    <div id="chart">

                                        <ul id="numbers">
                                            <li><span>100%</span></li>
                                            <li><span>90%</span></li>
                                            <li><span>80%</span></li>
                                            <li><span>70%</span></li>
                                            <li><span>60%</span></li>
                                            <li><span>50%</span></li>
                                            <li><span>40%</span></li>
                                            <li><span>30%</span></li>
                                            <li><span>20%</span></li>
                                            <li><span>10%</span></li>
                                            <li><span>0%</span></li>
                                        </ul>

                                        <ul id="bars">
                                            <li onclick="showPostRate({{$post->id}}, 1)"><div data-percentage="{{\App\Helpers::getPercentRate($post, 1)}}" data-count = "{{\App\Helpers::getPercentCount($post, 1)}}" class="bar"></div><span>Bardzo slabo</span></li>
                                            <li onclick="showPostRate({{$post->id}}, 2)"><div data-percentage="{{\App\Helpers::getPercentRate($post, 2)}}" data-count = "{{\App\Helpers::getPercentCount($post, 2)}}" class="bar"></div><span>Slabo</span></li>
                                            <li onclick="showPostRate({{$post->id}}, 3)"><div data-percentage="{{\App\Helpers::getPercentRate($post, 3)}}" data-count = "{{\App\Helpers::getPercentCount($post, 3)}}" class="bar"></div><span>Srednio</span></li>
                                            <li onclick="showPostRate({{$post->id}}, 4)"><div data-percentage="{{\App\Helpers::getPercentRate($post, 4)}}" data-count = "{{\App\Helpers::getPercentCount($post, 4)}}" class="bar"></div><span>Dobrze</span></li>
                                            <li onclick="showPostRate({{$post->id}}, 5)"><div data-percentage="{{\App\Helpers::getPercentRate($post, 5)}}" data-count = "{{\App\Helpers::getPercentCount($post, 5)}}" class="bar"></div><span>Bardzo dobrze</span></li
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                        @endif
                        <!--<div class="post-statistic">
                                <main class="stats">
                                    <header class="stats__header">
                                        <div class="stats__header-num">
                                            <p>8</p>
                                        </div>
                                        <div class="stats__header-name">
                                            <p>Alex<span>Ovechkin</span></p>
                                        </div>
                                    </header>
                                    <ul class="stats__list">
                                        <li class="stats__item">
                                            <p class="stats__item-num">65</p>
                                            <div class="stats__item-bar"></div>
                                        </li>
                                        <li class="stats__item">
                                            <p class="stats__item-num">56</p>
                                            <div class="stats__item-bar"></div>
                                        </li>
                                        <li class="stats__item">
                                            <p class="stats__item-num">50</p>
                                            <div class="stats__item-bar"></div>
                                        </li>
                                        <li class="stats__item">
                                            <p class="stats__item-num">32</p>
                                            <div class="stats__item-bar"></div>
                                        </li>
                                        <li class="stats__item">
                                            <p class="stats__item-num">38</p>
                                            <div class="stats__item-bar"></div>
                                        </li>
                                        <li class="stats__item">
                                            <p class="stats__item-num">32</p>
                                            <div class="stats__item-bar"></div>
                                        </li>
                                        <li class="stats__item">
                                            <p class="stats__item-num">51</p>
                                            <div class="stats__item-bar"></div>
                                        </li>
                                        <li class="stats__item">
                                            <p class="stats__item-num">50</p>
                                            <div class="stats__item-bar"></div>
                                        </li>
                                    </ul>
                                    <div class="stats__overlay">
                                        <div class="stats__overlay-back">
                                            <svg fill="white" xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36"><path d="M30 16.5H11.74l8.38-8.38L18 6 6 18l12 12 2.12-2.12-8.38-8.38H30v-3z"></path></svg>
                                            <p id="year">2009-2010</p>
                                        </div>
                                        <div class="stats__overlay-avg">
                                            <p class="avg" id="avg">0.69</p>
                                            <p>Goals per game</p>
                                        </div>
                                        <div class="stats__overlay-info">
                                            <div class="stats__overlay-info-half">
                                                <p id="goals">50</p>
                                                <p>Goals</p>
                                            </div>
                                            <div class="stats__overlay-info-half">
                                                <p id="games">72</p>
                                                <p>Games</p>
                                            </div>
                                        </div>
                                    </div>
                            </div>-->


                        </div>
                        @if($post->user_id == \Illuminate\Support\Facades\Auth::id())
                            <div class="post-settings">
                                <div  class="post-settings-trigger text-right">
                                    <i onclick="ShowOrHide($(this).parent().siblings('.post-settings-toogle'))" class="fa fa-cogs"></i>
                                </div>
                                <div class="post-settings-toogle">
                                    <div class="nav-item">
                                        <form action="{{route('post_destroy', ['post' => $post->id])}}" method="POST">
                                            @CSRF
                                            <a style="cursor: pointer" class="nav-link p-1" onclick="$(this).parent().submit()">usun post</a>
                                        </form>
                                    </div>

                                    <div class="nav-item">
                                        <a href="{{route('post_edit', ['id' => $post->id])}}" class="nav-link p-1" > edytuj post </a>
                                    </div>

                                </div>
                            </div>
                        @endif
                        @if(!\App\Report::checkIfReported('post', $post->id, \Illuminate\Support\Facades\Auth::id()))
                            <div class="report">
                                <a class="my_tooltip" onclick="openReportModal('post', '{{$post->id}}', '{{$post->title}}', '{{\Illuminate\Support\Facades\Auth::id()}}' )"> <i class="fa fa-warning"></i></a>
                            </div>
                        @endif
                    </div>

                </div>
                @endif
            @endforeach

        </div>
        <div class="col-sm-12 justify-content-center mt-3">
            {{$posts->links()}}
        </div>
    </div>
    <div class="modal fade" id="PostRateModal" tabindex="-1" role="dialog" aria-labelledby="PostRateModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body rate">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var comment_edit_route = '{{route('comment.update', ['comment' => null])}}';
        var comment_delete_route = '{{route('comment.delete', ['comment' => null])}}';
        var token = '{{csrf_token()}}';
        var users_rate_route = '{{route('users_rate', ['post' => null, 'rate' => null])}}';

    </script>
@endsection
