<div id="reports">
    <div class="d-flex action">

        <form onsubmit="sendRequest(this, event)" class="ml-2" id="reports-all-mark-seen" action="{{route('reports.all-mark-seen')}}" method="POST">
            <button class="btn my-button"> Oznacz wszytkie jako przeczytane </button>
        </form>
        <form style="display: none;" onsubmit="sendRequest(this, event)" class="ml-2" id="reports-delete" action="{{route('reports.delete')}}" method="POST">
            <button class="btn my-button"> Usuń zaznaczone elementy </button>
        </form>
        <form style="display: none;" onsubmit="sendRequest(this, event)" class="ml-2" id="reports-mark-seen" action="{{route('reports.mark-seen')}}" method="POST">
            <button class="btn my-button"> Oznacz jako przeczytane zaznaczone elementy </button>
        </form>
        <form style="display: none;" onsubmit="sendRequest(this, event)" class="ml-2" id="reports-mark-unseen" action="{{route('reports.mark-unseen')}}" method="POST">
            <button class="btn my-button"> Oznacz jako nie przeczytane zaznaczone elementy </button>
        </form>
        <form style="display: none;" onsubmit="sendRequest(this, event)" class="ml-2" id="reports-accept" action="{{route('reports.accept')}}" method="POST">
            <button class="btn my-button"> Akceptuj zgłoszenia </button>
        </form>
        <form onsubmit="sendRequest(this, event)" class="ml-2" id="reports-unaccept" action="{{route('reports.unaccept')}}" method="POST">
            <button class="btn my-button"> Odrzuć zgłoszenia </button>
        </form>
    </div>

    <table class="table reports">
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
            <tr style="@if($report->seen == 1) background-color: transparent @else background-color: #f2382d; @endif !important; border: 1px solid black; border-left: transparent; border-right: transparent ">
                <th> <input class="form-control reports-checkbox" onclick="reports_click(this)" type="checkbox" name="reports" multiple value="{{$report->id}}"> </th>
                <th scope="row">

                    {{$report->id}}</th>
                <td> {{$report->elem_type}} </td>
                <td> <a href="{{$report->getUrl()}}">{{$report->getElementName()}}</a></td>
                <td> <a href="{{url('user/'. $report->getUser()->id)}}"> </a>{{$report->getUser()->name}}</td>
                <td> {{$report->description}}</td>

                <td><a @if($report->getCount()>0) style="cursor: pointer" onclick="showOtherReports(this)" data-report_id = "{{$report->id}}"@endif>inne zgłoszenia: {{$report->getCount()}}</a> </td>
                @if($report->accepted == 1)
                    <td> <span style="font-size: 8px" class="alert alert-danger"><i class="fa fa-check"></i></span></td>
                    @endif
            </tr>


        @endforeach
        </tbody>
    </table>
{{--
    <span>{{$reports->links()}}</span>
--}}
<div id="other_reports">

</div>

</div>


