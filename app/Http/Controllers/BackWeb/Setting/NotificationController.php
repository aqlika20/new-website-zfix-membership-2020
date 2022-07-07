<?php

namespace App\Http\Controllers\BackWeb\Setting;

use App\BackWeb\Setting\UserManagement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() 
    {
        $currentUser = UserManagement::find(Auth::id());
        $page_title = 'Notification';
        $page_description = '';
        return view('back_web.setting.notification', compact('page_title', 'page_description', 'currentUser'));
    }

}
