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

    </style>
@endsection

@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible show" id="notification" role="alert" style="position:absolute;right:0;z-index: 5">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Notification :</strong> {{ $message }}
        </div>
    @endif

    @if ($message = Session::get('successstore'))
        <div class="alert alert-success alert-dismissible show" id="notification" role="alert" style="position:absolute;right:0;z-index: 5">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Notification :</strong> {{ $message }}
        </div>
    @endif

    @if ($message = Session::get('success1'))
        <div class="alert alert-success alert-dismissible show" id="notification" role="alert" style="position:absolute;right:0;z-index: 5">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Notification :</strong> {{ $message }}
        </div>
    @endif

    @if ($message = Session::get('successupdate'))
        <div class="alert alert-success alert-dismissible show" id="notification" role="alert" style="position:absolute;right:0;z-index: 5">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Notification :</strong> {{ $message }}
        </div>
    @endif

    @if ($message = Session::get('successdelete'))
        <div class="alert alert-success alert-dismissible show" id="notification" role="alert" style="position:absolute;right:0;z-index: 5">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Notification :</strong> {{ $message }}
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissible show" id="notification" role="alert" style="position:absolute;right:0;z-index: 5">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Notification :</strong> {{ $message }}
        </div>
    @endif

    @if ($message = Session::get('errorstore'))
        <div class="alert alert-danger alert-dismissible show" id="notification" role="alert" style="position:absolute;right:0;z-index: 5">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Notification :</strong> {{ $message }}
        </div>
    @endif


    @if ($message = Session::get('warning'))
        <div class="alert alert-success alert-dismissible show" id="notification" role="alert" style="position:absolute;right:0;z-index: 5">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Notification :</strong> {{ $message }}
        </div>
    @endif
    <!-- Content Wrapper. Contains page content -->
    {{-- <div class="content-wrapper"> --}}
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Liste globale des plannings des agents
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Accueil</a></li>
            <li><a href="#">Gerer les agents</a></li>
            <li class="active">Liste des plannings</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- SELECT2 EXAMPLE -->

        <!-- /.box -->

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Liste des vacations du planning</strong></h3>
                <!-- START ACCORDION & CAROUSEL-->

                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-solid">

                            @php

                                $totale_h = $totale[0]->heures_total + intval(($totale[0]->minutes / 60));
                                $total_m =  intval($totale[0]->minutes / 60)  > 0  ? (int)$totale[0]->minutes % 60 : (int)$totale[0]->minutes ;
                            @endphp

                            <p class="text-center">Planning archivé de l'agent  : <strong>{{ $agent->nom }} {{ $agent->prenoms }}</strong><b></b></p>
                            {{--                            <p class="text-center">Création du planning : <strong>{{ucfirst(\Carbon\Carbon::parse($datecreation[0]->created_at)->locale('fr_FR')->isoFormat('ddd  DD, MM YYYY')) }}</strong><b></b> &nbsp;&nbsp;&nbsp; Dernière modification du planning : <strong>{{ucfirst(\Carbon\Carbon::parse($dateajout[0]->latest)->locale('fr_FR')->isoFormat('ddd  DD, MM YYYY')) }}</strong><b></b></p>--}}
                            <p class="text-center">Heures totale du planning:  <strong>{{ \App\Helpers\BlackshFonctions::format($totale_h.':'.$total_m.':00') }}</strong><b></b></p>
                        {{--                <p class="text-center">Total des heures: <strong>TEST</strong></p>--}}
                        <!-- form start -->
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="box-group" id="accordion" style="position: relative;">
                                    <div class="box-header" style="position: absolute; z-index: 1;">

                                        {{--                      <a href="{{ route('planning.provisoire.vaccation.excel', $p->id)}}" data-toggle="tooltip" data-placement="top" title="Télécharger ce planning" style="border: none; height: 17px;" class="label label-success label-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-file-excel-o BTN-VK"></i> | EXCEL</a>--}}
                                        {{--                      <a href="{{ route('planning.provisoire.vaccation.pdf', $p->id)}}" data-toggle="tooltip" data-placement="top" title="Télécharger ce planning" style="border: none; height: 17px;" class="label label-danger label-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-file-pdf-o BTN-VK"></i> | PDF</a>--}}
                                        {{--                      --}}
                                        <div class="box-tools pull-left" style="margin-right: 15px">
                                            <div class="input-group input-group-sm hidden-xs" style="width: 30px;">
                                                <a class="btn btn-sm btn-social btn-vk generer-pdfIndiv" href="{{ route('planning.archived.vaccation.pdf', $agent->id)}}" target="_blank" style="background-color: #c72121;">
                                                    <i class="fa fa-file-pdf-o BTN-VK"></i> Générer PDF
                                                </a>
                                            </div>
                                        </div>

                                        <div class="box-tools pull-left" style="margin-right: 15px">
                                            <div class="input-group input-group-sm hidden-xs" style="width: 30px;">
                                                <a class="btn btn-sm btn-social btn-vk generer-excelIndiv" href="{{ route('planning.archived.vaccation.excel', $agent->id)}}" target="_blank" style="background-color: #0b7728;">
                                                    <i class="fa fa-file-excel-o BTN-VK"></i> Générer EXCEL
                                                </a>
                                            </div>
                                        </div>
                                        {{--                                        <div class="box-tools pull-left" style="margin-right: 15px">--}}
                                        {{--                                            <div class="input-group input-group-sm hidden-xs" style="width: 30px;">--}}
                                        {{--                                                <form class="valider_tout_planning" action="{{route('vacationprov.crea')}}" method="post" style="display: inline;">--}}
                                        {{--                                                    @csrf--}}
                                        {{--                                                    @method('put')--}}
                                        {{--                                                    <input type="hidden" value="{{ $agent->id }}" name="id_agent">--}}
                                        {{--                                                    <input type="hidden" value="{{ $plannings[0]->vacation_id }}" name="vacation_id">--}}
                                        {{--                                                    <button type="submit" style=":display: inline; margin-left: 3px;" class="btn btn-sm btn-social btn-vk generer-excelIndiv" data-toggle="tooltip" data-placement="top" target="_blank" style="background-color: #33b7b1;"><i class="fa fa-check BTN-VK"></i> Valider toutes les vacations</button>--}}
                                        {{--                                                </form>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <div class="box-tools pull-left" style="margin-right: 15px">--}}
                                        {{--                                            <div class="input-group input-group-sm hidden-xs" style="width: 30px;">--}}
                                        {{--                                                <button type="button" style=":display: inline; margin-left: 3px; background-color: gray" class="btn btn-sm btn-social btn-vk generer-excelIndiv" data-toggle="tooltip" data-placement="top" target="_blank" id="openform"><i class="fa fa-plus BTN-VK"></i> Ajouter une vacation à ce planning</button>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                    </div>
                                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                    <table id="datatable_vac" class="table table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>Site</th>
                                            <th>Date début</th>
                                            <th>Heure début</th>
                                            <th>Heure fin</th>
                                            <th>Heure pause</th>
                                            <th>Heures de Jour</th>
                                            <th>Heures de Nuit</th>
                                            <th>Total des heures</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($plannings as $planning)
                                            @php
                                                $heures_total_hours = $planning->heure_total_jour + intval(($planning->minutes_jour / 60));
                                                $minutes_jours =  intval($planning->minutes_jour / 60)  > 0  ? (int)$planning->minutes_jour % 60 : (int)$planning->minutes_jour ;
                                                $heure_total_nuit = $planning->heure_total_nuit + intval(($planning->minutes_nuit / 60));
                                                $minutes_nuit =  intval($planning->minutes_nuit/ 60 ) > 0 ? (int)$planning->minutes_nuit % 60 : (int)$planning->minutes_nuit ;
                                           
                                                $totale_heures =  $heures_total_hours + $heure_total_nuit + intval( ($minutes_jours + $minutes_nuit) / 60 ) ; 
                                                $minutes_totale =  intval( ($minutes_jours + $minutes_nuit) / 60 ) > 0 ? ($minutes_jours + $minutes_nuit) % 60 :  intval($minutes_jours + $minutes_nuit) ;
                                           @endphp
                                            <tr>
                                                <td> <a href="{{ route('gestionsite.show', $planning->site_id) }}">{{ $planning->site->nom }}</a></td>
                                                <td>{{ ucfirst(\Carbon\Carbon::parse($planning->date_debut)->locale('fr_FR')->isoFormat('ddd  DD, MM YYYY')) }}</td>
                                                <td>{{ \App\Helpers\BlackshFonctions::format(\Carbon\Carbon::parse($planning->heure_debut)->Format('H:i').':00') }}</td>
                                                <td>{{ \App\Helpers\BlackshFonctions::format(\Carbon\Carbon::parse($planning->heure_fin)->Format('H:i').':00') }}</td>
                                                <td>{{ \App\Helpers\BlackshFonctions::format(\Carbon\Carbon::parse($planning->pause)->Format('H:i').':00') }}</td>
                                                <td>{{ \App\Helpers\BlackshFonctions::format($heures_total_hours.':'.$minutes_jours .':00') }}</td>
                                                <td>{{ \App\Helpers\BlackshFonctions::format($heure_total_nuit. ':'.$minutes_nuit.':00')}}</td>
                                                <td>{{ \App\Helpers\BlackshFonctions::format($totale_heures. ':'.$minutes_totale.':00')}}</td>
                                                <td>
                                                    <button class="label label-primary label-sm" data-begin="{{$planning->heure_debut}}" data-end="{{$planning->heure_fin}}" data-datedeb="{{$planning->date_debut}}" data-pause="{{$planning->pause}}" data-planid="{{$planning->id}}" data-toggle="modal" data-target="#edit" style="border: none; height: 17px;"><i class="fa fa-pencil"></i></button>

{{--                                                    <form class="valider_un_planning" action="{{route('vacationprov.update',$planning->id)}}" method="post" style="display: inline;">--}}
{{--                                                        @csrf--}}
{{--                                                        @method('put')--}}
{{--                                                        <button type="submit" style="border: none; height: 17px;" class="label label-success label-sm" data-toggle="tooltip" data-placement="top" target="_blank"><i class="fa fa-check"></i></button>--}}
{{--                                                    </form>--}}

                                                    <form class="supprimer_un_planning" action="{{route('vacationprov.destroy',$planning->id)}}" method="post" style="display: inline;">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" onclick="return confirm('Voulez vous vraiment supprimer ce planning ?');" style="border: none; height: 17px;" class="label label-danger label-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
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

    <!-- Modal -->
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #B6D3B1; color: black;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="myModalLabel"><strong>Modification d'une vacation</strong></h4>
                </div>
                <form action="{{ route('gestionsite.update', 'test') }}" method="post">
                    {{method_field('patch')}}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <input type="hidden" name="planning_id" id="plan_id" value="">
                        <div class="form-group">
                            <label for="sitename">Site : </label>
                            <select class="form-control selectpicker" name="sitename" id="sitename">
                                @foreach($sites as $site)
                                    <option value="{{$site->id}}">{{$site->nom}}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="datedebut">Date début : </label>
                        <div class="input-group date" style="width: 100%;">
                            <input type="date" class="form-control" name="datedebut" id="datedebut">
                        </div>
                        <div class="form-group">
                            <label for="heuredebut">Heure début : </label>
                            <input type="time" class="form-control" name="heuredebut" id="heuredebut">
                        </div>
                        <div class="form-group">
                            <label for="heurefin">Heure Fin : </label>
                            <input type="time" class="form-control" name="heurefin" id="heurefin">
                        </div>
                        <div class="form-group">
                            <label for="heurepause">Heure Pause : </label>
                            <input type="time" class="form-control" name="heurepause" id="heurepause">
                        </div>
                    </div>
                    <div class="modal-footer" style="background-color: #B6D3B1; color: black;">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Fermer</button>
                        <button type="submit" onclick="return confirm('Avez-vous vérifié vos modifications ?');" class="btn btn-success"><i class="glyphicon glyphicon-check"></i> Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="store" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #B6D3B1; color: black;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="myModalLabel1"><strong>Ajouter une vacation</strong></h4>
                </div>
                <form action="{{ route('actionprovisoire.store') }}" method="post" id="addv">
                    {{method_field('post')}}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <input type="hidden" name="planning_id" id="plan_id" value="">
                        <div class="form-group">
                            <label for="sitename">Nom de l'agent : </label>
                            <input type="text" class="form-control @error('nomagent') is-invalid @enderror" name="" id="" readonly="readonly" value="{{ $agent->nom }} {{ $agent->prenoms }}" style="cursor: default;">

                            @error('nomagent')
                            <span class="invalid-feedback" role="alert" style="color: red;">
                   <i class="glyphicon glyphicon-remove-sign"></i> <strong>{{ $message }}</strong>
                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="sitename">Site : </label>
                            <select class="form-control select2 @error('sitename') is-invalid @enderror" name="sitename" id="sitename" style="width: 100%;">
                                <option value="" selected="selected" disabled="">Choisir un site</option>
                                @foreach($sites as $site)
                                    <option value="{{$site->id}}">{{$site->nom}}</option>
                                @endforeach
                            </select>

                            @error('sitename')
                            <span class="invalid-feedback" role="alert" style="color: red;">
                    <i class="glyphicon glyphicon-remove-sign"></i> <strong>{{ $message }}</strong>
                </span>
                            @enderror
                        </div>
                        <label for="datedebut">Date début : </label>
                        <div class="input-group date" style="width: 100%;">
                            <input type="date" class="form-control @error('datedebut') is-invalid @enderror" name="datedebut" id="datedebut">

                            @error('datedebut')
                            <span class="invalid-feedback" role="alert" style="color: red;">
                      <i class="glyphicon glyphicon-remove-sign"></i> <strong>{{ $message }}</strong>
                  </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="heuredebut">Heure début : </label>
                            <input type="time" class="form-control @error('heuredebut') is-invalid @enderror" name="heuredebut" id="heuredebut">

                            @error('heuredebut')
                            <span class="invalid-feedback" role="alert" style="color: red;">
                    <i class="glyphicon glyphicon-remove-sign"></i> <strong>{{ $message }}</strong>
                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="heurefin">Heure Fin : </label>
                            <input type="time" class="form-control @error('heurefin') is-invalid @enderror" name="heurefin" id="heurefin">

                            @error('heurefin')
                            <span class="invalid-feedback" role="alert" style="color: red;">
                    <i class="glyphicon glyphicon-remove-sign"></i> <strong>{{ $message }}</strong>
                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="heurepause">Heure Pause : </label>
                            <input type="time" class="form-control @error('heurepause') is-invalid @enderror" name="heurepause" id="heurepause">

                            @error('heurepause')
                            <span class="invalid-feedback" role="alert" style="color: red;">
                    <i class="glyphicon glyphicon-remove-sign"></i> <strong>{{ $message }}</strong>
                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer" style="background-color: #B6D3B1; color: black;">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Fermer</button>
                        <input type="hidden" value="{{ $agent->id }}" name="agentid">
                        <input type="hidden" value="{{ $plannings[0]->vacation_id }}" name="vacationid">
                        {{--                        <button type="submit" onclick="return confirm('Avez-vous vérifié vos modifications ?');" class="btn btn-success"><i class="glyphicon glyphicon-check"></i> Ajouter</button>--}}
                        <button type="submit"  class="btn btn-success"><i class="glyphicon glyphicon-check"></i> Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
            $('#datatable_vac').DataTable({
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
                    "searchPlaceholder": "Rechercher par site",
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

    <script>
        $(document).ready(function() {
            $('select').selectpicker();
        });
    </script>

    <script>
        $('#edit').on('show.bs.modal', function (event) {
            // on recupere les informations qu'on a stocké dans le button
            var button = $(event.relatedTarget)
            var begin = button.data('begin')
            var end = button.data('end')
            var datedeb = button.data('datedeb')
            var pause = button.data('pause')
            var planid = button.data('planid')
            var modal = $(this)
            // on affiches les informations récupérés dans la vue
            modal.find('.modal-body #datedebut').val(datedeb);
            modal.find('.modal-body #heuredebut').val(begin);
            modal.find('.modal-body #heurefin').val(end);
            modal.find('.modal-body #heurepause').val(pause);
            modal.find('.modal-body #plan_id').val(planid);

            console.log(planid);
        })

        $('#openform').on('click', function() {
            $('#store').modal('show');
        });

    </script>
@endsection