<div>
    <div class="container">
        @include('livewire.block.create')
        @include('livewire.block.update')
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addblock">
          + Add Block
      </button>

      @if(session()->has('message'))
        <script>swal("{{session('message')}}", "Click OK to Close", "success");</script>
      @endif
   
      
      <table class="table table-bordered ">
        <thead class = "table-primary">
          <tr>
            <th scope="col">id</th>
            <th scope="col">Block Name</th>
            <th scope="col">Block Description</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($blocks as $block )
            <tr>
            <th scope="row">{{$block->id}}</th>
              <td>{{$block->block_name}}</td>
              <td>{{$block->block_decription}}</td>
              <td>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateblock" wire:click.prevent="edit({{$block->id}})">
                    <i class="fa fa-edit"></i>
                  </button>
                  <button class="btn btn-danger" wire:click.prevent="deleteId({{$block->id}})" data-toggle="modal" data-target="#deletemodal">
                    <i class="fa fa-trash-alt"></i>
                  </button>


              </td>
            </tr>
          @endforeach
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
                    <button type="button" wire:click.prevent="delete({{$block_id}})" class="btn btn-danger close-modal" data-dismiss="modal">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
