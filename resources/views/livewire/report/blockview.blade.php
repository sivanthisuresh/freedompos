<div>
  
    <div class="row">
        <div class="col-lg-5">
            <table class="table  table-bordered">
                    <thead class = "text-primary">
                      <tr>
                        <th scope="col">BLOCK NAME</th>
                        <th scope="col">INMATE COUNT</th>
                        <th scope="col">SALES</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                      @foreach ($blockWiseInmates as $inmate )
                        <tr>
                          <td>{{$inmate["block_name"]}}</td>
                          <td>{{$inmate["count"]}}</td>
                          <td>₹ {{$inmate["sales"]}}</td>
                        </tr>
                      @endforeach
                      <tr>
                        <td></td>
                        <td><b>Total</b></td>
                        <td><b>₹ {{$blockSum}}</b></td>
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