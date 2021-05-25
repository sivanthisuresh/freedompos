<div class="row " style="margin-bottom: 20px;">
    <div class="col-lg-12">
      <div class="card  border border-primary">
        <div class="card-header ">
          <b>Block Wise Transaction( CREDIT)</b> 
        </div>
        <div class="card-body ">
            <table class="table  ">
                <thead class = "text-primary">
                  <tr>
                    <th scope="col">BLOCK NAME</th>
                    <th scope="col">WAGE</th>
                    <th scope="col">INTERVIEW-ADVOCATE</th>
                    <th scope="col">INTERVIEW-FAMILY</th>
                    <th scope="col">INTERVIEW</th>
                    <th scope="col">MONEY-ORDER</th>
                    <th scope="col">ADMISSION</th>
                    <th scope="col">LEAVE-PAROLE</th>

                  </tr>
                </thead>
                <tbody>
                
                  @foreach ($blockCredits as $credit )
                    <tr>
                      <td>{{$credit["block_name"]}}</td>
                      <td>₹ {{$credit["WAGE"]}}</td>
                      <td>₹ {{$credit["INTERVIEW-ADVOCATE"]}}</td>
                      <td>₹ {{$credit["INTERVIEW-FAMILY"]}}</td>
                      <td>₹ {{$credit["INTERVIEW"]}}</td>
                      <td>₹ {{$credit["MONEY ORDER"]}}</td>
                      <td>₹ {{$credit["ADMISSION"]}}</td>
                      <td>₹ {{$credit["LEAVE-PAROLE"]}}</td>
                    </tr>
                  @endforeach
                 
                </tbody>
            </table>
        </div>
        
      </div>
    </div>
</div>


<div class="row " style="margin-bottom: 30px;">
    <div class="col-lg-12">
      <div class="card  border border-primary">
        <div class="card-header ">
          <b>Block Wise Transaction( DEBIT )</b> 
        </div>
        <div class="card-body ">
            <table class="table  ">
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
                 
                </tbody>
            </table>
        </div>
        
      </div>
    </div>
</div>