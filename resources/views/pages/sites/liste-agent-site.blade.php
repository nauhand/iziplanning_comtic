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

        .select2-container--default .select2-selection--single{
            height: 30px !important;
        }

        .box-header {
            text-align: center ;
            padding: 15px;
        }
    </style>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    {{-- <div class="content-wrapper"> --}}
    <!-- Content Header (Page header) -->
    @if ($message = Session::get('info'))
        <div class="alert alert-warning alert-dismissible show" id="notification" role="alert" style="position:absolute;right:0;z-index: 5">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Notification :</strong> {{ $message }}
        </div>
    @endif
    <section class="content-header">
        <h1>
            Liste globale des plannings des agents
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Accueil</a></li>
            <li><a href="#">Sites de déploiements </a></li>
            <li class="active">Plannings du site {{ $site->nom }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- SELECT2 EXAMPLE -->

        <!-- /.box -->

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-top: 20px;">Liste des agents affectés au site : <strong>{{ $site->nom }}</strong> pour le mois de : <strong>{{ Carbon\Carbon::now()->monthName }} {{ Carbon\Carbon::now()->year }}</strong></h3>
                <!-- START ACCORDION & CAROUSEL-->
                @php


                    $heures_total_hours = $datahours[0]->heure_total_jour + intval(($datahours[0]->minutes_jour / 60));
                    $minutes_jours =  intval($datahours[0]->minutes_jour / 60)  > 0  ? (int)$datahours[0]->minutes_jour % 60 : (int)$datahours[0]->minutes_jour ;

                    $heure_total_nuit = $datahours[0]->heure_total_nuit + intval(($datahours[0]->minutes_nuit / 60));
                    $minutes_nuit =  intval($datahours[0]->minutes_nuit/ 60 ) > 0 ? (int)$datahours[0]->minutes_nuit % 60 : (int)$datahours[0]->minutes_nuit ;


                    $total = $heures_total_hours + $heure_total_nuit +  (intval( ($minutes_jours + $minutes_nuit) / 60)) ;
                    $minutes = intval( ($minutes_jours + $minutes_nuit)/ 60 ) > 0 ? ((int)($minutes_jours + $minutes_nuit) % 60 ) : (int)($minutes_jours + $minutes_nuit) ;
                  

                @endphp

                @php
                    // $totalf = $planningsferies[0]->heures_total ;
                    // $minutesf = $planningsferies[0]->minutes;
                    // $totalf = $totalf + (int)($minutesf / 60) ;
                    // $minutesf = (int)($minutesf % 60) ;
                    // $heures_total_hoursf = $planningsferies[0]->heure_total_jour + intval(($planningsferies[0]->minutes_jour / 60));
                    // $minutes_joursf =  intval($planningsferies[0]->minutes_jour / 60)  > 0  ? (int)$planningsferies[0]->minutes_jour % 60 : (int)$planningsferies[0]->minutes_jour ;
                    // $heure_total_nuitf = $planningsferies[0]->heure_total_nuit + intval(($planningsferies[0]->minutes_nuit / 60));
                    // $minutes_nuitf =  intval($planningsferies[0]->minutes_nuit/ 60 ) > 0 ? (int)$planningsferies[0]->minutes_nuit % 60 : (int)$planningsferies[0]->minutes_nuit ;
               
                    $totale_f = $planningsferies[0]->heure_total_jour +  $planningsferies[0]->heure_total_nuit  + intval(($planningsferies[0]->minutes_jour / 60)) + intval(($planningsferies[0]->minutes_nuit / 60)) ;
                    $minutes_f =  intval( ($planningsferies[0]->minutes_nuit +$planningsferies[0]->minutes_nuit)/ 60 ) > 0 ? ($planningsferies[0]->minutes_nuit +$planningsferies[0]->minutes_nuit)% 60 :   ($planningsferies[0]->minutes_nuit +$planningsferies[0]->minutes_nuit) ;
                                           
               @endphp
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-solid">
                            <p class="text-center" style="margin-top: 25px;">Total Heures Jour  : <span class="badge badge-primary" style="background-color: #176ad2;border-radius: 5px;">
                                    {{ \App\Helpers\BlackshFonctions::format($heures_total_hours.':'.$minutes_jours.':00') }}</span>
                                <b></b>&nbsp;&nbsp;&nbsp; Total Heures Nuit : <span class="badge badge-primary" style="background-color: #176ad2;border-radius: 5px;">{{ \App\Helpers\BlackshFonctions::format($heure_total_nuit.':'.$minutes_nuit.':00' )}}</span><b></b>&nbsp;&nbsp;&nbsp; Total Heures fériées : <strong> <span class="badge badge-primary" style="background-color: #176ad2;border-radius: 5px;">{{ \App\Helpers\BlackshFonctions::format($totale_f.':'.$minutes_f.':00' )}}</span><b></b></strong> 
                                <b></b> Total des Heures  : <strong> <span class="badge badge-primary" style="background-color: #176ad2;border-radius: 5px;">{{ \App\Helpers\BlackshFonctions::format($total.':'.$minutes.':00' )}}</span><b></b></strong>
                            </p>
                            <!-- form start -->
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="box-group" id="accordion" style="position: relative;">
                                    <div class="box-header" style="position: absolute; z-index: 1;">

                                        <div class="box-tools pull-left" style="margin-right: 15px">
                                            <div class="input-group input-group-sm hidden-xs" style="width: 30px;">
                                                <a class="btn btn-sm btn-social btn-vk generer-pdfIndiv" href="{{ route('agents.pdf.test',['id' => $id ]) }}" target="_blank" style="background-color: #c72121;">
                                                    <i class="fa fa-file-pdf-o BTN-VK"></i> Générer PDF
                                                </a>
                                            </div>
                                        </div>

                                        {{--                      <div class="box-tools pull-left" style="margin-right: 15px">--}}
                                        {{--                          <div class="input-group input-group-sm hidden-xs" style="width: 30px;">--}}
                                        {{--                          <a class="btn btn-sm btn-social btn-vk generer-excelIndiv" href="" target="_blank" style="background-color: #0b7728;">--}}
                                        {{--                              <i class="fa fa-file-excel-o BTN-VK"></i> Générer EXCEL--}}
                                        {{--                          </a>--}}
                                        {{--                          </div>--}}
                                        {{--                      </div>--}}
                                    </div>
                                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                    <table id="datatable" class="table table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>Nom & Prénoms</th>
                                            <th>Date début</th>
                                            <th>Heure début</th>
                                            <th>Heure fin</th>
                                            <th>Pause</th>
                                            <th>Heures de jour</th>
                                            <th>Heures de nuit</th>
                                            <th>Total des heures</th>
                                            {{-- <th></th> --}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($planningSite as $planning)
                                            @php
                                                $heures_total_hours = $planning->heure_total_jour + intval(($planning->minutes_jour / 60));
                                                $minutes_jours =  intval($planning->minutes_jour / 60)  > 0  ? (int)$planning->minutes_jour % 60 : (int)$planning->minutes_jour ;
                                                $heure_total_nuit = $planning->heure_total_nuit + intval(($planning->minutes_nuit / 60));
                                                $minutes_nuit =  intval($planning->minutes_nuit/ 60 ) > 0 ? (int)$planning->minutes_nuit % 60 : (int)$planning->minutes_nuit ;
                                                $totale = $planning->heure_total_jour +  $planning->heure_total_nuit  + intval(($planning->minutes_jour / 60)) + intval(($planning->minutes_nuit / 60)) ;
                                                $minutes =  intval( ($planning->minutes_nuit +$planning->minutes_nuit)/ 60 ) > 0 ? ($planning->minutes_nuit +$planning->minutes_nuit)% 60 :   ($planning->minutes_nuit +$planning->minutes_nuit) ;
                                            @endphp
                                            <tr>
                                                <td><a href="{{route('provisoire.show',$planning->agent->id)}}">{{ $planning->agent->nom }} {{ $planning->agent->prenoms}}</a></td>
                                                <td>{{ ucfirst(\Carbon\Carbon::parse($planning->date_debut)->locale('fr_FR')->isoFormat('ddd  DD, MM YYYY')) }}</td>
                                                {{--                          <td>{{ ucfirst(\Carbon\Carbon::parse($planning->date_debut)->locale('fr_FR')->isoFormat('ddd  DD, MM YYYY')) }}</td>--}}
                                                <td>{{ \Carbon\Carbon::parse($planning->heure_debut)->Format('H:i') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($planning->heure_fin)->Format('H:i') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($planning->pause)->Format('H:i') }}</td>
                                                <td>{{ \App\Helpers\BlackshFonctions::format($heures_total_hours.':'.$minutes_jours .':00') }}</td>
                                                <td>{{ \App\Helpers\BlackshFonctions::format($heure_total_nuit. ':'.$minutes_nuit.':00')}}</td>
                                                <td>{{ \App\Helpers\BlackshFonctions::format($totale. ':'.$minutes.':00')}}</td>
                                                {{--<td>
                                                 // action //
                                                </td> --}}


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
                <!-- /.row -->
            </div>
        </div>
    </section>
    <!-- /.content -->
    {{-- </div> --}}
    <!-- /.content-wrapper -->
@endsection

@section('script')
    <!-- jQuery 3 -->
    <!-- Select2 -->
    <script src="{{asset('')}}bower_components/select2/dist/js/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="{{asset('')}}plugins/input-mask/jquery.inputmask.js"></script>
    <script src="{{asset('')}}plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="{{asset('')}}plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- bootstrap color picker -->
    <script src="{{asset('')}}bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <!-- bootstrap time picker -->
    <script src="{{asset('')}}plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{asset('')}}plugins/iCheck/icheck.min.js"></script>

    <script>
        $(document).ready( function () {
            $('#datatable').DataTable({
                select :true,
                lengthChange: false,
                "ordering": false,
                "language": {

                    "sEmptyTable":     "Aucune donnée disponible dans le tableau",
                    "sInfo":           "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
                    "sInfoEmpty":      "Affichage de l'élément 0 à 0 sur 0 élément",
                    "sInfoFiltered":   "(filtré à partir de _MAX_ éléments au total)",
                    "sInfoPostFix":    "",
                    "sInfoThousands":  ",",
                    "sLengthMenu":     "Afficher _MENU_ éléments",
                    "sLoadingRecords": "Chargement...",
                    "sProcessing":     "Traitement...",
                    "sSearch":         " ",
                    "sZeroRecords":    "Aucun élément correspondant trouvé",
                    "oPaginate": {
                        "sFirst":    "Premier",
                        "sLast":     "Dernier",
                        "sNext":     "Suivant",
                        "sPrevious": "Précédent"
                    },
                    "searchPlaceholder": "Rechercher agents ...",
                    "oAria": {
                        "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                        "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
                    },
                    "select": {
                        "rows": {
                            "_": "%d lignes sélectionnées",
                            "0": "Aucune ligne sélectionnée",
                            "1": "1 ligne sélectionnée"
                        }
                    }

                },
            });
        } );
    </script>
@endsection