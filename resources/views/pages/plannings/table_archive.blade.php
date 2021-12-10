@if (!$general)
    @forelse ($plannings as $planning)
        <p class="text-center">Planning archivée de l'agent <b>{{ strtoupper($planning->agent->nom . ' ' .$planning->agent->prenoms)  }}</b></p>
        @break
        {{-- <li>{{ $user->name }}</li> --}}
        @empty
        <p>Aucun agent selectionné</p>
    @endforelse
@endif
{{-- <button class="col-xs-1 btn btn-success" id="pdf" title="Générer PDF">PDF</button>
<button class="col-xs-1 btn btn-primary" id="excel" title="Générer Excel" style="margin-left:5px;">Excel</button> --}}
@if (!$general)
    <button class="col-xs-1 btn btn-danger" id="retourArchive" title="Précédent" style="margin-left:5px;">Retour</button>
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
                    <td>{{ $planning->agent->nom.' '.$planning->agent->prenoms }}</td>
                    <td>{{ $planning->agent->qualification }}</td>
                    <td>{{ $planning->heure_total_jour + $planning->heure_total_nuit }}</td>
                    <td>{{ $planning->heure_total_nuit }}</td>

                    <td>
                        <a class="label label-primary afficher" data-idagent='{{ $planning->agent_id }}' data-toggle="tooltip" data-placement="bottom" title="Afficher"><i class="fa fa-eye"></i></a>
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
            <th>Statut</th>
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
                    <td>{{ strtoupper($planning->statut) }}</td>
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