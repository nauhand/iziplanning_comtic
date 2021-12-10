@php
    use Carbon\Carbon;
@endphp

        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title></title>
    {{-- <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}"> --}}
</head>
<style>
    *{
        /*font-size: 12px !important;*/
    }
</style>
<body>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" media="all">

<div class="container">
    <div class="row">
        {{-- Information de l'entreprise --}}
        <div class="col-md-4"></div>
        <div class="col-md-4 text-center">
            {{-- Image --}}
            <img src="{{ public_path('blacksecuritylogo2.jpg') }}" class="row" alt="">
            {{-- Nom de l'entreprise --}}
            <p style="font-size: 15px !important;"> <b style="font-size: 15px !important;"> BLACK SHIELD SECURITE </b> <br>
                La Protection et la Sécurité, notre métier <br>Tel: 01 41 38 68 11 </p>
        </div>
        <div class="col-md-4"></div>
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
        <div class="col-md-4 float-right" style="font-size: 14px !important; text-align: right;">
            {{ 'Paris le '. ucfirst(\Carbon\Carbon::now()->locale('fr_FR')->isoFormat('DD MMM YYYY')) }}
        </div>
    </div>
    {{-- Type du planning suivit de la date --}}
    <h4 class="row text-bold text-center" style="text-transform: uppercase; font-weight: bold; font-size: 20px !important;">PLANNING "PROVISOIRE" DU MOIS DE {{ Carbon::now()->monthName }}</h4>
    <hr>
    <div class="row details" style="font-size: 15px !important;">
        <div class="col-md-12">
            @php

                $total = $sumhours[0]->heures_total ;
                $minutes = $sumhours[0]->minutes;

                $total = $total + (int)($minutes / 60) ;
                $minutes = (int)($minutes % 60) ;


              $heures_total_hours = $sumhours[0]->heure_total_jour + intval(($sumhours[0]->minutes_jour / 60));
              $minutes_jours =  intval($sumhours[0]->minutes_jour / 60)  > 0  ? (int)$sumhours[0]->minutes_jour % 60 : (int)$sumhours[0]->minutes_jour ;

              $heure_total_nuit = $sumhours[0]->heure_total_nuit + intval(($sumhours[0]->minutes_nuit / 60));
              $minutes_nuit =  intval($sumhours[0]->minutes_nuit/ 60 ) > 0 ? (int)$sumhours[0]->minutes_nuit % 60 : (int)$sumhours[0]->minutes_nuit ;





            @endphp

            @php
                $totalf = $planningsferies[0]->heures_total ;
                $minutesf = $planningsferies[0]->minutes;
                $totalf = $totalf + (int)($minutesf / 60) ;

                $minutesf = (int)($minutesf % 60) ;
                $heures_total_hoursf = $planningsferies[0]->heure_total_jour + intval(($planningsferies[0]->minutes_jour / 60));
                $minutes_joursf =  intval($planningsferies[0]->minutes_jour / 60)  > 0  ? (int)$planningsferies[0]->minutes_jour % 60 : (int)$planningsferies[0]->minutes_jour ;
                $heure_total_nuitf = $planningsferies[0]->heure_total_nuit + intval(($planningsferies[0]->minutes_nuit / 60));
                $minutes_nuitf =  intval($planningsferies[0]->minutes_nuit/ 60 ) > 0 ? (int)$planningsferies[0]->minutes_nuit % 60 : (int)$planningsferies[0]->minutes_nuit ;



                $totale_heures_f =  $heures_total_hoursf + $heure_total_nuitf + intval( ($planningsferies[0]->minutes_jour + $planningsferies[0]->minutes_nuit) / 60 ) ;
                $minutes_totale_f =  intval( ($planningsferies[0]->minutes_nuit + $planningsferies[0]->minutes_jour) / 60 ) > 0 ? ($planningsferies[0]->minutes_nuit + $planningsferies[0]->minutes_jour) % 60 :  intval($planningsferies[0]->minutes_nuit + $planningsferies[0]->minutes_jour) ;
            @endphp


            <p><span><strong>Nom de l'agent : </strong> {{ $agent->nom }} {{ $agent->prenoms }}</span> <span class="pull-right"><strong>Total Heures Jour :</strong> {{ \App\Helpers\BlackshFonctions::format($heures_total_hours.':'.$minutes_jours.':00' )}}</span></p>

            <p><span><strong>Matricule : </strong> {{ $agent->matricule }}</span> <span class="pull-right"><strong>Total Heures Nuit :</strong> {{ \App\Helpers\BlackshFonctions::format($heure_total_nuit.':'.$minutes_nuit.':00')}} </span></p>

            <p><span><strong>N° Sécurité sociale :</strong> {{ $agent->numeross }}</span> <span class="pull-right"><strong>Total Heures fériées:</strong>{{ \App\Helpers\BlackshFonctions::format($totale_heures_f.':'.$minutes_totale_f.':00' )}}</span></p>


        </div>
    </div>
    <br><br>
    {{-- Information de l'agent --}}
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
        <tr>
            <th class="not_mapped_style" style="background-color:#2c2f26; color:white; text-align: center;">DATE</th>
            <th class="not_mapped_style" style="background-color:#2c2f26; color:white; text-align: center;">SITE</th>
            <th class="not_mapped_style" style="background-color:#2c2f26; color:white; text-align: center;">DÉBUT SERVICE</th>
            <th class="not_mapped_style" style="background-color:#2c2f26; color:white; text-align: center;">FIN SERVICE</th>
            <th class="not_mapped_style" style="background-color:#2c2f26; color:white; text-align: center;">PAUSE </th>
            <th class="not_mapped_style" style="background-color:#2c2f26; color:white; text-align: center;"> TOTAL HEURES JOUR</th>
            <th class="not_mapped_style" style="background-color:#2c2f26; color:white; text-align: center;"> TOTAL HEURES NUIT</th>
            <th class="not_mapped_style" style="background-color:#2c2f26; color:white; text-align: center;">TOTAL DES HEURES</th>
        </tr>
        </thead>
        <tbody class="text-center">
        @forelse($plannings as $key => $planning)
            <tr>
                @php
                    $total = $planning->heures_total ;
                    $minutes = $planning->minutes;

                    $total = $planning->heures_total + (int)($minutes / 60) ;
                    $minutes =  (int)$planning->minutes % 60 ;

                    $heures_total_hours = $planning->heure_total_jour + intval(($planning->minutes_jour / 60));
                    $minutes_jours =  intval($planning->minutes_jour / 60)  > 0  ? (int)$planning->minutes_jour % 60 : (int)$planning->minutes_jour ;

                    $heure_total_nuit = $planning->heure_total_nuit + intval(($planning->minutes_nuit / 60));
                    $minutes_nuit =  intval($planning->minutes_nuit/ 60 ) > 0 ? (int)$planning->minutes_nuit % 60 : (int)$planning->minutes_nuit ;

                @endphp
                <td>{{ucfirst(\Carbon\Carbon::parse($planning->date_debut)->locale('fr_FR')->isoFormat('ddd  DD')) }}</td>
                <td>{{ $planning->site->nom }}</td>
                <td>{{ $planning->heure_debut }}</td>
                <td>{{ $planning->heure_fin }}</td>
                <td>{{ $planning->pause }}</td>
                <td>{{ \App\Helpers\BlackshFonctions::format($heures_total_hours.':'.$minutes_jours.':00' ) }}</td>
                <td>{{ \App\Helpers\BlackshFonctions::format($heure_total_nuit .':'.$minutes_nuit.':00') }}</td>
                <td>{{ \App\Helpers\BlackshFonctions::format($total.':'.$minutes.':00') }}</td>
            </tr>
        @empty
            <tr>Aucun planning enregistré.</tr>
        @endforelse

        </tbody>
    </table>
</div>

</body>
</html>

