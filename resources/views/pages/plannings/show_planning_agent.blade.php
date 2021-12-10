@extends('layouts.app')
@php
  use Carbon\Carbon;
@endphp
@section('head')
  <link rel="stylesheet" type="text/css" href="{{asset('')}}dist/css/jquery-ui.css">
@endsection

@section('content')
  <div id="action_alert" title="Action"></div>

  <!-- Main content -->
  <section class="content">
    <!-- /.row -->
      <div class="row" id="route">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tous les plannings</h3>
            </div>
            <!-- /.box-header -->
            <div id="div_table_planning" class="box-body table-responsive no-padding">
              @include('pages.plannings.show_planning_agent_sub')
            </div>
          <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      
  </section>
  <!-- /.content -->
<!-- ./wrapper -->
@endsection