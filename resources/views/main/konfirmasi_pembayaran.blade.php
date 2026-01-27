@extends('layouts.shop')

@section('content')
    
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg st-color container">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Konfirmasi Pesanan</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Detail Pesanan</h4>
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <form action="{{ route('pembayaran', $pesanan->no_pesanan) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-4">
                                    <label for="no_pesanan">Nomor Pesanan</label>
                                    <input type="text" class="form-control" id="no_pesanan" value="{{ $pesanan->no_pesanan }}" disabled>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="tgl_bayar">Tanggal Pembayaran</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control @error('tgl_bayar') is-invalid @enderror" 
                                               name="tgl_bayar" 
                                               value="{{ old('tgl_bayar', date('d-m-Y')) }}" 
                                               id="tgl_bayar" 
                                               placeholder="Pilih tanggal pembayaran" 
                                               autocomplete="off"
                                               readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="tanggal-addon">
                                                <i class="fas fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        @error('tgl_bayar')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <small class="form-text text-muted">Klik pada kalender untuk memilih tanggal pembayaran</small>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="bukti_bayar">Bukti Pembayaran</label>
                                    <input type="file" class="file-bayar" id="bukti_bayar" name="bukti_bayar">
                                </div>
                                <a href="/shop" class="btn site-btn text-dark border border-secondary" style="background-color: white;">SHOP</a>
                                <button class="btn site-btn float-right">KIRIM</button>
                            </form>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Pembayaran</h4>
                                <div class="checkout__order__products">Bank <span>Rekening</span></div>
                                <ul>
                                    <li>BCA<span>121212121212</span></li>
                                    <li>MANDIRI<span>131313131313</span></li>
                                    <li>BRI<span>141414141414</span></li>
                                </ul>
                                <p class="text-justify">Pembayaran dapat di transfer pada salah satu daftar rekening diatas.</p>
                            </div>
                            <div class="checkout__order mt-5">
                                <h4>Detail Pesanan</h4>
                                <div class="checkout__order__products">Items <span>Total</span></div>
                                <ul>
                                    @foreach ($items as $item)
                                            <li>{{ $item->produk->nama_produk . ' (x'.  $item->qty . ')' }}  <span>Rp. {{ number_format($item->subtotal, 0, ',', '.') }}</span></li>
                                    @endforeach
                                </ul>
                                <div class="checkout__order__subtotal">Subtotal <span>Rp. {{ number_format($pesanan->subtotal, 0, ',', '.') }}</span></div>
                                <div class="checkout__order__subtotal mt-n3">Ongkir <span id="ongkir">Rp. {{ number_format($pesanan->ongkir, 0, ',', '.') }}</span></div>
                                <div class="checkout__order__total">Total <span id="total">Rp. {{ number_format($pesanan->total, 0, ',', '.') }}</span></div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

    <script>
        $(document).ready(function() {
            // Initialize date picker
            $('#tgl_bayar').datepicker({
                format: 'dd-mm-yyyy',
                todayBtn: "linked",
                todayHighlight: true,
                autoclose: true,
                orientation: "bottom auto",
                startDate: '-30d', // Allow dates from 30 days ago
                endDate: '+0d', // Only allow today and past dates
                language: 'id',
                daysOfWeekHighlighted: "0,6", // Highlight weekends
                templates: {
                    leftArrow: '<i class="fas fa-chevron-left"></i>',
                    rightArrow: '<i class="fas fa-chevron-right"></i>'
                }
            });

            // Open date picker when clicking on the input group
            $('#tgl_bayar').on('click', function() {
                $(this).datepicker('show');
            });

            // Open date picker when clicking on the calendar icon
            $('#tanggal-addon').on('click', function() {
                $('#tgl_bayar').datepicker('show');
            });

            // Set today's date as default if empty
            if ($('#tgl_bayar').val() === '') {
                $('#tgl_bayar').datepicker('setDate', 'today');
            }
        });
    </script>
@endsection
