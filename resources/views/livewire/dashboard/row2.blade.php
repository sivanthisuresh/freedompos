<div class="row " style="margin-bottom: 20px;">
    <div class="col-lg-7">
      <div class="card  border border-primary">
        <div class="card-header ">
          <b>Product's Category Wise Sales</b>
        </div>
        <div class="card-body ">
            <table class="table  ">
                <thead class = "text-primary">
                  <tr>
                    <th scope="col">PRODUCT's CATEGORY</th>
                    <th scope="col">SALES</th>
                  </tr>
                </thead>
                <tbody>
                
                  @foreach ($prodCatSales as $prod )
                    <tr>
                      <td>{{$prod["prod_catname"]}}</td>
                      <td>₹ {{$prod["sales"]}}</td>
                    </tr>
                  @endforeach
                 
                </tbody>
            </table>
        </div>
        
      </div>
    </div>
    
    <div class="col-lg-5">
        <div class="card border border-primary">
          <div class="card-header ">
           <b>
                Block Wise Sales
           </b>
            
          </div>
          <div class="card-body ">
            <table class="table  ">
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
                      <td>{{$inmate["sales"]}}</td>
                    </tr>
                  @endforeach
                 
                </tbody>
            </table>
          </div>
        </div>
      </div>
  </div>