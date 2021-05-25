<div wire:ignore.self class="modal fade" id="addblock" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3><u>Add Block</u></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            

            <div class="modal-body">
                <form >
                    <div class="form-group">
                        <label for="block_name">Block Name </label>
                        <input type="text" name="$block_name" class="form-control" wire:model.lazy="block_name" />
                        @error('block_name')<span class="text-danger">{{$message}}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="block_decription">Block Description</label>
                        <input type="text" name="$block_decription" class="form-control" wire:model.lazy="block_decription" />
                        @error('block_decription')<span class="text-danger">{{$message}}</span>@enderror
                    </div>

                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click = "resetInputFields()">Close</button>
                <button type="button" class="btn btn-primary" wire:click = "store()">Save changes</button>
            </div>
        </div>
    </div>
</div>