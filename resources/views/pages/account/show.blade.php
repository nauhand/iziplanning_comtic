@extends('layouts.app')

@section('head')
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{asset('')}}plugins/iCheck/all.css">
<!-- Bootstrap Color Picker -->
<link rel="stylesheet" href="{{asset('')}}bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="{{asset('')}}plugins/timepicker/bootstrap-timepicker.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('')}}bower_components/select2/dist/css/select2.min.css">
<style>
  button.dt-button, div.dt-button, a.dt-button{
    background-color: #3c8dbc !important;
    background-image: none;
  }
  .dataTables_wrapper .dataTables_filter input{
    margin-left: 0.5em;
    width: 250px;
    padding: 5px;
    border: 1px solid;
    color: #555;
    font-weight: normal;
    margin-bottom: 10px;
  }

</style>
@endsection

@section('content')

    <!-- Content Header (Page header) -->
    @if ($message = Session::get('successadmin'))
        <div class="alert alert-success alert-dismissible show" id="notification" role="alert" style="position:absolute;right:0;z-index: 5">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <strong>Notification :</strong> {{ $message }}
        </div>
      @endif 
{{-- <div class="content-wrapper"> --}}
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Activité de {{ $activity->username . ' ' . $activity->lastname }} du {{  ucfirst(\Carbon\Carbon::parse($activity->created_at)->locale('fr_FR')->isoFormat('ddd  DD, MM YYYY')) }} 
    </h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Accueil</a></li>
      <li><a href="#">Historiques des activités </a></li>
      <li class="active">liste</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- SELECT2 EXAMPLE -->

    <!-- /.box -->

    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title"><strong>Activités</strong></h3>
        <!-- START ACCORDION & CAROUSEL-->
        @if($table === 'sites')
        <div class="row">
          <div class="col-md-12">
            <div class="box box-solid">
              <!-- form start -->
              <!-- /.box-header -->
              <div class="box-body">
                <div class="box-group" id="accordion" style="position: relative;">
                  <div class="box-header" style="position: absolute; z-index: 1;">
                    
                   
                  </div>
                  <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                  <table id="datatable_vac" class="table table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <tbody>
                      <tr>
                         <th>Date</th>
                         <td>{{ ucfirst(\Carbon\Carbon::parse($activity->created_at)->locale('fr_FR')->isoFormat('ddd  DD, MM YYYY')) }}</td>
                      </tr>
                      <tr>
                        <th>Utilisateurs</th>
                        <td>{{ $activity->username . ' ' . $activity->lastname }}</td>
                     </tr>
                     <tr>
                        <th>Adresse ip</th>
                        <td>{{ $activity->ip }}</td>
                     </tr>
                     <tr>
                        <th>Ville</th>
                        <td>{{ $activity->ville }}</td>
                     </tr>
                     <tr>
                        <th>region</th>
                        <td>{{ $activity->region }}</td>
                     </tr>
                     <tr>
                        <th>pays</th>
                        <td>{{ $activity->pays }}</td>
                     </tr>
                     <tr>
                        <th>Action</th>
                        <td>{{ $activity->subject }}</td>
                     </tr>
                     <tr>
                        <th>Nom du site</th>
                        <td>{{ $activity->sitesnom }}</td>
                     </tr>
                     <tr>
                        <th>Adresse du site</th>
                        <td>{{ $activity->sitesadresse }}</td>
                     </tr>
                     <tr>
                        <th>Ville du site</th>
                        <td>{{ $activity->sitesville }}</td>
                     </tr>
                     <tr>
                        <th>Contact du site</th>
                        <td>{{ $activity->sitestelephone }}</td>
                     </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
        </div>
        @elseif($table === 'agents') 
        <div class="row">
            <div class="col-md-12">
              <div class="box box-solid">
                <!-- form start -->
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="box-group" id="accordion" style="position: relative;">
                    <div class="box-header" style="position: absolute; z-index: 1;">
                      
                     
                    </div>
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <table id="datatable_vac" class="table table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <tbody>
                        <tr>
                           <th>Date</th>
                           <td>{{ ucfirst(\Carbon\Carbon::parse($activity->created_at)->locale('fr_FR')->isoFormat('ddd  DD, MM YYYY')) }}</td>
                        </tr>
                        <tr>
                          <th>Utilisateurs</th>
                          <td>{{ $activity->username . ' ' . $activity->lastname }}</td>
                       </tr>
                       <tr>
                          <th>Adresse ip</th>
                          <td>{{ $activity->ip }}</td>
                       </tr>
                       <tr>
                          <th>Ville</th>
                          <td>{{ $activity->ville }}</td>
                       </tr>
                       <tr>
                          <th>region</th>
                          <td>{{ $activity->region }}</td>
                       </tr>
                       <tr>
                          <th>pays</th>
                          <td>{{ $activity->pays }}</td>
                       </tr>
                       <tr>
                          <th>Action</th>
                          <td>{{ $activity->subject }}</td>
                       </tr>
                       <tr>
                          <th>Nom de l'agent</th>
                          <td>{{ $activity->nom . ' ' . $activity->prenoms }}</td>
                       </tr>
                       <tr>
                        <th>Date d'entré</th>
                        <td>{{ ucfirst(\Carbon\Carbon::parse($activity->dateentree)->locale('fr_FR')->isoFormat('ddd  DD, MM YYYY'))  }}</td>
                     </tr> 
                        <tr>
                            <th>Type de contrat de contrat</th>
                            <td>{{ $activity->typecontrat }}</td>
                        </tr> 
                     
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
          </div>
        @elseif($table === 'plannings')
        <div class="row">
            <div class="col-md-12">
              <div class="box box-solid">
                <!-- form start -->
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="box-group" id="accordion" style="position: relative;">
                    <div class="box-header" style="position: absolute; z-index: 1;">
                      
                     
                    </div>
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <table id="datatable_vac" class="table table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <tbody>
                        <tr>
                           <th>Date</th>
                           <td>{{ ucfirst(\Carbon\Carbon::parse($activity->created_at)->locale('fr_FR')->isoFormat('ddd  DD, MM YYYY')) }}</td>
                        </tr>
                        <tr>
                          <th>Utilisateurs</th>
                          <td>{{ $activity->username . ' ' . $activity->lastname }}</td>
                       </tr>
                       <tr>
                          <th>Adresse ip</th>
                          <td>{{ $activity->ip }}</td>
                       </tr>
                       <tr>
                          <th>Ville</th>
                          <td>{{ $activity->ville }}</td>
                       </tr>
                       <tr>
                          <th>region</th>
                          <td>{{ $activity->region }}</td>
                       </tr>
                       <tr>
                          <th>pays</th>
                          <td>{{ $activity->pays }}</td>
                       </tr>
                       <tr>
                          <th>Action</th>
                          <td>{{ $activity->subject }}</td>
                       </tr>
                     
                        <hr>
                        <br>
                        <br>
                         <tr>
                            <th>Nom et prenoms</th>
                            <th>Nom du site</th>
                            <th>Heure de debut </th>
                            <th>Heure de fin </th>
                            <th>pause  </th>
                            <th>Heure totale jour </th>
                            <th>Heure totale nuit </th>
                         </tr>
                        @foreach ($vacations as $planning) 
                        <tr>
                            <th>{{ $planning->nom . ' ' . $planning->prenoms }}</th>
                            <th>{{$planning->sitenom }}</th>
                            <th>{{ $planning->heure_debut}} </th>
                            <th>{{ $planning->heure_fin}} </th>
                            <th>{{ $planning->pause}} </th>
                            <th>{{ $planning->heure_total_jour}} </th>
                            <th>{{ $planning->heure_total_nuit}} </th>
                         </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
          </div>
        @elseif($table == 'conges')  
        <div class="row">
     
            <div class="col-md-12">
              <div class="box box-solid">
                <!-- form start -->
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="box-group" id="accordion" style="position: relative;">
                    <div class="box-header" style="position: absolute; z-index: 1;">
                      
                     
                    </div>
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <table id="datatable_vac" class="table table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <tbody>
                        <tr>
                           <th>Date</th>
                           <td>{{ ucfirst(\Carbon\Carbon::parse($activity->created_at)->locale('fr_FR')->isoFormat('ddd  DD, MM YYYY')) }}</td>
                        </tr>
                        <tr>
                          <th>Utilisateurs</th>
                          <td>{{ $activity->username . ' ' . $activity->lastname }}</td>
                       </tr>
                       <tr>
                          <th>Adresse ip</th>
                          <td>{{ $activity->ip }}</td>
                       </tr>
                       <tr>
                          <th>Ville</th>
                          <td>{{ $activity->ville }}</td>
                       </tr>
                       <tr>
                          <th>region</th>
                          <td>{{ $activity->region }}</td>
                       </tr>
                       <tr>
                          <th>pays</th>
                          <td>{{ $activity->pays }}</td>
                       </tr>
                       <tr>
                          <th>Action</th>
                          <td>{{ $activity->subject }}</td>
                       </tr>
                       <tr>
                            <th>Nom de l'agent</th>
                            <td>{{ $activity->agentnom . ' ' . $activity->agentsprenom }}</td>
                        </tr>
                        <tr>
                            <th>Début du congé </th>
                            <td>{{ ucfirst(\Carbon\Carbon::parse($activity->date_debut)->locale('fr_FR')->isoFormat('ddd  DD, MM YYYY')) }}</td>
                        </tr>
                        <tr>
                            <th>Fin du congé </th>
                            <td>{{ ucfirst(\Carbon\Carbon::parse($activity->date_fin)->locale('fr_FR')->isoFormat('ddd  DD, MM YYYY')) }}</td>
                        </tr>
                        <tr>
                            <th>Motif du congé </th>
                            <td>{{ ucfirst($activity->motif) }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
          </div>
        @endif
        <!-- /.row -->
      </div>
    </div>
  </section>
  <!-- /.content -->
{{-- </div> --}}
<!-- /.content-wrapper -->
@endsection

@section('script')

    <script src="{{asset('')}}bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="{{asset('')}}plugins/input-mask/jquery.inputmask.js"></script>
    <script src="{{asset('')}}plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="{{asset('')}}plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <script src="{{asset('')}}bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="{{asset('')}}plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="{{asset('')}}plugins/iCheck/icheck.min.js"></script>

@endsection