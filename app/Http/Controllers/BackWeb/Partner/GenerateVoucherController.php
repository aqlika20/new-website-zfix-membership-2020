<?php

namespace App\Http\Controllers\BackWeb\Partner;

use App\Exports\BackWeb\Partner\GenerateVoucherExport;
use App\BackWeb\Partner\GenerateVoucher;
use App\BackWeb\Partner\RegisterNewPartner;
use App\BackWeb\Setting\UserManagement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Helper\Helper;

use Carbon\Carbon;

class GenerateVoucherController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() 
    {
        $currentUser = UserManagement::find(Auth::id());
        $page_title = 'Generate Voucher';
        $page_description = '';
        $partners = RegisterNewPartner::all();
        $vouchers = GenerateVoucher::select(DB::raw('type, COUNT(voucher_key) as amount, partners_id, inserted_at'))->groupBy('type','partners_id', 'inserted_at')->orderBy('inserted_at','desc')->get();
        return view('back_web.partner.generate_voucher', compact('page_title', 'page_description', 'currentUser', 'partners', 'vouchers'));
    }

    public function create(Request $request) 
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|numeric',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|string|max:255'
        ]);

        if ($validator->fails())
        {
            return redirect()->route('partner.generate-voucher.index')->with(['error'=>'Data not valid.']);
        }
        else if (empty(RegisterNewPartner::find($data['name'])))
        {
            return redirect()->route('setting.generate-voucher.index')->with(['error'=>'Data not valid.']);
        }
        else if ($data['type'] != 'Z Prime Lite' && $data['type'] != 'Z Prime' && $data['type'] != 'Z Prime+')
        {
            return redirect()->route('setting.generate-voucher.index')->with(['error'=>'Data not valid.']);
        }
        
        $data['partners_id'] = $data['name'];
        $partner = RegisterNewPartner::find($data['partners_id']);
        $data['status'] = 0;
        $data['inserted_at'] = Carbon::now();

        

        for ($num = 1; $num <= $data['amount']; $num++) {
            
            $data['voucher_key'] = $partner->partner_key.'-'.Helper::getVoucherKey($partner->partner_key);
            $serial_number = $num.$partner.$data['voucher_key'].date("l jS \of F Y h:i:s A").$data['type'];
            $serial_number = strtoupper(substr(md5($serial_number), 0, 8));
            $data['serial_number'] = $partner->partner_key.$serial_number;

            GenerateVoucher::create($data);
        }
    
        return redirect()->route('partner.generate-voucher.index')->with(['success'=>'Data created.']);
        
    }

    public function export($id, $inserted_at) 
    {
        return (new GenerateVoucherExport)->forParam($id, $inserted_at)->download('List Voucher (In-Active).xlsx');
    }

}
