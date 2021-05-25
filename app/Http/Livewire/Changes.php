<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Eventlog;
use App\Models\Transaction;
use App\Models\Inmate;

class Changes extends Component
{
    public $blockViewFlag;
    public $transViewFlag;
    public $blockevents;
    public $transactions;
    public $bydate;
    public $reportDate;

    public function render()
    {
        return view('livewire.changes');

    }

    public function transactionMadeEvent(){
      $this->blockViewFlag = false;
      $this->transViewFlag = true;
      if($this->bydate == false){
        $this->transactions = Transaction::join('inmates','inmates.id','transactions.id')
                              ->select('transactions.*','inmates.inmate_rpno','inmates.inmate_name')
                              ->orderBy('id', 'DESC')
                              ->get();
            //dd($this->transactions);
      }else{

        $this->transactions = Transaction::join('inmates','inmates.id','transactions.id')
                              ->whereDate('transactions.created_at',$this->reportDate)
                              ->select('transactions.*','inmates.inmate_rpno','inmates.inmate_name')
                              ->orderBy('id', 'DESC')
                              ->get();

        //dd($this->transactions);
      }

    //  dd($this->transactions);
    }

    public function blockChangeEvent(){
      $this->blockViewFlag = true;
      $this->transViewFlag = false;
      $this->blockevents = Eventlog::where('eventlog_type','UB-INMATE')->orderBy('id', 'DESC')->get();
    //  dd($this->blockevents);

    }

    public function setToday(){
      $this->bydate = false;
      $this->transactionMadeEvent();
    }

    public function setByDate(){
      $this->transactions = null;
      $this->bydate = true;
    }
}
