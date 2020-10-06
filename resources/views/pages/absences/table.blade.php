                                         
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
            {{-- <a href="{{ route('agent.agentAbsent') }}" target="_blank" class="btn btn-primary">PDF</a> --}}
              <table class="table table-hover">
                <tr>
                  <th>N°</th>
                  <th>Nom & Prénoms</th>
                  <th>Type d'absence</th>
                  <th>Date de début</th>
                  <th>Date de fin</th>
                  <th>Date de Modification</th>
                  {{-- <th>Action</th> --}}
                </tr>
                @forelse($absences as $key => $absence)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{$absence->agent->nom.' '.$absence->agent->prenoms}}</td>
                    <td>{{ mb_convert_case($absence->typeconge, MB_CASE_TITLE, "UTF-8") }}</td>
                    {{-- <td>{{ $absence->typeconge }}</td> --}}
                    <td>{{ ucfirst(\Carbon\Carbon::parse($absence->date_debut)->locale('fr_FR')->isoFormat('ddd DD, MM YYYY')) }}</td>
                    <td>{{ ucfirst(\Carbon\Carbon::parse($absence->date_fin)->locale('fr_FR')->isoFormat('ddd DD, MM YYYY')) }}</td>
                    <td>{{ ucfirst(\Carbon\Carbon::parse($absence->updated_at)->locale('fr_FR')->isoFormat('ddd DD, MM YYYY')) }}</td>
                    <td>
                      <a href="{{route('absence.edit',$absence->id)}}" class="label label-primary"  data-toggle="tooltip" data-placement="bottom" title="Afficher"><i class="fa fa-eye"></i></a>
                      <a href="{{route('absence.edit',$absence->id)}}" class="label label-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="bottom" title="Modifier"></i></a>
                      <span data-toggle="modal" data-link="{{route('absence.destroy',$absence->id)}}"   data-target="#modal-delete-element" data-div_refresh="div_absence_table" >
                        <a href="#" class="label label-danger" data-div_refresh="div_absence_table" data-toggle="tooltip" data-placement="bottom" title="Supprimer"><i class="fa fa fa-trash"></i></a>
                      </span>
                    </td>
                    {{-- <td>1</td> --}}
                  </tr>
                @empty
                  <tr>
                    <td colspan="7"><p class="text-center">Aucune absence enrégistrée pour le moment</p></td>
                  </tr>
                @endforelse
              </table>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>