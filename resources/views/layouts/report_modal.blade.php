<div class="modal fade" id="report_modal" tabindex="-1" role="dialog" aria-labelledby="company_modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Zgłoś element </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body row">
                <form style="width: 100%" id="report_form" method="POST" action="{{route('report.store')}}">
                    @CSRF
                    <div class="col-md-12">
                        <input type="hidden" id="user_id" name="user_id" >
                        <div class="d-flex mt-4">
                            <p> Typ Elementu:</p>
                            <p class="ml-3" id="typ"> </p>
                            <input type="hidden" id="elem_type" name="elem_type" >
                        </div>
                        <div class="d-flex mt-4">
                            <p> Nazwa elementu:</p>
                            <p class="ml-3" id="nazwa"> </p>
                            <input type="hidden" id="elem_id" name="elem_id">
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2" for="description">wpisz swoje uwagi:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="description"></textarea>

                            </div>
                        </div>
                    </div>
                </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="$('#report_form').submit()"  class="btn btn-primary">Zgłoś</button>
            </div>
        </div>
    </div>
</div>