<div>
    <p style="text-align: right;" class="d-print-none">
        <button  wire:click="setSupplierToday()" >Today</button>
        <button  wire:click="setSupplierDayWise()" >1d</button>
    </p>

    
    <div class="row">
        @if($fromFlag)
        <div class="col-lg-3">
        <p class= "d-print-none" >Select Date </p>
        <input class="d-print-none" type="date" class="form-control" wire:model="reportDate" wire:change="getSupplierReportDay()">
        </div>
       
        @endif
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                      <th scope="col">Supplier Name</th>
                      <th scope="col">Sale Amount</th>
        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($supplierWiseProducts as $supplier )
                    <tr>
        
                      <td>{{$supplier["supplier_name"]}}</td>
                      <td>₹ {{$supplier["sales_amount"]}}</td>
        
                    </tr>
                  @endforeach
                 
                 <tr>
                    
                    <td><b>Total Amount</b></td>
                    <td><b>₹ {{$supplierSum}}</b></td>
        
                  </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 text-right"><br>
         <br>
         <br>
         <br>
            <h6>Accountant Signature</h6>

            <br>
         <br>
        </div>
    </div>
    
</div>