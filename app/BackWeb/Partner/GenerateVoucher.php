<?php

namespace App\BackWeb\Partner;

use Illuminate\Database\Eloquent\Model;

class GenerateVoucher extends Model
{
    
    protected $table = 'vouchers';

    protected $fillable = [
        'voucher_key', 'serial_number', 'type', 'status', 'partners_id', 'inserted_at'
    ];

    protected $date = [
        'created_at', 'updated_at'
    ];

    public function partners()
    {
        return $this->belongsTo('App\BackWeb\Partner\RegisterNewPartner');
    }

}
