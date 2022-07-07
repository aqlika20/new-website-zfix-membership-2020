<?php

namespace App\Http\Controllers\Api\V2;

use App\BackWeb\Setting\CustomerManagement;
use App\BackWeb\Setting\StoreManagement;
use App\BackWeb\Process\Process;
use App\BackWeb\Partner\GenerateVoucher;
use App\Other\UniqueLink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use App\Helper\Helper;

class MembershipController extends Controller
{
    public function activation(Request $request){
        if(Auth::check()){
            
            $customer = CustomerManagement::where('users_id', Auth::id())->first();

            $input = $request->all();

            $validator = Validator::make($input, [
                'voucher_key' => 'required|string',
                'imei' => 'required|integer',
                // 'device_type' => 'required|string',
                // 'device_version' => 'required|string',
                // 'device_manufacturer' => 'required|string',
                // 'device_model' => 'required|string',
                // 'device_ram' => 'required|string',
                // 'device_storage' => 'required|string',
                'screen_has_problem' => 'required|integer',
                // 'lokasi_beli_voucher' => 'required|string',
            ]);
    
            if($validator->fails()){
                return response()->json([
                    'messages' => $validator->errors()
                ], 400);
            }

            $imei_exist = Process::where([
                ['imei', '=', $input['imei']], 
                ['status', '=', '0']
            ])->orWhere([
                ['imei', '=', $input['imei']], 
                ['status', '=', '1']
            ])->first();  
            
            if ($imei_exist) {
                return response()->json([
                    "message" => "Imei sudah terdaftar."
                ], 401);
            }
            
            $approved_exist = Process::where([
                ['customers_id', '=', $customer->id], 
                ['status', '=', '1']
            ])->first(); 

            if ($approved_exist) {
                return response()->json([
                    "message" => "Kamu sudah terdaftar dalam membership."
                ], 401);
            }

            $voucher_exist = GenerateVoucher::where([
                ['voucher_key', '=', $input['voucher_key']]
            ])->first();
            
            if ($voucher_exist) {
                if ($voucher_exist->status == '0') {
    
                    $input['customers_id'] = $customer->id;
                    $input['vouchers_id'] = $voucher_exist->id;

                    $input['status'] = '-4';
    
                    if ($input['screen_has_problem'] != 1 && $input['screen_has_problem'] != 0) {
                        return response()->json([
                            "message" => "Invalid screen_has_problem."
                        ], 401);
                    }

                    $imei_exist = Process::where([
                        ['imei', '=', $input['imei']], 
                        ['status', '=', '-4']
                    ])->first();  
                    
                    if ($imei_exist) {
                        $voucher = GenerateVoucher::where('id', $imei_exist->vouchers_id)->first();
                        $voucher->status = '0';
                        $voucher->save();
                        Process::where('id', $imei_exist->id)->delete();
                        UniqueLink::where('id', $imei_exist->unique_links_id)->delete();
                    }

                    $input1['code'] = Helper::convertCode($customer->id, $input['imei']);
                    
                    UniqueLink::create($input1);
                    $unique_link = UniqueLink::where([
                        ['code', '=', $input1['code']]
                    ])->first(); 

                    $input['unique_links_id'] = $unique_link->id;
                    Process::create($input);
    
                    
                    $voucher_exist->status = '2';
                    $voucher_exist->save();
    
                    $data = [
                        'code' => $unique_link->code
                    ];
            
                    return response()->json(['data' => $data], 200);
                } 
                else {
                    return response()->json([
                        "message" => "Voucher key has been used."
                    ], 401);
                }
            }

            else {
                return response()->json([
                    "message" => "Voucher key is not registered."
                ], 401);
            }
        }
    }

