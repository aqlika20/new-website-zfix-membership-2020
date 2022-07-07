<?php

namespace App\Http\Controllers\BackWeb\Process;

use App\BackWeb\Process\Process;
use App\Exports\BackWeb\Process\RequestForClaimExport;
use App\BackWeb\Setting\UserManagement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendClaimedMailable;
use App\Mail\SendRejectedClaimMailable; 

class RequestForClaimController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $req) 
    {
        $currentUser = UserManagement::find(Auth::id());
        $page_title = 'Request for Claim';
        $page_description = '';
        $processes = Process::where('status', 2)->orderBy('created_at','desc')->get();

        $method = $req->method();
        if ($req->isMethod('post'))
        {
            $raw_from = $req->input('from_date');
            $raw_to   = $req->input('to_date');

            $from = $raw_from.' 00:00:00';
            $to = $raw_to.' 23:59:59'; 

            return Excel::download(new RequestForClaimExport($from, $to), 'Report Request Claim '.$from.' - '.$to.'.xlsx');
 
        } 
        return view('back_web.process.request_for_claim', compact('page_title', 'page_description', 'currentUser', 'processes'));
    }

    public function detail($id) 
    {
        $currentUser = UserManagement::find(Auth::id());
        $page_title = 'Detail Request for Claim';
        $page_description = '';
        $process = Process::where('id', $id)->first();
        if (!$process) {
            return redirect()->route('process.request-for-claim.index')->with(['error'=>'Invalid parameter id.']);
        }

        return view('back_web.process.request_for_claim_detail', compact('page_title', 'page_description', 'currentUser', 'process'));
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
            return redirect()->route('process.request-for-claim.index')->with(['error'=>'Action failed.']);
        }

        else if (isset($data['action']) && $data['action'] != '' && $data['action'] == '3')
        {

            $process = Process::where([
                ['id', '=', $id]
            ])->first();
            if (!$process) {
                return redirect()->route('process.request-for-claim.index')->with(['error'=>'Invalid parameter id.']);
            }

            $process->actived_at = Carbon::now();
            if ($process->vouchers->type == 'Z Prime Lite') {
                $process->expired_at = Carbon::now()->addDays(30);
            }
            else if ($process->vouchers->type == 'Z Prime') {
                $process->expired_at = Carbon::now()->addDays(180);
            }
            else if ($process->vouchers->type == 'Z Prime+') {
                $process->expired_at = Carbon::now()->addDays(360);
            }

            $process->assign_by = Auth::user()->name;
            if (isset($data['imei'])) {
                $process->imei = $data['imei'];
            }
            $process->status = 3;
            
            $name = $process->customers->users->name;
            Mail::to($process->customers->users->email)->send(new SendClaimedMailable($name));

            $process->save();

            return redirect()->route('process.request-for-claim.index')->with(['success'=>'Action successed.']);
        }

        else if (!isset($data['action']) && isset($data['reason_for_rejected_claim']) && $data['reason_for_rejected_claim'] != '')
        {
            $process = Process::where([
                ['id', '=', $id]
            ])->first();
            if (!$process) {
                return redirect()->route('process.request-for-claim.index')->with(['error'=>'Invalid parameter id.']);
            }

            $process->reason_for_rejected_claim = $data['reason_for_rejected_claim'];
            $process->assign_by = Auth::user()->name;
            if (isset($data['imei'])) {
                $process->imei = $data['imei'];
            }
            $process->status = -3;

            $process->save();
            
            $name = $process->customers->users->name;
            Mail::to($process->customers->users->email)->send(new SendRejectedClaimMailable($name,$data['reason_for_rejected_claim']));


            return redirect()->route('process.request-for-claim.index')->with(['success'=>'Action successed.']);
        }

     else 
        {
        return redirect()->route('process.request-for-claim.index')->with(['error'=>'Action failed.']);
        }
    
    }

}
