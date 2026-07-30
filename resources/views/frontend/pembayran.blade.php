<x-frontend.app>
    <div class="container py-5 text-center">
        <h3>Terima Kasih, {{ $donasi->nama }}</h3>
        <p>Jumlah Donasi: <strong>Rp {{ number_format($donasi->jumlah_donasi, 0, ',', '.') }}</strong></p>

        <button id="pay-button" class="btn btn-primary btn-lg">Bayar Sekarang</button>
    </div>

    <!-- Script Midtrans Snap -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ $clientKey }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            snap.pay('{{ $donasi->snap_token }}', {
                onSuccess: function(result) {
                    window.location.href = "{{ route('frontend.mainpage') }}?status=success";
                },
                onPending: function(result) {
                    window.location.href = "{{ route('frontend.mainpage') }}?status=pending";
                },
                onError: function(result) {
                    alert("Pembayaran gagal!");
                },
                onClose: function() {
                    alert('Anda menutup halaman pembayaran tanpa menyelesaikan transaksi.');
                }
            });
        };
    </script>

</x-frontend.app>