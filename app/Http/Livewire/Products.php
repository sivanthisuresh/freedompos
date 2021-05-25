<?php

namespace App\Http\Livewire;

use App\Models\Eventlog;
use App\Models\Product;
use App\Models\Supplier;

use Livewire\Component;

class Products extends Component
{
    public $products;
    public $product_id;
    public $product_name;
    public $product_price;
    public $product_sell_price;

    public $product_supplier_id;
    public $product_supplier_name;

    public $product_category;

    public $eventlog_user_id, $eventlog_type, $eventlog_desc;

    public $product_created_id = 1;

    public $suppliers;

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
        $this->products = Product::join('suppliers','product_supplier_id','=','suppliers.id')->get(['products.*','suppliers.supplier_name','suppliers.supplier_address']);
       
        $this->suppliers = Supplier::all();
        //dd($this->products);
       
        return view('livewire.products');
    }

    public function resetInputFields(){
        $this->product_name = '';
        $this->product_price = '';
        $this->product_sell_price = '';
        $this->product_category = "";
        $this->product_supplier_id = "";
       
    }

    public function store(){
       
        $validatedData = $this->validate([
            'product_name' => 'required',
            'product_price' => 'required',
            'product_sell_price' => 'required',
            'product_supplier_id' =>'required',
            'product_created_id' =>'required',
            'product_category' => 'required'
        ]);
       
        
        //$result = Product::create($validatedData);
        //dd($result);

        $result = new Product;
        $result->product_name = $this->product_name;
        $result->product_price = $this->product_price;
        $result->product_sell_price = $this->product_sell_price;
        $result->product_supplier_id = $this->product_supplier_id;
        $result->product_created_id = 1;
        $result->product_category  = $this->product_category;
        $result->save();

        session()->flash('message', 'Product Created Successfully.');
        $this->resetInputFields();
        
        $this->eventlog_type = "C-PRODUCT";
        $this->eventlog_desc = $result->id;
        $this->eventlog_user_id = $result->product_created_id;
        $this->eventlog();

        $this->emit('close_modal');
    }


    public function deleteId($id){
        
        $this->product_id = $id;
        
    }

    
    public function delete($id)
    {
        if($id){
            Product::where('id',$id)->delete();
            


            $this->eventlog_type = "D-PRODUCT";
            $this->eventlog_desc = $id;
            $this->eventlog_user_id = $this->product_created_id;
            $this->eventlog();

            session()->flash('message', 'Product Deleted Successfully.');
        }


    }

    public function edit($id)
    {
       
        $product = Product::where('id',$id)->first();
        $this->product_id = $product->id;
        $this->product_name = $product->product_name;
        $this->product_price = $product->product_price;
        $this->product_sell_price = $product->product_sell_price;
        $this->product_supplier_id = $product->product_supplier_id;
        $this->product_category = $product->product_category;
        
    }

    public function update()
    {
        $validatedData = $this->validate([
            'product_name' => 'required',
            'product_price' => 'required',
            'product_sell_price' => 'required',
            'product_supplier_id' => 'required',
            'product_category' => 'required'
        ]);

        if ($this->product_id) {
            $product = product::find($this->product_id);
            $product->update([
                'product_name' => $this->product_name,
                'product_price' => $this->product_price,
                'product_sell_price' => $this->product_sell_price,
                'product_supplier_id' => $this->product_supplier_id,
                'product_category' => $this->product_category
            ]);

           
          
            session()->flash('message', 'Product Updated Successfully.');
            $this->resetInputFields();
            $this->emit('close_modal');

            $this->eventlog_type = "U-PRODUCT";
            $this->eventlog_desc = $product->id;
            $this->eventlog_user_id = $product->product_created_id;
            $this->eventlog();
        }
    }


}
