<?php

namespace App\Exports\BackWeb\Partner;

use App\BackWeb\Partner\GenerateVoucher;
use App\BackWeb\Setting\UserManagement;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\Auth;

class GenerateVoucherExport implements FromView, ShouldAutoSize, WithTitle
{

    use Exportable;

    public function forParam(int $id, string $inserted_at)
    {
        $this->id = $id;
        $this->inserted_at = $inserted_at;

        return $this;
    }

    public function title(): string
    {
        return 'Generate Voucher';
    }

    public function view(): View
    {
        $currentUser = UserManagement::find(Auth::id());
        $vouchers = GenerateVoucher::where(['partners_id' => $this->id, 'inserted_at' => $this->inserted_at])->get();

        return view('layout.back_web.export._excel_voucher', [
            'currentUser' => $currentUser,
            'status' => 0,
            'vouchers_data' => $vouchers
        ]);
    }

}
