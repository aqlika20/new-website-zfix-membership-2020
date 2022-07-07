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

class RegisterNewPartnerExport implements FromView, ShouldAutoSize, WithTitle
{

    use Exportable;

    public function forParam(int $id, int $status)
    {
        $this->id = $id;
        $this->status = $status;

        return $this;
    }

    public function title(): string
    {
        if ($this->status == 0) {
            $statusSheet = 'In-Active';
        }
        else if ($this->status == 1) {
            $statusSheet = 'Sold';
        }
        else if ($this->status == 2) {
            $statusSheet = 'Active';
        }
        return $statusSheet;
    }

    public function view(): View
    {
        $currentUser = UserManagement::find(Auth::id());
        $vouchers = GenerateVoucher::where(['partners_id' => $this->id, 'status' => $this->status])->get();

        return view('layout.back_web.export._excel_voucher', [
            'currentUser' => $currentUser,
            'status' => $this->status,
            'vouchers_data' => $vouchers
        ]);
    }

}
