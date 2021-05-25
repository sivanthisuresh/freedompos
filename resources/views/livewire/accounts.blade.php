<div class="container">

    @include('livewire.account.addbalance')
    @include('livewire.account.debitbalance')

    <form >
        <div class="form-group">
            <label for="term">Type Inmate RP.NO</label>
            <input type="text" name="$term" class="form-control" wire:model.defer="term" />
            @error('term')<span class="text-danger">{{$message}}</span>@enderror

            <button type="button" class="btn btn-primary" wire:click = "search()">Search Inmate</button>
        </div>
    </form>
    <div wire:loading>Searching Inmates ...</div>
    <div wire:loading.remove>

    <table class="table table-bordered ">
        <thead class = "table-primary">
          <tr>
            <th scope="col">Inmate RP.NO.</th>
            <th scope="col">Inmate Block No.</th>
            <th scope="col">Inmate Photo</th>
            <th scope="col">Inmate Name</th>

            <th scope="col">Inmate Balance</th>

            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          @isset($inmates)
          @foreach ($inmates as $inmate )
            <tr>
              <td>{{$inmate->inmate_rpno}}</td>
              <td>{{$inmate->inmate_block_id}}</td>
              <td>{{$inmate->inmate_photo}} </td>
              <td><b>{{$inmate->inmate_name}} </b><br>(s/o) {{$inmate->inmate_fname}}<br>{{$inmate->inmate_dob}}  </td>

              <td>Rs.{{$inmate->inmate_balance * 1}}</td>

              <td>
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addbalance" wire:click.prevent="addbalance({{$inmate->id}})">
                    CREDIT
                  </button>
                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#debitbalance" wire:click.prevent="subbalance({{$inmate->id}})">
                    DEBIT
                  </button>

              </td>
            </tr>
          @endforeach
          @endisset

        </tbody>
      </table>
      --------End of List--------

      @if(session()->has('message'))
        <script>swal("{{session('message')}}", "Click OK to Close", "success");</script>
      @endif

</div>
