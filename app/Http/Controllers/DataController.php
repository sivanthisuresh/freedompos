<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Inmate;
use App\Models\Transaction;
use App\Models\Invoice;
use App\Models\Inovicedetail;
use App\Models\Block;
use App\Models\Product;
use Carbon\Carbon;


class DataController extends Controller
{
    public $todayDate ;
    public $prodCatSales;
    public $blockSales;

    public $blockCredits;
    public $blockDebits;


    public function index(){
        $this->todayDate = Carbon::now()->format('Y-m-d');
        /*
        $prodCats = ['PCP-CANTEEN','PB-WET-CANTEEN', 'PB-DRY-CANTEEN','DEPARTMENT-STORE'];
        $x=0;
        foreach ($prodCats as $cat ) {
            $productIds = Product::where('product_category',$cat)->select('id','product_sell_price')->get();
            $temp_amount = 0;
            foreach($productIds as $prodid){
                $temp_single_amt = Inovicedetail::where('invoicedetail_product_id',$prodid->id)
                                                ->whereDate('created_at',$this->todayDate)
                                                ->sum('invoicedetails_product_qty');
                $temp_amount += ($temp_single_amt * $prodid->product_sell_price);
            }
            
            $prodCatSales[$x]["prod_catname"] = $cat;
            $prodCatSales[$x]["sales"] = $temp_amount;
            $x++;
        }

        */

        $blocks = Block::select('id','block_name')->get();
        
        $x = 0;
        
        foreach ($blocks as $block ) {
            //echo $block->id."=>";
            $inmates = Inmate::where('inmate_block_id',$block->id)->select('inmate_rpno')->get();
            //echo $inmates."<br>";
            $temp_single_amt = 0;
            foreach ($inmates as $inmate) {

                $temp_single_amt += Invoice::where('invoice_cus_id', $inmate->inmate_rpno)
                                            ->whereDate('created_at',$this->todayDate)
                                            ->sum('invoice_amount');

            }

            $this->blockSales[$x]["sales"] = $temp_single_amt;
            $x++;


        }


        $x = 0;

        foreach ($blocks as $block ) {
            
            $this->blockCredits[$x]["block_name"] = $block->block_name;
            $credits = ['PHONE-RECHARGE','MO-ADVOCATE','MO-FAMILY','MO-PAROLE','MEDICAL','STAMPS','LEAVE-BAIL'];
            

            foreach ($credits as $credit ) {
                //wage
                $inmates = Inmate::where('inmate_block_id',$block->id)->select('id')->get();
                $temp_credit = 0;
                foreach ($inmates as $inmate ) {
                    $temp_credit += Transaction::where('transaction_inmate_id',$inmate->id)
                                                ->where('transaction_mode',$credit)
                                                ->whereDate('created_at',$this->todayDate)
                                                ->sum('transaction_amt');
                }
                $this->blockDebits[$x][$credit] = $temp_credit;
            }
            $x++;
        }

        echo json_encode($this->blockCredits);
    }

   

    public function getInmate(Request $request)
    {   
        $days = [-6,0,-1,-2,-3,-4,-5];
        $toDay =  Carbon::now()->dayOfWeek;
        $fromdate = Carbon::now()->addDays($days[$toDay]);
        $todate = Carbon::now()->toDateTimeString();
        
        $inmateData = array();
        $inmateTagNo = $request->tagno;
        $inmates = Inmate::where('inmate_rpno',$inmateTagNo)->select('inmate_name','inmate_fname','inmate_dob','inmate_rpno','inmate_accno','inmate_balance')->get();
        $weeklimit =0;
        foreach ($inmates as $inmate) {
            $inmateData["name"] = $inmate->inmate_name;
            $inmateData["fname"]= $inmate->inmate_fname;
            $inmateData["dob"] = $inmate->inmate_dob;
            $inmateData["accbal"] = "Rs.".$inmate->inmate_balance;
            $weeklimit = "Rs.".$inmate->inmate_accno;
            $tempweek = $inmate->inmate_accno;
            $inmateData["limitbal"] = "Rs.".$inmate->inmate_accno;
        }
        
        $transactions = Invoice::where('invoice_cus_id','=',$inmateTagNo)
                                    ->whereDate('created_at',[$fromdate,$todate])
                                    ->sum('invoice_amount');

        $inmateData["weekbal"] = "Rs.".($tempweek - $transactions)  ;
        return response()->json($inmateData);
    }

   
    

}
