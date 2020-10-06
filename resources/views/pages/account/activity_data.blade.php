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




    <!-- Content Wrapper. Contains page content -->
    {{-- <div class="content-wrapper"> --}}
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Activité des utilisateurs de la plateforme Black-shield securité
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Accueil</a></li>
            <li><a href="#">Gestions des comptes  </a></li>
            <li class="active">Historiques</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- SELECT2 EXAMPLE -->

        <!-- /.box -->

        <div class="box box-primary">
            <div class="box-header with-border">
{{--                <h3 class="box-title"><strong>Plannings définitifs</strong></h3>--}}
                <!-- START ACCORDION & CAROUSEL-->

                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-solid">
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


                                        <div class="select-bootstrap" style="margin-left: 10px;margin-right: 14px;">
                                            <select class="form-control selectpicker" name="mois" id="mois" placeholder="Recherche par nom mois" data-toggle="tooltip" data-placement="top" title="Recherche par mois">
                                                <option value="" selected>Trier par mois</option>
                                                @for ($i = 0; $i < 12; $i++)
                                                    <option value="{{Carbon\Carbon::now()->firstOfYear()->addMonth($i)}}">{{Carbon\Carbon::now()->firstOfYear()->addMonth($i)->monthName}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="select-annee-bootstrap">
                                            <select name="annee" class="form-control" style="font-size:14px"  id="annee" placeholder="Recherche par annee" data-toggle="tooltip" data-placement="top" title="Recherche par annee">
                                                <option value="" selected>Trier par année</option>
                                                <option value="20{{Carbon\Carbon::now()->format('y')}}">20{{Carbon\Carbon::now()->format('y')}}</option>
                                                @for($i=1;$i<=5;$i++)
                                                    <option value="20{{Carbon\Carbon::now()->format('y')-$i}}">20{{Carbon\Carbon::now()->format('y')-$i}}</option>
                                                @endfor
                                            </select>
                                        </div>


                                    </form>
                                </div>
                                <div class="box-group" id="accordion">
                                    <div class="box-header" style="position: inherit;">

                                    </div>
                                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                    <table id="datatable_prov" class="table table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Utilisateur</th>
                                            <th>Adresse ip </th>
                                            <th>Ville	</th>
                                            <th>Région</th>
                                            <th>Action effectuée</th>
                                            <th>Donnée manipulée</th>
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

            function load_data(from_agent = '', mois = '', annee='')
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
                        url:'{{ route("logactivity.getdata") }}',
                        data:{from_agent:from_agent, mois:mois, annee:annee}
                    },
                    "columns":[
                        { data: "created_at" },
                        { data: "nom" },
                        { data: "adressip"},
                        { data: "ville" },
                        { data: "region" },
                        { data: "subject" },
                        { data: "donne" },
                        { data: "action", name: "action", orderable: false, searchable: false}

                    ]
                });
            }

            $('#from_agent').change(function(){
                var from_agent = $('#from_agent').val();
                var mois = $('#mois').val();
                var annee = $('#annee').val();

                if(from_agent != '' && mois == '' && annee == ''){
                    $('#datatable_prov').DataTable().destroy();
                    load_data(from_agent, mois, annee);
                }else if (from_agent != '' && mois != '' && annee == '') {
                    $('#datatable_prov').DataTable().destroy();
                    load_data(from_agent, mois, annee);
                }else{
                    $('#datatable_prov').DataTable().destroy();
                    load_data();
                }
            });

            $('#mois').change(function(){
                var from_agent = $('#from_agent').val();
                var mois = $('#mois').val();
                var annee = $('#annee').val();

                if(from_agent == '' && mois != '' && annee == ''){
                    $('#datatable_prov').DataTable().destroy();
                    load_data(from_agent, mois, annee);
                }else if (from_agent != '' && mois != '' && annee == '') {
                    $('#datatable_prov').DataTable().destroy();
                    load_data(from_agent, mois,annee);
                }else{
                    $('#datatable_prov').DataTable().destroy();
                    load_data();
                }
            });

            $('#annee').change(function(){
                var from_agent = $('#from_agent').val();
                var mois = $('#mois').val();
                var annee = $('#annee').val();

                if(from_agent == '' && mois != '' && annee != ''){
                    $('#datatable_prov').DataTable().destroy();
                    load_data(from_agent, mois, annee);
                }else if (from_agent != '' && mois != '' && annee != '') {
                    $('#datatable_prov').DataTable().destroy();
                    load_data(from_agent, mois, annee);
                }else if (from_agent == '' && mois == '' && annee != '') {
                    $('#datatable_prov').DataTable().destroy();
                    load_data(from_agent, mois, annee);
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