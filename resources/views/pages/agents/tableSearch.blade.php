@section('content')
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
                  <th>Département</th>
                  <th>Statut</th>
                  <th>Contact</th>
                  <th>Action</th>
                </tr>
                @if(count($agents)>0)
                  
                  @foreach($agents as $key => $agent)
                    <tr>
                      <td>{{$key + 1}}</td>
                      <td>{{$agent->nom.' '.$agent->prenoms}}</td>
                      <td>{{$agent->email}}</td>
                      <td>{{$agent->email}}</td>
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
                        <a href="{{route('planning.show_planning_agent',$agent)}}" class="label label-primary"><i class="fa fa fa-street-view" data-toggle="tooltip" data-placement="bottom" title="Planning"></i></a>
                        {{-- <span data-toggle="modal" data-link="{{route('agent.destroy',$agent->id)}}" data-target="#modal-delete-element" data-div_refresh="div_site_table" > --}}
                          <a href="{{route('planning.delete_planning_agent', $agent)}}" class="label label-danger" data-div_refresh="div_site_table" data-toggle="tooltip" data-placement="bottom" title="Supprimer"><i class="fa fa fa-trash"></i></a>
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
              <br>
              <br>
@endsection