                                        
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


              <table class="table table-hover">
                <tr>
                  <th></th>
                  <th>Nom & Prénoms</th>
                  <th>Email</th>
                  <th>Type contrat</th>
                  <th>Statut</th>
                  <th>Contact</th>
                  <th>Action</th>
                </tr>
                @if(count($agents)>0)
                  @php ( $nombreElement = $agents->count() * $agents->currentPage() - $agents->count() )
                  
                  @foreach($agents as $key => $agent)
                    <tr>
                      <td>{{$nombreElement + $key + 1}}</td>
                    <td>{{$agent->nom.' '.$agent->prenoms}}</td>
                      <td>{{$agent->email}}</td>
                      <td>{{$agent->typecontrat}}</td>
                      <td>
                        @if($agent->statut==='deploye')
                          <span class="label label-success">planifié</span>
                        @else
                          <span class="label label-warning">disponible</span>
                        @endif
                      </td>
                      <td>{{$agent->numeromobile}}</td>
                      <td>
                        <a href="{{route('agent.edit',$agent->id)}}" class="label label-primary"  data-toggle="tooltip" data-placement="bottom" title="Afficher"><i class="fa fa-eye"></i></a>
                        <a href="{{route('agent.edit',$agent->id)}}" class="label label-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="bottom" title="Modifier"></i></a>
                          <a href="{{route('planning.delete_planning_agent', $agent->id)}}" class="label label-danger" data-div_refresh="div_site_table" data-toggle="tooltip" data-placement="bottom" title="Supprimer"><i class="fa fa fa-trash"></i></a>
                          <a href="{{route('agent.excle_agent', $agent->id)}}" target="_blank" class="label label-success" data-div_refresh="div_site_table" data-toggle="tooltip" data-placement="bottom" title="Excel"><i class="fa fa-file-excel-o"></i> | EXCEL</a>
                          <a href="{{route('agent.pdf_agent', $agent->id)}}"   target="_blank"  class="label label-danger" data-div_refresh="div_site_table" data-toggle="tooltip" data-placement="bottom" title="PDF"><i class="fa fa-file-pdf-o"></i> | PDF</a>
                        {{-- </span> --}}
                      </td>  
                    </tr>
                  @endforeach
                @else
                  <tr>
                    <td colspan="7"><p class="text-center">Aucun agents enrégistré pour le moment</p></td>
                  </tr>
                @endif
              </table>
              <br>
              <br>
              <br>
              <br>
              <br>
              <div class="d-flex flex-row-reverse">
                {{$agents->links()}}
              </div>
              <br>
              <br>
              