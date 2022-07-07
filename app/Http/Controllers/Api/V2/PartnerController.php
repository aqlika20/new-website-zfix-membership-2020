<?php

namespace App\Http\Controllers\Api\V2;

use App\BackWeb\Setting\UserManagement;
use App\BackWeb\Process\Process;
use App\BackWeb\Partner\GenerateVoucher;
use App\Other\UniqueLink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendVoucherCreateMailable;
use App\Helper\Helper;

use Carbon\Carbon;

class PartnerController extends Controller
{
    public function create(Request $request) {
        if(Auth::check()){
            $customer = UserManagement::where('id', Auth::id())->first();

            if($customer->roles_id == "4"){
                $input = $request->all();

                $validator = Validator::make($input, [
                    'name' => 'required|string',
                    'email' => 'required|string',
                    'type' => 'required|string'
                ]);
        
                if($validator->fails()){
                    return response()->json([
                        'messages' => $validator->errors()
                    ], 400);
                }



                if ($input['type'] != 'Z Prime Lite' && $input['type'] != 'Z Prime' && $input['type'] != 'Z Prime+')
                {
                     
                }

                if ($input['type'] == 1) {
                    $input['type'] = "Z Prime Lite";
                }
                else if ($input['type'] == 2) {
                    $input['type'] = "Z Prime";
                }
                else if ($input['type'] ==3) {
                    $input['type'] = "Z Prime+";
                }
                else {
                    return response()->json([
                        "message" => "Invalid type voucher."
                    ], 401); 
                }

                $partner = RegisterNewPartner::where('users_id',$customer->id);
                $input['partners_id'] = $partner->id;
                
                $input['status'] = 0;
                $input['inserted_at'] = Carbon::now();

                $input['voucher_key'] = $partner->partner_key.'-'.Helper::getVoucherKey($partner->partner_key);
                $serial_number = $partner.$input['voucher_key'].date("l jS \of F Y h:i:s A").$input['type'];
                $serial_number = strtoupper(substr(md5($serial_number), 0, 8));
                $input['serial_number'] = $partner->partner_key.$serial_number;

                GenerateVoucher::create($input);
                Mail::to($input['email'])->send(new SendVoucherCreateMailable($input['name'],$input['type'],$input['voucher_key']));

                return response()->json(['success'], 201);
            }
            else{
                return response()->json([
                    "message" => "Only partner can do this."
                ], 401); 
            }
        } 
        
    }

    public function sold(Request $request) {
        if(Auth::check()){
            $customer = UserManagement::where('id', Auth::id())->first();

            if($customer->roles_id == "4"){
                $input = $request->all();

                $validator = Validator::make($input, [
                    'serial_number' => 'required|string',
                ]);
        
                if($validator->fails()){
                    return response()->json([
                        'messages' => $validator->errors()
                    ], 400);
                }
                $voucher = GenerateVoucher::where([
                    ['serial_number', '=', $input["serial_number"]]
                ])->first();
        
                if (!$voucher) {
                    return response()->json([
                        "message" => "Voucher has not registered yet."
                    ], 401);       
                }
        
                $voucher->status = 1;
                
                $voucher->save();
        
                return response()->json(['success'], 201);
            }
            else{
                return response()->json([
                    "message" => "Only partner can do this."
                ], 401); 
            }
        } 
        
    }
}
