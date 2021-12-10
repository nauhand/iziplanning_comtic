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