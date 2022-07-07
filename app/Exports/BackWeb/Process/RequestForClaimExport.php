<?php

namespace App\Exports\BackWeb\Process;

use App\BackWeb\Process\Process;
use App\BackWeb\Setting\UserManagement;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class RequestForClaimExport implements FromView, ShouldAutoSize, WithTitle
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
     // varible form and to 
     public function __construct(String $from = null , String $to = null)
     {
         $this->from = $from;
         $this->to   = $to;
     }

    public function title(): string
    {
        return 'Request For Claim';
    }

     //function header in excel
     public function view(): View
     {
       $request_claim = Process::where('updated_at','>=',$this->from)->where('updated_at','<=', $this->to)->get();  
       $currentUser = UserManagement::find(Auth::id());

        return  view('layout.back_web.export._excel_request_claim', [
            'currentUser' => $currentUser,
            'request_claim_data' => $request_claim
        ]);
    }
}

