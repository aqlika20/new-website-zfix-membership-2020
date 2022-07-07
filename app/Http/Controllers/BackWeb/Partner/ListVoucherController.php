<?php

namespace App\Http\Controllers\BackWeb\Partner;

use App\Exports\BackWeb\Partner\ListVoucherExport;
use App\BackWeb\Partner\GenerateVoucher;
use App\BackWeb\Partner\RegisterNewPartner;
use App\BackWeb\Setting\UserManagement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ListVoucherController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() 
    {
        $currentUser = UserManagement::find(Auth::id());
        $page_title = 'List Voucher';
        $page_description = '';
        $partner = RegisterNewPartner::where('users_id', Auth::id())->get()->first();
        $vouchers = GenerateVoucher::where('partners_id', $partner->id)->get();
        $vouchers_in_active = GenerateVoucher::where(
            [
                ['partners_id', '=', $partner->id] ,
                ['status', '=', 0]
            ]
        )->count();
        $vouchers_sold = GenerateVoucher::where(
            [
                ['partners_id', '=', $partner->id] ,
                ['status', '=>', 1]
            ]
        )->count();
        $vouchers_active = GenerateVoucher::where(
            [
                ['partners_id', '=', $partner->id] ,
                ['status', '=', 2]
            ]
        )->count();
        $id = $partner->id;
        return view('back_web.partner.list_voucher', compact('page_title', 'page_description', 'currentUser', 'vouchers', 'vouchers_in_active', 'vouchers_sold', 'vouchers_active', 'id'));
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
        return (new ListVoucherExport)->forParam($id, $status)->download('List Voucher ('.$statusFile.').xlsx');
    }

    public function sold($id)
    {
        $voucher = GenerateVoucher::where([
            ['voucher_key', '=', $id]
        ])->first();

        if (!$voucher) {
            return redirect()->route('partner.list-voucher.index',[$voucher->partners_id])->with(['error'=>'Voucher has not registered yet.']);
        }
        if ($voucher->status != 0) {
            return redirect()->route('partner.list-voucher.index',[$voucher->partners_id])->with(['error'=>'Voucher has been sold.']);
        }

        $voucher->status = 1;
        
        $voucher->save();

        return redirect()->route('partner.list-voucher.index',[$voucher->partners_id])->with(['success'=>'Voucher sold.']);
    }

}
