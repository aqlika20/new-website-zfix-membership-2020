<?php

namespace App\Other;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notifications';

    protected $fillable = [
        'customers_id', 'type', 'title', 'description', 'show', 'read'
    ];

    protected $date = [
        'created_at', 'updated_at'
    ];
}
