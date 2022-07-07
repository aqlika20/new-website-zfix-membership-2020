<?php

namespace App\Http\Controllers\BackWeb\Process;

use App\BackWeb\Process\Process;
use App\Exports\BackWeb\Process\RejectedExport;
use App\BackWeb\Setting\UserManagement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


class RejectedController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $req) 
    {
        $currentUser = UserManagement::find(Auth::id());
        $page_title = 'Rejected';
        $page_description = '';
        $processes = Process::where('status', -1)->orderBy('created_at','desc')->get();

        $method = $req->method();
        if ($req->isMethod('post'))
        {
            $raw_from = $req->input('from_date');
            $raw_to   = $req->input('to_date');

            $from = $raw_from.' 00:00:00';
            $to = $raw_to.' 23:59:59'; 

            return Excel::download(new RejectedExport($from, $to), 'Report Rejected '.$from.' - '.$to.'.xlsx');
 
        } 

        return view('back_web.process.rejected', compact('page_title', 'page_description', 'currentUser', 'processes'));
    }

    public function detail($id) 
    {
        $currentUser = UserManagement::find(Auth::id());
        $page_title = 'Detail Rejected';
        $page_description = '';
        $process = Process::where('id', $id)->first();
        if (!$process) {
            return redirect()->route('process.rejected.index')->with(['error'=>'Invalid parameter id.']);
        }

        return view('back_web.process.rejected_detail', compact('page_title', 'page_description', 'currentUser', 'process'));
    }

}
