<div class="row">
  <div class="col-xs-4">
    <div class="panel panel-danger">
      <div class="panel-heading" style="text-align: center;">
        <h4 style="color: white">Due Tomorrow</h4>
      </div>
      <div class="panel-body" style="text-align: center">
        <a style="cursor: pointer" data-toggle="modal" data-target="#taskDueTomorrow"><h2> {{ auth()->user()->tasksDueTomorrow()->count() }} </h2></a>
      </div>
    </div>
  </div>

  <div class="col-xs-4">
    <div class="panel panel-warning">
      <div class="panel-heading" style="text-align: center">
        <h4 style="color: white">Due This Week</h4>
      </div>
      <div class="panel-body" style="text-align: center">
        <a style="cursor: pointer" data-toggle="modal" data-target="#taskDueThisWeek"><h2>{{ auth()->user()->tasksDueThisWeek()->count() }}</h2></a>
      </div>
    </div>
  </div>

  <div class="col-xs-4">
    <div class="panel panel-default">
      <div class="panel-heading" style="text-align: center">
        <h4>Due Next Week</h4>
      </div>
      <div class="panel-body" style="text-align: center">
        <a style="cursor: pointer" data-toggle="modal" data-target="#taskDueNextWeek"><h2>{{ auth()->user()->tasksDueNextWeek()->count() }}</h2></a>
      </div>
    </div>
  </div>
</div>

@include('modals.tasks_due_tomorrow')
@include('modals.tasks_due_this_week')
@include('modals.tasks_due_next_week')
