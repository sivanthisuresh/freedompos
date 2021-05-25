@include('layout.header')
@include('layout.navbar')

<div class="container" style="color:black;">
    <h4><strong>PRISONER CASH CARD </strong></h4>
</div>
@livewire('transactions')
<div class="card-body">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
</div>

@livewireScripts

@include('layout.footer')