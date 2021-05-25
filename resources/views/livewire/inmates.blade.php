<div>
    <div class="container">
        @include('livewire.inmate.create')
        @include('livewire.inmate.update')
        @include('livewire.inmate.updateblock')


      @if(session()->has('message'))
        <script>swal("{{session('message')}}", "Click OK to Close", "success");</script>
      @endif

      <form >
          <div class="form-group">
              <label for="term"><b>Type Inmate RP.NO</b></label>
              <input type="text" name="$term" class="form-control" wire:model.defer="term" />
              @error('term')<span class="text-danger">{{$message}}</span>@enderror

              <button type="button" class="btn btn-primary" wire:click = "search()">Search Inmate</button>
              <button type="button" class="btn btn-warning" wire:click = "getall()">SHOW ALL INMATES</button>
              <button type="button" class="btn btn-success" wire:click = "clearData()" data-toggle="modal" data-target="#addinmate">
                  + Add Inmate
              </button>
          </div>
      </form>

      <div wire:loading>Searching Inmates ...</div>
      <div wire:loading.remove>



      <table class="table table-bordered ">
        <thead class = "table-primary">
          <tr>
            <th scope="col">Inmate RP.NO.</th>
            <th scope="col"> Block Name</th>
            <th scope="col"> Name</th>

            <th scope="col"> Balance</th>

            <th scope="col">EDIT-DELETE-BLOCK CHANGE</th>
          </tr>
        </thead>
        <tbody>
          @if($inmates)
          @foreach ($inmates as $inmate )
            <tr>
              <td>{{$inmate->inmate_rpno}}</td>
              <td>{{$inmate->block_name}}</td>

              <td><b>{{$inmate->inmate_name}} </b><br>(s/o) {{$inmate->inmate_fname}}<br>{{$inmate->inmate_dob}}  </td>

              <td>Rs.{{$inmate->inmate_balance * 1}}</td>

              <td>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateinmate" wire:click.prevent="edit({{$inmate->id}})">
                    <i class="fa fa-edit"></i>
                  </button>
                  <button class="btn btn-danger" wire:click.prevent="deleteId({{$inmate->id}})" data-toggle="modal" data-target="#deletemodal">
                    <i class="fa fa-trash-alt"></i>
                  </button>

                  <button class="btn btn-warning" wire:click.prevent="edit({{$inmate->id}})" data-toggle="modal" data-target="#updateblock">
                    <i class="fa fa-id-badge"></i>
                  </button>
              </td>
            </tr>
          @endforeach
        @endif

        </tbody>
      </table>
      </div>

      <div wire:ignore.self class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="deletemodal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletemodal">Delete Confirm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
               <div class="modal-body">
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="delete()" class="btn btn-danger close-modal" data-dismiss="modal">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
