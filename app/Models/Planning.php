<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
	protected $fillable = [
	    'agent_id', 'site_id','vacation_id', 'date_debut','heure_debut','heure_fin' , 'pause', 'heure_total_nuit', 'heure_total_jour', 'statut',
	];

    protected $guarded= [];

    public function agent(){
    	return $this->belongsTo('App\Models\Agent');
    }

    public function site(){
    	return $this->belongsTo('App\Models\Site');
    }
}
