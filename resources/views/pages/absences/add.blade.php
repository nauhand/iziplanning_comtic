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
@endsection


@section('content')
  <!-- Content Wrapper. Contains page content -->
  {{-- <div class="content-wrapper"> --}}
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Accueil</a></li>
        <li><a href="#">Gestion des congés</a></li>
        <li class="active">Ajouter</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <br><br>
      <!-- /.row -->
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8 offset-md-2">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Enregistrer une absence</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form role="form" action="{{route('conge.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                  <div class="form-group @error('agent') has-error @enderror">
                    <label>Nom de l'Agent</label>
                    <select name="agent" class="form-control">
                      <option value="" hidden>Choisir agent</option>
                      @forelse($agents as $agent)
                        <option value="{{$agent->id}}" {{old('agent')==$agent->id ? 'selected' : null}}>{{$agent->nom.' '.$agent->prenoms}}</option>
                      @empty
                        <option value=""></option>
                      @endforelse
                    </select>
                    @error('agent')
                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                    @enderror
                  </div>
                  <div class="form-group @error('typeconge') has-error @enderror">
                    <label>Type d'absence</label>
                    <select name="typeconge" id="typeconge" class="form-control">
                      <option value="" hidden>Choisir le type</option>
                      <option value="congé">Congé</option>
                      <option value="congé">Congé paternité</option>
                      <option value="congé">Congé maternité</option>
                      <option value="Absences injustifiées">Absences injustifiées</option>
                      <option value="Retards">Retards</option>
                      <option value="Arrêt maladie">Arrêt maladie</option>
                      <option value="Enfant malade">Enfant malade</option>
                      <option value="Accident de travail">Accident de travail</option>
                      <option value="Autre">Autre</option>
                    </select>
                    @error('typeconge')
                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                    @enderror
                  </div>
                  {{-- <div class="form-group @error('typeconge')  has-error @enderror">
                    <label>Type de congé</label>
                    <select name="typeconge" class="form-control">
                      <option value="">Choisir le type</option>
                      <option value="annuel">Congé Annuel</option>
                      <option value="sanssolde">Congé sans solde</option>
                      <option value="maladie">Congé Maladie</option>
                      <option value="formation">Congé de Formation</option>
                      <option value="maternite">Congé de Maternité / Paternité</option>
                      <option value="familiale">Congé pour des raisons Familiales</option>
                      <option value="autre">Autre</option>
                    </select>
                    @error('typeconge')
                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                    @enderror
                  </div> --}}
                  <div class="form-row">
                    <div class="form-group col-md-6 @error('date_debut')  has-error @enderror" style="padding-left: 0px">
                      <label for="inputEmail4">Du</label>
                    <input name="date_debut" type="date" id="date_debut" class="form-control" value="{{old('date_debut') ?: ''}}">
                      @error('date_debut')
                          <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                      @enderror
                    </div>
                    <div class="form-group col-md-6 @error('date_fin')  has-error @enderror" style="padding-right: 0px">
                      <label for="inputPassword4">Au</label>
                      <input name="date_fin" type="date" id="date_fin" class="form-control" value="{{old('date_fin') ?: ''}}">
                      @error('date_fin')
                          <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                      @enderror
                    </div>
                  </div>                   
                  <div class="form-group @error('motif')  has-error @enderror">
                    <label>Motif d'absence</label>
                    <textarea name="motif" rows="7" class="form-control">{{old('motif')}}</textarea>
                    @error('motif')
                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                    @enderror
                  </div>
                  <div class="pull-right">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                  </div>

                </div>
                <!-- /.box-body -->

              </form>
            </div>
            <!-- /.box -->
          </div>
        </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  {{-- </div> --}}
  <!-- /.content-wrapper -->

    <!-- Main content -->
    {{-- <section class="content">
      <br><br>
      <!-- /.row -->
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8 offset-md-2">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Nouvelle Absence</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form role="form" action="{{route('conge.store')}}" method="post"  enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                  <div class="form-group @error('agent')  has-error @enderror">
                    <label>Nom de l'Agent</label>
                    <select name="agent" class="form-control">
                      <option value="">Choisir agent</option>
                      @if(count($agents)>0)
                        @foreach($agents as $agent)
                          <option value="{{$agent->id}}" {{old('agent')==$agent->id ? 'selected' : null}}>{{$agent->nom.' '.$agent->prenoms}}</option>
                        @endforeach
                      @endif
                    </select>
                    @error('agent')
                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                    @enderror
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6 @error('date_debut')  has-error @enderror" style="padding-left: 0px">
                      <label for="inputEmail4">Du</label>
                      <input name="date_debut" type="date" class="form-control" value="{{old('date_debut') ?: ''}}">
                      @error('date_debut')
                          <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                      @enderror
                    </div>
                    <div class="form-group col-md-6 @error('date_fin')  has-error @enderror" style="padding-right: 0px">
                      <label for="inputPassword4">Au</label>
                      <input name="date_fin" type="date" class="form-control" value="{{old('date_fin') ?: ''}}">
                      @error('date_fin')
                          <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                      @enderror
                    </div>
                  </div>                   
                  <div class="form-group @error('motif')  has-error @enderror">
                    <label>Motif de congé</label>
                    <textarea name="motif" rows="7" class="form-control">{{old('motif')}}</textarea>
                    @error('motif')
                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                    @enderror
                  </div>
                  <div class="pull-right">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                  </div>

                </div>
                <!-- /.box-body -->

              </form>
            </div>
            <!-- /.box -->
          </div>
        </div>
      <!-- /.box -->
    </section> --}}
    
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
  
  $('#typeconge').change(function(e){
    
    if ($(this).val() == 'congé'){
      
      $('#date_debut').attr('min', moment().format('YYYY-MM-DD'));
      $('#date_fin').attr('min', moment().format('YYYY-MM-DD'));

    } else{

      $('#date_debut').attr('min', Date.now());
      $('#date_fin').attr('min', Date.now());

    }
    
  })
</script>

@endsection