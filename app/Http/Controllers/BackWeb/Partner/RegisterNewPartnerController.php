<?php

namespace App\Http\Controllers\BackWeb\Partner;

use App\Exports\BackWeb\Partner\RegisterNewPartnerExport;
use App\BackWeb\Partner\GenerateVoucher;
use App\BackWeb\Partner\RegisterNewPartner;
use App\BackWeb\Setting\UserManagement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterNewPartnerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() 
    {
        $currentUser = UserManagement::find(Auth::id());
        $page_title = 'Register New Partner';
        $page_description = '';
        $partners = RegisterNewPartner::all();
        return view('back_web.partner.register_new_partner', compact('page_title', 'page_description', 'currentUser', 'partners'));
    }

    public function detail($id) 
    {
        $currentUser = UserManagement::find(Auth::id());
        $page_title = 'Detail Register New Partner';
        $page_description = '';
        $vouchers = GenerateVoucher::where('partners_id', $id)->get();
        if ($vouchers->count() == 0) {
            return redirect()->route('partner.register-new-partner.index')->with(['error'=>'Invalid parameter id.']);
        }
        $vouchers_in_active = GenerateVoucher::where(['partners_id' => $id, 'status' => '0'])->count();
        $vouchers_sold = GenerateVoucher::where(['partners_id' => $id, 'status' => '1'])->count();
        $vouchers_active = GenerateVoucher::where(['partners_id' => $id, 'status' => '2'])->count();
        return view('back_web.partner.register_new_partner_detail', compact('page_title', 'page_description', 'currentUser', 'vouchers', 'vouchers_in_active', 'vouchers_sold', 'vouchers_active','id'));
    }

    public function create(Request $request) 
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'pic' => 'required|string|max:255',
            'contact_pic' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'partner_key' => 'required|string|max:255',

        ]);

        if ($validator->fails())
        {
            return redirect()->route('partner.register-new-partner.index')->with(['error'=>'Data not valid.']);
        }
        
        $data['password'] = Hash::make($data['password']);
        $data['roles_id'] = '4'; 

        $users_id = UserManagement::create($data)->id;

        // if ($users_id < 10) {
        //     $data['partner_key'] = '0'.strval($users_id);
        // }
        // else {
        //     $data['partner_key'] = strval($users_id);
        // }
        
        $data['users_id'] = $users_id;

        RegisterNewPartner::create($data);

        return redirect()->route('partner.register-new-partner.index')->with(['success'=>'Data created.']);
    }

    public function export($id, $status) 
    {
        if ($status == 0) {
            $statusFile = 'In-Active';
        }
        else if ($status == 1) {
            $statusFile = 'Sold';
        }
        else if ($status == 2) {
            $statusFile = 'Active';
        }
        return (new RegisterNewPartnerExport)->forParam($id, $status)->download('List Voucher ('.$statusFile.').xlsx');
    }

    public function view($id) 
    {
        $currentUser = UserManagement::find(Auth::id());
        $page_title = 'Edit Register New Partner';
        $page_description = '';
        $partner = RegisterNewPartner::find($id);
        if (!$partner) {
            return redirect()->route('partner.register-new-partner.index')->with(['error'=>'Invalid parameter id.']);
        }
        return view('back_web.partner.register_new_partner_edit', compact('page_title', 'page_description', 'currentUser', 'partner'));
    }

    public function edit($id, Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'pic' => 'required|string|max:255',
            'contact_pic' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        if ($validator->fails())
        {
            return redirect()->route('partner.register-new-partner.index')->with(['error'=>'Data not valid.']);
        }

        $partner = RegisterNewPartner::where([
            ['id', '=', $id]
        ])->first();
        if (!$partner) {
            return redirect()->route('partner.register-new-partner.index')->with(['error'=>'Invalid parameter id.']);
        }

        $user = UserManagement::where([
            ['id', '=', $partner->users_id]
        ])->first();

        $user->name = $data['name'];
        $partner->pic = $data['pic'];
        $partner->contact_pic = $data['contact_pic'];
        $partner->address = $data['address'];
        
        $user->save();
        $partner->save();

        return redirect()->route('partner.register-new-partner.index')->with(['success'=>'Data edited.']);
    }

    public function sold($id)
    {
        $voucher = GenerateVoucher::where([
            ['voucher_key', '=', $id]
        ])->first();
        if (!$voucher) {
            return redirect()->route('partner.register-new-partner.index',[$voucher->partners_id])->with(['error'=>'Invalid parameter id.']);
        }

        $voucher->status = 1;
        
        $voucher->save();

        return redirect()->route('partner.register-new-partner.detail',[$voucher->partners_id])->with(['success'=>'Voucher sold.']);
    }

    public function delete($id) 
    {
        $partner = RegisterNewPartner::where([
            ['id', '=', $id]
        ])->first();
        if (!$partner) {
            return redirect()->route('partner.register-new-partner.index')->with(['error'=>'Invalid parameter id.']);
        }

        RegisterNewPartner::where('id', $id)->delete();
        GenerateVoucher::where('id', $id)->delete();
        UserManagement::where('id', $partner->users_id)->delete();
        return redirect()->route('partner.register-new-partner.index')->with(['success'=>'Data deleted.']);
    }

}
