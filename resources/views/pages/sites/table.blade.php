              @php
                use Carbon\Carbon;
              @endphp
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
                  <th>N°</th>
                  <th>Etablissement</th>
                  <th>Ville</th>
                  <th>Contact</th>
                  <th>Date d'ajout</th>
                  <th>Action</th>
                </tr>
                
                @if(count($sites)>0)
                @php ( $nombreElement = $sites->count() * $sites->currentPage() - $sites->count() )
                @foreach($sites as $key => $site)
                  <tr>
                    <td>{{$nombreElement + $key + 1}}</td>
                      <td style="width: 350px;"><a href="{{route('planning.index_definitives_by_site', $site->id)}}">{{$site->nom.' '.$site->prenoms}}</a></td>
                      <td style="width: 150px;">{{$site->ville}}</td>
                      <td>{{$site->telephone}}</td>
                      <td>{{Carbon::parse($site->created_at)->format('d/m/Y')}}</td>
                      <td>
                        <a href="{{route('site.edit',$site->id)}}" class="label label-primary"  data-toggle="tooltip" data-placement="bottom" title="Afficher"><i class="fa fa-eye"></i></a>
                        <a href="{{route('site.edit',$site->id)}}" class="label label-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="bottom" title="Modifier"></i></a>
                        <a href="{{route('site.edit',$site->id)}}" class="label label-primary"><i class="fa fa fa-street-view" data-toggle="tooltip" data-placement="bottom" title="Planning"></i></a>
                        <span data-toggle="modal" data-link="{{route('site.destroy',$site->id)}}"   data-target="#modal-delete-element" data-div_refresh="div_site_table" >
                          <a href="#" class="label label-danger"  data-div_refresh="div_site_table" data-toggle="tooltip" data-placement="bottom" title="Supprimer"><i class="fa fa fa-trash"></i></a>
                        </span>
                        <a href="{{route('site.excel', ['id' => $site->id])}}" target="_blank" class="label label-success" data-div_refresh="div_site_table" data-toggle="tooltip" data-placement="bottom" title="Excel"><i class="fa fa-file-excel-o"></i></a>
                        <a href="{{route('site.pdf', ['id' => $site->id])}}"   target="_blank"  class="label label-danger" data-div_refresh="div_site_table" data-toggle="tooltip" data-placement="bottom" title="PDF"><i class="fa fa-file-pdf-o"></i></a>
                      </td> 
                      {{-- <td>
                        <div class="input-group input-group-sm">
                          <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-warning">Action</button>
                            <button type="button" class="btn btn-sm btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                              <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu menu">
                              <li><a href="{{route('site.edit',$site->id)}}">Afficher</a>
                              </li>
                              <li><a href="{{route('site.edit',$site->id)}}">Modifier</a></li>
                              <li><a href="#">Planning</a></li>
                              <li class="divider"></li>
                              <li><a href="#" data-link="{{route('site.destroy',$site->id)}}"  class="text-red"  data-div_refresh="div_site_table" data-toggle="modal" data-target="#modal-delete-element">Supprimer</a></li>
                            </ul>
                          </div>
                        </div>
                      </td>  --}}               
                    </tr>
                  @endforeach
                @else
                  <tr>
                    <td colspan="6"><p class="text-center">Aucun site enrégistré pour le moment</p></td>
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
              <div class="d-flex flex-row-reverse">
                  {{$sites->links()}}
              </div>