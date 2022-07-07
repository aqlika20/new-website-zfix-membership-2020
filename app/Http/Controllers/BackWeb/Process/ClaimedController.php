<?php

namespace App\Http\Controllers\BackWeb\Process;

use App\BackWeb\Process\Process;
use App\Exports\BackWeb\Process\ClaimedExport;
use App\BackWeb\Setting\UserManagement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendRejectedMailable;
use App\Mail\SendClaimedPickupMailable;
use App\Mail\SendClaimedOnProcessMailable;
use App\Mail\SendClaimedCompletedMailable;
use App\Helper\Helper;
use App\Mail\SendClaimedMailable;

class ClaimedController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $req) 
    {
        $currentUser = UserManagement::find(Auth::id());
        $page_title = 'Claimed';
        $page_description = '';
        $processes = Process::where('status', 3)->orderBy('created_at','desc')->get();
        $method = $req->method();
        if ($req->isMethod('post'))
        {
            $raw_from = $req->input('from_date');
            $raw_to   = $req->input('to_date');

            $from = $raw_from.' 00:00:00';
            $to = $raw_to.' 23:59:59'; 

            return Excel::download(new ClaimedExport($from, $to), 'Report Claimed '.$from.' - '.$to.'.xlsx');
 
        } 
        
        return view('back_web.process.claimed', compact('page_title', 'page_description', 'currentUser', 'processes'));
    }

    public function detail($id) 
    {
        $currentUser = UserManagement::find(Auth::id());
        $page_title = 'Detail Claimed';
        $page_description = '';
        $process = Process::where('id', $id)->first();

        if (!$process) {
            return redirect()->route('process.claimed.index')->with(['error'=>'Invalid parameter id.']);
        }
        return view('back_web.process.claimed_detail', compact('page_title', 'page_description', 'currentUser', 'process'));
    }

    public function edit($id, Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'status_claim' => 'required|string|max:255',
        ]);

        if ($validator->fails())
        {
            return redirect()->route('process.claimed.index')->with(['error'=>'Data not valid.']);
        }

        $process = Process::where([
            ['id', '=', $id]
        ])->first();
        if (!$process) {
            return redirect()->route('process.claimed.index')->with(['error'=>'Invalid parameter id.']);
        }

        $process->status_claim = $data['status_claim']; 
        if ( $process->status_claim == '1') {
            $name = $process->customers->users->name;
            Mail::to($process->customers->users->email)->send(new SendClaimedPickupMailable($name));
        }
        if ($process->status_claim == '2') {
            $name = $process->customers->users->name;
            Mail::to($process->customers->users->email)->send(new SendClaimedOnProcessMailable($name));
        }
        if ($process->status_claim == '3') {
            $name = $process->customers->users->name;
            Mail::to($process->customers->users->email)->send(new SendClaimedCompletedMailable($name));
        }

        $process->save();

        return redirect()->route('process.claimed.index')->with(['success'=>'Action successed.']);
    }

}
