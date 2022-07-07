<?php

namespace App\Other;

use Illuminate\Database\Eloquent\Model;

class UniqueLink extends Model
{

    protected $table = 'unique_links';

    protected $fillable = [
        'code', 'screen_image', 'side_image', 'imei_image' ,'imei_video'
    ];

    protected $date = [
        'created_at', 'updated_at'
    ];
}
