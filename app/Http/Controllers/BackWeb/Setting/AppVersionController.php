<?php

namespace App\Http\Controllers\BackWeb\Setting;

use App\BackWeb\Setting\UserManagement;
use App\BackWeb\Setting\AppVersion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AppVersionController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() 
    {
        $currentUser = UserManagement::find(Auth::id());
        $page_title = 'App Version';
        $page_description = '';
        $app_version = AppVersion::where('id',1)->first();

        return view('back_web.setting.app_version', compact('page_title', 'page_description', 'currentUser', 'app_version')); 
    }

    public function edit(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'version' => 'required|string|max:255'
        ]);

        if ($validator->fails())
        {
            return redirect()->route('setting.app-version.index')->with(['error'=>'Data not valid.']);
        }

        $app_version = AppVersion::where([
            ['id', '=', 1]
        ])->first();
        if (!$app_version) {
            return redirect()->route('setting.app-version.index')->with(['error'=>'Invalid parameter id.']);
        }

        $app_version->version = $data['version'];

        $app_version->save();

        return redirect()->route('setting.app-version.index')->with(['success'=>'Data edited.']);
    }
}
