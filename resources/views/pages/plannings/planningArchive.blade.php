@extends('layouts.app')
@php
  use Carbon\Carbon;
@endphp
@section('head')
  <link rel="stylesheet" type="text/css" href="{{asset('')}}dist/css/jquery-ui.css">
@endsection
{{-- <style>
  .select2-container {
    max-width: 400px;
  }
</style> --}}

@section('content')
  <div id="action_alert" title="Action"></div>

  <!-- Main content -->
  <section class="content">
    <!-- /.row -->
    <div class="row" id="route" data-route="{{ route('planning.index_archive') }}">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Tous les plannings</h3>
            <div class="box-tools">
              <form id="form-search" data-route="{{route('planning.index_archive')}}" style="display:flex;">
                @csrf
                <input type="search" id="datalist_agent_name" width class="form-control" style="font-size:14px; margin-right:5px" list="list_agent_name" placeholder="Rechercher par Agent">

                  <datalist id="list_agent_name" class="text-capitalize">
                    @foreach($list_agents as $agent)
                    <option data-value="{{$agent->id}}" {{old('agent')==$agent->id ? 'selected' : null}} value="{{$agent->nom . ' ' . $agent->prenoms}}"></option>
                    @endforeach
                  </datalist>
  
                  <input type="hidden" id="generer_agent_name">
                  <input type="hidden" id="generer_agent_name_text">

                  <input type="search" id="datalist_site_name" width class="form-control" style="font-size:14px; margin-right:5px" list="list_site_name" placeholder="Rechercher par Site">
                  <datalist id="list_site_name" class="text-capitalize">
                    @foreach($sites as $site)
                    <option data-value="{{$site->id}}" {{old('site')==$site->id ? 'selected' : null}} value="{{$site->nom}}"></option>
                    @endforeach
                  </datalist>
  
                  <input type="hidden" id="generer_site_name">
                  <input type="hidden" id="generer_site_name_text">
                  
                  <select name="idMois" style="font-size:14px !important; margin-bottom:15px;margin-right:5px" class="form-control text-capitalize" id="idMois">
                    <option value="" selected>Rechercher par Mois</option>
                    @for ($i = 0; $i < 12; $i++)
                      <option value="{{Carbon::now()->firstOfYear()->addMonth($i)}}">{{Carbon::now()->firstOfYear()->addMonth($i)->monthName}}</option>
                    @endfor
                  </select>
                  
                {{-- <div class="box-tools" style="margin-right: 5px">
                  <div class="input-group input-group-sm hidden-xs" style="width: 120px;">

                    <input type="search" id="searchZone" class="form-control" style="font-size:14px" list="agent_name" placeholder="AGENTS">
                    
                    <datalist id="agent_name" class="text-capitalize">
                      @foreach($list_agents as $agent)
                      <option data-value="{{$agent->id}}" {{old('agent')==$agent->id ? 'selected' : null}} value="{{$agent->nom.' '.$agent->prenoms}}"></option>
                      @endforeach
                    </datalist>
                    <input type="hidden" name="agent_name" id="agent_name-hidden">

                  </div>
                </div>
                <div class="box-tools" style="margin-right: 5px">
                  <div class="input-group input-group-sm hidden-xs" style="width: 120px;">
                    <select name="mois" class="form-control text-uppercase" style="font-size:14px" id="mois">
                      <option value="" selected>Choix du mois</option>
                      <option value="jan">Janvier</option>
                      <option value="feb">Février</option>
                      <option value="mar">Mars</option>
                      <option value="apr">Avril</option>
                      <option value="may">Mai</option>
                      <option value="jun">Juin</option>
                      <option value="jul">Juillet</option>
                      <option value="aug">Août</option>
                      <option value="sep">Septembre</option>
                      <option value="oct">Octobre</option>
                      <option value="nov">Novembre</option>
                      <option value="dec">Decembre</option>
                    </select>
                  </div>
                </div> --}}
                {{-- <div class="box-tools" style="margin-right: 30px"> --}}
                  {{-- <div class="input-group input-group-sm hidden-xs" style="width: 100px;"> --}}

                    <select name="idAnnee" class="form-control text-uppercase" style="font-size:14px"  id="idAnnee">
                      @for($i=1;$i<7;$i++)
                        <option value="20{{Carbon::now()->addYear(7-$i)->format('y')}}">20{{Carbon::now()->addYear(7-$i)->format('y')}}</option>
                      @endfor
                      <option value="20{{Carbon::now()->format('y')}}" selected>20{{Carbon::now()->format('y')}}</option>
                      @for($i=1;$i<=7;$i++)
                        <option value="20{{Carbon::now()->format('y')-$i}}">20{{Carbon::now()->format('y')-$i}}</option>
                      @endfor
                    </select>

                    {{-- <div class="input-group-btn">
                      <button type="button" class="btn btn-default" id="search"><i class="fa fa-search"></i></button>
                    </div> --}}
                  {{-- </div> --}}
                {{-- </div> --}}
              </form>
            </div>
          </div>
          <!-- /.box-header -->
          <div id="div_table_planning" class="box-body table-responsive no-padding">
            @include('pages.plannings.table_archive')
          </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
  </section>
  <!-- /.content -->
<!-- ./wrapper -->
@endsection

@section('script')

{{-- <script type="text/javascript" src="{{asset('')}}assets/js/blackScript.js"></script> --}}
<script src="{{asset('assets/js/planningArchive.js')}}"></script>
<script>
  $('#searchZone').change(function () {
    
    var valeur = $("#agent_name option[value='"+ $('#searchZone').val() +"']").data('value');
    $('#agent_name-hidden').val(valeur);

  });
</script>

@endsection