            @php
              use Carbon\Carbon;
            @endphp
            {{-- {{dd(\Session::all())}} --}}
            @extends('pages.agents.create.layout')
            @section('tab')
              <!-- form start -->
              <form id="regForm" role="form" action="{{route('agent.postStepOne')}}" method="post">
              @csrf
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="box-group" id="accordion">
                    <!-- One "tab" for each step in the form: -->

                    <div class="tab">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            Identité  #1
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse">
                        <div class="box-body">
                          <div class="col-md-6">
                            <div class="form-group civilite @error('civilite')  has-error @enderror">
                              <label>Civilité</label>
                              <select class="form-control" name="civilite">
                                <option value="">Choisir le genre</option>
                                <option value="M" {{old('civilite')=='M' || $agent->civilite=='M' ? 'selected' : null}}>Monsieur</option>
                                <option value="Mll" {{old('civilite')=='Mll' || $agent->civilite=='Mll' ? 'selected' : null}}>Mademoiselle</option>
                                <option value="Mme" {{old('civilite')=='Mme' || $agent->civilite=='Mme' ? 'selected' : null}}>Madame</option>
                              </select>
                              @error('civilite')
                                  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                              @enderror
                            </div>
                            <div class="form-group nom @error('nom')  has-error @enderror">
                              <label>Nom</label>
                              <input name="nom" type="text" class="form-control"  placeholder="Entrer le nom" value="{{old('nom') ?: $agent->nom}}">
                              @error('nom')
                                  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                              @enderror
                            </div>
                            <div class="form-group datenaissance @error('datenaissance')  has-error @enderror">
                              <label>Date de naissance:</label>
                              <div class="input-group date">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <input type="date" name="datenaissance" class="form-control pull-right" id="datepicker" max="{{Carbon::now()->addYear(-18)->toDateString()}}" value="{{old('datenaissance') ?: $agent->datenaissance}}">
                              </div>
                              <!-- /.input group -->
                              @error('datenaissance')
                                  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                              @enderror
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group statutmatrimonial @error('statutmatrimonial')  has-error @enderror">
                              <label>Statut Matrimonial</label>
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
                              <label>Prénoms</label>
                              <input name="prenoms" type="text" class="form-control"  placeholder="Entrer le(s) Prénom(s)" value="{{old('prenoms') ?: $agent->prenoms}}">
                              @error('prenoms')
                                  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</label>
                              @enderror
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>

                    <div style="overflow:auto;margin-right: 26px">
                      <div style="float:right;">
                        <button type="button" class="btn btn-flat btn-primary" id="nextBtn" onclick="submitForm('regForm')">Etape Suivante</button>
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
                <!-- /.box-body -->
              </form>
            @endsection