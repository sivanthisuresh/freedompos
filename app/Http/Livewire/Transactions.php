<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

use App\Models\Inmate;
use App\Models\Transaction;
use App\Models\Invoice;
use App\Models\Block;
use Carbon\Carbon;

class Transactions extends Component
{
    
    public $account_rpno;
    public $inmates;
    public $inmate_id;
    public $term;

    public $inmate_name;
    public $inmate_fname;
    public $inmate_rpno;
    public $inmate_blockno;
    public $inmate_photo_file;
    public $inmate_photo;
    public $inmate_dob;
    public $inmate_accno;
    public $inmate_balance;
 
    public $inmate_weekspend;
    public $inmate_weekbal;
    public $transaction_type;
    public $transaction_amt;

    public $translist;

    public $check;
    public $fromdate;
    public $todate;

    public $Qfromdate;
    public $Qtodate;

    public function render()
    {
        $days = [-6,0,-1,-2,-3,-4,-5];
        $toDay =  Carbon::now()->dayOfWeek;
        $this->fromdate = date_format( Carbon::now()->addDays($days[$toDay]),"d/m/Y");
        $this->todate = date_format(Carbon::now(), "d/m/Y");

        $this->Qfromdate = Carbon::now()->addDays($days[$toDay]);
        $this->Qtodate = Carbon::now()->toDateTimeString();

        return view('livewire.transactions');
         
    }

    public function getAllTransactions(){
        
        $this->clearInmate();
        
        $validatedData  = $this->validate([
            'term' => 'required|min:6',
        ]);


        $this->inmates = Inmate::where('inmate_rpno',$this->term)->first();
       
        
        
        //dd($this->inmates);
       
        if($this->inmates)
        {

            $block_name  = Block::where('id',$this->inmates->inmate_block_id)->select('block_name')->first();

            $response = Http::post('127.0.0.1:8080/cbe/v5/public/api/inmate', [
                'tagno' => $this->inmates->inmate_rpno,
            ]);

          
                
            $this->check = 1;
            $this->inmate_rpno = $this->inmates->inmate_rpno;
            $this->inmate_name = $this->inmates->inmate_name;
            $this->inmate_accno = $this->inmates->inmate_accno;
            $this->inmate_balance = $this->inmates->inmate_balance;
            $this->inmate_fname = $this->inmates->inmate_fname;
            $this->inmate_dob = $this->inmates->inmate_dob;
            $this->inmate_blockno = $block_name->block_name;
            $this->inmate_weekspend = $response->body();
            $this->inmate_weekbal = (double)$this->inmate_accno - (double)$this->inmate_weekspend;
            $retails = Invoice::where('invoice_cus_id',$this->inmates->inmate_rpno)->get();
            
            $i = 0;
            $this->translist = array();
            if($retails){
                foreach ($retails as $retail ) {
                    $this->translist[$i]["date"] = $retail->created_at;
                    $this->translist[$i]["amount"] = "- ₹ ".$retail->invoice_amount;
                    $this->translist[$i]["mode"] = "PRISONER OUTLET";
                    $this->translist[$i]["type"] = "red";
                    $i++;
                }
            }

            $trans = Transaction::where('transaction_inmate_id',$this->inmates->id)->get();
            
            if($trans){
                foreach ($trans as $tran ) {
                    $this->translist[$i]["date"] = $tran->created_at;
                    $this->translist[$i]["mode"] = $tran->transaction_mode;
                    if($tran->transaction_type == "EXPENSE"){
                        $this->translist[$i]["type"] = "red";
                        $this->translist[$i]["amount"] = "- ₹ ".$tran->transaction_amt;
                    }else{
                        $this->translist[$i]["type"] = "green";
                        $this->translist[$i]["amount"] = "+ ₹ ".$tran->transaction_amt;
                    }

                    $i++;

                }
            }
            
            rsort($this->translist);
            
        }
        //dd($this->check);
    }


