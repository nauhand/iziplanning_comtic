@extends('layouts.app')
@php
  use Carbon\Carbon;
@endphp
@section('head')
  <link rel="stylesheet" type="text/css" href="{{asset('')}}dist/css/jquery-ui.css">
@endsection

@section('content')
  <div id="user_dialog" title="Add Data" class="hidden">
    {{-- NOM DE L'AGENT --}}
    <div class="form-group">
      <label for="agent_name">Nom de l'agent</label>
      <select name="agent_name" class="form-control select2" id="agent_name" style="width: 100%;">
        <option value="" id="agent_option" selected></option>
        {{-- @if(count($agents)>0)
        @foreach($agents as $agent)
        <option value="{{$agent->id}}" {{old('agent')==$agent->id ? 'selected' : null}}>{{$agent->nom.' '.$agent->prenoms}}</option>
        @endforeach
        @endif --}}
      </select>
      @error('agent')
      <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
      @enderror
      <span id="error_agent_name" class="text-danger"></span>
    </div>

    {{-- NOM DU SITE --}}
    <div class="form-group">
      <label for="site_name">Site</label>
      <select name="site_name" id="site_name" class="form-control select2">
        <option value="" selected hidden>Choisir un site</option>
        @if(count($sites)>0)
          @foreach($sites as $site)
            <option value="{{$site->id}}" {{old('site')==$site->id ? 'selected' : null}}>{{$site->nom}}</option>
          @endforeach
        @endif
      </select>
      @error('site')
        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
      @enderror
      <span id="error_site_name" class="text-danger"></span>
    </div>

    {{-- DATE DE DEBUT --}}
    <div class="form-group">
      <label for="date_debut">Date de début</label>
      <input type="date" name="date_debut" id="date_debut" class="form-control" />
      <span id="error_date_debut" class="text-danger"></span>
    </div>

    {{-- HEURE DEBUT --}}
    <div class="form-group">
      <label for="heure_debut">Heure début</label>
      <input type="time" name="heure_debut" id="heure_debut" class="form-control" value="00:00" />
      <span id="error_heure_debut" class="text-danger"></span>
    </div>

    {{-- HEURE FIN --}}
    <div class="form-group">
      <label for="heure_fin">Heure fin</label>
      <input type="time" name="heure_fin" id="heure_fin" class="form-control" value="00:00" />
      <span id="error_heure_fin" class="text-danger"></span>
    </div>

    {{-- HEURE DE PAUSE --}}
    <div class="form-group">
      <label for="heure_pause">Heure de pause</label>
      <input type="time" name="heure_pause" id="heure_pause" class="form-control" value="00:00" />
      <span id="error_heure_pause" class="text-danger"></span>
    </div>

    <div class="form-group col-12" align="center">
      <input type="hidden" name="row_id" id="hidden_row_id" />
      <button type="button" name="save" id="save" class="btn btn-info">Créer</button>
    </div>
  </div>
  <div id="action_alert" title="Action"></div>

    <!-- Main content -->
    <section class="content">
      {{-- <div class="row">
        <div class="col-xs-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Planning</h3>
            </div>
            <div class="box-body">
              <a href="{{route('planning.create')}}" class="btn btn-primary" role="button">Plannifier un agent</a>
            </div>
          </div>
        </div>
      </div> --}}
      <!-- /.row -->
      <div class="row" id="route" data-route="{{ route('provisoire.search') }}">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tous les plannings</h3>
            </div>
            <!-- /.box-header -->
            <div id="div_table_planning" class="box-body table-responsive no-padding">
              <div class="box-tools pull-right" style="width: 450px; padding-bottom: 15px;">
                <form id="form-search" action="#" method="post" style="display:flex;" >
                  @csrf
                          <input type="search" id="datalist_agent_name" width class="form-control" style="font-size:14px; margin-right:5px" list="list_agent_name" placeholder="Rechercher par Agent">
                          
                          <datalist id="list_agent_name" class="text-capitalize">
                            @foreach($list_agents as $agent)
                            <option data-value="{{$agent->id}}" {{old('agent')==$agent->id ? 'selected' : null}} value="{{$agent->nom . ' ' . $agent->prenoms}}"></option>
                            @endforeach
                          </datalist>
              
                          <input type="hidden" id="generer_agent_name">
                          <input type="hidden" id="generer_agent_name_text">
                        {{-- </div>
                      </div> --}}

                      {{-- <div class="input-group" style="margin-left:5px">
                        <div class="input-group input-group"> --}}
                          {{-- <label for="generer_agent_name" class="input-group-addon"><i class="fa fa-search"></i></label> --}}
                          <input type="search" id="datalist_site_name" width class="form-control" style="font-size:14px; margin-right:5px" list="list_site_name" placeholder="Rechercher par Site">
                          
                          <datalist id="list_site_name" class="text-capitalize">
                            @foreach($sites as $site)
                            <option data-value="{{$site->id}}" {{old('site')==$site->id ? 'selected' : null}} value="{{$site->nom}}"></option>
                            @endforeach
                          </datalist>
              
                          <input type="hidden" id="generer_site_name">
                          <input type="hidden" id="generer_site_name_text">
                        
                </form>
              </div>
              <br>
              @include('pages.plannings.table_planning')
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
{{-- </div> --}}
<!-- ./wrapper -->
@endsection

@section('script')

<script type="text/javascript" src="{{asset('')}}assets/js/blackScript.js"></script>
<script src="{{asset('')}}assets/js/planningProvisoire.js"></script>
<script>
  $(document).ready( function () {
      $('#datatable1').DataTable({
            select :true,
            lengthChange: false,
            "ordering": false,
            "bFilter": false,
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

  $(document).ready( function () {
      $('#datatable2').DataTable({
            select :true,
            lengthChange: false,
            "ordering": false,
            "bFilter": false,
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
<script>
  function search() {
    
    const idAgent   = $("#list_agent_name option[value='"+ $('#datalist_agent_name').val() +"']").data('value');
    const nameAgent = $('#datalist_agent_name').val();

    const idSite    = $("#list_site_name option[value='"+ $('#datalist_site_name').val() +"']").data('value');
    const nameSite  = $('#datalist_site_name').val();

    // const idQualif    = $("#list_qualification_name option[value='"+ $('#datalist_qualification_name').val() +"']").data('value');
    // const nameQualif  = $('#datalist_qualification_name').val();

    console.log("id :" + idAgent);
    console.log("name : "+nameAgent);
    
    $('#generer_agent_name').val(idAgent);
    $('#generer_agent_name_text').val(nameAgent);
    console.log($('#generer_agent_name').val(idAgent));
    console.log($('#generer_agent_name_text').val(nameAgent));

    console.log($("#route").data("route"));
    console.log("---------------------------------------");
    console.log("idAgent :"+idAgent);
    console.log("nameAgent :"+nameAgent);
    console.log("idSite :"+idSite);
    console.log("nameSite :"+nameSite);
    // console.log("idQualif :"+idQualif);
    // console.log("nameQualif :"+nameQualif);
    console.log($("#route").data("route"));

    $.ajax({
      url: $("#route").data("route"),
      type: 'GET',
      data: {
        idAgent     : idAgent,
        nameAgent   : nameAgent,
        idSite      : idSite,
        nameSite    : nameSite,
        // idQualif    : idQualif,
        // nameQualif  : nameQualif
      },
      dataType: 'json',
      beforeSend: function() {
        $("div.close").show();
      },
      success: function(data) {
        $('#div_table_planning').html(data.content);
        $("div.close").hide();
        console.log(data);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr);
        console.log(thrownError);
        $("div.close").hide();

      }
    });


  }
  $('#datalist_agent_name').change(function () {
    search();
  });
  $('#datalist_site_name').change(function () {
    search();
  });
  // $('#datalist_qualification_name').change(function () {
  //   search();
  // });
</script>

@endsection