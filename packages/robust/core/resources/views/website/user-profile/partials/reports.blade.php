<div class="row">
    <div class="col-md-12">
        <h3 class="title-more-detail" id="my-saved-report">Saved Market Reports (0) </h3>
        <table class="table table-striped table-saved-alerts">
            <thead>
            <tr>
                <th>#</th>
                <th>Report name</th>
                <th>Frequency</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($lead->reports) && !empty($lead->reports))
                @foreach($lead->reports as $reports)
                    <tr>
                        <td>{{$reports->id}}</td>
                        <td>{{$reports->name}}</td>
                        <td>{{$reports->frequency}}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