    public function getNoTransactions(){
        
        

        $this->inmates = Inmate::where('inmate_rpno',$this->term)->first();
       
        
        
        //dd($this->inmates);
       
        if($this->inmates)
        {

            $block_name  = Block::where('id',$this->inmates->inmate_block_id)->select('block_name')->first();

            $response = Http::post('127.0.0.1:8080/cbe/v5/public/api/inmate', [
                'tagno' => $this->inmates->inmate_rpno,
            ]);

          
                
            $this->check = 1;
            $this->inmate_rpno = $this->inmates->inmate_rpno;
            $this->inmate_name = $this->inmates->inmate_name;
            $this->inmate_accno = $this->inmates->inmate_accno;
            $this->inmate_balance = $this->inmates->inmate_balance;
            $this->inmate_fname = $this->inmates->inmate_fname;
            $this->inmate_dob = $this->inmates->inmate_dob;
            $this->inmate_blockno = $block_name->block_name;
            $this->inmate_weekspend = $response->body();
            $this->inmate_weekbal = (double)$this->inmate_accno - (double)$this->inmate_weekspend;
            $retails = Invoice::where('invoice_cus_id',$this->inmates->inmate_rpno)->get();
            
            $i = 0;
            $this->translist = array();
            if($retails){
                foreach ($retails as $retail ) {
                    $this->translist[$i]["date"] = $retail->created_at;
                    $this->translist[$i]["amount"] = "- ₹ ".$retail->invoice_amount;
                    $this->translist[$i]["mode"] = "PRISONER OUTLET";
                    $this->translist[$i]["type"] = "red";
                    $i++;
                }
            }

            $trans = Transaction::where('transaction_inmate_id',$this->inmates->id)->get();
            
            if($trans){
                foreach ($trans as $tran ) {
                    $this->translist[$i]["date"] = $tran->created_at;
                    $this->translist[$i]["mode"] = $tran->transaction_mode;
                    if($tran->transaction_type == "EXPENSE"){
                        $this->translist[$i]["type"] = "red";
                        $this->translist[$i]["amount"] = "- ₹ ".$tran->transaction_amt;
                    }else{
                        $this->translist[$i]["type"] = "green";
                        $this->translist[$i]["amount"] = "+ ₹ ".$tran->transaction_amt;
                    }

                    $i++;

                }
            }
            
            rsort($this->translist);
            
        }
        //dd($this->check);
    }

    public function getWeekTransactions(){
        
       

        $this->inmates = Inmate::where('inmate_rpno',$this->term)->first();
        
        
        //dd($this->inmates);
       
        if($this->inmates)
        {

            $block_name  = Block::where('id',$this->inmates->inmate_block_id)->select('block_name')->first();

            $response = Http::post('127.0.0.1:8080/cbe/v5/public/api/inmate', [
                'tagno' => $this->inmates->inmate_rpno,
            ]);

          
                
            $this->check = 1;
            $this->inmate_rpno = $this->inmates->inmate_rpno;
            $this->inmate_name = $this->inmates->inmate_name;
            $this->inmate_accno = $this->inmates->inmate_accno;
            $this->inmate_balance = $this->inmates->inmate_balance;
            $this->inmate_fname = $this->inmates->inmate_fname;
            $this->inmate_dob = $this->inmates->inmate_dob;
            $this->inmate_blockno = $block_name->block_name;
            $this->inmate_weekspend = $response->body();
            $this->inmate_weekbal = (double)$this->inmate_accno - (double)$this->inmate_weekspend;
            $retails = Invoice::where('invoice_cus_id',$this->inmates->inmate_rpno)
                                ->whereBetween('created_at',[$this->Qfromdate,$this->Qtodate])
                                ->get();
            
            $i = 0;
            $this->translist = array();
            if($retails){
                foreach ($retails as $retail ) {
                    $this->translist[$i]["date"] = $retail->created_at;
                    $this->translist[$i]["amount"] = "- ₹ ".$retail->invoice_amount;
                    $this->translist[$i]["mode"] = "PRISONER OUTLET";
                    $this->translist[$i]["type"] = "red";
                    $i++;
                }
            }

            $trans = Transaction::where('transaction_inmate_id',$this->inmates->id)
                                ->whereBetween('created_at',[$this->Qfromdate,$this->Qtodate])
                                ->get();
            
            if($trans){
                foreach ($trans as $tran ) {
                    $this->translist[$i]["date"] = $tran->created_at;
                    $this->translist[$i]["mode"] = $tran->transaction_mode;
                    if($tran->transaction_type == "EXPENSE"){
                        $this->translist[$i]["type"] = "red";
                        $this->translist[$i]["amount"] = "- ₹ ".$tran->transaction_amt;
                    }else{
                        $this->translist[$i]["type"] = "green";
                        $this->translist[$i]["amount"] = "+ ₹ ".$tran->transaction_amt;
                    }

                    $i++;

                }
            }
            
            rsort($this->translist);
            
        }
        //dd($this->check);
    }

    public function clearInmate(){
        $this->check = 0;
        $this->inmate_rpno = "";
        $this->inmate_name = "";
        $this->inmate_accno = "";
        $this->inmate_balance = "";
        $this->inmate_fname = "";
        $this->inmate_dob = "";
        $this->inmate_blockno = "";
        $this->inmate_weekbal = "";
    }

    public function clearAll(){
        $this->term = "";
        $this->check = 0;
        $this->inmate_rpno = "";
        $this->inmate_name = "";
        $this->inmate_accno = "";
        $this->inmate_balance = "";
        $this->inmate_fname = "";
        $this->inmate_dob = "";
        $this->inmate_blockno = "";
        $this->inmate_weekbal = "";

    }

}
