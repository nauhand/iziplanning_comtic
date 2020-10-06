@if (!$general)
    @forelse ($plannings as $planning)
        <p class="text-center">Planning définitif de l'agent <b>{{ strtoupper($planning->agent->nom . ' ' .$planning->agent->prenoms)  }}</b></p>
        @break
        {{-- <li>{{ $user->name }}</li> --}}
        @empty
        <p>Aucun agent selectionné</p>
    @endforelse
@endif
{{-- @if (Request::url() === route('planning.index_definitives'))

@endif --}}
@if (!$general)
    <div class="box-header">
        
        <div class="box-tools" style="margin-right: 30px">
            <div class="input-group input-group-sm hidden-xs" style="width: 30px;">
            <a class="btn btn-sm btn-social btn-vk generer-pdfIndiv" data-id="{{$plannings[0]->agent_id}}" data-pdfroute=" {{ route('planning.defIndivPdf') }} " target="_blank">
                <i class="fa fa-file-pdf-o BTN-VK"></i> Générer PDF
            </a>
            </div>
        </div>
        <div class="box-tools" style="margin-right: 30px">
            <div class="input-group input-group-sm hidden-xs" style="width: 30px;">
            <a class="btn btn-sm btn-social btn-vk generer-excelIndiv" data-excelroute=" {{ route('excel.planningDefIndiv') }} " data-id="{{$plannings[0]->agent_id}}" target="_blank">
                <i class="fa fa-file-excel-o BTN-VK"></i> Générer EXCEL
            </a>
            </div>
        </div>
        <button class="col-xs-1 btn btn-danger" id="retour" title="Précédent" style="margin-left:5px;">Retour</button>
        
    </div>
    {{-- <a class="col-xs-1 btn btn-success" href=" {{ route('planning.defIndivPdf', $plannings[0]->agent_id) }} " target="_blank" id="pdf" title="Générer PDF">PDF</a> --}}
    {{-- <a href="{{ route('excel.planningDefIndiv', $plannings[0]->agent_id) }}" target="_blank" class="col-xs-1 btn btn-primary" id="excel" title="Générer Excel" style="margin-left:5px;">Excel</a> --}}
    {{-- <button class="col-xs-1 btn btn-danger" id="retour" title="Précédent" style="margin-left:5px;">Retour</button> --}}
@else
    <div class="box-header">

        <div class="box-tools" style="margin-right: 30px">
            <div class="input-group input-group-sm hidden-xs" style="width: 30px;">
            <a class="btn btn-sm btn-social btn-vk generer-pdf" data-pdfroute=" {{ route('planning.defGeneralPdf') }} " target="_blank">
                <i class="fa fa-file-pdf-o BTN-VK"></i> Générer PDF
            </a>
            </div>
        </div>
        <div class="box-tools" style="margin-right: 30px">
            <div class="input-group input-group-sm hidden-xs" style="width: 30px;">
            <a class="btn btn-sm btn-social btn-vk generer-excel" data-excelroute=" {{ route('excel.planningDef') }} " target="_blank">
                <i class="fa fa-file-excel-o BTN-VK"></i> Générer EXCEL
            </a>
            </div>
        </div>

    </div>
    {{-- <a class="col-xs-1 btn btn-success" href=" {{ route('planning.defGeneralPdf') }} " target="_blank" id="pdf" title="Générer PDF">PDF</a>
    <a href="{{ route('excel.planningDef') }}" class="col-xs-1 btn btn-primary" id="excel" title="Générer Excel" style="margin-left:5px;">Excel</a> --}}
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
<table class="table table-hover" style="padding-bottom: 200px">
    @if ($general)

        <tr>
            <th>N°</th>
            <th>Nom & Prénoms</th>
            <th>Qualification</th>
            <th>Heure Total</th>
            <th>Heure de Nuit</th>
            <th>Action</th>
        </tr>

        @if(count($plannings)>0)
            @foreach($plannings as $key => $planning)
                <tr>

                    <td>{{ $key+1 }}</td>
                    <td><a href="{{ route('planning.defIndivPdf', $planning->agent_id) }}" title="Générer le PDF" target="_blank">{{ $planning->agent->nom.' '.$planning->agent->prenoms }}</a></td>
                    <td>{{ $planning->agent->qualification }}</td>
                    <td>{{ $planning->heure_total_jour + $planning->heure_total_nuit }}</td>
                    <td>{{ $planning->heure_total_nuit }}</td>

                    <td>
                        <a class="label label-primary afficher" data-agent='{{ $planning->agent_id }}' data-toggle="tooltip" data-placement="bottom" title="Afficher"><i class="fa fa-eye"></i></a>
                    </td>        

                </tr>
            @endforeach
        @else
        <tr>
            <td colspan="7"><p class="text-center">Aucun planning ajouté pour le moment</p></td>
        </tr>
        @endif

    @else

        <tr>
            <th>N°</th>
            <th>Nom & Prénoms</th>
            <th>Site</th>
            <th>Date</th>
            <th>Heure début</th>
            <th>Heure fin</th>
            <th>Heure pause</th>
            <th>Heure Total</th>
            <th>Heure de Nuit</th>
        </tr>

        @if(count($plannings)>0)
            @foreach($plannings as $key => $planning)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ ucfirst($planning->agent->nom.' '.$planning->agent->prenoms) }}</td>
                    <td>{{ $planning->site->nom }}</td>
                    <td>{{ ucfirst(\Carbon\Carbon::parse($planning->date_debut)->locale('fr_FR')->isoFormat('ddd  DD, MM YYYY')) }}</td>
                    <td>{{ $planning->heure_debut }}</td>
                    <td>{{ $planning->heure_fin }}</td>
                    <td>{{ $planning->pause }}</td>
                    <td>{{ $planning->heure_total_jour + $planning->heure_total_nuit }}</td>
                    <td>{{ $planning->heure_total_nuit }}</td>             
                </tr>
            @endforeach
        @else
        <tr>
            <td colspan="7"><p class="text-center">Aucun planning ajouté pour le moment</p></td>
        </tr>
        @endif

    @endif

    {{-- <tr>
    <th>N°</th>
    <th>Nom & Prénoms</th>
    <th>Contact</th>
    <th>Heure Total</th>
    <th>Heure Nuit</th>
    @if ($general)
        <th>Action</th>
    @endif
    </tr>
    @if(count($plannings)>0)
        @if ($general)

            @foreach($plannings as $key => $planning)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $planning->agent->nom.' '.$planning->agent->prenoms }}</td>
                    <td>{{ $planning->agent->numeromobile }}</td>
                    <td>{{ $planning->heure_total_jour + $planning->heure_total_nuit }}</td>
                    <td>{{ $planning->heure_total_nuit }}</td>
                    <td>
                        <a class="label label-primary afficher" data-agent='{{ $planning->agent_id }}' data-toggle="tooltip" data-placement="bottom" title="Afficher"><i class="fa fa-eye"></i></a>
                    </td>                
                </tr>
            @endforeach
            
        @else

            @foreach($plannings as $key => $planning)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $planning->agent->nom.' '.$planning->agent->prenoms }}</td>
                    <td>{{ $planning->agent->numeromobile }}</td>
                    <td>{{ $planning->heure_total_jour + $planning->heure_total_nuit }}</td>
                    <td>{{ $planning->heure_total_nuit }}</td>
                </tr>
            @endforeach

        @endif

    @else
    <tr>
        <td colspan="7"><p class="text-center">Aucun planning ajouté pour le moment</p></td>
    </tr>
    @endif --}}
</table>
<br>
<br>