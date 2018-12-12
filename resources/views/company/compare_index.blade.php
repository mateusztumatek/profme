<div id="compare" class="tab-content">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <form onsubmit="compare(this, event)" action="{{route('compare.index')}}" method="POST">
                @CSRF
                <div class="form-group form-inline">



                    <label for="user_1" class="col-sm-2">pracownik:</label>
                    <div class="col-sm-10">
                        <select id="user_1" class="form-control" name="user_1">
                            @foreach($employees as $key=>$employee)
                                <option @if($key == 0) selected @endif value="{{$employee->getUser()->id}}">{{$employee->getUser()->name}} stanowisko: {{$employee->position}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group form-inline">

                    <label for="user_2" class="col-sm-2">Inny użytkownik:</label>
                    <div class="col-sm-10">
                        <input id="user_2" type="text" class="form-control" required>
                        <input id="user_2_id" type="hidden" class="form-control" name="user_2_id" required>
                    </div>


                </div>
                <button type="submit" style="display: none" id="compare_button" class="btn my-button"> porównaj </button>
            </form>
        </div>



    </div>

</div>