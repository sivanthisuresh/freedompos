<?php

namespace App\Http\Livewire;

use App\Models\Supplier;
use App\Models\Eventlog;
use Livewire\Component;

class Suppliers extends Component
{
    public $suppliers, $supplier_id, $supplier_name , $supplier_address, $supplier_email, $supplier_phone, $supplier_created_id = 1;
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
        $this->suppliers  = Supplier::all();
        return view('livewire.suppliers');
    }

    public function resetInputFields(){
        $this->supplier_name = '';
        $this->supplier_email = '';
        $this->supplier_address = '';
        $this->supplier_phone = '';
    }

    public function store(){
        $validatedData = $this->validate([
            'supplier_name' => 'required',
            'supplier_address' => 'required',
            'supplier_phone' => 'required',
            'supplier_email' => 'required|email',
            'supplier_created_id' =>'required'
        ]);

        $result = Supplier::create($validatedData);
        session()->flash('message', 'Supplier Created Successfully.');
        $this->resetInputFields();

        $this->eventlog_type = "C-SUPPLIER";
        $this->eventlog_desc = $result->id;
        $this->eventlog_user_id = $result->supplier_created_id;
        $this->eventlog();

        $this->emit('close_modal');
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $supplier = Supplier::where('id',$id)->first();
        $this->supplier_id = $supplier->id;
        $this->supplier_name = $supplier->supplier_name;
        $this->supplier_address = $supplier->supplier_address;
        $this->supplier_phone = $supplier->supplier_phone;
        $this->supplier_email = $supplier->supplier_email;

    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $validatedData = $this->validate([
            'supplier_name' => 'required',
            'supplier_address' => 'required',
            'supplier_phone' => 'required|min:10|max:10',
            'supplier_email' => 'required|email'
        ]);

        if ($this->supplier_id) {
            $supplier = Supplier::find($this->supplier_id);
            $supplier->update([
                'supplier_name' => $this->supplier_name,
                'supplier_address' => $this->supplier_address,
                'supplier_phone' => $this->supplier_phone,
                'supplier_email' => $this->supplier_email
            ]);
            $this->updateMode = false;
            session()->flash('message', 'Supplier Updated Successfully.');
            $this->resetInputFields();
            $this->emit('close_modal');

            $this->eventlog_type = "U-SUPPLIER";
            $this->eventlog_desc = $supplier->id;
            $this->eventlog_user_id = $supplier->supplier_created_id;
            $this->eventlog();
        }
    }

    public function deleteId($id){
        $this->supplier_id = $id;
    }


    public function delete($id)
    {
        if($id){
            Supplier::where('id',$id)->delete();
            $this->eventlog_type = "D-SUPPLIER";
            $this->eventlog_desc = $id;
            $this->eventlog_user_id = $this->supplier_created_id;
            $this->eventlog();
            session()->flash('message', 'Supplier Deleted Successfully.');
        }

    }

}
