<?php

namespace App\Http\Livewire;

use App\Models\Inmate;
use App\Models\Transaction;
use App\Models\Eventlog;
use Livewire\Component;

class Accounts extends Component
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
    public $transaction_mode;

    public $transaction_type;
    public $transaction_amt;

    public $eventlog_user_id, $eventlog_type, $eventlog_desc;


    public function render()
    {
        return view('livewire.accounts');

    }

    private function eventlog(){

        $validatedData = $this->validate([
            'eventlog_user_id' => 'required',
            'eventlog_type' => 'required',
            'eventlog_desc' => 'required'
        ]);
        Eventlog::create($validatedData);
    }


    public function search(){

        $validatedData  = $this->validate([
            'term' => 'required|min:3',
        ]);
        $searchterm  =  '%'.$this->term.'%';
        $this->inmates = Inmate::where('inmate_rpno','LIKE',$searchterm)->get();
        $this->term = "";

    }

    public function addbalance($id){

        $inmate = Inmate::where('id',$id)->first();

        $this->inmate_id = $inmate->id;
        $this->inmate_name =$inmate->inmate_name;
        $this->inmate_fname = $inmate->inmate_fname;
        $this->inmate_rpno = $inmate->inmate_rpno;
        $this->inmate_blockno = $inmate->inmate_blockno;
        $this->inmate_dob=$inmate->inmate_dob;
        $this->inmate_accno = $inmate->inmate_accno;
        $this->inmate_balance = $inmate->inmate_balance;

    }

    public function maketransaction($id)
    {

        $this->validate([

            'transaction_amt'=>'required',
            'transaction_mode'=>'required',

        ]);


        $trans = new Transaction;
        $trans->transaction_inmate_id = $this->inmate_id;
        $trans->transaction_mode = $this->transaction_mode;
        $trans->transaction_type = "INCOME";
        $trans->transaction_amt = $this->transaction_amt * 1;
        $trans->transaction_bal = (double)$this->inmate_balance * 1 + (double)$this->transaction_amt * 1;
        $trans->transaction_user_id = 1;
        $trans->save();

        $inmate = Inmate::where('id','=',$id)->first();
        $inmate->inmate_balance = (double)$this->inmate_balance * 1 + (double)$this->transaction_amt * 1;
        $inmate->save();



        session()->flash('message', 'Transaction Successfully.');
        $this->transaction_mode = "";
        $this->transaction_amt = "";


        $this->eventlog_type = "INCOME-TRANSACTION";
        $this->eventlog_desc = $trans->id;
        $this->eventlog_user_id = 1;
        $this->eventlog();

        $this->emit('close_modal');

        $this->term = "";

        $this->inmates = Inmate::where('inmate_name','LIKE','')->get();
    }


    public function makedebit($id)
    {


        $this->validate([

            'transaction_amt'=>'required',
            'transaction_mode'=>'required',
            'transaction_amt' =>['required','numeric', 'max:'.$this->inmate_balance*1],

        ]);



        $trans = new Transaction;
        $trans->transaction_inmate_id = $this->inmate_id;
        $trans->transaction_mode = $this->transaction_mode;
        $trans->transaction_type = "EXPENSE";
        $trans->transaction_amt = $this->transaction_amt * 1;
        $trans->transaction_bal = (double)$this->inmate_balance * 1 - (double)$this->transaction_amt * 1;
        $trans->transaction_user_id = 1;
        $trans->save();

        $inmate = Inmate::where('id','=',$id)->first();
        $inmate->inmate_balance = (double)$this->inmate_balance * 1 - (double)$this->transaction_amt * 1;
        $inmate->save();

        session()->flash('message', 'Transaction Successfully.');
        $this->transaction_mode = "";
        $this->transaction_amt = "";


        $this->eventlog_type = "DEBIT-TRANSACTION";
        $this->eventlog_desc = $trans->id;
        $this->eventlog_user_id = 1;
        $this->eventlog();

        $this->emit('close_modal');

        $this->term = "";

        $this->inmates = Inmate::where('inmate_name','LIKE','')->get();
    }


    public function subbalance($id)
    {

        $inmate = Inmate::where('id',$id)->first();

        $this->inmate_id = $inmate->id;
        $this->inmate_name =$inmate->inmate_name;
        $this->inmate_fname = $inmate->inmate_fname;
        $this->inmate_rpno = $inmate->inmate_rpno;
        $this->inmate_blockno = $inmate->inmate_blockno;
        $this->inmate_dob=$inmate->inmate_dob;
        $this->inmate_accno = $inmate->inmate_accno;
        $this->inmate_balance = $inmate->inmate_balance;

    }

    public function getInmateTransaction(){

    }
}
