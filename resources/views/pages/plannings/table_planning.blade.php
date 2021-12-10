              @if (!$general)
              @forelse ($plannings as $planning)
                <p class="text-center">Planning provisoire de l'agent <b>{{ strtoupper($planning->agent->nom . ' ' .$planning->agent->prenoms)  }}</b></p>
                @break
                {{-- <li>{{ $user->name }}</li> --}}
              @empty
                <p>Aucun agent selectionné</p>
              @endforelse
              
                {{-- <p class="text-center">Planning provisoire de l'agent {{ $planning[0]->agent->nom  }}</p> --}}
                {{-- <button class="col-xs-1 btn btn-danger" id="retour">Retour</button> --}}
                <div id="retour_provisoire">
                  <a href="{{ route('planning.index') }}" class="col-xs-1 btn btn-danger" style="margin:15px;">Retour</a>
                </div>
              @endif
              
              <div class="close">
                <div class="cs-loader">
                  <div class="cs-loader-inner">
                    <label> ●</label>
                    <label> ●</label>
                    <label> ●</label>
                    <label> ●</label>
                    <label> ●</label>
                    <label> ●</label>
                  </div>
                </div>
              </div>
              @if ($general)
              <table id="datatable1" class="table table-striped dt-responsive nowrap" style="padding-bottom: 200px">
                <thead>
                  <tr>
                    <th>Nom & Prénoms</th>
                    <th>Qualification</th>
                    <th>Heure Total</th>
                    <th>Heure de Nuit</th>
                    <th>Actions</th>
                  </tr> 
                </thead>
                
                  @if(count($plannings)>0)
                    @foreach($plannings as $planning)
                      <tr>
                        <td>{{ $planning->agent->nom.' '.$planning->agent->prenoms }}</td>
                        <td>{{ $planning->agent->qualification }}</td>
                        <td>{{ $planning->heure_total_jour + $planning->heure_total_nuit }}</td>
                        <td>{{ $planning->heure_total_nuit }}</span></td>

                        <td>
                          <a class="label label-primary afficher" data-agent='{{ $planning->agent_id }}' data-toggle="tooltip" data-placement="bottom" title="Afficher"><i class="fa fa-eye"></i></a>
                          {{-- <a class="label label-success valider" data-agent='{{ $planning->agent_id }}'><i class="fa fa-check" data-toggle="tooltip" data-placement="bottom" title="Validé"></i></a> --}}
                          <a class="label label-danger"><i class="fa fa-trash supprimer" data-agent='{{ $planning->agent_id }}' data-toggle="tooltip" data-placement="bottom" title="Supprimer"></i></a>
                        </td>        

                      </tr>
                    @endforeach
                  @endif
                  </table>
                  @else
                  <table id="datatable2" class="table table-striped dt-responsive nowrap" style="padding-bottom: 200px">
                  <thead>
                    <tr>
                      <th>Nom & Prénoms</th>
                      <th>Site</th>
                      <th>Date</th>
                      <th>Heure début</th>
                      <th>Heure fin</th>
                      <th>Heure pause</th>
                      <th>Heure Total</th>
                      <th>Heure de Nuit</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                
                  @if(count($plannings)>0)
                    @foreach($plannings as $planning)
                      <tr>
                        <td>{{ ucfirst($planning->agent->nom.' '.$planning->agent->prenoms) }}</td>
                        <td>{{ $planning->site->nom }}</td>
                        <td>{{ ucfirst(\Carbon\Carbon::parse($planning->date_debut)->locale('fr_FR')->isoFormat('ddd DD, MM YYYY')) }}</td>
                        <td>{{ $planning->heure_debut }}</td>
                        <td>{{ $planning->heure_fin }}</td>
                        <td>{{ $planning->pause }}</td>
                        <td>{{ $planning->heure_total_jour + $planning->heure_total_nuit }}</td>
                        <td>{{ $planning->heure_total_nuit }}</span></td>

                        <td>

                          <a class="label label-primary "><i class="fa fa-pencil modifier" data-id="{{ $planning->id }}" data-agent_id="{{ $planning->agent_id }}" data-agent_nom="{{ $planning->agent->nom }}" data-site_id="{{ $planning->site_id }}" data-site_nom="{{ $planning->site->nom }}" data-date_debut="{{ $planning->date_debut }}" data-heure_debut="{{ $planning->heure_debut }}" data-heure_fin="{{ $planning->heure_fin }}" data-heure_pause="{{ $planning->pause }}" data-toggle="tooltip" data-placement="bottom" title="Modifier"></i></a>
                          <a class="label label-danger"><i class="fa fa-trash supprimerIndividuel" data-agent='{{ $planning->id }}' data-toggle="tooltip" data-placement="bottom" title="Supprimer"></i></a>

                        </td>                
                      </tr>
                    @endforeach
                  @endif

                @endif
              </table>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>