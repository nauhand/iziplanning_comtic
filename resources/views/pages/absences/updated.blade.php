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
                <h3 class="box-title">Modifier l'absence de <b>{{ $absence_updated->agent->nom .' '. $absence_updated->agent->prenoms }}</b></h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form action="{{route('absence.update', $absence_updated->id)}}" method="POST">
                @csrf
                @method('patch')
                <div class="box-body">
                  <div class="form-group @error('agent')  has-error @enderror">
                    <label>Nom de l'Agent</label>
                    <select name="agent" class="form-control">
                      <option value="{{ $absence_updated->agent_id }}">{{ $absence_updated->agent->nom .' '. $absence_updated->agent->prenoms }}</option>
                    </select>
                    @error('agent')
                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                    @enderror
                  </div>
                  <div class="form-group @error('typeconge') has-error @enderror">
                    <label>Type d'absence</label>
                    <select name="typeconge" class="form-control">
                      <option value="" hidden>Choisir le type</option>
                      <option value="Congés" {{ $absence_updated->typeconge == 'Congés' ? 'selected' : null}}>Congé</option>
                      <option value="Congés paternité" {{ $absence_updated->typeconge == 'Congés paternité' ? 'selected' : null}}>Congés paternité</option>
                      <option value="Congés maternité" {{ $absence_updated->typeconge == 'Congés maternité' ? 'selected' : null}}>Congé maternité</option>
                      <option value="Absences injustifiées" {{ $absence_updated->typeconge == 'Absences injustifiées' ? 'selected' : null}}>Absences injustifiées</option>
                      <option value="Retards" {{ $absence_updated->typeconge == 'Retards' ? 'selected' : null}}>Retards</option>
                      <option value="Arrêt maladie" {{ $absence_updated->typeconge == 'Arrêt maladie' ? 'selected' : null}}>Arrêt maladie</option>
                      <option value="Enfant malade" {{ $absence_updated->typeconge == 'Enfant malade' ? 'selected' : null}}>Enfant malade</option>
                      <option value="Accident de travail" {{ $absence_updated->typeconge == 'Accident de travail' ? 'selected' : null}}>Accident de travail</option>
                      <option value="Autre" {{ $absence_updated->typeconge == 'Autre' ? 'selected' : null}}>Autre</option>
                    </select>
                    @error('typeconge')
                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                    @enderror
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6 @error('date_debut')  has-error @enderror" style="padding-left: 0px">
                      <label for="inputEmail4">Du</label>
                      <input name="date_debut" type="date" class="form-control" value="{{old('date_debut') ?: $absence_updated->date_debut}}">
                      @error('date_debut')
                          <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                      @enderror
                    </div>
                    <div class="form-group col-md-6 @error('date_fin')  has-error @enderror" style="padding-right: 0px">
                      <label for="inputPassword4">Au</label>
                      <input name="date_fin" type="date" class="form-control" value="{{old('date_fin') ?: $absence_updated->date_fin}}">
                      @error('date_fin')
                          <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                      @enderror
                    </div>
                  </div>                   
                  <div class="form-group @error('motif')  has-error @enderror">
                    <label>Motif d'absence</label>
                    <textarea name="motif" rows="7" class="form-control">{{old('motif') ?: $absence_updated->motif}}</textarea>
                    @error('motif')
                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                    @enderror
                  </div>
                  <div class="pull-right">
                    <button type="submit" class="btn btn-primary">Modifier l'absence</button>
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

@endsection