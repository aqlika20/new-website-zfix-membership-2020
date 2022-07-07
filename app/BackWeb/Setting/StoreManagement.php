<?php

namespace App\BackWeb\Setting;

use Illuminate\Database\Eloquent\Model;

class StoreManagement extends Model
{

    protected $table = 'stores';

    protected $fillable = [
        'name', 'address'
    ];

    protected $date = [
        'created_at', 'updated_at'
    ]; 
}
