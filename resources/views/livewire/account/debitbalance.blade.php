<div wire:ignore.self class="modal fade" id="debitbalance" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3><u>MAKE EXPENSE</u></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" >
                <div >
                   <h4>RP.No.{{$inmate_rpno}} <br> <b>{{$inmate_name}}</b></h4>
                   <h5>Father Name : <b>{{$inmate_fname}}</b></h5>
                   <h6>{{$inmate_dob}}</h6>
                   <h6>Block No.{{$inmate_blockno}} </h6>
                   <p class="category">Current Balance:<b style="color: red"> Rs.{{$inmate_balance*1}}</b> </p>


                    <div class="form-group">
                        <label for="transaction_mode">Type of Expense</label>
                        <select style="color:red; font-weight:bold;" class="form-control" id="transaction_mode" name="$transaction_mode" wire:model="transaction_mode">
                            <option  value="" ></option>
                            <option  value="PHONE-RECHARGE" >PHONE-RECHARGE</option>
                            <option  value="MO-ADVOCATE" >MO-ADVOCATE</option>
                            <option  value="MO-FAMILY" >MO-FAMILY</option>
                            <option  value="MO-PAROLE" >MO-PAROLE</option>
                            <option  value="MEDICAL" >MEDICAL</option>
                            <option  value="STAMPS" >STAMPS</option>
                            <option  value="LEAVE-BAIL" >LEAVE-BAIL</option>
                            <option  value="LAST-DEBIT" >LAST-DEBIT</option>

                        </select>
                        @error('transaction_type')<span class="text-danger">{{$message}}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="transaction_amt">Transaction Amount in Rs.</label>
                        <input style="color:red; font-weight:bold;" type="text" name="$transaction_amt" class="form-control" wire:model.lazy="transaction_amt" />
                        @error('transaction_amt')<span class="text-danger">{{$message}}</span>@enderror
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
                <button type="button" class="btn btn-danger" wire:click = "makedebit({{$inmate_id}})">MAKE DEBIT</button>
            </div>
        </div>
    </div>
</div>
