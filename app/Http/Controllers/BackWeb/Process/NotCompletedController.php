<?php

namespace App\Http\Controllers\BackWeb\Process;

use App\BackWeb\Process\Process;
use App\BackWeb\Setting\UserManagement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotCompletedController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() 
    {
        $currentUser = UserManagement::find(Auth::id());
        $page_title = 'Not Completed';
        $page_description = '';
        $processes = Process::where('status', '=', -4)->orderBy('created_at','desc')->get();
        return view('back_web.process.not_completed', compact('page_title', 'page_description', 'currentUser', 'processes'));
    }

}
