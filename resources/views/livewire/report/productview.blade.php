<div>
    <p style="text-align: right;" class="d-print-none">
        <button  wire:click="setProductToday()" >Today</button>
        <button  wire:click="setProductDay()" >1d</button>
    </p>

    
    <div class="row">
        @if($fromFlag)
        <div class="col-lg-3">
        <p class= "d-print-none" >Select Date </p>
        <input class="d-print-none" type="date" class="form-control" wire:model="reportDate" wire:change="getProductReportDay()">
        </div>

        @endif
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                      <th scope="col">Produtct Name</th>
                      <th scope="col">Product Price</th>
                      <th scope="col">Qty</th>
                      <th scope="col">Sale Amount</th>
                      <th scope="col">Profit(5%)</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($productWise as $sale )
                    <tr>

                      <td>{{$sale["product_name"]}}</td>
                      <td>₹ {{$sale["product_price"]}}</td>
                      <td>{{$sale["qty"]}}</td>
                      <td>₹ {{$sale["sales_amount"]}}</td>
                      <td>₹ {{$sale["profit"]}}</td>


                    </tr>
                  @endforeach

                 <tr>

                    <td><b>Total</b></td>
                    <td><b></b></td>
                    <td><b></b></td>
                    <td><b>₹ {{$productSum}}</b></td>
                    <td><b>₹ {{$profitSum}}</b></td>

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
