<?php

namespace App\Http\Livewire;

use App\Models\Block;
use App\Models\Eventlog;

use Livewire\Component;

class Blocks extends Component
{
    public $blocks,$block_id, $block_name, $block_decription, $block_created_id; 
    public $eventlog_user_id, $eventlog_type, $eventlog_desc;


    private function eventlog(){
        $validatedData = $this->validate([
            'eventlog_user_id' => 'required',
            'eventlog_type' => 'required',
            'eventlog_desc' => 'required'
        ]);
        Eventlog::create($validatedData);
    }

    public function render()
    {
        $this->blocks = Block::all();
        return view('livewire.blocks');
    }

    public function resetInputFields(){
        $this->block_name = '';
        $this->block_decription = '';
    
    }

    public function store(){
        $validatedData = $this->validate([
            'block_name' => 'required',
            'block_decription' => 'required',
        ]);

        $block = new Block;
        $block->block_name = $this->block_name;
        $block->block_decription = $this->block_decription;
        $block->block_created_id = 1;
        $result = $block->save();

        session()->flash('message', 'Block Created Successfully.');
        $this->resetInputFields();
      
        $this->eventlog_type = "C-BLOCK";
        $this->eventlog_desc = $block->id;
        $this->eventlog_user_id = 1;
        $this->eventlog();

        $this->emit('close_modal');
    }

    public function deleteId($id){
        $this->block_id = $id;
    }

    
    public function delete($id)
    {
        if($id){
            Block::where('id',$id)->delete();
            


            $this->eventlog_type = "D-BLOCK";
            $this->eventlog_desc = $id;
            $this->eventlog_user_id = $this->block_created_id;
            $this->eventlog();

            session()->flash('message', 'Block Deleted Successfully.');
        }
    }

    public function edit($id)
    {
        
        $block = Block::find($id);

        $this->block_id = $block->id;
        $this->block_name = $block->block_name;
        $this->block_decription = $block->block_decription;
        //dd($block);
    }

    public function update()
    {
        $this->validate([
            'block_name' => 'required',
            'block_decription' => 'required',
        ]);

        $block = Block::find($this->block_id);
        $block->block_name = $this->block_name;
        $block->block_decription = $this->block_decription;
        $result = $block->save();

        session()->flash('message', 'Block Updated Successfully.');
        $this->resetInputFields();
        $this->emit('close_modal');

        $this->eventlog_type = "U-BLOCK";
        $this->eventlog_desc = $block->id;
        $this->eventlog_user_id = 1;
        $this->eventlog();
    }
}
