<div class="container">
  @if(!$check)
  <div class="row">
    <div class="col-lg-4 col-md-4 col-xs-12">
      <form >
        <div class="form-group">
            <label for="term">Type Inmate  RP.NO</label>
            <input type="text" name="$term" class="form-control" wire:model.defer="term" />
            @error('term')<span class="text-danger">{{$message}}</span>@enderror
            <div wire:loading>
              Loading.....
            </div>
            <div wire:loading.remove></div>
            <button type="button" class="btn btn-primary" wire:click = "getAllTransactions()">Search Inmate</button>
        </div>
      </form>

    </div>
  </div>
  @endif
  @if($check)
  <div class="row" >
    <div class="col-md-4 col-xs-12" >
      <button type="button" class="btn btn-danger" wire:click = "clearAll()">X</button>
        <div class="card card-user" style="border: solid 1px;">
          <div class="card-body">
            <div class="author" style="margin-top: 20px;">
                <img class="avatar border-gray" src="{{ asset('../resources/img/avatar.png') }}" alt="inmates_photo">
                <h6 class="title">{{$inmate_rpno}}</h6>
                <h4 class="title">{{$inmate_name}}</h4>
                <h6 class="">s/o {{$inmate_fname}}</h6>
                <p class="description">{{$inmate_dob}}</p>
                <p class="">Block Name: <b> {{$inmate_blockno}} </b></p>
                Account Balance <h5 style="color: green;" > <b> Rs. {{$inmate_balance}} </b></h5>

            </div>
          </div>
          <div class="card-footer">
            <hr>
              <div class="row" style="text-align: center;">
                <div class="col-lg-12 col-xs-12 col-md-12">
                  <p >Current week<br><b><i> {{$fromdate}} to {{$todate}} </i></b><br>
                  </p>
                   <h5 >Total Week Spend <br><b style="color: red ;">Rs.  {{$inmate_weekspend}} </b></h5>
                   <h5 >Week Balance  <br><b style="color: blue;"> Rs. {{$inmate_weekbal}} / Rs. {{$inmate_accno}}  </b> </h5>
                </div>

              </div>
          </div>
        </div>
    </div>

    <div class="col-lg-4">
      <div class="container">
        <div class="btn-group" role="group" aria-label="Basic example">
          <button type="button" class="btn btn-primary" wire:click = "getNoTransactions()" >Credit and Debit Summary</button>
          <button type="button" class="btn btn-warning" wire:click="getWeekTransactions()">This Week</button>
        </div>

        @isset($translist)
        @foreach ($translist as $trans )
          <div class="row  border border-radius border-dark rounded"
          style="margin-bottom: 5px; padding-top: 5px;
                padding-bottom:5px;
                -webkit-box-shadow: -2px 15px 25px -8px rgba(0,0,0,0.75);
                -moz-box-shadow: -2px 15px 25px -8px rgba(0,0,0,0.75);
                box-shadow: -2px 10px 5px -8px rgba(0,0,0,0.75);">
            <div class="col-6"><span style="font-size: 10px;">{{$trans["date"]}}</span> <br><b> {{$trans["mode"]}}</b></div>
            <div class="col-6" style="text-align: end;"><h5 style="color: {{$trans["type"]}} ;"><b>{{$trans["amount"]}}</b></h5></div>
          </div>
        @endforeach
        @endisset
      </div>

      --------End of List--------
    </div>

  </div>
  @endif
  </div>

    @if(session()->has('message'))
      <script>swal("{{session('message')}}", "Click OK to Close", "success");</script>
    @endif

</div>
