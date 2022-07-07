<?php

namespace App\BackWeb\Setting;

use Illuminate\Database\Eloquent\Model;

class CustomerManagement extends Model
{

    protected $table = 'customers';

    protected $fillable = [
        'address', 'contact', 'identity', 'birth_date', 'gender', 'users_id'
    ];

    protected $date = [
        'created_at', 'updated_at'
    ];

    public function users()
    {
        return $this->belongsTo('App\BackWeb\Setting\UserManagement');
    }
    
}
