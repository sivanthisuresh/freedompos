<div wire:ignore.self class="modal fade" id="updateinmate" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3><u>Add Inmate</u></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">
                <form >
                    <div class="form-group">
                        <label for="inmate_name">Inmate Name</label>
                        <input type="text" name="$inmate_name" class="form-control" wire:model.lazy="inmate_name" />
                        @error('inmate_name')<span class="text-danger">{{$message}}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="inmate_fname">Inmate Father Name</label>
                        <input type="text" name="$inmate_fname" class="form-control" wire:model.lazy="inmate_fname" />
                        @error('inmate_fname')<span class="text-danger">{{$message}}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="inmate_rpno">Inmate RP.NO.</label>
                        <input type="text" name="$inmate_rpno" class="form-control" wire:model.lazy="inmate_rpno" />
                        @error('inmate_rpno')<span class="text-danger">{{$message}}</span>@enderror
                    </div>


                    <div class="form-group">
                        <label for="inmate_block_id">Week Limit: </label>
                        <select class="form-control" id="inmate_block_id" name="$product_supplier_id" wire:model="inmate_accno">
                            <option  value="" >Select Week Limit... </option>
                            <option  value="450"> 450</option>
                            <option  value="750"> 750</option>
                        </select>
                        @error('inmate_accno')<span class="text-danger">{{$message}}</span>@enderror
                    </div>


                    <div class="form-group">
                        <label for="inmate_dob">Inmate DOB</label>
                        <input type="text" name="$inmate_dob" class="form-control" wire:model.lazy="inmate_dob" />
                        @error('inmate_dob')<span class="text-danger">{{$message}}</span>@enderror
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="resetInputFields()" >Close</button>
                <button type="button" class="btn btn-primary" wire:click = "update()">Save changes</button>
            </div>
        </div>
    </div>
</div>
