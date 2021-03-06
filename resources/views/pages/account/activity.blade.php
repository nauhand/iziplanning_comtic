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
      Liste des utilisateurs
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
        {{-- <h3 class="box-title"><strong>Historiques des activités </strong></h3> --}}
        <!-- START ACCORDION & CAROUSEL-->
       <input type="hidden" id="token" value="{{ csrf_token() }}" name="_token">

        <div class="row">
          <div class="col-md-12">
            <div class="box box-solid">
              <!-- form start -->
              <!-- /.box-header -->
              <div class="box-body">
                <div class="box-group" id="accordion" style="position: relative;">
                  <div class="row">
                    <div class="col-md-2">
                      <select name="user_id" id="user_id"  class="form-control">
                        <option value="">UTILISATEUR</option>
                        @foreach ($user as $u)
                        <option value="{{ $u->id }}">{{ $u->nom . ' ' .$u->prenoms }}</option>   
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-2">
                      <select name="action_id" id="action_id"  class="form-control">
                        <option value="">ACTION</option>
                        <option value="1">AJOUT</option>
                        <option value="2">MODIFICATION</option>
                        <option value="3">SUPPRESSION</option>
                      </select>
                    </div>
                    <div class="col-md-2">
                      <select name="type_data" id="type_data"  class="form-control">
                        <option value="">DONNÉ</option>
                        <option value="agents">AGENT</option>
                        <option value="conges">CONGÉ</option>
                        <option value="plannings">PLANNINGS</option>
                        <option value="sites">SITES</option>
                      </select>
                    </div>
                    <div class="col-md-4">
                      <div class="form-row">
                        <div class="form-group col-md-6 " style="padding-left: 0px">
                          <input name="date_debut" type="date" id="date_debut" class="form-control select2" value="">
                        </div>
                        <div class="form-group col-md-6 " style="padding-right: 0px">
                          <input name="date_fin" type="date" id="date_fin" class="form-control select2" value="">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-1">
                      <button class="btn btn-success" id="btn_search"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                  <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                  <table id="datatable_vac" class="table table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                      <tr>
                      <th>Date</th>
                      <th>uUilisateur</th>
                      <th>Adresse Ip</th>
                      <th>Pays</th>
                      <th>Ville</th>
                      <th>Région</th>
                      <th>Action effectuée</th>
                      <th>Donnée manipulée</th>
                      <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="content_log">
                      @foreach ($log_activies as $log)
                      <tr>
                          <td>{{ ucfirst(\Carbon\Carbon::parse($log->created_at)->locale('fr_FR')->isoFormat('ddd  DD, MM YYYY')) }}</td>
                          <td>{{ $log->adminname . ' ' . $log->adminlastname }}</td>
                          <td>{{ $log->ip }}</td>               
                          <td>{{ $log->pays }}</td>       
                          <td>{{ $log->ville }}</td>             
                          <td>{{ $log->region  }}</td>    
                          <td>{{ $log->subject  }}</td>    
                          <td>{{ $log->table  }}</td>            
                          <td>
                             <a href="{{ route('logactivity.show', ['id' => $log->id . '-'.$log->table ]) }}"  class="label label-primary label-sm"><i class="fa fa-eye"></i></a>
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
              "searchPlaceholder": "Rechercher une activité",
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

let btn = document.querySelector('#btn_search');
let action = document.querySelector("#action_id");
let user = document.querySelector("#user_id");
let date_start = document.querySelector('#date_debut');
let date_end = document.querySelector('#date_fin');
let type_data = document.querySelector('#type_data');
let token = document.querySelector("#token");
let content_log = document.querySelector('#content_log');


btn.addEventListener('click', function(e){
    $.ajax({
        url: location.origin + '/activite-des-comptes/recherche/data',
        type: 'POST',
        data: {
            userId      : user.value,
            action      : action.value ,
            date_start  : date_start.value,
            date_end    : date_end.value,
            type        : type_data.value,
            _token      : token.value 
        },
        dataType: 'json',
        beforeSend: function() {
           console.log('befor send')
        },
        success: function(data) {
        //  console.log(data.data.length);
          if(data.data.length > 0) { 
          data.data.forEach(element => {
            content_log.innerHTML = '';
              data.data.forEach( element => {
                insertData(element);
              })
            }); 
          } else {
            content_log.innerHTML = '';
          }
        },  
        error: function (xhr, ajaxOptions, thrownError) {
           console.log('error')
        }
    });
  
})

function insertData(element) {
    let tr = document.createElement('tr');

    let tdate = document.createElement('td');
    tdate.innerText = element.created_at ;
    tr.appendChild(tdate);

    let tdnom = document.createElement('td');
    tdnom.innerText = element.adminname == undefined ? '' : element.adminname  + ' ' + element.adminlastname == undefined ? '' : element.adminlastname;
    tr.appendChild(tdnom);

    let tdip = document.createElement('td');
    tdip.innerText = element.ip ;
    tr.appendChild(tdip);

    let tdpays = document.createElement('td');
    tdpays.innerText = element.pays ;
    tr.appendChild(tdpays);

    let tdville = document.createElement('td');
    tdville.innerText = element.ville ;
    tr.appendChild(tdville);

    let tdregion = document.createElement('td');
    tdregion.innerText = element.region ;
    tr.appendChild(tdregion);

    let tdsubject = document.createElement('td');
    tdsubject.innerText = element.subject ;
    tr.appendChild(tdsubject);

    let tdtable = document.createElement('td');
    tdtable.innerText = element.table ;
    tr.appendChild(tdtable);

    let tdaction = document.createElement('td');
    let a = document.createElement('a');
    a.setAttribute('href',location.origin+'/activite-des-comptes/'+element.id + '-' + element.table);
    a.classList.add('label', 'label-primary' , 'label-sm');
    let i = document.createElement('i');
    i.classList.add('fa', 'fa-eye');
    a.appendChild(i);
    tdaction.appendChild(a);
    tr.appendChild(tdaction);
    content_log.appendChild(tr);

}

</script>
@endsection