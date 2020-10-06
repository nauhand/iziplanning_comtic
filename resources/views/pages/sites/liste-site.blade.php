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
      Liste des sites attribués à des agents
    </h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Accueil</a></li>
      <li><a href="#">Gerer les sites</a></li>
      <li class="active">Liste des sites</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- SELECT2 EXAMPLE -->

    <!-- /.box -->

    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Fiche site</h3>
        <!-- START ACCORDION & CAROUSEL-->

        <div class="row">
          <div class="col-md-12">
            <div class="box box-solid">
              <div class="box-header with-border">
              </div>
              <!-- form start -->
              <!-- /.box-header -->
              <div class="box-body">
                <div class="box-group" id="accordion">
                  <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                  <table id="datatable" class="table table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                      <tr>
                        <th>Site ID</th>
                        <th>Etablissement </th>
                        <th>Ville</th>
                        <th>Contact</th>
                        <th>Date d'ajout</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($sitesListe as $value)
                      <tr>
                        <td> {{$value->id}} </td>
                        <td> {{$value->nom}}</td>
                        <td> {{$value->ville}} </td>
                        <td> {{$value->telephone}} </td>
                         <td> {{ ucfirst(\Carbon\Carbon::parse($value->created_at)->locale('fr_FR')->isoFormat('ddd  DD, MM YYYY')) }}</td>
                        <td>
                          <a class="label label-primary label-sm" href="{{route('gestionsite.show',$value->id)}}"><i class="fa fa-eye"></i> liste</a>
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
            dom: 'Bfrtip',
                   buttons: [
                       {
                           extend:    'excelHtml5',
                           text:      '<i class="fa fa-file-excel-o"></i> <span> Excel </span>',
                           titleAttr: 'Excel',
                       },
                       {
                           extend:    'pdfHtml5',
                           text:      '<i class="fa fa-file-pdf-o"></i>'+'<span> PDF </span>',
                           titleAttr: 'PDF'
                       }
                   ],
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
              "sSearch":         "Recherche globale :",
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
          });
  } );
</script>

@endsection