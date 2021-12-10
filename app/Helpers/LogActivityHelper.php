<?php 

namespace App\Helpers;
use App\Models\Planning;
use Carbon\Carbon;
use Request;
use App\Models\LogActivity as ModelsLogActivity;
use Illuminate\Support\Facades\DB;

class LogActivityHelper
{
    public static function log($subject , $severity , $table , $id)

    {
    	$log = [];
    	$log['subject'] = $subject;
    	$log['url'] = Request::fullUrl();
    	$log['method'] = Request::method();
    	$log['ip'] = Request::ip();
		$log['severity_level'] = $severity ;
		$log['agent'] = Request::header('user-agent');
		$log['user_id'] = auth()->check() ? auth()->user()->id : 1;
		$log['table'] = $table ;
		$log['table_id'] = $id ;
		// cal api 
		$query = @unserialize(file_get_contents('http://ip-api.com/php/'. $log['ip']));

		if($query && $query['status'] == 'success') {
			$log['contry'] = $query['country'];
			$log['region'] = $query['regionName'];
			$log['ville']  = $query['city'];
		}
    	ModelsLogActivity::create($log);
	
	}

    public static function logActivityLists()
    {
		return  DB::table('log_activity')
			->select(DB::raw("log_activity.* , users.nom as adminname , users.prenoms as adminlastname ") )
			->orderByDesc('id')
			->join('users', 'log_activity.user_id', '=', 'users.id')
			->get();
	}
	
	public static function logactivity( $id )
	{
		list($id_table,$table) = explode('-',$id);
		
		switch ($table) {
			case 'sites':
					return [DB::table('log_activity')
					->select(DB::raw("log_activity.* , sites.ville as sitesville , sites.nom as sitesnom , sites.adresse as sitesadresse , sites.telephone as sitestelephone , users.nom as username , users.prenoms as lastname  ") )
					->join('sites', 'log_activity.table_id', '=', 'sites.id')
					->join('users', 'log_activity.user_id', '=', 'users.id')
					->where(DB::raw('log_activity.id') , '=' , $id_table)
					->get(), $table];
				break;
			case 'agent' :
				return [DB::table('log_activity')
					->select(DB::raw("log_activity.*  , agents.* , users.nom as username , users.prenoms as lastname   ") )
					->join('agents', 'log_activity.table_id', '=', 'agents.id')
					->join('users', 'log_activity.user_id', '=', 'users.id')
					->where(DB::raw('log_activity.id') , '=' , $id_table)
					->get(), $table];
					break ;
			case 'plannings' :
				return [
					DB::table('log_activity')
					->select(DB::raw("log_activity.* , users.nom as username , users.prenoms as lastname ") )
					->join('users', 'log_activity.user_id', '=', 'users.id')
					->where(DB::raw('log_activity.id') , '=' , $id_table)
					->get(), $table , 
					];
					break ;
			case 'conges' :
				return [
					DB::table('log_activity')
					->select(DB::raw("log_activity.* , users.nom as username , users.prenoms as lastname , conges.* , agents.nom as agentnom , agents.prenoms as agentsprenom") )
					->join('users', 'log_activity.user_id', '=', 'users.id')
					->join('conges', 'log_activity.table_id', '=', 'conges.id')
					->join('agents', 'conges.agent_id', '=', 'agents.id')
					->where(DB::raw('log_activity.id') , '=' , $id_table)
					->get(), $table 
					];
					break ;

			default:
				break;
		}
	}
	public static function logplannings( $id )
	{
	    if($id == null) {
            return DB::table('plannings')->select(DB::raw('agents.*,plannings.*,sites.nom as sitenom'))
                ->join('agents', 'plannings.agent_id', '=', 'agents.id')
                ->join('sites', 'plannings.site_id', '=', 'sites.id')
                ->where('statut', 'definitif')
                ->where('date_debut', '>=',Carbon::now()->firstOfMonth() )
                ->orderBy('date_debut', 'asc')
                ->get();
        } elseif($id == 0) {
            return DB::table('plannings')->select(DB::raw('agents.*,plannings.*,sites.nom as sitenom'))
                ->join('agents', 'plannings.agent_id', '=', 'agents.id')
                ->join('sites', 'plannings.site_id', '=', 'sites.id')
                ->where('statut', 'archives')
                ->where('date_debut', '>=',Carbon::now()->firstOfMonth() )
                ->orderBy('date_debut', 'asc')
                ->get();
        }
		return DB::table('plannings')->select(DB::raw('agents.*,plannings.*,sites.nom as sitenom'))
				->join('agents', 'plannings.agent_id', '=', 'agents.id')
				->join('sites', 'plannings.site_id', '=', 'sites.id')
                ->where('date_debut', '>=',Carbon::now()->firstOfMonth() )
                ->orderBy('date_debut', 'asc')
				->where('vacation_id',$id)->get();
	}

}