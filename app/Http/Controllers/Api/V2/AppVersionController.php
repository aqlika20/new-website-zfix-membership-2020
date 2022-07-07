<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\BackWeb\Setting\AppVersion;

class AppVersionController extends Controller
{
    public function detail(){
        if(Auth::check()){
            
            $version = AppVersion::all();

            $data = [
                'version' => $version[0]->version,
            ];

            return response()->json(['data' => $data], 200);
        }
    }
}
