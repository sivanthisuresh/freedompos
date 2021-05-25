<div class="container" >

    <div class="row">


        <div class="col-lg-6" >
            <div class="btn-group d-print-none"  role="group">
                <button
                    type="button"
                    class="btn btn-warning"
                    wire:click = "blockChangeEvent()"
                    style="color:black;  margin-right:5px;">
                    BLOCK CHANGE REPORT
                </button>

                <button
                    type="button"
                    class="btn btn-warning"
                    wire:click = "transactionMadeEvent()"
                    style="color:black;  margin-right:5px;">
                    TRANSACTIONS MADE REPORT
                </button>

            </div>
        </div>
        <div class="col-lg-4"></div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            @if($blockViewFlag)
            @include('livewire.change.blockchangeview')
            @endif

            @if($transViewFlag)
                @include('livewire.change.transactionmadeview')
            @endif
        </div>
   </div>


</div>
