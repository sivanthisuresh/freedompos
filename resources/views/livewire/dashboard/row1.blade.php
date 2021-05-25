<div class="row">
    
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats border border-primary">
        <div class="card-body  ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning ">
                <i class="fa fa-shopping-cart text-warning"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="bnumbers">
                <p class="card-category underline">Outlet Sales</p>
                <p class="card-title">₹ {{$freedomsales}}<p>
              </div>
            </div>
          </div>
        </div>
       
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats border border-primary">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning ">
                <i class="fa fa-rupee-sign text-success"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="bnumbers">
                <p class="card-category underline">Inmate Sales</p>
                <p class="card-title">₹ {{$inmatesales}}<p>
              </div>
            </div>
          </div>
        </div>
       
      </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
      <div class="card card-stats border border-primary">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning ">
                <i class="fa fa-money-check-alt text-danger"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="bnumbers">
                <p class="card-category underline">Credit/Debit</p>
                <p class="card-title">₹ {{$creditToday}}.00/{{$debitToday}}.00<p>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
    <div class="col-lg-2 col-md-6 col-sm-6">
      <div class="card card-stats border border-primary">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning ">
                <i class="fa fa-user-shield text-primary"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="bnumbers">
                <p class="card-category underline">Inmates</p>
                <p class="card-title">{{$inmateCount * 1 }}<p>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
</div>
