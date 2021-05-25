<div class="container" >

    <div class="row">

        <div class="col-lg-2" 
            style="margin: auto;
            width: 20%;
            text-align:right;
            padding: 5px;"
        ><h5><b>REPORTS</b></h5></div>
        {{$reportDate}}
        <div class="col-lg-6" >
            <div class="btn-group d-print-none"  role="group">
                <button 
                    type="button" 
                    class="btn btn-warning" 
                    wire:click = "supplierReport()" 
                    style="color:black;  margin-right:5px;">
                    SUPPLIERS
                </button>
        
                <button 
                    type="button" 
                    class="btn btn-warning" 
                    wire:click = "productReport()" 
                    style="color:black;  margin-right:5px;">
                    PRODUCTS
                </button>
        
                <button 
                    type="button" 
                    class="btn btn-warning" 
                    wire:click = "blockReport()" 
                    style="color:black;  margin-right:5px;">
                    BLOCKS
                </button>
        
                <button 
                    type="button" 
                    class="btn btn-warning" 
                    wire:click = "creditReport()" 
                    style="color:black;  margin-right:5px;">
                    CREDITS
                </button>
        
                <button 
                    type="button" 
                    class="btn btn-warning" 
                    wire:click = "debitReport()" 
                    style="color:black;  margin-right:5px;">
                    DEBITS
                </button>
            </div>
        </div>
        <div class="col-lg-4"></div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            @if($supplierViewFlag)
            @include('livewire.report.supplierview')
            @endif

            @if($productViewFlag)
                @include('livewire.report.productview')
            @endif

            @if($blockViewFlag)
                @include('livewire.report.blockview')
            @endif

            @if($creditViewFlag)
                @include('livewire.report.creditview')
            @endif

            @if($debitViewFlag)
                @include('livewire.report.debitview')
            @endif
        </div>
   </div>

   
   
</div>
  
