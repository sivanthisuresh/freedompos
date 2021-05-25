<div class="" style="margin-bottom:50px;">
  <p style="text-align: right;" class="d-print-none">
      <button  wire:click="setToday()" >All</button>
      <button  wire:click="setByDate()" >1d</button>
  </p>
  <div class="row">
      @if($bydate)
      <div class="col-lg-3">
      <p class= "d-print-none" >Select Date </p>
      <input class="d-print-none" type="date" class="form-control" wire:model="reportDate" wire:change="transactionMadeEvent()">
      </div>

      @endif
  </div>
  <table class="table table-bordered ">
    <thead>
      <th>DATE</th>
      <th>INMATE RP.NO.</th>
      <th>INMATE NAME</th>
      <th> TYPE</th>
      <th> MODE</th>
      <th> AMOUNT</th>
    </thead>
    <tbody>
      @if($transactions)
      @foreach ($transactions as $trans )
        <tr>
          <td>{{$trans->created_at}}</td>
          <td>{{$trans->inmate_rpno}}</td>
          <td>{{ $trans->inmate_name}}</td>
          <td>{{$trans->transaction_type}}</td>
          <td>{{$trans->transaction_mode}}</td>
          <td>{{$trans->transaction_amt}}</td>
        </tr>
      @endforeach
    @endif

    </tbody>
  </table>
</div>
