<?php

namespace App\Http\Controllers\Other;

use App\BackWeb\Process\Process;
use App\BackWeb\Partner\GenerateVoucher;
use App\Other\UniqueLink;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Helper\Helper;

class UniqueLinkController extends Controller
{

    public function index($code) 
    {
        $statusMobile = false;
        if (Helper::isMobileDevice()) {
            $statusMobile = true;
        }

        $current = UniqueLink::where('code', $code)->first();
        
        $statusCurrent = 0;
        if ($current) {

            $process = Process::where('unique_links_id', $current->id)->first();
            if (empty($process)) {
                $statusCurrent = 3;
            }
            else {
                if ($process->device_version >= 10) {
                    if ($current->screen_image == null || $current->side_image == null || $current->imei_video == null) {
                        $statusCurrent = 1;
                    }
                    else {
                        $statusCurrent = 2;
                    }
                }
                else {
                    if ($current->screen_image == null || $current->side_image == null || $current->imei_image == null) {
                        $statusCurrent = 1;
                    }
                    else {
                        $statusCurrent = 2;
                    }
                }  
            }
            
        }
        else {
            $statusCurrent = 0;
            $process = "-";
        }

        return view('other.code', compact('statusMobile', 'statusCurrent', 'process', 'code'));
    }

    public function edit($code, Request $request) 
    {
        $data = $request->all();

        $unique_link = UniqueLink::where([
            ['code', '=', $code]
        ])->first();

        if (!$unique_link) {
            return redirect()->route('code.index',[$code])->with(['error'=>'Data not valid.']);
        }

        $process = Process::where('unique_links_id', $unique_link->id)->first();
        if ($process) {
            if ($process->device_version >= 10) {
            
                $validator = Validator::make($data, [
                    'screen_image' => 'required|string',
                    'side_image' => 'required|string',
                    'imei_video' => 'required|string'
                ]);
    
                if ($validator->fails())
                {
                    return redirect()->route('code.index',[$code])->with(['error'=>'Data not valid.']);
                }
    
                $data['screen_image'] = Helper::convert($code, $data['screen_image'], 1);
                $data['side_image'] = Helper::convert($code, $data['side_image'], 2);
                $data['imei_video'] = Helper::convert($code, $data['imei_video'], 4);
        
                $unique_link->screen_image = $data['screen_image'];
                $unique_link->side_image = $data['side_image'];
                $unique_link->imei_video = $data['imei_video'];
                $unique_link->save();
            }
            else {
                $validator = Validator::make($data, [
                    'screen_image' => 'required|string',
                    'side_image' => 'required|string',
                    'imei_image' => 'required|string'
                ]);
    
                if ($validator->fails())
                {
                    return redirect()->route('code.index',[$code])->with(['error'=>'Data not valid.']);
                }
    
                $data['screen_image'] = Helper::convert($code, $data['screen_image'], 1);
                $data['side_image'] = Helper::convert($code, $data['side_image'], 2);
                $data['imei_image'] = Helper::convert($code, $data['imei_image'], 3);
        
                $unique_link->screen_image = $data['screen_image'];
                $unique_link->side_image = $data['side_image'];
                $unique_link->imei_image = $data['imei_image'];
                $unique_link->save();
            } 
            
    
           
            
            $process = Process::where([
                ['unique_links_id', '=', $unique_link->id]
            ])->first();

            $voucher = GenerateVoucher::where('id', $process->vouchers_id)->first();
            $voucher->status = '2';
            $voucher->save();
    
            $process->status = 0;
            $process->save();      
        }
        return redirect()->route('code.index',[$code]); 
    }
}
