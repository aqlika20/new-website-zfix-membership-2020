<?php

namespace App\Http\Controllers\BackWeb\Process;

use App\BackWeb\Process\Process;
use App\Exports\BackWeb\Process\QueueExport;
use App\BackWeb\Setting\UserManagement;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendApprovedMailable;
use App\Mail\SendRejectedMailable;
use Illuminate\Support\Facades\Http;
use App\Helper\Helper;


class QueueController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $req) 
    {
        $currentUser = UserManagement::find(Auth::id());
        $page_title = 'Queue';
        $page_description = '';
        $processes = Process::where('status', 0)->orderBy('created_at', 'asc')->orderBy('created_at','desc')->get();
        $method = $req->method();
        if ($req->isMethod('post'))
        {
            $raw_from = $req->input('from_date');
            $raw_to   = $req->input('to_date');

            $from = $raw_from.' 00:00:00';
            $to = $raw_to.' 23:59:59'; 

            return Excel::download(new QueueExport($from, $to), 'Report Queue '.$from.' - '.$to.'.xlsx');
 
        } 
        return view('back_web.process.queue', compact('page_title', 'page_description', 'currentUser', 'processes'));
    }

    public function detail($id) 
    {
        $currentUser = UserManagement::find(Auth::id());
        $page_title = 'Detail Queue';
        $page_description = '';
        $users = UserManagement::where([
            ['roles_id', '!=', 3],
            ['roles_id', '!=', 4],
            ['roles_id', '!=', 5]
        ])->get();
        $process = Process::where('id', $id)->first();
        // dd($process->vouchers->partners->partner_key);
        if (!$process) {
            return redirect()->route('process.queue.index')->with(['error'=>'Invalid parameter id.']);
        }
        
        return view('back_web.process.queue_detail', compact('page_title', 'page_description', 'currentUser', 'process', 'users'));
    }

    public function action($id, Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'action' => 'string',
            'imei' => 'string'
        ]);

        if ($validator->fails())
        {
            return redirect()->route('process.queue.index')->with(['error'=>'Action failed.']);
        }

        else if (isset($data['action']) && $data['action'] != '' && $data['action'] == '1') 
        {
            $currentUser = UserManagement::find(Auth::id());
            $process = Process::where([
                ['id', '=', $id]
            ])->first();
            if (!$process) {
                return redirect()->route('process.queue.index')->with(['error'=>'Invalid parameter id.']);
            }

            if ($process->vouchers->partners->partner_key == '002') {
                $phone = $process->customers->contact;
                $phone = ltrim($phone, "+");
                $phone = substr_replace($phone,"628",0,2);
                try {
                    $response = Http::withHeaders(["User-Agent" => "Mozilla/5.0 (Windows NT 5.1; rv:19.0) Gecko/20100101 Firefox/19.0"])->asForm()->post(Helper::$api_url_xl_authentication, [
                        'client_id' => 'ta37f7eywbh7fg8s4qwewvaq',
                        'client_secret' => 'SjDr4TzH8p',
                        'grant_type' => 'client_credentials',
                        
                    ]);
            
                    if ($response->successful()) {
                        $raw = $response->json();
                        $trx_id = substr(MD5($phone.$process->customers->users->email.$process->id),0,20);
    
                        try {
                            $response = Http::withHeaders(["User-Agent" => "Mozilla/5.0 (Windows NT 5.1; rv:19.0) Gecko/20100101 Firefox/19.0"])->withToken($raw['access_token'])->post(Helper::$api_url_xl_getkey, [
                                'inputString' => "100180|zfix75|".Carbon::now()->isoFormat('YYYYMMDDHH'),
                                'encryptKey' => "ThisTestKey",
                            ]);
                
                            if ($response->successful()) {
                                $raw1 = $response->json();
                                $key = $raw1['key'];
                                $safe_key = str_replace("+", "%2B", $key);
                                $safe_key = str_replace("=", "%3D", $safe_key);
                                // dd($safe_key);
                                try {
                                    $response = Http::withHeaders(["User-Agent" => "Mozilla/5.0 (Windows NT 5.1; rv:19.0) Gecko/20100101 Firefox/19.0"])->withToken($raw['access_token'])->post(Helper::$api_url_xl_redeem."?key=".$safe_key, [
                                        'brand_id' => "100180",
                                        'prod_id' => "zfix_3000_MB_1",
                                        'trx_id' => $trx_id, // Transaction id generated by client
                                        'msisdn' => $phone
                                    ]);
            
                                    if ($response->successful()) {
                                        $process->actived_at = Carbon::now();
                                        if ($process->vouchers->type == 'Z Prime Lite') {
                                            $process->expired_at = Carbon::now()->addMonths(1);
                                        }
                                        else if ($process->vouchers->type == 'Z Prime') {
                                            $process->expired_at = Carbon::now()->addMonths(6);
                                        }
                                        else if ($process->vouchers->type == 'Z Prime+') {
                                            $process->expired_at = Carbon::now()->addMonths(12);
                                        }
                                        $process->assign_by = Auth::user()->name;
                                        if (isset($data['imei'])) {
                                            $process->imei = $data['imei'];
                                        }
                                        $process->status = 1;
                                        
                                        $process->save();
                            
                                        $name = $process->customers->users->name; 
                                        Mail::to($process->customers->users->email)->send(new SendApprovedMailable($name));
                            
                                        return redirect()->route('process.queue.index')->with(['success'=>'Action successed.']);
                                    }
                                    else { 
                                        return redirect()->route('process.queue.index')->with(['error'=>'Action failed.']);
                                    }
                                }
                                catch (\Exception $e) {
                                    return redirect()->route('process.queue.index')->with(['error'=>'There is a problem.']);
                                }
                            }
                            else { 
                                return redirect()->route('process.queue.index')->with(['error'=>'Action failed.']);
                            }
                        
                        }
                        catch (\Exception $e) {
                            return redirect()->route('process.queue.index')->with(['error'=>'There is a problem.']);
                        }
                    }
                    else { 
                        return redirect()->route('process.queue.index')->with(['error'=>'Action failed.']);
                    }
                }
                catch (\Exception $e) {
                    return redirect()->route('process.queue.index')->with(['error'=>'There is a problem.']);
                }
            } else{
                $process->actived_at = Carbon::now();
                if ($process->vouchers->type == 'Z Prime Lite') {
                    $process->expired_at = Carbon::now()->addMonths(1);
                }
                else if ($process->vouchers->type == 'Z Prime') {
                    $process->expired_at = Carbon::now()->addMonths(6);
                }
                else if ($process->vouchers->type == 'Z Prime+') {
                    $process->expired_at = Carbon::now()->addMonths(12);
                }
                $process->assign_by = Auth::user()->name;
                if (isset($data['imei'])) {
                    $process->imei = $data['imei'];
                }
                $process->status = 1;
                
                $process->save();
    
                $name = $process->customers->users->name; 
                Mail::to($process->customers->users->email)->send(new SendApprovedMailable($name));
    
                return redirect()->route('process.queue.index')->with(['success'=>'Action successed.']);
            }
        }

        else if (!isset($data['action']) && isset($data['reason_for_rejected']) && $data['reason_for_rejected'] != '')
        {         
            $currentUser = UserManagement::find(Auth::id());
            $process = Process::where([
                ['id', '=', $id]
            ])->first();
            if (!$process) {
                return redirect()->route('process.queue.index')->with(['error'=>'Invalid parameter id.']);
            }

            $process->reason_for_rejected = $data['reason_for_rejected']; 
            $process->assign_by = Auth::user()->name;
            if (isset($data['imei'])) {
                $process->imei = $data['imei'];
            }
            $process->status = -1;
            
            $process->save();
            
            $name = $process->customers->users->name;
            Mail::to($process->customers->users->email)->send(new SendRejectedMailable($name,$data['reason_for_rejected']));
            
            return redirect()->route('process.queue.index')->with(['success'=>'Action successed.']);
        }

        else 
        {
            return redirect()->route('process.queue.index')->with(['error'=>'Action failed.']);
        }
        
    }



}
