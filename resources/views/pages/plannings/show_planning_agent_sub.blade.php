
    @forelse ($plannings as $planning)
        <p class="text-center">Planning définitif de l'agent <b>{{ strtoupper($planning->agent->nom . ' ' .$planning->agent->prenoms)  }}</b></p>
        @break
        {{-- <li>{{ $user->name }}</li> --}}
        @empty
        <p>Aucun agent selectionné</p>
    @endforelse
    
<button class="col-xs-1 btn btn-success" id="pdf" title="Générer PDF">PDF</button>
<button class="col-xs-1 btn btn-primary" id="excel" title="Générer Excel" style="margin-left:5px;">Excel</button>


<table class="table table-hover" style="padding-bottom: 200px">

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

    @forelse($plannings as $key => $planning)
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
    @empty
        <tr>
            <td colspan="7"><p class="text-center">Aucun planning ajouté pour le moment</p></td>
        </tr>
    @endforelse

</table>
<br>
<br>