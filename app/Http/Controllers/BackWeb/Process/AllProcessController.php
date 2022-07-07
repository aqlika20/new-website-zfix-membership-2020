<?php

namespace App\Http\Controllers\BackWeb\Process;

use App\BackWeb\Process\Process;
use App\BackWeb\Setting\UserManagement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AllProcessController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() 
    {
        $currentUser = UserManagement::find(Auth::id());
        $page_title = 'All Process';
        $page_description = '';
        $processes = Process::where('status', '!=', -4)->orderBy('created_at','desc')->get();
        return view('back_web.process.all_process', compact('page_title', 'page_description', 'currentUser', 'processes'));
    }

}
