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
              <div class="form-group">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="ads" id="same" class="check">
                   ADS
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="maitrechien" id="same" class="check">
                    Maitre chien
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="ssiap1" class="check">
                    SSIAP1
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="ssiap2" class="check">
                    SSIAP2
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="chefequipe" class="check">
                    Chef d'équipe
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="superviseur" class="check">
                    Superviseur
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="commercial" class="check">
                    Commercial
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="agentcontrole" class="check">
                    Agent de contôle
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="assitanceRh" class="check">
                    Assistance RH
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="responsableRh" class="check">
                    Responsable RH
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="comptable_assistant" class="check">
                    Assistance comptable
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="comptable" class="check">
                    comptable
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="comptable_expert" class="check">
                    Expert Comptable
                  </label>
                </div>
              </div>
              <div class="form-group dateentree @error('dateentree')  has-error @enderror">
                <label>Date d'entré (*)</label>
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
                @error('dureeducontrat')
                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                @enderror
              </div>
              <div class="form-group numerocartepro @error('numerocartepro')  has-error @enderror">
                <label> Numéro carte professionnelle (*)</label>
                <input name="numerocartepro" type="text" class="form-control"  placeholder="Entrer le numéro de la carte professionnelle" value="{{old('numerocartepro') ?: ''}}">
                @error('numerocartepro')
                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                @enderror
              </div>
              <div class="form-group numeroads @error('numeroads')  has-error @enderror" id="div_numeroads" hidden>
                <label> Numéro ADS (*)</label>
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
          <button type="button" class="btn btn-flat btn-primary precedent">Etape Précédente</button>
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
  