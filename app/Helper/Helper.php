<?php

namespace App\Helper;
use App\Other\Notification;
use App\Other\UniqueLink;
use App\BackWeb\Partner\GenerateVoucher;
use App\BackWeb\Process\Process;
use Carbon\Carbon;

class Helper
{
    public static $api_url_xl_authentication = "https://apigw.xl.co.id/digitalreward/v1/oauth";
    public static $api_url_xl_getkey = "https://apigw.xl.co.id/digitalreward/v1/getkey";
    public static $api_url_xl_redeem = "https://apigw.xl.co.id/digitalreward/v1/redeem";
    public static $api_url_xl_stock = "https://apigw.xl.co.id/digitalreward/v1/stock";
    public static $api_url_xl_transaction = "https://apigw.xl.co.id/digitalreward/v1/transaction";


    public static function isMobileDevice(){
        $aMobileUA = array(
            '/iphone/i' => 'iPhone', 
            '/ipod/i' => 'iPod', 
            '/ipad/i' => 'iPad', 
            '/android/i' => 'Android', 
            '/blackberry/i' => 'BlackBerry', 
            '/webos/i' => 'Mobile'
        );
    
        // return true if mobile user agent is detected
        foreach($aMobileUA as $sMobileKey => $sMobileOS){
            if(preg_match($sMobileKey, $_SERVER['HTTP_USER_AGENT'])){
                return true;
            }
        }
        // otherwise return false. 
        return false;
    }

    public static function convert($code, $base_64, $type) {
        $rawFileName = substr(md5(date("Y-m-d H:m:s").$code),0,10);
        
        $extension = explode('/', explode(':', substr($base_64, 0, strpos($base_64, ';')))[1])[1];   
        // if ($extension != 'jpg' && $extension != 'jpeg' && $extension != 'png') {
        //     return redirect()->route('code.index')->with(['error'=>'Data not valid.']);
        // }

        $replace = substr($base_64, 0, strpos($base_64, ',')+1); 
        $file = str_replace($replace, '', $base_64); 
        $file = str_replace(' ', '+', $file); 
        $fileName = $rawFileName.'.'.$extension;

        $finalFile = base64_decode($file);
        
        if ($type == 1) {
            file_put_contents(public_path().'/api/screen-image/'.$fileName, $finalFile);
        }
        else if ($type == 2) {
            file_put_contents(public_path().'/api/side-image/'.$fileName, $finalFile);
        }
        else if ($type == 3) {
            file_put_contents(public_path().'/api/imei-image/'.$fileName, $finalFile);
        }
        else if ($type == 4) {
            file_put_contents(public_path().'/api/imei-video/'.$fileName, $finalFile);
        }

        return $fileName;
    }

    public static function convertCode($customer_id, $imei) {
        $code = substr(md5(date("Y-m-d H:m:s").$imei.$customer_id.rand()),0,4);
        if (empty($code)) {
            return $this->convertCode($customer_id, $imei);
        }
        $unique_link = UniqueLink::where([
            ['code', '=', $code]
        ])->first(); 
        if ($unique_link) {
            return $this->convertCode($customer_id, $imei);
        }
        return $code;
    }

    public static function getVoucherKey($raw_partner_key) {
        $raw = date("l jS \of F Y h:i:s A").rand().Carbon::now();
        $raw = strtoupper(substr(md5($raw), 0, 6));
        $voucher_exist = GenerateVoucher::where([
            ['voucher_key', '=', $raw_partner_key.'-'.$raw]
        ])->first();
        if ($voucher_exist) {
            return getVoucherKey($raw_partner_key);
        }
        else {
            return $raw;
        }
    }

    public static function addNotification($type, $customers_id) {

            $process = Process::where([
                ['customers_id', '=', $customers_id],
                ['status', '!=', -1],
                ['status', '!=', -3],
                ['status_claim', '!=', 3],
             ])->first();

            if ($process->status_claim == 0) {
                $title = 'Siapkan Gadget Kamu!';
                $description = 'Sebentar lagi tim kami akan menjemput gadget kamu untuk diperbaiki. Pastikan gadget kamu sudah siap dijemput ya!';
            }
            if ($process->status_claim == 1) {
                $title = 'Gadget Kamu Sedang Diperbaiki';
                $description = 'Hai, gadget kamu akan segera kembali lagi kurang lebih 7-14 hari kerja. Jadi, mohon bersabar ya! ☺️';
            }
            if ($process->status_claim == 2) {
                $title = 'Yey. Gadget Kamu Segera Kembali!';
                $description = 'Selamat! Gadget kamu telah selesai diperbaiki oleh tim kami.';
            }
 

        
        $data['title'] = $title;
        $data['description'] = $description;
        $data['type'] = $type;
        $data['customers_id'] = $customers_id;
        $data['show'] = 0;
        $data['read'] = 0;
            
        Notification::create($data);
    }
}