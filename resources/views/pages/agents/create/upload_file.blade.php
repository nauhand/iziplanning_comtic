@php
  use Carbon\Carbon;
@endphp


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

  <form id="enregistrementAgent" role="form" method="POST" action="{{ route('agent.savefile') }}" enctype="multipart/form-data">
    {{csrf_field()}}
{{-- Form 5 --}}
<div class="box-body form-block hide">
    <div class="box-group" id="accordion"></div>
    
    <div class="tab">
        <div class="box-header with-border">
            <h4 class="box-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Téléchargement de fichier</a>
            </h4>
        </div>
        <div id="collapseThree" class="panel-collapse">
            <div class="box-body">
                <div class="col-md-6">
                    <div class="form-group piece_identite">
                        <label for="piece_identite" class="custom-select">Pièce d'identité (recto)</label>
                        <input type="file" id="piece_identite" name="piece_identite" class="form-control btn-file @error('piece_identite') btn btn-danger @enderror">
                        @error('piece_identite')
                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                        @enderror
                    </div>
                    <div class="form-group piece_identite_verso">
                        <label for="piece_identite_verso" class="custom-select">Pièce d'identité (verso)</label>
                        <input type="file" id="piece_identite_verso" name="piece_identite_verso" class="form-control btn-file @error('piece_identite_verso') btn btn-danger @enderror">
                        @error('piece_identite_verso')
                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                        @enderror
                    </div>
                    <div class="form-group passport">
                        <label for="passport" class="custom-select">Passport (page 1)</label>
                        <input type="file" id="passport" name="passport" class="form-control btn-file @error('passport') btn btn-danger @enderror">
                        @error('passport')
                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                        @enderror
                    </div>
                    <div class="form-group passport_verso">
                        <label for="passport_verso" class="custom-select">Passport (page 2)</label>
                        <input type="file" id="passport_verso" name="passport_verso" class="form-control btn-file @error('passport_verso') btn btn-danger @enderror">
                        @error('passport_verso')
                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                        @enderror
                    </div>
                    <div class="form-group carte_nationale">
                        <label for="carte_nationale" class="custom-select">Carte d'identité nationale (recto)</label>
                        <input type="file" id="carte_nationale" name="carte_nationale" class="form-control btn-file @error('carte_nationale') btn btn-danger @enderror">
                        @error('carte_nationale')
                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                        @enderror
                    </div>
                    <div class="form-group carte_nationale_verso">
                        <label for="carte_nationale_verso" class="custom-select">Carte d'identité nationale (verso)</label>
                        <input type="file" id="carte_nationale_verso" name="carte_nationale_verso" class="form-control btn-file @error('carte_nationale_verso') btn btn-danger @enderror">
                        @error('carte_nationale_verso')
                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                        @enderror
                    </div>
                    <div class="form-group carte_vaccin_chien">
                        <label for="carte_vaccin_chien" class="custom-select">Carte de vaccination du chien</label>
                        <input type="file" id="carte_vaccin_chien" name="carte_vaccin_chien" class="form-control btn-file @error('carte_vaccin_chien') btn btn-danger @enderror">
                        @error('carte_vaccin_chien')
                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                        @enderror
                    </div>
                    <div class="form-group carte_professionnelle">
                        <label for="carte_vaccin_chien" class="custom-select">Carte professionnelle</label>
                        <input type="file" id="carte_professionnelle" name="carte_professionnelle" class="form-control btn-file @error('carte_professionnelle') btn btn-danger @enderror">
                        @error('carte_professionnelle')
                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group titre_sejour">
                        <label for="titre_sejour" class="custom-select">Titre de séjour (recto)</label>
                        <input type="file" id="titre_sejour" name="titre_sejour" class="form-control btn-file @error('titre_sejour') btn btn-danger @enderror">
                        @error('titre_sejour')
                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                        @enderror
                    </div>
                    <div class="form-group titre_sejour_verso">
                        <label for="titre_sejour_verso" class="custom-select">Titre de séjour (verso)</label>
                        <input type="file" id="titre_sejour_verso" name="titre_sejour_verso" class="form-control btn-file @error('titre_sejour_verso') btn btn-danger @enderror">
                        @error('titre_sejour_verso')
                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                        @enderror
                    </div>
                    <div class="form-group recepice_titre_sejour">
                        <label for="recepice_titre_sejour" class="custom-select">Recepicé du titre de séjour</label>
                        <input type="file" id="recepice_titre_sejour" name="recepice_titre_sejour" class="form-control btn-file @error('recepice_titre_sejour') btn btn-danger @enderror">
                        @error('recepice_titre_sejour')
                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                        @enderror
                    </div>
                    <div class="form-group carte_vitale">
                        <label for="carte_vitale" class="custom-select">Carte vitale (recto)</label>
                        <input type="file" id="carte_vitale" name="carte_vitale" class="form-control btn-file @error('carte_vitale') btn btn-danger @enderror">
                        @error('carte_vitale')
                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                        @enderror
                    </div>
                    <div class="form-group carte_vitale_verso">
                        <label for="carte_vitale_verso" class="custom-select">Carte vitale (verso)</label>
                        <input type="file" id="carte_vitale_verso" name="carte_vitale_verso" class="form-control btn-file @error('carte_vitale_verso') btn btn-danger @enderror">
                        @error('carte_vitale_verso')
                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                        @enderror
                    </div>
                    <div class="form-group permis_conduire">
                        <label for="permis_conduire" class="custom-select">Permis de conduire (recto)</label>
                        <input type="file" id="permis_conduire" name="permis_conduire" class="form-control btn-file @error('permis_conduire') btn btn-danger @enderror">
                        @error('permis_conduire')
                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                        @enderror
                    </div>
                    <div class="form-group permis_conduire_verso">
                        <label for="permis_conduire_verso" class="custom-select">Permis de conduire (verso)</label>
                        <input type="file" id="permis_conduire_verso" name="permis_conduire_verso" class="form-control btn-file" @error('permis_conduire_verso') btn btn-danger @enderror">
                        @error('permis_conduire_verso')
                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="overflow:auto;margin-right: 26px">
        <div style="float:right;">
            <a type="button" class="btn btn-flat btn-primary precedent">Etape Précédente</a>
            <button type="submit" class="btn btn-flat btn-primary validateForm" >Ajouter</button>
        </div>
    </div>

    <div style="text-align:center;margin-top:40px;">
        <span class="step finish"></span>
        <span class="step finish"></span>
        <span class="step finish"></span>
        <span class="step finish"></span>
        <span class="step active"></span>
    </div>
</div>

  </form>
@endsection

@section('script')

  <script>
    
  </script>

@endsection