<?php

namespace App\Http\Controllers\BackWeb;

use App\BackWeb\Process\Process;
use App\BackWeb\Setting\UserManagement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $currentUser = UserManagement::find(Auth::id());
        $page_title = 'Dashboard';
        $page_description = '';

        $count_queue = Process::where('status', 0)->count();
        $count_approved = Process::where('status', 1)->count();
        $count_rejected = Process::where('status', -1)->count();
        $count_expired = Process::where('status', -2)->count();
        $count_request_for_claim = Process::where('status', 2)->count();
        $count_claimed = Process::where('status', 3)->count();
        $count_rejected_claim = Process::where('status', -3)->count();

        return view('back_web.dashboard', compact('page_title', 'page_description', 'currentUser', 'count_queue', 'count_approved', 'count_rejected', 'count_expired', 'count_request_for_claim', 'count_claimed', 'count_rejected_claim' ));
    }

}
