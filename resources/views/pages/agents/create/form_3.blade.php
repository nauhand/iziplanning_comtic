{{-- Forme 3 --}}
{{--<div class="box-body form-block ">--}}
<div class="box-body form-block hide">
    <div class="box-group" id="accordion">
    <!-- One "tab" for each step in the form: -->

        <div class="tab">
            <div class="box-header with-border">
                <h4 class="box-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                    Informations administratives
                    </a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse">
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nationalité</label>
                            {{$agent->nationalite}}
                            <select class="form-control nationalite" name="nationalite">
                            <option value="FR"  {{old('nationalite')=='FR' || $agent->nationalite=='FR' ? 'selected' : null}}>Française</option>
                            <option value="ET" {{old('nationalite')=='ET' || $agent->nationalite=='ET' ? 'selected' : null}}>Etrangère</option>
                            </select>
                            @error('nationalite')
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                            @enderror
                        </div>
                        <div class="form-group numeropermis @error('numeropermis') has-error @enderror">
                            <label>Numéro de permis de conduire</label>
                            <input name="numeropermis" type="text" class="form-control"  placeholder="Entrer le numéro de permis de conduire" value="{{old('numeropermis') ?: $agent->numeropermis}}">
                            @error('numeropermis')
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                            @enderror
                        </div>
                        <div class="form-group lieudelivrancepermis @error('lieudelivrancepermis') has-error @enderror">
                            <label>Lieu de délivrance du permis</label>
                            <input name="lieudelivrancepermis" type="text" class="form-control"  placeholder="Entrer le lieu de délivrance du permis" value="{{old('lieudelivrancepermis') ?: $agent->lieudelivrancepermis}}">
                            @error('lieudelivrancepermis')
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                            @enderror
                        </div>
                        <div class="form-group dateetablpermis @error('dateetablpermis') has-error @enderror">
                            <label>Date d'établissement du permis</label>
                            <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" name="dateetablpermis" class="form-control pull-right" id="datepicker" value="{{old('dateetablpermis') ?: $agent->dateetablpermis}}">
                            </div>
                            <!-- /.input group -->
                            @error('dateetablpermis')
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                            @enderror
                        </div>
{{--                        <div class="form-group dateexpirpermis @error('dateexpirpermis') has-error @enderror">--}}
{{--                            <label>Date d'expiration du permis</label>--}}
{{--                            <div class="input-group date">--}}
{{--                            <div class="input-group-addon">--}}
{{--                                <i class="fa fa-calendar"></i>--}}
{{--                            </div>--}}
{{--                            <input type="date" name="dateexpirpermis" class="form-control pull-right" id="datepicker" value="{{old('dateexpirpermis') ?: $agent->dateexpirpermis}}">--}}
{{--                            </div>--}}
{{--                            <!-- /.input group -->--}}
{{--                            @error('dateexpirpermis')--}}
{{--                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
                        <div class="form-group categoriepermis @error('categoriepermis') has-error @enderror">
                            <label>Catégorie du permis</label>
                            <select name="categoriepermis[]" class="form-control select2" multiple="multiple" data-placeholder="Entrer la catégorie du permis" style="width: 100%;">
                                <option value="AM" {{in_array('AM',old('categoriepermis') ?: array()) ? 'selected' : null}}>Catégorie AM</option>
                                <option value="A" {{in_array('A',old('categoriepermis') ?: array()) ? 'selected' : null}}>Permis A</option>
                                <option value="A1" {{in_array('A1',old('categoriepermis') ?: array()) ? 'selected' : null}}>Permis A1</option>
                                <option value="A2" {{in_array('A2',old('categoriepermis') ?: array()) ? 'selected' : null}}>Permis A2</option>
                                <option value="B" {{in_array('B',old('categoriepermis') ?: array()) ? 'selected' : null}}>Permis B</option>
                                <option value="B1" {{in_array('B1',old('categoriepermis') ?: array()) ? 'selected' : null}}>Permis B1</option>
                                <option value="BE" {{in_array('BE',old('categoriepermis') ?: array()) ? 'selected' : null}}>Permis BE</option>
                                <option value="C" {{in_array('C',old('categoriepermis') ?: array()) ? 'selected' : null}}>Permis C</option>
                                <option value="C1" {{in_array('C1',old('categoriepermis') ?: array()) ? 'selected' : null}}>Permis C1</option>
                                <option value="CE" {{in_array('CE',old('categoriepermis') ?: array()) ? 'selected' : null}}>Permis CE</option>
                                <option value="C1E" {{in_array('C1E',old('categoriepermis') ?: array()) ? 'selected' : null}}>Permis C1E</option>
                                <option value="D" {{in_array('D',old('categoriepermis') ?: array()) ? 'selected' : null}}>Permis D</option>
                                <option value="D1" {{in_array('D1',old('categoriepermis') ?: array()) ? 'selected' : null}}>Permis D1</option>
                                <option value="DE" {{in_array('DE',old('categoriepermis') ?: array()) ? 'selected' : null}}>Permis DE</option>
                                <option value="D1E" {{in_array('D1E',old('categoriepermis') ?: array()) ? 'selected' : null}}>Permis D1E</option>
                            </select>
                            @error('categoriepermis')
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group numerocni @error('numerocni')  has-error @enderror" id="div_carteidentite">
                            <label>Numéro Carte Nationale d’Identité (*)</label>
                            <input name="numerocni" type="text" class="form-control"  placeholder="Entrer le numéro de la carte nationale d’identité " value="{{old('numerocni') ?: $agent->numerocni}}">
                            @error('numerocni')
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                            @enderror
                        </div>
                        <div class="form-group numeroetranger @error('numeroetranger')  has-error @enderror" id="div_numeroetranger" style="display: none">
                            <label>Numéro étranger</label>
                            <input name="numeroetranger" type="text" class="form-control"  placeholder="Entrer le numéro étranger" value="{{old('numeroetranger') ?: $agent->numeroetranger}}">
                            @error('numeroetranger')
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                            @enderror
                        </div>
                        <div class="form-group typetitresejour @error('typetitresejour') has-error @enderror" id="div_typetitresejour">
                            <label>Type de titre de séjour</label>
                            <select name="typetitresejour" id="typetitresejour" class="form-control">
                                <option value="Carte de séjour">Carte de séjour</option>
                                <option value="Récépissé">Récépissé du titre de séjour</option>
                            </select>
                            {{-- <input name="typetitresejour" type="text" class="form-control"  placeholder="Entrer le type de titre de sejour" value="{{old('typetitresejour') ?: $agent->typetitresejour}}"> --}}
                            @error('typetitresejour')
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                            @enderror
                        </div>
                        <div class="form-group lieudelivrancecs @error('lieudelivrancecs')  has-error @enderror" id="div_lieudelivrancecs" style="display: none">
                            <label>Lieu de délivrance de la carte de séjour</label>
                            <input name="lieudelivrancecs" type="text" class="form-control"  placeholder="Entrer le lieux de délivrance de la carte" value="{{old('lieudelivrancecs') ?: $agent->lieudelivrancecs}}">
                            @error('lieudelivrancecs')
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                            @enderror
                        </div>
                        <div class="form-group etablissementcartedesejour @error('etablissementcartedesejour')  has-error @enderror" id="div_etablissementcartedesejour" style="display: none">
                            <label>Date d'etablissement de la carte de séjour</label>
                            <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" name="etablissementcartedesejour" class="form-control pull-right" id="datepicker" value="{{old('etablissementcartedesejour') ?: $agent->etablissementcartedesejour}}">
                            </div>
                            <!-- /.input group -->
                            @error('etablissementcartedesejour')
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                            @enderror
                        </div>
                        <div class="form-group expirationcartedesejour @error('expirationcartedesejour')  has-error @enderror" id="div_expirationcartedesejour" style="display: none">
                            <label>Date d'expiration de la carte de séjour</label>
                            <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" name="expirationcartedesejour" class="form-control pull-right" id="datepicker" value="{{old('expirationcartedesejour') ?: $agent->expirationcartedesejour}}">
                            </div>
                            <!-- /.input group -->
                            @error('expirationcartedesejour')
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                            @enderror
                        </div>
                        <div class="form-group numeross @error('numeross')  has-error @enderror" >
                            <label>Numéro de sécurité sociale</label>
                            <input name="numeross" type="text" class="form-control"  placeholder="Entrer le numéro de sécurité sociale" value="{{old('numeross') ?: $agent->numeross}}">
                            @error('numeross')
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                            @enderror
                        </div>
{{--                        <div class="form-group caf @error('caf')  has-error @enderror" >--}}
{{--                            <label>N° CAF</label>--}}
{{--                            <input name="caf" type="text" class="form-control" value="{{old('caf') ?: $agent->caf}}">--}}
{{--                            @error('caf')--}}
{{--                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
                    </div>

                </div>
            </div>
        </div>

        <div style="overflow:auto;margin-right: 26px">
            <div style="float:right;">
                <button type="button" class="btn btn-flat btn-primary btn_customer_red  precedent" id="nextBtn">Etape Précédente</button>
                <button type="button" class="btn btn-flat btn-primary suivant" data-route="{{ route('agent.addVerification') }}" data-type="form_3">Etape Suivante</button>
            </div>
        </div>

        <div style="text-align:center;margin-top:40px;">
            <span class="step finish"></span>
            <span class="step finish"></span>
            <span class="step active"></span>
            <span class="step"></span>
            <span class="step"></span>
        </div>
    <!-- /.box-body -->
    </div>
</div>
{{-- 
<script type="text/javascript">
    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
    });

    $('.btn-file :file').on('fileselect', function(event, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
            log = label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
    
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#img-upload').attr('src', e.target.result);
                $('#img-upload').css('height','200px');

            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function(){
        readURL(this);
    });   
</script> --}}