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

        /*.dataTables_wrapper .dataTables_filter input{*/
        /*    margin-left: 0.5em;*/
        /*    width: 250px;*/
        /*    padding: 5px;*/
        /*    border: 1px solid;*/
        /*    color: #555;*/
        /*    font-weight: normal;*/
        /*    margin-bottom: 14px;*/
        /*    position: relative;*/
        /*    left: -300px;*/
        /*    top: -6px;*/

        /*}*/

        /*.select_customer {*/
        /*    margin-left: 0.5em;*/
        /*    width: 150px;*/
        /*    padding: 5px;*/
        /*    border: 1px solid;*/
        /*    color: #555;*/
        /*    font-weight: normal;*/
        /*    margin-bottom: 14px;*/
        /*    position: relative;*/
        /*    left: -20px;*/
        /*    top: -6px;*/
        /*}*/

        .select2-container--default .select2-selection--single{
            height: 30px !important;
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
                <h3 class="box-title"><strong>Plannings definitif</strong></h3>
                <!-- START ACCORDION & CAROUSEL-->

                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-solid">
                            <!-- form start -->
                            <!-- /.box-header -->

                                <div class="box-group" id="accordion" style="position: relative;">
                                    <div class="box-body">
                                        <div class="box-tools pull-right" >
                                            <div style="display:flex;" >
                                                <input type="search" name="from_agent" id="with_name" class="form-control" placeholder="Recherche par nom"  title="Recherche par nom" style="font-size:14px; margin-right:5px; border: 1px solid black; width: 250px;">
                                                <select class="form-control selectpicker" name="mois" id="mois" placeholder="Recherche par nom mois"  title="Recherche par mois">
                                                    <option value="" selected>Trier par mois</option>
                                                    @php
                                                        $count = 13 - Carbon\Carbon::now()->month;
                                                    @endphp
                                                    @for ($i = 0; $i < $count; $i++)
                                                        <option value="{{Carbon\Carbon::now()->addMonth($i)}}">{{Carbon\Carbon::now()->addMonth($i)->monthName}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    <div class="box-header" style="position: absolute; z-index: 1;">

                                        <div class="box-tools pull-left" style="margin-right: 15px">
                                            <div class="input-group input-group-sm hidden-xs" style="width: 30px;">
                                                <a class="btn btn-sm btn-social btn-vk generer-pdfIndiv" href="{{ route('planning.definitif.pdf',['type' => 'definitif'])}}" target="_blank" style="background-color: #c72121;">
                                                    <i class="fa fa-file-pdf-o BTN-VK"></i> Générer PDF
                                                </a>
                                            </div>
                                        </div>

                                        <div class="box-tools pull-left" style="margin-right: 15px">
                                            <div class="input-group input-group-sm hidden-xs" style="width: 30px;">
                                                <a class="btn btn-sm btn-social btn-vk generer-excelIndiv" href="{{ route('planning.definitif.excel',['type' => 'definitif'])}}" target="_blank" style="background-color: #0b7728;">
                                                    <i class="fa fa-file-excel-o BTN-VK"></i> Générer EXCEL
                                                </a>
                                            </div>
                                        </div>
                                        <div class="box-tools pull-left" style="margin-right: 15px">
                                            <div class="input-group input-group-sm hidden-xs" style="width: 30px;">
                                                <form class="valider_tout_planning" action="{{route('definitif.crea')}}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('put')
                                                    <button type="submit" style=":display: inline; margin-left: 3px;" class="btn btn-sm btn-social btn-vk generer-excelIndiv" data-toggle="tooltip" data-placement="top" target="_blank" style="background-color: #33b7b1;"><i class="glyphicon glyphicon-bookmark BTN-VK"></i> Archiver tout les plannings</button>
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
                                            <th>Total Heures  jour</th>
                                            <th>Total heures  nuit</th>
                                            <th>Total des Heures </th>
                                            <th>Statut</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if ($data)
                                            @foreach($data as $p)
                                                <tr>
                                                    @php
                                                        $total = $p->heures_total ;
                                                        $minutes = $p->minutes;

                                                        $total = $p->heures_total + (int)($minutes / 60) ;
                                                        $minutes =  intval(($p->minutes / 60)) > 0 ? (int)$p->minutes % 60 : (int)$p->minutes ;

                                                       $heures_total_hours = $p->heure_total_jour + intval(($p->minutes_jour / 60));
                                                       $minutes_jours = intval(($p->minutes_jour / 60))  >  0 ? (int)$p->minutes_jour % 60 : (int)$p->minutes_jour ;
                                                       $heure_total_nuit = $p->heure_total_nuit + intval(($p->minutes_nuit / 60));
                                                      # $minutes_nuit =  (int)$p->minutes_nuit % 60  < 0 ? (int)$p->minutes_nuit % 60 : (int)$p->minutes_nuit ;
                                                       $minutes_nuit = intval(($p->minutes_nuit / 60))  >  0 ? (int)$p->minutes_nuit % 60 : (int)$p->minutes_nuit ;

                                                    @endphp

                                                    <td>{{ ucfirst(\Carbon\Carbon::parse($p->created_at)->locale('fr_FR')->isoFormat('ddd  DD, MM YYYY')) }}</td>
                                                    <td> {{ $p->nom }}</td>
                                                    <td>{{  $p->prenoms }}</td>
                                                    <td>{{ \App\Helpers\BlackshFonctions::format($heures_total_hours . ':'.$minutes_jours.':0') }} </td>
                                                    <td>{{ \App\Helpers\BlackshFonctions::format($heure_total_nuit . ':'.$minutes_nuit.':0') }} </td>
                                                    <td>{{ \App\Helpers\BlackshFonctions::format($total.':'.$minutes.':0') }} </td>
                                                    <td> <span class="badge label label-success">definitif</span></td>
                                                    <td>
                                                        {{-- <a class="label label-primary label-sm" href="{{route('provisoire.show',$id)}}"><i class="fa fa-eye"></i></a> --}}
                                                        <form class="voir_un_planning" action="{{route('definitif.show',$p->id)}}" method="get" style="display: inline;">
                                                            @csrf
                                                            <input type="hidden" name="vacationid" value="{{ $p->vacation_id }}">
                                                            <button type="submit" data-toggle="tooltip" data-placement="top" title="voir les vacations" style="border: none; height: 17px;" class="label label-primary label-sm" data-toggle="tooltip" data-placement="top" target="_blank"><i class="fa fa-eye"></i></button>
                                                        </form>

                                                        <form class="valider_un_planning" action="{{route('definitif.update',$p->id)}}" method="post" style="display: inline;">
                                                            @csrf
                                                            @method('put')
                                                            <input type="hidden" name="vacationid" value="{{ $p->vacation_id }}">
                                                            <input type="hidden" name="type" value="archived">
                                                            <button type="submit" data-toggle="tooltip" data-placement="top" title="archiver ce planning" style="border: none; height: 17px;" class="label label-warning label-sm" data-toggle="tooltip" data-placement="top" target="_blank"><i class="glyphicon glyphicon-bookmark"></i></button>
                                                        </form>

                                                        <form class="valider_un_planning" action="{{route('definitif.update',$p->id)}}" method="post" style="display: inline;">
                                                            @csrf
                                                            @method('put')
                                                            <input type="hidden" name="vacationid" value="{{ $p->vacation_id }}">
                                                            <input type="hidden" name="type" value="provisoire">
                                                            <button type="submit" data-toggle="tooltip" data-placement="top" title="passer en provisoire" style="border: none; height: 17px;" class="label label-success label-sm" data-toggle="tooltip" data-placement="top" target="_blank"><i class="glyphicon glyphicon-sort"></i></button>
                                                        </form>

                                                        <form class="supprimer_un_planning" action="{{route('definitif.destroy',$p->id)}}" method="post" style="display: inline;">
                                                            @csrf
                                                            @method('delete')
                                                            <input type="hidden" name="vacationid" value="{{ $p->vacation_id }}">
                                                            <button type="submit" data-toggle="tooltip" data-placement="top" title="supprimer ce planning" onclick="return confirm('Voulez vous vraiment supprimer ce planning ?');" style="border: none; height: 17px;" class="label label-danger label-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash"></i></button>
                                                        </form>

                                                        <a href="{{ route('planning.definitif.vaccation.excel', ['id' => $p->id ])}}" data-toggle="tooltip" data-placement="top" title="Télécharger ce planning" style="border: none; height: 17px;" class="label label-success label-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-file-excel-o BTN-VK"></i> | EXCEL</a>
                                                        <a href="{{ route('planning.definitif.vaccation.pdf', ['id' => $p->id])}}" data-toggle="tooltip" data-placement="top" title="Télécharger ce planning" style="border: none; height: 17px;" class="label label-danger label-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-file-pdf-o BTN-VK"></i> | PDF</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif

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
{{--    <script src="{{asset('')}}bower_components/select2/dist/js/select2.full.min.js"></script>--}}
{{--    <!-- InputMask -->--}}
{{--    <script src="{{asset('')}}plugins/input-mask/jquery.inputmask.js"></script>--}}
{{--    <script src="{{asset('')}}plugins/input-mask/jquery.inputmask.date.extensions.js"></script>--}}
{{--    <script src="{{asset('')}}plugins/input-mask/jquery.inputmask.extensions.js"></script>--}}
{{--    <!-- bootstrap color picker -->--}}
{{--    <script src="{{asset('')}}bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>--}}
{{--    <!-- bootstrap time picker -->--}}
{{--    <script src="{{asset('')}}plugins/timepicker/bootstrap-timepicker.min.js"></script>--}}
{{--    <!-- iCheck 1.0.1 -->--}}
{{--    <script src="{{asset('')}}plugins/iCheck/icheck.min.js"></script>--}}

    <script>
        $('#datatable_prov').DataTable({
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
                "sSearch":         " ",
                "sZeroRecords":    "Aucun élément correspondant trouvé",
                "oPaginate": {
                    "sFirst":    "Premier",
                    "sLast":     "Dernier",
                    "sNext":     "Suivant",
                    "sPrevious": "Précédent"
                },
                // "searchPlaceholder": "Rechercher un compte",
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

    </script>

    <script>
        $(document).ready(function() {
            $('select').selectpicker();
        });
    </script>

@endsection