<?php

namespace App\BackWeb\Setting;

use Illuminate\Database\Eloquent\Model;

class AppVersion extends Model
{

    protected $table = '_app_version';
    public $timestamps = false;
    
    protected $fillable = [
        'version'
    ];
}
