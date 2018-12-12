<div class="modal fade bd-example-modal-lg" id="other_reports" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content w-50 m-auto">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Inne zgłoszenia dla tego postu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @foreach($reports as $report)
                    <div class="row justify-content-center p-2" @if($report->seen == 0) style="background-color: #ff4558; color: white!important;" @endif>
                        <div class="col-md-4 d-flex align-items-center ">
                            <div class="profile-img">
                                <img src="{{$report->getUser()->getProfileUrl()}}">
                            </div>
                            <p class="ml-1">{{$report->getUser()->name}}</p>
                        </div>
                        <div class="col-md-6">
                            <p>{{$report->description}}</p>
                        </div>
                        <div class="col-md-2">
                            <p>{{$report->created_at}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>