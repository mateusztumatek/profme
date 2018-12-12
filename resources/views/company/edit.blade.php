
<form enctype="multipart/form-data" method="POST" action="{{route('user.company.edit', ['company' => $company])}}">
    @CSRF


    <div class="row justify-content-center">

        <div class="col-lg-8">
            <h3 class="text-center"> Edytuj swóją firmę {{$company->official_name}}:</h3>
            <div class="form-group row">

                <label class="col-sm-2 col-form-label" for="name">Nazwa twojej firmy:</label>

                <div class="col-sm-10">
                    <input type="text" name="name" value="{{$company->official_name}}" class="form-control" placeholder="np. Socative z.o.o.">

                    @if($errors->has('name'))
                        <span class="text-muted alert"> {{$errors->first('name')}}</span>
                    @endif

                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="email">Email twojej firmy: </label>

                <div class="col-sm-10">
                    <input value="{{$company->email}}" type="email" name="email" class="form-control" placeholder="socative@gmail.com">
                    @if($errors->has('email'))
                        <span class="invalid-feedback" style="display: block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                    @endif
                </div>

            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Dane adresowe </label>
                <div class="col-sm-10 row">
                    <div class="col-sm-6">
                        <input value="{{$company->city}}" class="form-control" type="text" name="city" id="City" placeholder="Miasto">
                        @if($errors->has('city'))
                            <span class="invalid-feedback" style="display: block">
                                <strong>{{ $errors->first('city') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <input value="{{$company->postal_code}}" class="form-control" type="text" id="postal_code" name="postal_code" pattern="^[0-9]{2}-[0-9]{3}$" placeholder="kod-pocztowy (xx-xxx)">
                        @if($errors->has('postal_code'))
                            <span class="invalid-feedback" style="display: block">
                                <strong>{{ $errors->first('postal_code') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-6 mt-2">
                        <input value="{{$company->street}}" class="form-control" type="text" name="street" id="street" placeholder="ulica">
                        @if($errors->has('street'))
                            <span class="invalid-feedback" style="display: block">
                                <strong>{{ $errors->first('street') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-6 mt-2">
                        <input value="{{$company->street_number}}" class="form-control" name="street_number" type="text" id="street_number" placeholder="numer ulicy">
                        @if($errors->has('street_number'))
                            <span class="invalid-feedback" style="display: block">
                                <strong>{{ $errors->first('street_number') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-6 mt-2">
                        <input value="{{$company->country}}" class="form-control" name="country" type="text" id="country" placeholder="country">
                        @if($errors->has('country'))
                            <span class="invalid-feedback" style="display: block">
                                <strong>{{ $errors->first('country') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="nip"> NIP: </label>
                <div class="col-sm-10">
                    <input value="{{$company->nip}}" type="text" name="nip" class="form-control" required>
                    @if($errors->has('nip'))
                        <span class="invalid-feedback" style="display: block">
                                <strong>{{ $errors->first('nip') }}</strong>
                            </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">

                <label for="logo" class="col-sm-2 col-form-label"> Logo twojej firmy: </label>
                <div class="col-sm-1">
                    <img onclick="loadGallery(this)" style="max-width: 100%" src="{{$company->getLogo()}}">
                </div>
                <DIV class="col-sm-9">
                    <input value="{{$company->image}}" type="file" class=" form-control" name="logo">
                    @if($errors->has('logo'))
                        <span class="invalid-feedback" style="display: block">
                                <strong>{{ $errors->first('logo') }}</strong>
                            </span>
                    @endif
                </DIV>

            </div>
            <button class="btn btn-primary" type="submit">zatwierdź</button>
        </div>




    </div>
</form>