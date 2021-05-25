@include('layout.header')
        
@include('layout.navbar')


<div class="container" style="color:black;">
    <h4><strong> PRODUCTS DETAILS </strong></h4>
</div>

@livewire('products')

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
        $('#addproduct').modal('hide');
    });

    window.livewire.on('close_modal',()=>{
        $('#updateproduct').modal('hide');
    });

</script>
@include('layout.footer')