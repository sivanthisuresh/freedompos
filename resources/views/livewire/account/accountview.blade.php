@include('layout.header')
@include('layout.navbar')

<div class="container" style="color:black;">
    <h4><strong>ACCOUNT DETAILS </strong></h4>
</div>
@livewire('accounts')
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
        $('#addbalance').modal('hide');
    });

    window.livewire.on('close_modal',()=>{
        $('#debitbalance').modal('hide');
    });

 
</script>
@include('layout.footer')