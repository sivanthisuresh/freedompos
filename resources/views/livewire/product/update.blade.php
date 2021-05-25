<div wire:ignore.self class="modal fade" id="updateproduct" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3><u>Update Product</u></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            
            <div class="modal-body">
                <form >
                    <div class="form-group">
                        <label for="product_name">Product Name </label>
                        <input type="text" name="$product_name" class="form-control" wire:model.lazy="product_name" />
                        @error('product_name')<span class="text-danger">{{$message}}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="product_price">Product Price</label>
                        <input type="text" name="$product_price" class="form-control" wire:model.lazy="product_price" />
                        @error('product_price')<span class="text-danger">{{$message}}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="product_sell_price">Product Sell Price </label>
                        <input type="text" name="$product_sell_price" class="form-control" wire:model.lazy="product_sell_price" />
                        @error('product_sell_price')<span class="text-danger">{{$message}}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="product_category">Supplier Details: {{$product_category}}</label>
                        <select class="form-control" id="product_category" name="$product_category" wire:model="product_category">
                            <option  value="" ></option>
                            <option  value="PCP-CANTEEN" >PCP-CANTEEN</option>
                            <option  value="PB-WET-CANTEEN" >PB-WET-CANTEEN</option>
                            <option  value="PB-DRY-CANTEEN" >PB-DRY-CANTEEN</option>
                            <option  value="DEPARTMENT-STORE" >DEPARTMENT-STORE</option>
                        </select>
                        @error('product_category')<span class="text-danger">{{$message}}</span>@enderror
                    </div>


                    <div class="form-group">
                        <label for="product_supplier_id">Supplier Details: {{$product_supplier_id}}</label>
                        <select class="form-control" id="product_supplier_id" name="$product_supplier_id" wire:model="product_supplier_id">
                            <option  value="" ></option>
                            @foreach ($suppliers as $supplier )
                            <option  value="{{$supplier->id}}" >{{$supplier->supplier_name}} , {{$supplier->supplier_address}}</option>
                            @endforeach
                        </select>
                    </div>

                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
                <button type="button" class="btn btn-primary" wire:click = "update()">Save changes</button>
            </div>
        </div>
    </div>
</div>