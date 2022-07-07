<?php

namespace App\BackWeb\Process;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
   
    protected $table = 'processes';

    protected $fillable = [
        'customers_id', 'vouchers_id', 'unique_links_id','imei', 'device_type', 'device_version', 'device_manufacturer', 'device_model', 'device_ram', 'device_storage', 'screen_has_problem', 'lokasi_beli_voucher', 'screen_image', 'status', 'contact', 'contact_alternatif', 'tanggal_kerusakan', 'waktu_kerusakan', 'provinsi', 'kota', 'alamat_penjemputan', 'kode_pos', 'lokasi_beli_membership', 'layanan_perbaikan', 'kronologis', 'status_claim', 'assign_by'
    ];

    protected $date = [
        'created_at', 'updated_at'
    ];

    public function customers()
    {
        return $this->belongsTo('App\BackWeb\Setting\CustomerManagement');
    }

    public function vouchers()
    {
        return $this->belongsTo('App\BackWeb\Partner\GenerateVoucher');
    }

    public function uniqueLinks()
    {
        return $this->belongsTo('App\Other\UniqueLink');
    }

}
