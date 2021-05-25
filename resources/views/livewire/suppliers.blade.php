<div>
    <div class="container">
        @include('livewire.supplier.create')
        @include('livewire.supplier.update')
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addsupplier">
          + Add Supplier
      </button>

      @if(session()->has('message'))
        <script>swal("{{session('message')}}", "Click OK to Close", "success");</script>
      @endif
   
      
      <table class="table table-bordered ">
        <thead class = "table-primary">
          <tr>
            <th scope="col">id</th>
            <th scope="col">Supplier Name</th>
            <th scope="col">Supplier Address</th>
            <th scope="col">Supplier Phone</th>
            <th scope="col"> Supplier Email</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($suppliers as $supplier )
            <tr>
            <th scope="row">{{$supplier->id}}</th>
              <td>{{$supplier->supplier_name}}</td>
              <td>{{$supplier->supplier_address}}</td>
              <td>{{$supplier->supplier_phone}}</td>
              <td>{{$supplier->supplier_email}}</td>
            
              <td>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updatesupplier" wire:click.prevent="edit({{$supplier->id}})">
                    <i class="fa fa-edit"></i>
                  </button>
                  <button class="btn btn-danger" wire:click.prevent="deleteId({{$supplier->id}})" data-toggle="modal" data-target="#deletemodal">
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
                    <button type="button" wire:click.prevent="delete({{$supplier_id}})" class="btn btn-danger close-modal" data-dismiss="modal">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
