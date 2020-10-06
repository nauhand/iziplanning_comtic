{{-- Forme 4 --}}
<div class="box-body form-block hide">
  <div class="box-group" id="accordion"></div>

    <div class="tab">
      <div class="box-header with-border">
        <h4 class="box-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
            Emploi et qualification  #4
          </a>
        </h4>
      </div>
      <div id="collapseThree" class="panel-collapse">
        <div class="box-body">
          <div class="col-md-6">
            <div class="form-group typecontrat @error('typecontrat')  has-error @enderror">
              <label>Type de Contrat (*)</label>
              <select class="form-control" name="typecontrat" required>
                <option value="">Choisir le contrat</option>
                <option value="cdi" {{old('typecontrat')=='cdi' || $agent->typecontrat=='cdi' ? 'selected' : null}}>CDI</option>
                <option value="cdd" {{old('typecontrat')=='cdd' || $agent->typecontrat=='cdd' ? 'selected' : null}}>CDD</option>
                <option value="interim" {{old('typecontrat')=='interim' || $agent->typecontrat=='interim' ? 'selected' : null}}>Intérim</option>
                <option value="essai" {{old('typecontrat')=='essai' || $agent->typecontrat=='essai' ? 'selected' : null}}>Essai</option>
              </select>
              @error('typecontrat')
                  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
              @enderror
            </div>
            <!-- checkbox -->
            <div class="form-group diplome[] @error('diplome') has-error @enderror" id="diplome">
              <label>Diplôme</label>
              <select name="categoriepermis[]" class="form-control select2" multiple="multiple" data-placeholder="" style="width: 100%;">
                <option value="ads" {{in_array('ads',old('diplome') ?: array()) ? 'selected' : null}}>ADS</option>
                <option value="maitrechien" {{in_array('maitrechien',old('diplome') ?: array()) ? 'selected' : null}}> Maitre chien</option>
                <option value="ssiap1" {{in_array('ssiap1',old('diplome') ?: array()) ? 'selected' : null}}> SSIAP1</option>
                <option value="ssiap2" {{in_array('ssiap2',old('diplome') ?: array()) ? 'selected' : null}}> SSIAP2</option>
                <option value="chefequipe" {{in_array('chefequipe',old('diplome') ?: array()) ? 'selected' : null}}>Chef d'équipe</option>
                <option value="superviseur" {{in_array('superviseur',old('diplome') ?: array()) ? 'selected' : null}}>Superviseur</option>
                <option value="commercial" {{in_array('commercial',old('diplome') ?: array()) ? 'selected' : null}}> Commercial</option>
                <option value="agentcontrole" {{in_array('agentcontrole',old('diplome') ?: array()) ? 'selected' : null}}> Agent de contôle </option>
                <option value="assitanceRh" {{in_array('assitanceRh',old('diplome') ?: array()) ? 'selected' : null}}>Assistance RH</option>
                <option value="responsableRh" {{in_array('responsableRh',old('diplome') ?: array()) ? 'selected' : null}}>Responsable RH</option>
                <option value="comptable_assistant" {{in_array('comptable_assistant',old('diplome') ?: array()) ? 'selected' : null}}> Assistance comptable</option>
                <option value="comptable" {{in_array('comptable',old('diplome') ?: array()) ? 'selected' : null}}>comptable</option>
                <option value="comptable_expert" {{in_array('comptable_expert',old('diplome') ?: array()) ? 'selected' : null}}> Expert Comptable</option>
              </select>
              @error('diplome')
              <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
              @enderror
            </div>


            <div class="form-group dateentree @error('dateentree')  has-error @enderror">
              <label>Date d'entrée (*)</label>
              <input name="dateentree" type="date" class="form-control" placeholder="Entrer le(s) Prénom(s)" value="{{old('dateentree') ?: $agent->dateentree}}" required>
              @error('dateentree')
              <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
              @enderror
          </div>
          <div class="form-group datelimitecarteproffess @error('datelimitecarteproffess')  has-error @enderror">
            <label>Date limite carte professionnelle (*)</label>
            <input name="datelimitecarteproffess" type="date" class="form-control" placeholder="Entrer le(s) Prénom(s)" value="{{old('datelimitecarteproffess') ?: $agent->datelimitecarteproffess}}" required>
            @error('datelimitecarteproffess')
            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
            @enderror
        </div>
          </div>
          <div class="col-md-6">
            <div class="form-group dureeducontrat @error('dureeducontrat')  has-error @enderror" id="div_dureeducontrat" style="display: none;">
              <label>Durée du Contrat (*)</label>
              <input type="number" class="form-control" {{old('dureeducontrat')}} name="dureeducontrat" placeholder="mois">

              {{-- <select class="form-control" name="dureeducontrat">
                <option value="">Choisir la durée</option>
                <option value="3mois" {{old('dureeducontrat')=='3mois' || $agent->dureeducontrat=='3mois' ? 'selected' : null}}>3 Mois</option>
                <option value="6mois" {{old('dureeducontrat')=='6mois' || $agent->dureeducontrat=='6mois' ? 'selected' : null}}>6 Mois</option>
                <option value="1ans" {{old('dureeducontrat')=='1ans' || $agent->dureeducontrat=='1ans' ? 'selected' : null}}>1 ans</option>
                <option value="2ans" {{old('dureeducontrat')=='2ans' || $agent->dureeducontrat=='2ans' ? 'selected' : null}}>2 ans</option>
              </select> --}}
              @error('dureeducontrat')
                  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
              @enderror
            </div>
            <div class="form-group cartepro @error('cartepro')  has-error @enderror" >
              <label> Numéro de carte professionnelle </label>
              <input name="cartepro" type="text" class="form-control"  placeholder="Entrer le numéro de la carte professionnelle" value="{{old('cartepro') ?: $agent->cartepro}}">
              @error('cartepro')
              <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
              @enderror
            </div>
            <div class="form-group numeroads @error('numeroads')  has-error @enderror" hidden>
              <label> ADS (*)</label>
              <input name="numeroads" type="text" class="form-control"  placeholder="Entrer le numéro de la carte professionnelle" value="{{old('numeroads') ?: $agent->numeroads}}">
              @error('numeroads')
                  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
              @enderror
            </div>
            <div class="form-group nomchien @error('nomchien')  has-error @enderror" id="div_nomchien" hidden>
              <label>Nom du chien (*)</label>
              <input name="nomchien" type="text" class="form-control"  placeholder="Entrer le nom du chien" value="{{old('nomchien') ?: $agent->nomchien}}">
              @error('nomchien')
                  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
              @enderror
            </div>
            <div class="form-group datevaliditevaccin @error('datevaliditevaccin')  has-error @enderror" id="div_datevaliditevaccin" hidden>
              <label>Date de validité du vaccin (*)</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="date" name="datevaliditevaccin" class="form-control pull-right" id="datepicker" value="{{old('datevaliditevaccin') ?: $agent->datevaliditevaccin}}">
              </div>
              <!-- /.input group -->
              @error('datevaliditevaccin')
                  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
              @enderror
            </div>
          </div>
        </div>
      </div>
    </div>

    <div style="overflow:auto;margin-right: 26px">
      <div style="float:right;">
        <button type="button" class="btn btn-flat btn-primary btn_customer_red  precedent">Etape Précédente</button>
        <button type="button" class="btn btn-flat btn-primary suivant" data-route="{{ route('agent.addVerification') }}" data-type="form_4">Etape Suivante</button>
      </div>
    </div>

    <div style="text-align:center;margin-top:40px;">
      <span class="step finish"></span>
      <span class="step finish"></span>
      <span class="step finish"></span>
      <span class="step active"></span>
      <span class="step"></span>
    </div>
  <!-- /.box-body -->
</div>