@include('layout.header')
        
@include('layout.navbar')

<div class="container" style="color:black;">
    <h4><strong> SUPPLIERS DETAILS </strong></h4>
</div>
@livewire('suppliers')

<div class="card-body">
   

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
</div>
@livewireScripts
<script>
    window.livewire.on('close_modal',()=>{
        $('#addsupplier').modal('hide');
    });

    window.livewire.on('close_modal',()=>{
        $('#updatesupplier').modal('hide');
    });

</script>
@include('layout.footer')