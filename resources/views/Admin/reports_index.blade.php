<div id="reports">
    <div class="d-flex action">
        <a class="btn my-button" href="#">Oznacz wszystkie jako przeczytane</a>
        <form style="display: none;" onsubmit="sendRequest(this, event)" class="ml-2" id="reports-delete" action="{{route('reports.delete')}}" method="POST">
            <button class="btn my-button"> Usuń zaznaczone elementy </button>
        </form>
        <form style="display: none;" onsubmit="sendRequest(this, event)" class="ml-2" id="reports-mark-seen" action="{{route('reports.mark-seen')}}" method="POST">
            <button class="btn my-button"> Oznacz jako przeczytane zaznaczone elementy </button>
        </form>
        <form style="display: none;" onsubmit="sendRequest(this, event)" class="ml-2" id="reports-mark-unseen" action="{{route('reports.mark-unseen')}}" method="POST">
            <button class="btn my-button"> Oznacz jako nie przeczytane zaznaczone elementy </button>
        </form>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col">#</th>
            <th scope="col">Typ elementu</th>
            <th scope="col">Element</th>
            <th scope="col">Użytkownik Zgłaszający</th>
            <th scope="col">opis zgłoszenia</th>

        </tr>
        </thead>
        <tbody>

        @foreach($reports as $report)
            <tr @if($report->seen == 0) style="background-color: #ff4558" @endif>
                <th> <input class="form-control reports-checkbox" onclick="reports_click(this)" type="checkbox" name="reports" multiple value="{{$report->id}}"> </th>
                <th scope="row">

                    {{$report->id}}</th>
                <td> {{$report->elem_type}} </td>
                <td> <a href="{{$report->getUrl()}}">{{$report->getElementName()}}</a></td>
                <td> <a href="{{url('user/'. $report->getUser()->id)}}"> </a>{{$report->getUser()->name}}</td>
                <td> {{$report->description}}</td>

                <td><a @if($report->getCount()>0) style="cursor: pointer" onclick="showOtherReports(this)" data-report_id = "{{$report->id}}"@endif>inne zgłoszenia: {{$report->getCount()}}</a> </td>





                @if($report->elem_type == 'education')
                <td class="d-flex">
                    <form method="POST" action="{{route('report.accept', ['report' => $report])}}"> @CSRF <a onclick="$(this).parent().submit()"><i class="fa fa-check"></i></a></form>
                    <form class="ml-2"> <a onclick="$(this).parent().submit()"><i class="fa fa-times"></i></a></form>

                </td>
                    @endif
            </tr>


        @endforeach
        </tbody>
    </table>

<div id="other_reports">

</div>

</div>


