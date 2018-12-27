@extends('layouts.app')
@section('content')

    <div class="col-sm-12">
        <div  id="tabs">
            <ul class="tabs-label">
                <li onclick="search_url = base_url+'/autocomplete/users'" class="tab-label"><a href="#tabs-1">Użytkownicy</a></li>
                <li onclick="search_url = base_url+'/autocomplete/posts'" class="tab-label"><a href="#tabs-2">Posty</a></li>
                <li onclick="search_url = base_url+'/autocomplete/companies'" class="tab-label"><a href="#tabs-3">Firmy</a></li>
                <li class="tab-label"><a href="#tabs-4">Oceny</a></li>
                <li class="tab-label"><a href="#tabs-5">Edukacje</a></li>

                <li onclick="search_url = base_url + '/autocomplete/reports'" class="tab-label"><a href="#tabs-6">Zgłoszenia</a></li>
                <li class="tab-label"><a href="#tabs-7">Przywileje</a></li>

                <li class="tab-label float-right">

                    <input placeholder="wyszukaj użytkownika" style="padding: 0.200rem 0.3rem" class="form-control search-form mr-5" data-type="users" type="text" id="searchbox_users" >
                </li>
            </ul>
            <!-- tabela Użytkownicy -->
            <div class="tab" id="tabs-1">
                <div class="tab-content">

                       <table class="table">
                           <thead>
                           <tr>
                               <th scope="col">#</th>
                               <th scope="col">Imię</th>
                               <th scope="col">email</th>
                               <th scope="col">data urodzenia
                               <th scope="col">płeć</th>
                               <th scope="col">Miasto</th>
                               <th scope="col">Numer Tefelonu</th>
                               <th scope="col">średnia ocena</th>
                               <th scope="col">status</th>
                               <th scope="col">akcje</th>
                           </tr>
                           </thead>
                           <tbody>

                           @foreach($users as $user)
                           <tr>
                               <th scope="row">{{$user->id}}</th>
                               <td><a href="{{url('user/'.$user->id)}}">{{$user->name}}</a></td>
                               <td>{{$user->email}}</td>
                               <td>{{$user->date_of_birth}}</td>
                               <td>{{$user->sex}}</td>
                               <td>{{$user->city}}</td>
                               <td>{{$user->phone}}</td>
                               <td>
                                   @if(\App\Rate::getRate($user) == 0) nie ma oceny
                                   @else
                                   {{round(\App\Rate::getRate($user), 2)}}
                                   @endif
                               </td>
                               <td style="width: 6%;">
                                   @if($user->isbanned())
                                   zbanowany do: {{$user->banned_to}}
                                       @else
                                   aktywny
                                   @endif
                               </td>
                               <td><button type="button" data-toggle="modal" data-target="#user_permission" class="btn btn-primary" data-whatever="{{$user->id}}"><span class="fa fa-key"></span></button></td>
                           </tr>
                            @endforeach
                           </tbody>
                       </table>
                       <span>{{$users->links()}}</span>

                </div>
            </div>
            <!-- Koniec tabeli Użytkownicy -->
            <div class="tab" id="tabs-2">
                <div class="tab-content">

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Użytkownik</th>
                            <th scope="col">Tytuł</th>
                            <th scope="col">Opis</th>
                            <th scope="col">Zdjęcie</th>
                            <th scope="col">Status</th>
                            <th scope="col">Komentarze</th>
                            <th scope="col">akcje</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($posts as $post)
                            <tr>
                                <th scope="row">{{$post->id}}</th>
                                <td><a href="{{url('user/'.$post->getUser()->id)}}">{{$post->getUser()->name}}</a></td>
                                <td style="width: 30%">{{$post->title}}</td>
                                <td style="width: 35%">{{$post->description}}</td>
                                <td><img onclick="loadGallery(this)" style="max-height: 40px; max-width: 40px" src="{{$post->getImageUrl()}}"></td>
                                <td>{{$post->status}}</td>
                                <td @if(count($post->comments()) > 0)onclick="open_comments_modal(this)" data-id="{{$post->id}}" style="cursor: pointer" @endif>{{count($post->comments())}}</td>
                                <td>
                                    <form method="POST" action="{{route('post_destroy', ['post' => $post])}}">
                                        @CSRF
                                      <button type="submit" class="btn btn-primary" ><span class="fa fa-trash"></span></button>

                                     </form>

                                </td>
                                <td><a href="{{url('post/edit/'. $post->id)}}" class="btn btn-primary"><span class="fa fa-key"></span></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <span>{{$posts->links()}}</span>

                </div>
            </div>
            <!-- tabela firmy -->
                <div class="tab" id="tabs-3">
                    <div class="tab-content">

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Użytkownik</th>
                                <th scope="col">email</th>
                                <th scope="col">oficjalna nazwa
                                <th scope="col">logo</th>
                                <th scope="col">kod pocztowy</th>
                                <th scope="col">ulica</th>
                                <th scope="col">numer ulicy</th>
                                <th scope="col">NIP</th>
                                <th scope="col">miasto</th>
                                <th scope="col">państwo</th>
                                <th scope="col">aktywny</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($companies as $company)
                                <tr>
                                    <th scope="row">{{$company->id}}</th>
                                    <td><a href="{{url('user/'.$company->getUser()->id)}}">{{$company->getUser()->name}}</a></td>
                                    <td>{{$company->email}}</td>
                                    <td><a href="{{url('company/'.$company->id)}}">{{$company->official_name}}</a></td>
                                    <td><img src="{{$company->getLogo()}}" class="rounded"></td>
                                    <td>{{$company->postal_code}}</td>
                                    <td>{{$company->street}}</td>
                                    <td>{{$company->street_number}}</td>
                                    <td>{{$company->nip}}</td>
                                    <td>{{$company->city}}</td>
                                    <td>{{$company->country}}</td>
                                    <td>{{$company->is_verify}}</td>







                                    <td><button type="button" data-toggle="modal" data-target="#company_modal" class="btn btn-primary" data-whatever="{{$company->id}}"><span class="fa fa-key"></span></button></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <span>{{$companies->links()}}</span>

                    </div>
                </div>
            <div class="tab" id="tabs-4">
                <div class="tab-content">

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Użytkownik oceniający</th>
                            <th scope="col">Element</th>
                            <th scope="col">Typ elementu</th>
                            <th scope="col">ocena</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($rates as $rate)
                            <tr>
                                <th scope="row">{{$rate->id}}</th>
                                <td style="width: 20%"><a href="@if($rate->getUser() instanceof \App\User) {{url('user/'.$rate->getUser()->id)}} @else {{url('company/'. $rate->getUser()->id)}}@endif">@if($rate->getUser() instanceof \App\User) użytkownik: {{$rate->getUser()->name}} @else firma: {{$rate->getUser()->official_name}}@endif</a></td>
                                <td style="width: 15%">
                                    @if($rate->getElement() instanceof \App\Post)
                                    <a href="{{url('user/'. $rate->getElement()->user_id)}}">{{$rate->getElement()->title}}</a>
                                        @else
                                    <a href="{{url('user/'. $rate->getElement()->user_id)}}"> {{$rate->getElement()->getUser()->name}}</a>
                                    @endif
                                </td>

                                <td scope="row">{{$rate->elem_type}}</td>
                                <td>{{$rate->rate}}</td>
                                <td>
                                    <form method="POST" action="{{route('rate.delete', ['rate' => $rate])}}">
                                        @CSRF
                                        <button type="submit" class="btn btn-primary" ><span class="fa fa-trash"></span></button>

                                    </form>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <span>{{$rates->links()}}</span>

                </div>
            </div>
            <div class="tab" id="tabs-5">
                <div class="tab-content">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Użytkownik</th>
                            <th scope="col">kierunek </th>
                            <th scope="col">Instytucja</th>
                            <th scope="col">Opis</th>
                            <th scope="col">Od</th>
                            <th scope="col">Do</th>
                            <th scope="col">aktywne</th>
                        </tr>
                        </thead>
                        <tbody>

                         @foreach($educations as $education)
                            <tr>
                                <th scope="row">{{$education->id}}</th>
                                <td><a href="{{url('user/'.$education->getUser()->id)}}">{{$education->getUser()->name}}</a></td>
                                <td>{{$education->getDirection()->name}}</td>
                                <td>{{$education->institution}}</td>
                                <td>{{$education->description}}</td>
                                <td>{{$education->since}}</td>
                                <td>{{$education->untill}}</td>
                                <td>@if($education->active == 1) <span> <i class="fa fa-check"></i></span> @else <span> <i class="fa fa-times"></i></span> @endif</td>
                                <td><button type="button" class="open_education_modal btn btn-primary" data-id="{{$education->id}}"><span class="fa fa-key"></span></button></td>

                                <td>
                                        <form onsubmit="submitForm(this,event)" method="POST" action="{{route('education.delete', ['education' => $education])}}">
                                            @CSRF
                                        <button type="submit" class="delete_education btn btn-primary" data-id = "{{$education->id}}"><span class="fa fa-trash"></span></button>
                                        </form>
                                </td>


                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <span>{{$educations->links()}}</span>
                </div>

            </div>
            <!-- Koniec tabeli firmy -->
            <div class="tab" id="tabs-6">
                <div class="tab-content">
                    @include('admin.reports_index')
                </div>
            </div>
            <div class="tab" id="tabs-7">
                <div class="tab-content">
                    <button onclick="getPrivilageCreateModal()" type="button" class="btn my-button"> Dodaj Przywilej </button>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">użytkownik</th>
                            <th scope="col">Nazwa</th>
                            <th scope="col">ikona</th>
                            <th scope="col">ustawienia</th>
                            <th scope="col">płeć</th>
                            <th scope="col">grupa</th>
                            <th scope="col">aktywne</th>
                            <th scope="col">Opis</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($privileges as $privilege)
                            <tr>
                                <th scope="row">{{$privilege->id}}</th>
                                <td><a href="{{url('user/'.$privilege->getUser()->id)}}">{{$privilege->getUser()->name}}</a></td>
                                <td>{{$privilege->name}}</td>
                                <td><img src="{{$privilege->getIcon()}}" style="max-width: 70px; max-height: 70px"></td>
                                <td>
                                    @foreach($privilege->getSettings() as $key => $setting)
                                        {{key($setting). ' => '. $setting[key($setting)]}}
                                        <br>
                                        @endforeach

                                </td>
                                <td>{{$privilege->sex}}</td>
                                <td>{{$privilege->group}}</td>
                                <td>{{$privilege->active}}</td>
                                <td>{{substr($privilege->description, 0, 10)}}...</td>
                                <td><button type="button" data-privilege_id="{{$privilege->id}}" class="btn btn-primary" onclick="getPrivilegeEditModal(this)"><span class="fa fa-key"></span></button></td>
                                <td>
                                    <form onsubmit="confirm_form(this, 'czy na pewno chcesz usunąć ten element?', event)" action="{{route('privilege.delete', ['privilege' => $privilege])}}" method="POST">
                                        @CSRF
                                        <button type="submit" class="btn btn-primary"><span class="fa fa-trash"></span></button>
                                    </form>
                                </td>


                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <span>{{$privileges->links()}}</span>

                </div>
            </div>


    </div>

    <div class="modal fade" id="company_modal" tabindex="-1" role="dialog" aria-labelledby="company_modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Firma: <span id="company_name"></span> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-8">
                        <form enctype="multipart/form-data" id="company_edit_form" method="POST" >
                            @CSRF
                            <div class="form-group row">
                                <label class="col-2 col-form-label" for="official_name">Oficjalna nazwa</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" id="official_name_input" name="official_name" placeholder="nazwa twojej firmy" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label" for="email_input">email</label>
                                <div class="col-10">
                                    <input class="form-control" type="email" id="email_input" name="email" placeholder="email firmy" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label" for="nip_input">nip</label>
                                <div class="col-10">
                                    <input class="form-control" type="email" id="nip_input" name="nip" placeholder="email firmy" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label" for="country">Państwo</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" id="country_input" name="country" placeholder="państwo" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label" for="city">miasto</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" id="city_input" name="city" placeholder="miasto" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label" for="postal_code">kod pocztowy</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" id="postal_code_input" name="postal_code" placeholder="kod pocztowy" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label" for="street">ulica</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" id="street_input" name="street" placeholder="ulica">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label" for="street_number">numer domu</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" id="street_number_input" name="street_number" placeholder="numer domu">
                                </div>
                            </div>
                            <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="is_verify">aktywny</label>
                                    <input class="ml-2 form-check-input" type="checkbox" id="is_verify_input" name="is_verify" required>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label" for="logo">logo</label>
                                <div class="col-10">
                                    <input class="form-control" type="file" id="logo_input" name="logo">
                                </div>
                                <img style="max-width: 50px; max-height: 50px; display: none" id="company_logo_placeholder">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="$('#company_edit_form').submit()"  class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="user_permission" tabindex="-1" role="dialog" aria-labelledby="user_permission" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Użytkownik: <span id="user_name"></span> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="change_permission_form" method="POST">
                        @CSRF

                    <div class="col-sm-10 col-md-5">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="admin" name="permission[]"  >
                            <label class="form-check-label" for="defaultCheck1">
                                Admin
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-10 col-md-5">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="user" name="permission[]" >
                            <label class="form-check-label" for="defaultCheck1">
                                Użytkownik
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-10 col-md-5">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="moderator" name="permission[]" >
                            <label class="form-check-label" for="defaultCheck1">
                                Moderator
                            </label>
                        </div>
                    </div>


                    </form>
                    <hr class="mt-2 mb-2">
                    <form id="delete_user_form" method="POST">
                        @CSRF

                        <button type="submit" class="btn btn-primary">usuń użytkownika </button>
                    </form>
                    <form id="ban_user_form" method="POST">
                        @CSRF
                        <div class="col-sm-10 col-md-5 mb-2 mt-2">
                            <div class="form-inline">
                                <input class="form-control" type="date" name="banned_to" required>
                                <label class="form-check-label ml-2" for="defaultCheck1">
                                    zbanuj użytkownika
                                </label>
                            </div>
                        </div>
                        <button type="button" onclick="$('#ban_user_form').submit()" class="btn btn-primary">zatwierdz status</button>
                    </form>
                </div>






                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="$('#change_permission_form').submit()" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection('content')