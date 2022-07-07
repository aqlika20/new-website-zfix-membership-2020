<?php

namespace App\Http\Controllers\BackWeb;

use App\BackWeb\Setting\CustomerManagement;
use App\BackWeb\Setting\UserManagement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() 
    {
        $currentUser = UserManagement::find(Auth::id());
        $page_title = 'Profile';
        $page_description = '';
        if ($currentUser->roles->id == 5) {
            $currentCustomer = CustomerManagement::where('users_id', $currentUser->id)->first();
            return view('back_web.profile', compact('page_title', 'page_description', 'currentUser', 'currentCustomer'));
        }
        else {
            return view('back_web.profile', compact('page_title', 'page_description', 'currentUser'));
        }
        
    }

    public function edit(Request $request)
    {
        $currentUser = UserManagement::find(Auth::id());

        $data = $request->all();

        if ($currentUser->roles->id == 5) {
            $validator = Validator::make($data, [
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'contact' => 'required|string|max:255'
            ]);
        }
        else {
            $validator = Validator::make($data, [
                'name' => 'required|string|max:255'
            ]);
        }

        if ($validator->fails())
        {
            return redirect()->route('profile.index')->with(['error'=>'Data not valid.']);
        }

        $user = UserManagement::where([
            ['id', '=', Auth::id()]
        ])->first();

        $user->name = $data['name'];
        $user->save();

        if ($currentUser->roles->id == 5) {
            $customer = CustomerManagement::where('users_id', $user->id)->first();
            $customer->address = $data['address'];
            $customer->contact = $data['contact'];
            $customer->save();
        }        

        return redirect()->route('profile.index')->with(['success'=>'Data edited.']);
    } 

    public function change_password(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails())
        {
            return redirect()->route('profile.index')->with(['error'=>'New Password not valid.']);
        }

        $user = UserManagement::where([
            ['id', '=', Auth::id()]
        ])->first();

        $user->password = Hash::make($data['new_password']);;

        $user->save();

        return redirect()->route('profile.index')->with(['success'=>'Password changed.']);
    } 

}
