<div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered ">
                <thead class = "text-primary">
                  <tr>
                    <th scope="col">BLOCK NAME</th>
                    <th scope="col">PHONE-RECHARGE</th>
                    <th scope="col">MO-ADVOCATE</th>
                    <th scope="col">MO-FAMILY</th>
                    <th scope="col">MO-PAROLE</th>
                    <th scope="col">MEDICAL</th>
                    <th scope="col">STAMPS</th>
                    <th scope="col">LEAVE-BAIL</th>

                  </tr>
                </thead>
                <tbody>
                
                  @foreach ($blockDebits as $debit )
                    <tr>
                        <td>{{$debit["block_name"]}}</td>
                        <td>₹ {{$debit["PHONE-RECHARGE"]}}</td>
                        <td>₹ {{$debit["MO-ADVOCATE"]}}</td>
                        <td>₹ {{$debit["MO-FAMILY"]}}</td>
                        <td>₹ {{$debit["MO-PAROLE"]}}</td>
                        <td>₹ {{$debit["MEDICAL"]}}</td>
                        <td>₹ {{$debit["STAMPS"]}}</td>
                        <td>₹ {{$debit["LEAVE-BAIL"]}}</td>
                    </tr>
                  @endforeach
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>Total</b></td>
                    <td><b>₹ {{$debitSum}}</b></td>
                  </tr>
                 
                </tbody>
            </table>
        </div>
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