    public function check(Request $request){
        if(Auth::check()){

            $input = $request->all();

            $validator = Validator::make($input, [
                'request_code' => 'required|integer',
            ]);
    
            if($validator->fails()){
                return response()->json([
                    'messages' => $validator->errors()
                ], 400);
            }

            else {
                if ($input['request_code'] == -1) { //check if the data has been received or not after upload screen image and side image
                    $validator = Validator::make($input, [
                        'code' => 'required|string'
                    ]);
            
                    if($validator->fails()){
                        return response()->json([
                            'messages' => $validator->errors()
                        ], 400);
                    }
        
                    $image_exist = UniqueLink::where([
                        ['code', '=', $input['code']], 
                        ['screen_image', '!=', ''], 
                        ['side_image', '!=', '']
                    ])->first();  
                    
                    if ($image_exist) {
                        return response()->json(['received' => true], 200);
                    }
                    else {
                        return response()->json(['received' => false], 401);
                    }
                   
                }
                else if ($input['request_code'] == 0) { //check voucher if available or not
                    $validator = Validator::make($input, [
                        'voucher_key' => 'required|string',
                        'imei' => 'required|string'
                    ]);
            
                    if($validator->fails()){
                        return response()->json([
                            'messages' => $validator->errors()
                        ], 400);
                    }
        
                    $imei_exist = Process::where([
                        ['imei', '=', $input['imei']], 
                        ['status', '=', '1']
                    ])->orWhere([
                        ['imei', '=', $input['imei']], 
                        ['status', '=', '0']
                    ])->first();  
                    
                    if ($imei_exist) {
                        return response()->json([
                            "message" => "Imei is registered in process."
                        ], 401);
                    }
        
                    $voucher_exist = GenerateVoucher::where([
                        ['voucher_key', '=', $input['voucher_key']]
                    ])->first();
        
                    if ($voucher_exist) {
                        if ($voucher_exist->status == '0') {
                            return response()->json(["data" => $voucher_exist], 200);
                        } 
                        else {
                            return response()->json([
                                "message" => "Voucher key has been used."
                            ], 401);
                        }
                    }
        
                    else {
                        return response()->json([
                            "message" => "Voucher key is not registered."
                        ], 401);
                    }
                }
                else if ($input['request_code'] == 1) { //check code if screen image and side image have been submitted or not
                    $validator = Validator::make($input, [
                        'code' => 'required|string'
                    ]);
            
                    if($validator->fails()){
                        return response()->json([
                            'messages' => $validator->errors()
                        ], 400);
                    }
        
                    $uniqe_link = UniqueLink::where([
                        ['code', '=', $input['code']], 
                        ['screen_image', '!=', null],
                        ['side_image', '!=', null]
                    ])->first();  
                    
                    if ($uniqe_link) {
                        $data = [
                            'uniqe_link' => $uniqe_link
                        ];
                        return response()->json(['data' => $data], 200);
                    }
                    else {
                        return response()->json([
                            "message" => "Screen image and side image have not been submitted yet."
                        ], 401);
                    }
                }
                else if ($input['request_code'] == 2) { //check imei if it has been registered and can be claimed or not
                    $validator = Validator::make($input, [
                        'imei' => 'required|string'
                    ]);
            
                    if($validator->fails()){
                        return response()->json([
                            'messages' => $validator->errors()
                        ], 400);
                    }
        
                    $imei_exist = Process::where([
                        ['imei', '=', $input['imei']], 
                        ['status', '=', '1']
                    ])->first();  
                    
                    if (!$imei_exist) {
                        return response()->json([
                            "message" => "Imei cannot be claimed at this time."
                        ], 401);
                    }
                }
            }
        }
    }

