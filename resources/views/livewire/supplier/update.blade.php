
<div wire:ignore.self class="modal fade" id="updatesupplier" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="updatesupplier">Update Supplier</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form>
                <input type="hidden" name="$supplier_id" wire:model="supplier_id"/>
                <input type="hidden" name="$supplier_created_id" wire:model="supplier_created_id"/>
                <div class="form-group">{{$supplier_created_id}}
                    <label for="supplier_name">Supplier Name </label>
                    <input type="text" name="$supplier_name" class="form-control" wire:model.lazy="supplier_name" />
                    @error('supplier_name')<span class="text-danger">{{$message}}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="supplier_address">Supplier Address</label>
                    <input type="text" name="$supplier_address" class="form-control" wire:model.lazy="supplier_address" />
                    @error('supplier_address')<span class="text-danger">{{$message}}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="supplier_phone">Supplier Phone </label>
                    <input type="text" name="$supplier_phone" class="form-control" wire:model.lazy="supplier_phone" />
                    @error('supplier_phone')<span class="text-danger">{{$message}}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="supplier_email">Supplier Email </label>
                    <input type="text" name="$supplier_email" class="form-control" wire:model.lazy="supplier_email" />
                    @error('supplier_email')<span class="text-danger">{{$message}}</span>@enderror
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="resetInputFields()" >Close</button>
            <button type="button" class="btn btn-primary" wire:click.prevent = "update({{$supplier_id}})">Update Changes</button>
        </div>
        </div>
    </div>
    </div>