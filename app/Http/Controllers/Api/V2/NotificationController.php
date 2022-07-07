<?php

namespace App\Http\Controllers\Api\V2;

use App\BackWeb\Setting\CustomerManagement;
use App\BackWeb\Process\Process;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Other\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Password;

use Carbon\Carbon;

use App\Helper\Helper;

class NotificationController extends Controller
{
    
   public function getNotification() {
    if(Auth::check()){

        $customer = CustomerManagement::where([
            ['users_id', '=', Auth::id()]
        ])->first();
        
        $notif_raw = Notification::where([
            ['customers_id', '=', $customer->id],
            ['show', '=', 0],
            ['read', '=', 0],
        ])->first();

        if (empty($notif_raw)) {
            return response()->json(['message' => 'not found.'], 404);
        }

        $data = [
            'notif' => $notif_raw
        ];
        $notif = Notification::where([
            ['customers_id', '=', $customer->id],
            ['show', '=', 0],
            ['read', '=', 0],
        ])->first();

        $notif->show = 1;
        $notif->save();

        return response()->json(['data' => $data], 200);

       
    }
   }

//    public function updateNotification() {
//     $customer = CustomerManagement::where('users_id', Auth::id())->first();

//     $input = $request->all();

//     $validator = Validator::make($input, [
//         'show' => 'required|integer',
//     ]);

//     if($validator->fails()){
//         return response()->json([
//             'messages' => $validator->errors()
//         ], 400);
//     }

//     if ($input['show'] != 1) {
//         return response()->json([
//             'messages' => 'Data not found'
//         ], 400); 
//     }

//     $notification = Process::where([
//         ['imei', '=', $input['imei']], 
//         ['status', '=', '1']
//     ])->first();

//     if ($process_exist) {
//         $process_exist->contact_alternatif = $request->input('contact_alternatif');
//         $process_exist->tanggal_kerusakan = $request->input('tanggal_kerusakan');

//         $process_exist->save();

//         return response()->json(['success'], 201);
//     }

//     else {
//         return response()->json([
//             "message" => "kamu belum terdaftar dalam membership."
//         ], 401);
//     }
// }
// $input['customers_id'] = $customer->id;
//    }

}
