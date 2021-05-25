<?php

namespace App\Http\Controllers;

use App\Models\Inmate;
use App\Models\Invoice;

use Illuminate\Http\Request;
use Carbon\Carbon;

class InmateController extends Controller
{

    public function getWeekTransaction(Request $request)
    {
        $days = [-6,0,-1,-2,-3,-4,-5];
        $toDay =  Carbon::now()->dayOfWeek;
        $fromdate = Carbon::now()->addDays($days[$toDay]);
        $todate = Carbon::now()->toDateTimeString();

        $rpno = $request->tagno;
  
        $invoices  = Invoice::where('invoice_cus_id','=',$rpno)
                                    ->whereBetween('created_at',[$fromdate,$todate])
                                    ->select('invoice_amount')
                                    ->get();
        $totalWeekSpend = 0;
        
        foreach ($invoices  as $invoice) {
            $totalWeekSpend += $invoice['invoice_amount'] * 1 ;
        }
        
        return response()->json($totalWeekSpend);
    }
    
}