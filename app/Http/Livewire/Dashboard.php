<?php

namespace App\Http\Livewire;

use App\Models\Inmate;
use App\Models\Transaction;
use App\Models\Invoice;
use App\Models\Inovicedetail;
use App\Models\Block;
use App\Models\Product;
use Carbon\Carbon;

use Livewire\Component;

class Dashboard extends Component
{
    public $todayDate ;
    public $inmateCount ;
    
    public $creditToday; 
    public $debitToday;
    
    public $freedomsales;
    public $inmatesales;

    public $blockWiseInmates ;
    public $prodCatSales;
    

    public $blockCredits;
    public $blockDebits;

    public function render()
    {
        $this->todayDate = Carbon::now()->format('Y-m-d');

        $this->inmateCount = Inmate::all()->count();

        $this->creditToday = Transaction::where('created_at','>',$this->todayDate )
                                ->where('transaction_type','INCOME')
                                ->sum('transaction_amt');

        $this->debitToday = Transaction::where('created_at','>',$this->todayDate )
                                ->where('transaction_type','EXPENSE')
                                ->sum('transaction_amt');

        $this->freedomsales = Invoice::where('invoice_type','=', 'FREEDOM-OUTLET')
                                    ->whereDate('created_at', $this->todayDate)
                                    ->sum('invoice_amount');

        $this->inmatesales = Invoice::where('invoice_type','=', 'INMATE-OUTLET')
                                ->whereDate('created_at', $this->todayDate)
                                ->sum('invoice_amount');                            
        
        /*
        $temp =  Invoice::whereDate('created_at', $this->todayDate)->get();
        */
        
        $blocks = Block::select('id','block_name')->get();
        
        $x = 0;
        foreach ($blocks as $block ) {
            $this->blockWiseInmates[$x]["block_name"] = $block->block_name;
            $this->blockWiseInmates[$x]["count"] = Inmate::where('inmate_block_id','=', $block->id)->count();
           
            $inmates = Inmate::where('inmate_block_id',$block->id)->select('inmate_rpno')->get();
            $temp_single_amt = 0;
            foreach ($inmates as $inmate) {

                $temp_single_amt += Invoice::where('invoice_cus_id', $inmate->inmate_rpno)
                                            ->whereDate('created_at',$this->todayDate)
                                            ->sum('invoice_amount');

            }

            $this->blockWiseInmates[$x]["sales"] = $temp_single_amt;
            $x++;
        }
        
       // dd($this->blockWiseInmates);
        $x = 0;
       
        

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
            
            $this->prodCatSales[$x]["prod_catname"] = $cat;
            $this->prodCatSales[$x]["sales"] = $temp_amount;
            $x++;
        }



        $x = 0;

        foreach ($blocks as $block ) {
            
            $this->blockCredits[$x]["block_name"] = $block->block_name;
            $credits = ['WAGE','INTERVIEW-ADVOCATE','INTERVIEW-FAMILY','INTERVIEW','MONEY ORDER','ADMISSION','LEAVE-PAROLE'];
         
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
                $this->blockCredits[$x][$credit] = $temp_credit;
            }
            $x++;
        }

        



        foreach ($blocks as $block ) {
            
            $this->blockDebits[$x]["block_name"] = $block->block_name;
           
            $debits = ['PHONE-RECHARGE','MO-ADVOCATE','MO-FAMILY','MO-PAROLE','MEDICAL','STAMPS','LEAVE-BAIL'];

            foreach ($debits as $debit ) {
                //wage
                $inmates = Inmate::where('inmate_block_id',$block->id)->select('id')->get();
                $temp_debit = 0;
                foreach ($inmates as $inmate ) {
                    $temp_debit += Transaction::where('transaction_inmate_id',$inmate->id)
                                                ->where('transaction_mode',$debit)
                                                ->whereDate('created_at',$this->todayDate)
                                                ->sum('transaction_amt');
                }
                $this->blockDebits[$x][$debit] = $temp_debit;
            }
            
            $x++;

        }
        $x =0;

       

        return view('livewire.dashboard');

    }



}
