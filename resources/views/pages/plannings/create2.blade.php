@extends('layouts.app')

@section('head')
    <!-- fullCalendar -->
  <link rel="stylesheet" href="{{asset('')}}/bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="{{asset('')}}/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
    <!-- Select2 -->
  <!-- Time Picker -->
  <link rel="stylesheet" href="{{asset('')}}/assets/css/timePicker.css">
  <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" href="{{asset('')}}/assets/css/aristo/aristo.css">
  {{-- <link rel="stylesheet" href="{{asset('')}}bower_components/select2/dist/css/select2.min.css"> --}}
@endsection

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <br>
  <div class="container-fluid">
    <form action="{{route('planning.store')}}" method="post">
      @csrf
      <section>
        <div class="panel panel-header"><h4>Créer une Vacation</h4></div><br>
        <div class="panel panel-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group @error('agent')  has-error @enderror">
                  <label for="agent">Agent</label>
                  <select name="agent" class="form-control select2" style="width: 100%;">
                      <option value="">Choisir un agent pour son planning</option>
                      @if(count($agents)>0)
                          @foreach($agents as $agent)
                              <option value="{{$agent->id}}" {{old('agent')==$agent->id ? 'selected' : null}}>{{$agent->nom.' '.$agent->prenoms}}</option>
                          @endforeach
                      @endif
                  </select>
                  @error('agent')
                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                  @enderror
              </div>
            </div>
            <div class="col-md-6">
                    <div class="form-group col-md-6 @error('date_debut')  has-error @enderror" style="padding-left: 0px; width: 100%;">
                      <label for="agent">Date Debut</label>
                      <input type="text" name="date_debut[]" class="form-control date" id="datepicker2" placeholder="Date debut" autocomplete="off">
                      @error('date_debut')
                          <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                      @enderror
                    </div>
            </div>
          </div>
          <table class="table table-borderd">
            <thead>
              <tr>
                <th>Site</th>
                <th>Heure Debut</th>
                <th>Heure Fin</th>
                <th>Pause</th>
              </tr>
            </thead>
            <tbody class="tbodyt">
              <tr id="champ">
                <td>
                    <select name="site[]" class="form-control select2" style="padding-left: 0px; width: 100%;" id="site_id">
                        <option value="" >Choisir un site</option>
                        @if(count($sites)>0)
                          @foreach($sites as $site)
                            <option value="{{$site->id}}" {{old('site')==$site->id ? 'selected' : null}}>{{$site->nom}}</option>
                          @endforeach
                        @endif
                    </select>
                    @error('site')
                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                    @enderror
                </td>
                <td>
                    <div class="form-group heure_debut col-md-6 @error('heure_debut')  has-error @enderror" style="padding-left: 0px; width: 100%;">
                      <input id="heure_debut" name="heure_debut[]" type="text" class="time-picker form-control" placeholder="Heure Début" readonly style="background: white">
                      @error('heure_debut')
                          <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                      @enderror
                    </div>
                </td>
                <td>
                    <div class="form-group heure_fin col-md-6 @error('heure_fin')  has-error @enderror" style="padding-right: 0px; width: 100%;">
                      <input id="heure_fin" name="heure_fin[]" type="text" class="time-picker form-control" placeholder="Heure Fin" readonly style="background: white">
                      @error('heure_fin')
                          <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                      @enderror
                    </div>
                </td>
                <td>
                  <div class="form-group pause col-md-6 @error('pause')  has-error @enderror" style="padding-right: 0px; width: 100%;">
                    <input type="text" name="pause[]" class="time-picker form-control" placeholder="la pause" readonly style="background: white" id="pause_id">
                    @error('pause')
                          <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                    @enderror
                  </div>
                </td>
                <td><button type="button" class="btn btn-danger"><i class="glyphicon glyphicon-remove-sign"></i></button></td>
              </tr>
            </tbody>
          </table>
          <button type="submit" class="btn btn-primary" id="submin_id">Valider</button>
        </div>
      </section>
    </form>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>  
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
    <script type="text/javascript" src="http://multidatespickr.sourceforge.net/jquery-ui.multidatespicker.js"></script>
    <script type="text/javascript" src="js/jquery/mobiscroll.jquery.min.js"></script>  
  </div>
  <!-- /.content-wrapper -->
@endsection

@section('script')
<!-- fullCalendar -->
<script src="{{asset('')}}/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<script>
  $(document).ready(function(){

    $('#datepicker2').datepicker({
    format: 'd-m-yyyy',
    lang: 'fr',
    multidate: true,
    closeOnDateSelect: true,
    });

    $('#datepicker2').change(function(){
      $('#champ').clone(true, true).appendTo('.tbodyt');
    });

    $('.glyphicon-remove-sign').on('click', function(){
      $('#champ').remove();
    });



    // $('#datepicker3').datepicker({
    //   format: 'd-mm-yyyy',
    //   lang: 'fr',
    //   multidate: true,
    //   closeOnDateSelect: true
    // });
  });
</script>
<!-- Page specific script -->
<!-- Add calendarJsFile -->
@include('pages.plannings.calendarJs')
<!-- / Add calendarJsFile -->
@endsection