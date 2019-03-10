@set('widget_helper',new Robust\Projects\Helpers\WidgetHelper)
<div class="col-xlg-7 col-md-6">
    <!-- Panel Projects Status -->
    <div class="panel widget-container" id="projects-status">
        <span class="del-btn">
             <i class="icon md-delete handle" aria-hidden="true"></i>
        </span>
         <span class="drag-btn">
            <i class="fa fa-arrows handle"></i>
        </span>
        <div class="panel-heading">
            <h3 class="panel-title">
                Projects Status
                <span class="badge badge-info">{{$widget_helper->totalProjects()}}</span>
            </h3>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Project</td>
                    <td>Status</td>
                    <td class="text-left">Progress</td>
                </tr>
                </thead>
                <tbody>
                @foreach($widget_helper->projects() as $project)
                    <tr>
                        <td>{{$project->id}}</td>
                        <td>{{$project->name}}</td>
                        <td>
                            <span class="label label-primary">Developing</span>
                        </td>
                        <td>
                            <span data-plugin="peityLine"></span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>