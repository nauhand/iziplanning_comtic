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

    @if ($message = Session::get('successvacation'))
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

    @if ($message = Session::get('successdelete'))
        <div class="alert alert-success alert-dismissible show" id="notification" role="alert" style="position:absolute;right:0;z-index: 5">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Notification :</strong> {{ $message }}
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-success alert-dismissible show" id="notification" role="alert" style="position:absolute;right:0;z-index: 5">
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
                <h3 class="box-title"><strong>Plannings définitifs</strong></h3>
                <!-- START ACCORDION & CAROUSEL-->

                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-solid">
                            @php

                                $totale_h = $total[0]->heures_total + intval(($total[0]->minutes / 60));
                                $total_m =  intval($total[0]->minutes / 60)  > 0  ? (int)$total[0]->minutes % 60 : (int)$total[0]->minutes ;
                            @endphp

                            <p class="text-center" style="font-size: 20px;">Total des heures :  <strong>{{ \App\Helpers\BlackshFonctions::format($totale_h.':'.$total_m.':00') }}</strong><b></b></p>

                            <!-- form start -->
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="box-tools pull-right" style="padding-bottom: 15px;">
                                    <form id="form-search" action="#" method="post" style="display:flex;" >
                                        @csrf
                                        <input type="search" name="from_agent" id="from_agent" class="form-control" placeholder="Recherche par nom" data-toggle="tooltip" data-placement="top" title="Recherche par nom" style="font-size:14px; margin-right:5px; border: 1px solid black; width: 250px;">

                                        <datalist id="list_agent_name" class="text-capitalize">
                                        </datalist>

                                        <input type="hidden" id="generer_agent_name">
                                        <input type="hidden" id="generer_agent_name_text">


                                        <select class="form-control selectpicker" name="mois" id="mois" placeholder="Recherche par nom mois" data-toggle="tooltip" data-placement="top" title="Recherche par mois">
                                            <option value="" selected>Trier par mois</option>
                                            @php
                                                $count = 13 - Carbon\Carbon::now()->month;
                                            @endphp
                                            @for ($i = 0; $i < $count; $i++)
                                                <option value="{{Carbon\Carbon::now()->addMonth($i)}}">{{Carbon\Carbon::now()->addMonth($i)->monthName}}</option>
                                            @endfor
                                        </select>


                                    </form>
                                </div>
                                <div class="box-group" id="accordion">
                                    <div class="box-header" style="position: inherit;">

                                        <div class="box-tools pull-left" style="margin-right: 15px">
                                            <div class="input-group input-group-sm hidden-xs" style="width: 30px;">
                                                <a class="btn btn-sm btn-social btn-vk generer-pdfIndiv" href="{{ route('planning.provisoire.pdf', ['type' => 'definitif']) }}" target="_blank" style="background-color: #c72121;">
                                                    <i class="fa fa-file-pdf-o BTN-VK"></i> Générer PDF
                                                </a>
                                            </div>
                                        </div>

                                        <div class="box-tools pull-left" style="margin-right: 15px">
                                            <div class="input-group input-group-sm hidden-xs" style="width: 30px;">
                                                <a class="btn btn-sm btn-social btn-vk generer-excelIndiv" href="{{ route('planning.provisoire.excel', ['type' => 'definitif']) }}" target="_blank" style="background-color: #0b7728;">
                                                    <i class="fa fa-file-excel-o BTN-VK"></i> Générer EXCEL
                                                </a>
                                            </div>
                                        </div>
                                        <div class="box-tools pull-left" style="margin-right: 15px">
                                            <div class="input-group input-group-sm hidden-xs" style="width: 30px;">
                                                <form class="valider_tout_planning" action="{{route('definitif.crea')}}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('put')
                                                    <button type="submit" style=":display: inline; margin-left: 3px;" class="btn btn-sm btn-social btn-vk generer-excelIndiv" data-toggle="tooltip" data-placement="top" target="_blank" style="background-color: #33b7b1;"><i class="glyphicon glyphicon-bookmark BTN-VK"></i> Archiver tous les plannings</button>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                    <table id="datatable_prov" class="table table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>Créé le</th>
                                            <th>Nom</th>
                                            <th>Prénoms </th>
                                            <th>Total des heures jour</th>
                                            <th>Total des heures nuit</th>
                                            <th>Total des Heures</th>
                                            <th>Statut</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        {{--  --}}
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
        $(document).ready(function() {

            load_data();

            function load_data(from_agent = '', mois = '')
            {
                var table = $('#datatable_prov').DataTable({
                    select :true,
                    lengthChange: false,
                    "ordering": false,
                    "bFilter" : false,
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
                        "sSearch":         "Rechercher :",
                        "sZeroRecords":    "Aucun élément correspondant trouvé",
                        "oPaginate": {
                            "sFirst":    "Premier",
                            "sLast":     "Dernier",
                            "sNext":     "Suivant",
                            "sPrevious": "Précédent"
                        },
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
                    "processing": true,
                    "serverSide": true,
                    "ajax":{
                        url:'{{ route("definitif.getdata") }}',
                        data:{from_agent:from_agent, mois:mois}
                    },
                    "columns":[
                        { data: "created_at" },
                        { data: "nom" },
                        { data: "prenoms"},
                        { data: "heure_total_jour" },
                        { data: "heure_total_nuit" },
                        { data: "heures_total" },
                        { data: "statut" },
                        { data: "action", name: "action", orderable: false, searchable: false}

                    ]
                });
            }

            $('#from_agent').change(function(){
                var from_agent = $('#from_agent').val();
                var mois = $('#mois').val();

                if(from_agent != '' && mois == ''){
                    $('#datatable_prov').DataTable().destroy();
                    load_data(from_agent, mois);
                }else if (from_agent != '' && mois != '') {
                    $('#datatable_prov').DataTable().destroy();
                    load_data(from_agent, mois);
                }else{
                    $('#datatable_prov').DataTable().destroy();
                    load_data();
                }
            });

            $('#mois').change(function(){
                var from_agent = $('#from_agent').val();
                var mois = $('#mois').val();

                if(from_agent == '' && mois != ''){
                    $('#datatable_prov').DataTable().destroy();
                    load_data(from_agent, mois);
                }else if (from_agent != '' && mois != '') {
                    $('#datatable_prov').DataTable().destroy();
                    load_data(from_agent, mois);
                }else{
                    $('#datatable_prov').DataTable().destroy();
                    load_data();
                }
            });


        } );
    </script>
    <script>
        $(document).ready(function() {
            $('select').selectpicker();
        });
    </script>

@endsection