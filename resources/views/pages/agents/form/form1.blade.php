

@extends('pages.agents.create.layout')
@section('tab')
<style>
    .input-group {
    position: relative;
    display: flex;
    flex-wrap: wrap;
    align-items: stretch;
    width: 100%;
    }

    .input-group>.form-control,
    .input-group>.custom-select,
    .input-group>.custom-file {
    position: relative;
    flex: 1 1 auto;
    margin-bottom: 0;
    margin-bottom: 5px;
    }
    .custom-select{
      margin-top: 5px;
    }

    .btn-file {
    position: relative;
    overflow: hidden;
    vertical-align: middle;
    }

    .fileinput.input-group {
    display: flex;
    margin-bottom: 9px;
    flex-wrap: nowrap;
    }

    .fileinput.input-group>* {
    position: relative;
    z-index: 2;
    }

    .fileinput .form-control {
    padding: .375rem .75rem;
    display: inline-block;
    margin-bottom: 0px;
    vertical-align: middle;
    cursor: text;
    }

    .fileinput-filename {
    display: inline-block;
    overflow: hidden;
    vertical-align: middle;
    }

    .form-control .fileinput-filename {
    vertical-align: bottom;
    }

    .input-group>.form-control:not(:last-child),
    .input-group>.custom-select:not(:last-child) {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    }

    .fileinput.input-group>.btn-file {
    z-index: 1;
    }

    .fileinput-new {
    padding-right: 10px;
    }

    .fileinput-new.input-group .btn-file,
    .fileinput-new .input-group .btn-file {
    border-radius: 0 4px 4px 0;
    }

    .fileinput-new.input-group .btn-file,
    .fileinput-new .input-group .btn-file {
    border-radius: 0 .25rem .25rem 0;
    }

    .input-group-addon:not(:first-child) {
    border-left: 0;
    }

    .fileinput .input-group-addon {
    padding: .375rem .75rem;
    width: auto;
    }

    .fileinput-exists .fileinput-new,
    .fileinput-new .fileinput-exists {
    display: none;
    }

    .fileinput .btn {
    vertical-align: middle;
    }

    .fileinput .input-group-addon {
    padding: .375rem .75rem;
    }

    .btn:not(:disabled):not(.disabled) {
    cursor: pointer;
    }

    .fileinput.input-group>.btn-file {
    z-index: 1;
    }

    .fileinput-new.input-group .btn-file,
    .fileinput-new .input-group .btn-file {
    border-radius: 0 4px 4px 0;
    }

    .fileinput-new.input-group .btn-file,
    .fileinput-new .input-group .btn-file {
    border-radius: 0 .25rem .25rem 0;
    }

    .btn-file>input {
    position: absolute;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
    margin: 0;
    font-size: 23px;
    cursor: pointer;
    filter: alpha(opacity=0);
    opacity: 0;
    direction: ltr;
    }
</style>

  <form id="enregistrementAgent" role="form" method="POST" action="{{ route('agent.1') }}" >
    @csrf

{{-- Form 1 --}}
@php
    use Carbon\Carbon;
@endphp
<div class="box-body form-block" >
    <div class="box-group" id="accordion">
    <!-- One "tab" for each step in the form: -->

    <div class="tab">
        <div class="box-header with-border">
            <h4 class="box-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Identité  #1</a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse">
        <div class="box-body">
            <div class="col-md-6">
            <div class="form-group civilite @error('civilite') has-error @enderror">
                <label>Civilité (*)</label>
                <select class="form-control" name="civilite" >
                    <option value="" selected hidden>Choisir le genre</option>
                    <option value="M" {{old('civilite')=='M' || $agent->civilite=='M' ? 'selected' : null}}>Monsieur</option>
                    <option value="Mll" {{old('civilite')=='Mll' || $agent->civilite=='Mll' ? 'selected' : null}}>Mademoiselle</option>
                    <option value="Mme" {{old('civilite')=='Mme' || $agent->civilite=='Mme' ? 'selected' : null}}>Madame</option>
                </select>
                @error('civilite')
                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                @enderror
            </div>
            <div class="form-group nom @error('nom')  has-error @enderror">
                <label>Nom (*)</label>
                <input name="nom" type="text" class="form-control"  placeholder="Entrer le nom" value="{{old('nom') ?: $agent->nom}}" >
                @error('nom')
                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                @enderror
            </div>
            <div class="form-group datenaissance @error('datenaissance')  has-error @enderror">
                <label>Date de naissance: (*)</label>
                <div class="input-group date">
                {{-- <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div> --}}
                <input type="date" name="datenaissance" class="form-control pull-right" id="datepicker" min="{{Carbon::now()->addYear(-100)->toDateString()}}" max="{{Carbon::now()->addYear(-18)->toDateString()}}" value="{{old('datenaissance') ?: $agent->datenaissance}}" >
                </div>
                <!-- /.input group -->
                @error('datenaissance')
                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                @enderror
            </div>
            </div>
            <div class="col-md-6">
                <div class="form-group statutmatrimonial @error('statutmatrimonial')  has-error @enderror">
                    <label>Statut Matrimonial (*)</label>
                    <select class="form-control" name="statutmatrimonial">
                    <option value="">Choisir le statut</option>
                    <option value="mar" {{old('statutmatrimonial')=='mar' || $agent->statutmatrimonial=='mar' ? 'selected' : null}}>Marié(e)</option>
                    <option value="cel" {{old('statutmatrimonial')=='cel' || $agent->statutmatrimonial=='cel' ? 'selected' : null}}>Célibataire</option>
                    <option value="veuf" {{old('statutmatrimonial')=='veuf' || $agent->statutmatrimonial=='veuf' ? 'selected' : null}}>Veuf(ve)</option>
                    </select>
                    @error('statutmatrimonial')
                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                    @enderror
                </div>
                <div class="form-group prenoms @error('prenoms')  has-error @enderror">
                    <label>Prénoms (*)</label>
                    <input name="prenoms" type="text" class="form-control" placeholder="Entrer le(s) Prénom(s)" value="{{old('prenoms') ?: $agent->prenoms}}" >
                    @error('prenoms')
                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                    @enderror
                </div>
              
                <div class="form-group adressegeo @error('adressegeo')  has-error @enderror">
                    <label>Adresse géographique</label>
                    <input name="adressegeo" type="text" class="form-control"  placeholder="Entrer l'adresse géographique" value="{{old('adressegeo') ?: $agent->adressegeo}}">
                    @error('adressegeo')
                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                    @enderror
                </div>
            </div>
        </div>
        </div>
    </div>

    <div style="overflow:auto;margin-right: 26px">
        <div style="float:right;">
            <button type="submit" class="btn btn-flat btn-primary suivant" >Etape Suivante</button>
        </div>
    </div>

    <div style="text-align:center;margin-top:40px;">
        <span class="step active"></span>
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
    </div>
    <!-- /.box-body -->
    </div>
</div>

  </form>
@endsection

@section('script')
@endsection