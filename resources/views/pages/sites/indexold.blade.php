@extends('layouts.app')

@section('head')

@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Liste des sites
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Accueil</a></li>
        <li><a href="#">Sites de déploiement</a></li>
        <li class="active">Liste des sites</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">

            <div class="input-group form-control" style="margin-bottom:15px">
              <div class="input-group input-group">
                <label for="generer_agent_name" class="input-group-addon"><i class="fa fa-search"></i></label>
                <input type="search" id="datalist_agent_name" width class="form-control" style="font-size:14px" list="list_agent_name" data-route="{{route('site.index')}}" placeholder="Rechercher un site">
                
                <datalist id="list_agent_name" class="text-capitalize">
                  @foreach($sitesListe as $site)
                  <option data-value="{{$site->id}}" {{old('agent')==$site->id ? 'selected' : null}} value="{{$site->nom}}"></option>
                  @endforeach
                </datalist>

                <input type="hidden" name="generer_agent_name" id="generer_agent_name">
                <input type="hidden" id="generer_agent_name_text">
              </div>
            </div>

            <div class="box-header">
              
              {{-- <div class="box-tools">
                <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                  <div class="input-group-btn">
                    <button type="button" id="btn-search-site" class="btn btn-default btn-search-site"><i class="fa fa-search"></i></button>
                  </div>
                </div>
                
              </div> --}}
              <div class="box-tools" style="margin-right: 30px" >
                <div class="input-group input-group-sm hidden-xs" style="width: 30px;">
                  <a class="btn btn-success btn-sm" href="{{ route('excel.site')}}" target="_blank">
                    <i class="fa fa-file-excel-o"></i> Générer EXCEL
                  </a>
                </div>
              </div>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 30px;margin-left:20px;">
                  <a class="btn btn-sm btn-danger " href=" {{ route('pdf.site') }} " target="_blank">
                    <i class="fa fa-file-pdf-o BTN-VK"></i> Générer PDF
                  </a>
                </div>
              </div>
              <!-- <div class="box-tools" style="margin-right: 30px">
                <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                 <select class="form-control">
                    <option>Tout Afficher</option>
                    <option>Déployé</option>
                    <option>Non Déployé</option>
                  </select>

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding" id="div_site_table">

                @include('pages.sites.table')
                
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
</div>
<!-- ./wrapper -->


@endsection

@section('script')

<script>
  $('#datalist_agent_name').change(function () {
    
    let id = $("#list_agent_name option[value='"+ $('#datalist_agent_name').val() +"']").data('value');
    let nameSite = $('#datalist_agent_name').val();

    $.ajax({
      url: $("#datalist_agent_name").data("route"),
      type: 'GET',
      data: {
        id: id,
        nameSite: nameSite
      },
      dataType: 'json',
      beforeSend: function() {
        $("div.close").show();
      },
      success: function(data) {
        $('#div_site_table').html(data.content);
        $("div.close").hide();
        
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("div.close").hide();

      }
    });
    
  });
</script>
    
@endsection