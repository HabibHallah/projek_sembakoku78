@extends('layouts/commonMaster' )

@section('layoutContent')

<!-- Content -->
@yield('content')
<form id="payment-form" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Nama" required />
    <input type="email" name="email" placeholder="Email" required />
    <input type="tel" name="phone" placeholder="Nomor HP" required />
    <input type="number" name="total_amount" placeholder="Total Pembayaran" required />

    <button type="submit" id="pay-button">Bayar Sekarang</button>
</form>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    document.getElementById('payment-form').addEventListener('submit', function (event) {
        event.preventDefault();

        fetch('/payment', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({
                name: document.querySelector('input[name="name"]').value,
                email: document.querySelector('input[name="email"]').value,
                phone: document.querySelector('input[name="phone"]').value,
                total_amount: document.querySelector('input[name="total_amount"]').value,
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.snap_token) {
                snap.pay(data.snap_token); // Panggil popup pembayaran Midtrans
            } else {
                alert('Gagal membuat transaksi');
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script>
<!--/ Content -->

@endsection