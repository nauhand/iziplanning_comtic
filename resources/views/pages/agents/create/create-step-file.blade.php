{{-- {{dd(\Session::all())}} --}}
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
                        <!-- form start -->
    <form id="regForm" role="form" action="{{route('agent.postStepFile')}}" method="post" enctype="multipart/form-data">
        @csrf
        <!-- /.box-header -->
        <div class="box-body">
            <div class="box-group" id="accordion"></div>
            <!-- One "tab" for each step in the form: -->
            <div class="tab">
                <div class="box-header with-border">
                    <h4 class="box-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Téléchargement de fichier</a>
                    </h4>
                </div>
                <div id="collapseThree" class="panel-collapse">
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="input-group piece_identite @error('piece_identite')  btn btn-danger @enderror" id="div_piece_identite">
                                <label for="piece_identite" class="custom-select">Pièce d'identité (recto)</label>
                                <input type="file" id="piece_identite" name="piece_identite" class="form-control btn-file custom-file @error('piece_identite') btn btn-danger @enderror">
                                @error('piece_identite')
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                                @enderror
                                
                            </div>
                            <div class="form-group nomchien @error('nomchien')  has-error @enderror" id="div_nomchien">
                                <label>Nom du chien</label>
                                <input name="nomchien" type="text" class="form-control"  placeholder="Entrer le nom du chien" value="{{old('nomchien') ?: $agent->nomchien}}">
                                @error('nomchien')
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                                @enderror
                              </div>
                            @error('piece_identite')
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $message }}</label>
                            @enderror
                            <div class="input-group">
                                <label for="piece_identite_verso" class="custom-select">Pièce d'identité (verso)</label>
                                <input type="file" id="piece_identite_verso" name="piece_identite_verso" class="form-control btn-file custom-file @error('piece_identite_verso') has-error @enderror">
                                @error('piece_identite_verso')
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label for="passport" class="custom-select">Passport (page 1)</label>
                                <input type="file" id="passport" name="passport" class="form-control btn-file custom-file @error('passport') has-error @enderror">
                                @error('passport')
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label for="passport_verso" class="custom-select">Passport (page 2)</label>
                                <input type="file" id="passport_verso" name="passport_verso" class="form-control btn-file custom-file @error('passport_verso') has-error @enderror">
                                @error('passport_verso')
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label for="carte_nationale" class="custom-select">Carte d'identité nationale (recto)</label>
                                <input type="file" id="carte_nationale" name="carte_nationale" class="form-control btn-file custom-file @error('carte_nationale') has-error @enderror">
                                @error('carte_nationale')
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label for="carte_nationale_verso" class="custom-select">Carte d'identité nationale (verso)</label>
                                <input type="file" id="carte_nationale_verso" name="carte_nationale_verso" class="form-control btn-file custom-file @error('carte_nationale_verso') has-error @enderror">
                                @error('carte_nationale_verso')
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <label for="titre_sejour" class="custom-select">Titre de séjour (recto)</label>
                                <input type="file" id="titre_sejour" name="titre_sejour" class="form-control btn-file custom-file @error('titre_sejour') has-error @enderror">
                                @error('titre_sejour')
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label for="titre_sejour_verso" class="custom-select">Titre de séjour (verso)</label>
                                <input type="file" id="titre_sejour_verso" name="titre_sejour_verso" class="form-control btn-file custom-file @error('titre_sejour_verso') has-error @enderror">
                                @error('titre_sejour_verso')
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label for="carte_vitale" class="custom-select">Carte vitale (recto)</label>
                                <input type="file" id="carte_vitale" name="carte_vitale" class="form-control btn-file custom-file @error('carte_vitale') has-error @enderror">
                                @error('carte_vitale')
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label for="carte_vitale_verso" class="custom-select">Carte vitale (verso)</label>
                                <input type="file" id="carte_vitale_verso" name="carte_vitale_verso" class="form-control btn-file custom-file @error('carte_vitale_verso') has-error @enderror">
                                @error('carte_vitale_verso')
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label for="permis_conduire" class="custom-select">Permis de conduire (recto)</label>
                                <input type="file" id="permis_conduire" name="permis_conduire" class="form-control btn-file custom-file @error('permis_conduire') has-error @enderror">
                                @error('permis_conduire')
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label for="permis_conduire_verso" class="custom-select">Permis de conduire (verso)</label>
                                <input type="file" id="permis_conduire_verso" name="permis_conduire_verso" class="form-control btn-file custom-file @error('permis_conduire_verso') has-error @enderror">
                                @error('permis_conduire_verso')
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="overflow:auto;margin-right: 26px">
                <div style="float:right;">
                <button type="button" class="btn btn-flat btn-primary" id="nextBtn" onclick="getPreviousForm('{{route('agent.createStepFour')}}')">Etape Précédente</button>
                <button type="button" class="btn btn-flat btn-primary" id="nextBtn" onclick="submitForm('regForm')">Ajouter</button>
                </div>
            </div>

            <div style="text-align:center;margin-top:40px;">
                <span class="step finish"></span>
                <span class="step finish"></span>
                <span class="step finish"></span>
                <span class="step finish"></span>
                <span class="step active"></span>
            </div>
        <!-- /.box-body -->
        </div>
      <!-- /.box-body -->
    </form>
    
    <script>
      $(document).ready(function(){
          $('.check').click(function() {
              $('.check').not(this).prop('checked', false);
          });
      });
    </script>
  @endsection