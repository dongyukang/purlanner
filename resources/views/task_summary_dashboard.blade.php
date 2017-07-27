<div class="row">
  <div class="col-xs-4">
    <div class="panel panel-danger">
      <div class="panel-heading" style="text-align: center;">
        <h5 style="color: white">Due Tomorrow</h5>
      </div>
      <div class="panel-body" style="text-align: center">
        <a style="cursor: pointer" data-toggle="modal" data-target="#taskDueTomorrow"><h3> {{ auth()->user()->tasksDueTomorrow()->count() }} </h3></a>
      </div>
    </div>
  </div>

  <div class="col-xs-4">
    <div class="panel panel-warning">
      <div class="panel-heading" style="text-align: center">
        <h5 style="color: white">Due This Week</h5>
      </div>
      <div class="panel-body" style="text-align: center">
        <a style="cursor: pointer" data-toggle="modal" data-target="#taskDueThisWeek"><h3>{{ auth()->user()->tasksDueThisWeek()->count() }}</h3></a>
      </div>
    </div>
  </div>

  <div class="col-xs-4">
    <div class="panel panel-default">
      <div class="panel-heading" style="text-align: center">
        <h5>Due Next Week</h5>
      </div>
      <div class="panel-body" style="text-align: center">
        <a style="cursor: pointer" data-toggle="modal" data-target="#taskDueNextWeek"><h3>{{ auth()->user()->tasksDueNextWeek()->count() }}</h3></a>
      </div>
    </div>
  </div>
</div>

@include('modals.tasks_due_tomorrow')
@include('modals.tasks_due_this_week')
@include('modals.tasks_due_next_week')
