<?php

namespace App\Http\Livewire;
use Livewire\WithFileUploads;
use App\Models\Inmate;
use App\Models\Eventlog;
use App\Models\Block;
use Livewire\Component;


class Inmates extends Component
{
    use WithFileUploads;

    public $inmate_id;
    public $inmate_name;
    public $inmate_fname;
    public $inmate_rpno;
    public $inmate_block_id;
    public $inmate_block_id_old;
    public $inmate_block_name_update;
    public $term;


    public $inmate_photo_file;
    public $inmate_photo;
    public $inmate_dob;
    public $inmate_accno;
    public $inmate_balance;
    public $inmate_created_id = 1;

    public $blocks;

    public $eventlog_user_id ;
    public $eventlog_type;
    public $eventlog_desc;

    public $inmates;



    public function render()
    {
        $this->blocks = Block::all();
        return view('livewire.inmates');
    }

    public function getall(){
      $this->inmates = Inmate::join('blocks','blocks.id','=','inmate_block_id')
                        ->select('inmates.*','blocks.block_name')
                        ->get();
      //dd($this->inmates);
      $this->blocks = Block::all();
    }

    private function eventlog(){
        $validatedData = $this->validate([
            'eventlog_user_id' => 'required',
            'eventlog_type' => 'required',
            'eventlog_desc' => 'required'
        ]);
        Eventlog::create($validatedData);
    }

    public function resetInputFields (){
        $this->inmate_name ='';
        $this->inmate_fname = '';
        $this->inmate_rpno = '';
        $this->inmate_block_id = '';
        $this->inmate_dob='';
        $this->inmate_photo = '';
        $this->inmate_accno = '';
        $this->inmate_balance = '';

        $this->getall();
    }
    public function store(){

        //dd($this->inmate_block_id);
        $this->validate([
            'inmate_name' => 'required',
            'inmate_fname' => 'required',
            'inmate_rpno' => 'required',
            'inmate_block_id' => 'required',
            'inmate_accno' => 'required',
            'inmate_dob' => 'required',
            'inmate_created_id' => 'required'
        ]);


        $inmate = new Inmate;
        $inmate->inmate_name =$this->inmate_name;
        $inmate->inmate_fname = $this->inmate_fname;
        $inmate->inmate_rpno = $this->inmate_rpno;
        $inmate->inmate_block_id = $this->inmate_block_id;
        $inmate->inmate_accno = $this->inmate_accno;
        $inmate->inmate_dob=$this->inmate_dob;

        $inmate->inmate_created_id = 1;
        $inmate->save();


        session()->flash('message', 'Inmate Created Successfully.');
        $this->resetInputFields();

        $this->eventlog_type = "C-INMATE";
        $this->eventlog_desc = $inmate->id;
        $this->eventlog_user_id = $inmate->inmate_created_id;
        $this->eventlog();

        $this->emit('close_modal');

    }




    public function deleteId($id){

        $this->inmate_id = $id;

    }


    public function delete()
    {
        if($this->inmate_id){
            Inmate::where('id',$this->inmate_id)->delete();



            $this->eventlog_type = "D-INMATE";
            $this->eventlog_desc = $this->inmate_id;
            $this->eventlog_user_id = $this->inmate_created_id;
            $this->eventlog();

            session()->flash('message', 'Inmate Deleted Successfully.');
        }


    }
    //inmate_block_id

    public function edit($id)
    {
        //$this->inmates = Inmate::join('blocks','blocks.id','=','inmate_block_id')->get();
        $inmate = Inmate::join('blocks','blocks.id','=','inmate_block_id')
                          ->where('inmates.id', $id)
                          ->select('inmates.*','blocks.block_name')
                          ->first();
        //this start
        if($inmate){
          $this->inmate_id = $inmate->id;
          $this->inmate_name =$inmate->inmate_name;
          $this->inmate_fname = $inmate->inmate_fname;
          $this->inmate_rpno = $inmate->inmate_rpno;
          $this->inmate_dob=$inmate->inmate_dob;
          $this->inmate_accno = $inmate->inmate_accno;
          $this->inmate_block_id = $inmate->inmate_block_id;
          $this->inmate_block_id_old = $inmate->inmate_block_id;
          $this->inmate_block_name_update = $inmate->block_name;
        }



    }

    public function update()
    {

        $validatedData = $this->validate([
            'inmate_name' => 'required',
            'inmate_fname' => 'required',
            'inmate_rpno' => 'required',
            'inmate_accno' => ' required',
            'inmate_dob' => 'required'
        ]);

        if ($this->inmate_id) {

            $inmate = Inmate::find($this->inmate_id);

            $inmate->inmate_name = $this->inmate_name;
            $inmate->inmate_fname = $this->inmate_fname;
            $inmate->inmate_rpno = $this->inmate_rpno;
            $inmate->inmate_accno = $this->inmate_accno;
            $inmate->inmate_dob = $this->inmate_dob;
            $inmate->inmate_created_id = 1;
            $inmate->save();
            $this->getall();
            session()->flash('message', 'Inmate Updated Successfully.');
            $this->resetInputFields();
            $this->emit('close_modal');

            $this->eventlog_type = "U-INMATE";
            $this->eventlog_desc = $inmate->id;
            $this->eventlog_user_id = $inmate->inmate_created_id;
            $this->eventlog();
        }

    }


    public function updateBlock()
    {

        $validatedData = $this->validate([
            'inmate_block_id' => 'required',
        ]);

        if ($this->inmate_id) {

            $inmate = Inmate::find($this->inmate_id);

            $inmate->inmate_name = $this->inmate_name;
            $inmate->inmate_fname = $this->inmate_fname;
            $inmate->inmate_rpno = $this->inmate_rpno;
            $inmate->inmate_accno = $this->inmate_accno;
            $inmate->inmate_dob = $this->inmate_dob;
            $inmate->inmate_created_id = 1;
            $inmate->inmate_block_id = $this->inmate_block_id;
            $inmate->save();
            $block_name_new = Block::where('id',$this->inmate_block_id)->select('block_name')->first();
            session()->flash('message', 'Inmate Updated Successfully.');
            $this->eventlog_desc = $this->inmate_rpno."-FROM : ".$this->inmate_block_name_update."  || TO : ".$block_name_new->block_name;
            $this->resetInputFields();
            $this->emit('close_modal');

            $this->eventlog_type = "UB-INMATE";

            $this->eventlog_user_id = $inmate->inmate_created_id;
            $this->eventlog();

            $this->getall();
        }

    }

    public function search(){
      $validatedData  = $this->validate([
          'term' => 'required|min:3',
      ]);
      $searchterm  =  '%'.$this->term.'%';
      //dd($searchterm);
      $this->inmates = Inmate::where('inmate_rpno','LIKE', $searchterm)
                        ->join('blocks','blocks.id','=','inmate_block_id')
                        ->select('inmates.*','blocks.block_name')
                        ->get();

      $this->term = "";
    }

    public function clearData(){
      $this->inmates = null;
    }

}