    public function requestForClaim(Request $request){
        if(Auth::check()){

            $customer = CustomerManagement::where('users_id', Auth::id())->first();

            $input = $request->all();

            $validator = Validator::make($input, [
                'imei' => 'required|integer',
                'contact_alternatif' => 'required|string',
                'tanggal_kerusakan' => 'required|string',
                'waktu_kerusakan' => 'required|string',
                'provinsi' => 'required|string',
                'kota' => 'required|string',
                'alamat_penjemputan' => 'required|string',
                'kode_pos' => 'required|string',
                'layanan_perbaikan' => 'required|string',
                'kronologis' => 'required|string'
            ]);

            if($validator->fails()){
                return response()->json([
                    'messages' => $validator->errors()
                ], 400);
            }
    
            $process_exist = Process::where([
                ['imei', '=', $input['imei']], 
                ['status', '=', '1']
            ])->first();

            if ($process_exist) {
                $process_exist->contact_alternatif = $request->input('contact_alternatif');
                $process_exist->tanggal_kerusakan = $request->input('tanggal_kerusakan');
                $process_exist->waktu_kerusakan = $request->input('waktu_kerusakan');
                $process_exist->provinsi = $request->input('provinsi');
                $process_exist->kota = $request->input('kota');
                $process_exist->layanan_perbaikan = $request->input('layanan_perbaikan');
                $process_exist->kode_pos = $request->input('kode_pos');
                $process_exist->alamat_penjemputan = $request->input('alamat_penjemputan');
                $process_exist->kronologis = $request->input('kronologis');
                $process_exist->status = '2';
                $process_exist->status_claim = '0';
                $process_exist->created_at = Carbon::now();
                $process_exist->save();

                return response()->json(['success'], 201);
            }

            else {
                return response()->json([
                    "message" => "kamu belum terdaftar dalam membership."
                ], 401);
            }
        }
    }

    public function myPlan() {
        if(Auth::check()){
            $customer = CustomerManagement::where([
                ['users_id', '=', Auth::id()]
            ])->first();  
            
            $process = Process::where([
                ['customers_id', '=', $customer->id],
                ['status', '=', '0']
            ])->orWhere([
                ['customers_id', '=', $customer->id],
                ['status', '=', '1']
            ])->orWhere([
                ['customers_id', '=', $customer->id],
                ['status', '=', '-2']
            ])->get();  
    
            $data = [
                'process' => $process
            ];
    
            return response()->json(['data' => $data], 200);
        }
    }

    public function myClaim() {
        if(Auth::check()){
            $customer = CustomerManagement::where([
                ['users_id', '=', Auth::id()]
            ])->first();  
            
            $process = Process::where([
                ['customers_id', '=', $customer->id],
                ['status', '=', '2']
            ])->orWhere([
                ['customers_id', '=', $customer->id],
                ['status', '=', '3']
            ])->get(); 

            $newProcess = [];
            foreach($process as $raw) {
                $newProcess[] = [
                    'imei' => $raw->imei,
                    'voucher_type' => $raw->vouchers->type,
                    'voucher_key' => $raw->vouchers->voucher_key,
                    'serial_number' => $raw->vouchers->serial_number,
                    'created_at' => $raw->created_at,
                    'status' => $raw->status,
                    'status_claim' => $raw->status_claim
                ];
            }
    
            $data = [
                'process' => $newProcess
            ];
    
            return response()->json(['data' => $data], 200);
        }
    }

    public function current() {
        if(Auth::check()){
            $customer = CustomerManagement::where([
                ['users_id', '=', Auth::id()]
            ])->first();  
            
            $process = Process::where([
                ['customers_id', '=', $customer->id]
                // ['status', '=', '1']
            ])->first();

            if ($process) {
                if ($process->status == '1') {
                    $voucher = GenerateVoucher::where([
                        ['id', '=', $process->vouchers_id]
                    ])->first();
            
                    $data = [
                        'process' => $process,
                        'voucher_key' => $voucher->voucher_key,
                        'type' => $voucher->type,
                        'actived' => $process->actived_at,
                        'status' => $process->status,
                        'imei' => $process->imei, 


                    ];
            
                    return response()->json(['data' => $data], 200);
                }

                else{
                    
                    $data = [
                        'process' => $process,
                        'voucher_key' => "-",
                        'actived' => $process->actived_at,
                        'status' => $process->status

                    ];
            
                    return response()->json(['data' => $data], 200);
                }
               
            }  else{
                    
                $data = [
                    'voucher_key' => "-"
                ];
        
                return response()->json(['data' => $data], 200);
            }
        }
    }

    public function getStore() { 
            
        $store = StoreManagement::all();
        
        $data = [
            'store' => $store,
        ]; 

        return response()->json(['data' => $data], 200);
        
    }
}
