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
    @if ($message = Session::get('success'))
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
      Liste des Sites
    </h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Accueil</a></li>
      <li><a href="#">Gestions des Sites </a></li>
      <li class="active">liste</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- SELECT2 EXAMPLE -->

    <!-- /.box -->

    <div class="box box-primary">
      <div class="box-header with-border">
        <!-- START ACCORDION & CAROUSEL-->

        <div class="row">
          <div class="col-md-12">
            <div class="box box-solid">
              <!-- form start -->
              <!-- /.box-header -->
              <div class="box-body">
                <div class="box-group" id="accordion" style="position: relative;">
                  <div class="box-header" style="position: absolute; z-index: 1;">
                      <div class="box-tools pull-left" style="margin-right: 15px">
                          <div class="input-group input-group-sm hidden-xs" style="width: 30px;">
                          <a class="btn btn-sm btn-social btn-vk generer-pdfIndiv" href="{{ route('pdf.site') }} " target="_blank" style="background-color: #c72121;">
                              <i class="fa fa-file-pdf-o BTN-VK"></i> Générer PDF
                          </a>
                          </div>
                      </div>

{{--                      <div class="box-tools pull-left" style="margin-right: 15px">--}}
{{--                          <div class="input-group input-group-sm hidden-xs" style="width: 30px;">--}}
{{--                          <a class="btn btn-sm btn-social btn-vk generer-excelIndiv" href="{{ route('excel.site')}}" target="_blank" style="background-color: #0b7728;">--}}
{{--                              <i class="fa fa-file-excel-o BTN-VK"></i> Générer EXCEL--}}
{{--                          </a>--}}
{{--                          </div>--}}
{{--                      </div>--}}
                    <div class="box-tools pull-left" style="margin-right: 15px">
                      <div class="input-group input-group-sm hidden-xs" style="width: 30px;">
                        <a class="btn btn-sm btn-social btn-vk generer-excelIndiv" href="{{ route('site.create')}}"  style="background-color: gray;">
                          <i class="fa fa-sitemap BTN-VK"></i> Ajouter un site
                        </a>
                      </div>
                    </div>
                  </div>
                  <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                  <table id="datatable_vac" class="table table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                      <tr>
                        <th>Site</th>
                        <th>Ville</th>
                        <th>Contact</th>
                        <th>Date d'ajout</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($sites as $site)
                      <tr>
                        <td style="width: 350px;"><a href="{{route('gestionsite.show', $site->id)}}">{{$site->nom.' '.$site->prenoms}}</a></td>
                        <td style="width: 150px;">{{$site->ville}}</td>
                        <td>{{$site->telephone}}</td>
                        <td>{{\Carbon\Carbon::parse($site->created_at)->format('d/m/Y')}}</td>
                          <td>
                            <a href="{{route('site.edit',$site->id)}}" class="label label-primary"  data-toggle="tooltip" data-placement="bottom" title="Afficher"><i class="fa fa-eye"></i></a>
                            <a href="{{route('site.edit',$site->id)}}" class="label label-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="bottom" title="Modifier"></i></a>

                              <a href="{{route('site.destroy',$site->id)}}" class="label label-danger"   title="Supprimer"><i class="fa fa fa-trash"></i></a>
{{--                            <a href="{{route('site.excel', ['id' => $site->id])}}" target="_blank" class="label label-success" data-div_refresh="div_site_table" data-toggle="tooltip" data-placement="bottom" title="Excel"><i class="fa fa-file-excel-o"></i></a>--}}
                              <a href="{{route('agents.pdf.test',['id' => $site->id ])}}"   target="_blank"  class="label label-danger" data-div_refresh="div_site_table" data-toggle="tooltip" data-placement="bottom" title="PDF"><i class="fa fa-file-pdf-o"></i> | PDF</a>
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
              "searchPlaceholder": "Rechercher un site ...",
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

</script>
@endsection