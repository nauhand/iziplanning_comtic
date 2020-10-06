{{-- Form 2 --}}
<div class="box-body form-block hide">
    <div class="box-group" id="accordion">
    <!-- One "tab" for each step in the form: -->

        <div class="tab">
            <div class="box-header with-border">
            <h4 class="box-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                Coordonnées  #2
                </a>
            </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse">
            <div class="box-body">
                <div class="col-md-6">
                <div class="form-group adressegeo @error('adressegeo')  has-error @enderror">
                    <label>Adresse géographique</label>
                    <input name="adressegeo" type="text" class="form-control"  placeholder="Entrer l'adresse géographique" value="{{old('adressegeo') ?: $agent->adressegeo}}">
                    @error('adressegeo')
                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                    @enderror
                </div>
                <div class="form-group codepostal @error('codepostal') has-error @enderror">
                    <label>Code postal</label>
                    <input name="codepostal" type="text" class="form-control"  placeholder="Entrer le code postal" value="{{old('codepostal') ?: $agent->codepostal}}">
                    @error('codepostal')
                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                    @enderror
                </div>
                <div class="form-group ville @error('ville') has-error @enderror">
                    <label>Ville</label>
                    <input name="ville" type="text" class="form-control" placeholder="Ville" value="{{old('ville') ?: $agent->ville}}">
                    @error('ville')
                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                    @enderror
                </div>
                {{-- <div class="form-group adressegeo @error('adressegeo')  has-error @enderror">
                    <label>Adresse géographique</label>
                    <input name="adressegeo" type="text" class="form-control"  placeholder="Entrer l'adresse géographique" value="{{old('adressegeo') ?: $agent->adressegeo}}">
                    @error('adressegeo')
                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                    @enderror
                </div> --}}
                <div class="form-group">
                    <label>Département</label>
                    <select class="form-control  departement_id" name="departement">
                    <option value="">Choisir le département</option>
                    @if(count($departements)>0)
                        @foreach($departements as $departement)
                        <option value="{{$departement->id}}" {{old('departement_id')==$departement->id || $agent->departement_id==$departement->id ? 'selected' : null}}>{{$departement->nom}}</option>
                        @endforeach
                    @endif
                    @error('departement_id')
                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                    @enderror
                    </select>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group numeromobile @error('numeromobile')  has-error @enderror">
                    <label>Numéro Mobile (*)</label>
                    <input name="numeromobile" type="tel" minlength="13" maxlength="13" class="form-control"  placeholder="Entrer le numéro mobile" value="{{old('numeromobile') ?: $agent->numeromobile}}" required>
                    @error('numeromobile')
                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                    @enderror
                </div>
                <div class="form-group numerofixe @error('numerofixe')  has-error @enderror">
                    <label>Numéro Fixe</label>
                    <input name="numerofixe" type="tel" class="form-control"  placeholder="Entrer le numéro fixe" value="{{old('numerofixe') ?: $agent->numerofixe}}">
                    @error('numerofixe')
                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                    @enderror
                </div>
                <div class="form-group email @error('email')  has-error @enderror">
                    <label>Adresse Mail</label>
                    <input name="email" type="text" class="form-control"  placeholder="Entrer l'adresse mail" value="{{old('email') ?: $agent->email}}">
                    @error('email')
                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                    @enderror
                </div>
                </div>
            </div>
            </div>
        </div>
{{--        .btn_customer_red {--}}
{{--        background: red ;--}}
{{--        border: 0 solid red ;--}}
{{--        }--}}
{{--        .btn_customer_green{--}}
{{--        background: green ;--}}
{{--        border: 0 solid red ;--}}
{{--        }--}}

        <div style="overflow:auto;margin-right: 26px">
            <div style="float:right;">
                <button type="button" class="btn btn-flat btn-primary  btn_customer_red  precedent">Etape Précédente</button>
                <button type="button" class="btn btn-flat btn-primary suivant" data-route="{{ route('agent.addVerification') }}" data-type="form_2">Etape Suivante</button>
            </div>

            <div style="text-align:center;margin-top:40px;">
            <span class="step finish"></span>
            <span class="step active"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            </div>
        <!-- /.box-body -->
        </div>
    </div>
</div>