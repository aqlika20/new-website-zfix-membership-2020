<?php

namespace App\Http\Controllers\Api\V2;

use App\BackWeb\Setting\CustomerManagement;
use App\BackWeb\Setting\UserManagement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\User;

class UserController extends Controller
{
    public function detail(){
        if(Auth::check()){
            
            $user = User::where('id', Auth::id())->first();
            $customer = CustomerManagement::where('users_id', Auth::id())->first();

            $data = [
                'user' => $user,
                'customer' => $customer
            ];

            return response()->json(['data' => $data], 200);
        }
    }

    public function edit(Request $request)
    {
        if(Auth::check()){

            $data = $request->all();

            $validator = Validator::make($data, [
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'contact' => 'required|string|max:255',
                'identity' => 'required|string|max:255',
                'birth_date' => 'required|string|max:255',
                'gender' => 'required|string|max:255'
            ]);
            

            if ($validator->fails())
            {
                return response()->json([
                    'messages' => $validator->errors()
                ], 400);
            }

            $user = UserManagement::where([
                ['id', '=', Auth::id()]
            ])->first();

            $user->name = $data['name'];
            $user->save();

            $customer = CustomerManagement::where('users_id', $user->id)->first();
            $customer->address = $data['address'];
            $customer->contact = $data['contact'];
            $customer->identity = $data['identity'];
            $customer->birth_date = $data['birth_date'];
            $customer->gender = $data['gender'];
            $customer->save();
                  

            return response()->json(['success'], 201);
        }
    } 
}
