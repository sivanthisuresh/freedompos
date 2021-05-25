@include('layout.header')
@include('layout.navbar')


<div class="container" style="color:black;">
    <h4><strong> INMATES DETAILS </strong></h4>
</div>
@livewire('inmates')
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
        $('#addinmate').modal('hide');
    });

    window.livewire.on('close_modal',()=>{
        $('#updateinmate').modal('hide');
    });

    window.livewire.on('close_modal',()=>{
        $('#updateblock').modal('hide');
    });

</script>
@include('layout.footer')
