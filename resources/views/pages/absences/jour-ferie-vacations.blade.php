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
            background-color: #3C8DBC !important;
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
    <!-- Content Wrapper. Contains page content -->
    {{-- <div class="content-wrapper"> --}}
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Jours fériés
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Accueil</a></li>
            <li><a href="#">Gerer les agents</a></li>
            <li class="active">Liste des agents</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- SELECT2 EXAMPLE -->
        <!-- /.box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Liste des vacations pour les jours fériés du mois</strong></h3>
                <!-- START ACCORDION & CAROUSEL-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-solid">
                            <!-- form start -->
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="box-group" id="accordion" style="position: relative;">
                                    <div class="box-header" style="position: absolute; z-index: 1;">
{{--                                        <div class="box-tools pull-left" style="margin-right: 15px">--}}
{{--                                            <div class="input-group input-group-sm hidden-xs" style="width: 30px;">--}}
{{--                                                <a class="btn btn-sm btn-social btn-vk generer-pdfIndiv" href="" target="_blank" style="background-color: #C72121;">--}}
{{--                                                    <i class="fa fa-file-pdf-o BTN-VK"></i> Générer PDF--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="box-tools pull-left" style="margin-right: 15px">--}}
{{--                                            <div class="input-group input-group-sm hidden-xs" style="width: 30px;">--}}
{{--                                                <a class="btn btn-sm btn-social btn-vk generer-excelIndiv" href="" target="_blank" style="background-color: #0B7728;">--}}
{{--                                                    <i class="fa fa-file-excel-o BTN-VK"></i> Générer EXCEL--}}
{{--                                                </a>--}}
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
                                            <th>Heures de Jours</th>
                                            <th>Heures de Nuits</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($plannings as $planning)
                                            @php
                                                $heures_total_hours = $planning->heure_total_jour + intval(($planning->minutes_jour / 60));
                                                $minutes_jours =  intval($planning->minutes_jour / 60)  > 0  ? (int)$planning->minutes_jour % 60 : (int)$planning->minutes_jour ;
                                                $heure_total_nuit = $planning->heure_total_nuit + intval(($planning->minutes_nuit / 60));
                                                $minutes_nuit =  intval($planning->minutes_nuit/ 60 ) > 0 ? (int)$planning->minutes_nuit % 60 : (int)$planning->minutes_nuit ;
                                            @endphp
                                            <tr>
                                                <td><a href="{{ route('gestionsite.show', $planning->id) }}">{{ $planning->nom }}</a></td>
                                                <td>{{ ucfirst(\Carbon\Carbon::parse($planning->date_debut)->locale('fr_FR')->isoFormat('ddd  DD, MM YYYY')) }}</td>
                                                <td>{{ \Carbon\Carbon::parse($planning->heure_debut)->Format('H:i') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($planning->heure_fin)->Format('H:i') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($planning->pause)->Format('H:i') }}</td>
                                                <td>{{ \App\Helpers\BlackshFonctions::format($heures_total_hours.':'.$minutes_jours .':00') }}</td>
                                                <td>{{ \App\Helpers\BlackshFonctions::format($heure_total_nuit. ':'.$minutes_nuit.':00')}}</td>
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