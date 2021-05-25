<div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table  table-bordered">
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
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>Total</b></td>
                    <td><b>₹ {{$creditSum}}</b></td>
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