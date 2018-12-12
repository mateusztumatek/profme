<div class="modal fade" tabindex="-1" role="dialog" id="employee-create">
    <div class="modal-dialog" role="document">

        <div class="modal-content" id="post-create-content">
            <div class="post-site">
                <div class="container mt-5">
                    <button onclick="$('#employee-create').modal('hide')" class="my-button" id="close-button" style="position: absolute; top: 20px; "><i class="fa fa-close"></i></button>

                    <div class="row justify-content-center">
                        <div class="col-md-4 row justify-content-center ui-front">
                          <input type="text" class="form-control" id="employer_search_input">
                        </div>
                    </div>

                    <div class="post-create-content">

                        <div  class="col-md-12 text-center mt-5">
                            <p  style=" color: white ;font-size: 60px; font-family: 'Freestyle Script'">Witaj {{\Illuminate\Support\Facades\Auth::user()->name}}</p>
                        </div>

                        <div  class="col-md-12 text-center mt-5">
                            <p  style=" color: black ;font-size: 20px; font-family: 'muli'; font-weight: 200; text-shadow: none !important;">Znajdź firmę i dodaj stanowisko...</p>
                        </div>
                       <div id="company_placeholder">

                       </div>
                    </div>




                </div>
            </div>
        </div>
    </div>
</div>