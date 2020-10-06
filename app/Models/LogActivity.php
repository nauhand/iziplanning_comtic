<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'subject','url', 'method','ip','agent' , 'user_id' ,'pays' , 'ville' , 'region' , 'severity_level' , 'table' , 'table_id'
    ];
    
    protected $table = 'log_activity';
    protected $primaryKey = 'id';

    
}
