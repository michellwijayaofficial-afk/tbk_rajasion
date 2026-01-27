@extends('layouts.shop')

@section('content')
    
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section st-color container">
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
                <form action="/shop/proses_pesanan" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-7 col-md-6">
                            <div class="form-group mb-4">
                                <label for="tipe_pembayaran">Tipe Pembayaran</label>
                                <select class="form-control selectpicker border @error('tipe_pembayaran') border-danger @enderror" id="tipe_pembayaran" name="tipe_pembayaran" data-size="4" data-live-search="true" title="Pilih Tipe Pembayaran">
                                    <option value="0" 
                                    @if (old('tipe_pembayaran') == "0")
                                        selected
                                    @endif>Transfer Bank</option>
                                    <option value="1"  @if (old('tipe_pembayaran') == "1")
                                    selected
                                @endif>COD (<i>Cash On Delivery</i>)</option>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="nama_penerima">Nama Penerima</label>
                                <input type="text" class="form-control @error('nama_penerima') is-invalid @enderror" id="nama_penerima" name="nama_penerima" autocomplete="off" value="{{ old('nama_penerima') }}" autofocus>
                            </div>
                            <div class="form-row mb-3">
                                <div class="form-group col-md-6">
                                  <label for="notelp_penerima">No. Telp Penerima</label>
                                  <input type="text" class="form-control @error('notelp_penerima') is-invalid @enderror" id="notelp_penerima" name="notelp_penerima" value="{{ old('notelp_penerima', auth()->user()->notelp) }}" autocomplete="off">
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="email">Email</label>
                                  <input type="text" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" readonly>
                                </div>
                              </div>
                            <div class="form-group mb-4">
                                <label for="kabupaten">Kabupaten</label>
                                <input type="text" class="form-control @error('kabupaten') is-invalid @enderror" id="kabupaten" name="kabupaten" autocomplete="off" value="{{ old('kabupaten') }}" placeholder="Masukkan nama kabupaten">
                            </div>
                            <div class="form-group mb-4">
                                <label for="kecamatan">Kecamatan</label>
                                <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" id="kecamatan" name="kecamatan" autocomplete="off" value="{{ old('kecamatan') }}" placeholder="Masukkan nama kecamatan">
                            </div>
                            <div class="form-group mb-4">
                                <label for="alamat_penerima">Alamat Pengiriman</label>
                                <textarea class="form-control @error('alamat_penerima') border border-danger @enderror" id="alamat_penerima" rows="2" name="alamat_penerima" autocomplete="off">{{ auth()->user()->alamat }}</textarea>
                            </div>
                            <div class="form-group mb-4">
                                <label for="catatan">Catatan Pesanan</label>
                                <textarea class="form-control @error('catatan') border border-danger @enderror" id="catatan" rows="3" name="catatan" autocomplete="off">{{ old('catatan') }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6">
                            <div class="checkout__order">
                                <h4>Detail Pesanan</h4>
                                <div class="checkout__order__products">Items <span>Total</span></div>
                                <ul>
                                    @foreach ($items as $item)
                                            <li><b class="text-capitalize font-weight-normal">{{ $item->produk->nama_produk }}</b> (x{{ $item->qty }})  <span>Rp. {{ number_format($item->subtotal, 0, ',', '.') }}</span></li>
                                    @endforeach
                                </ul>
                                <div class="checkout__order__subtotal">Subtotal <span>Rp. {{ number_format($subtotal, 0, ',', '.') }}</span></div>
                                <div class="checkout__order__subtotal mt-n3">Ongkir <span id="ongkir">Rp. {{ number_format(0, 0, ',', '.') }}</span></div>
                                <div class="checkout__order__total">Total <span id="total">Rp. {{ number_format($subtotal, 0, ',', '.') }}</span></div>
                                <button type="submit" class="site-btn">Konfirmasi Pesanan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

    <script>
        // Set default shipping cost for manual input
        function calculateShipping() {
            var kabupaten = $("#kabupaten").val();
            var kecamatan = $("#kecamatan").val();
            var subtotal = {{ $subtotal }};
            
            // Default shipping cost - you can adjust this logic
            var ongkir = 15000; // Default shipping cost
            
            // You can add custom logic based on kabupaten/kecamatan if needed
            if (kabupaten.toLowerCase().includes('jakarta') || kecamatan.toLowerCase().includes('jakarta')) {
                ongkir = 10000; // Cheaper for Jakarta
            }
            
            $('#ongkir').html('Rp. ' + ongkir.toLocaleString('id-ID'));
            $('#total').html('Rp. ' + (subtotal + ongkir).toLocaleString('id-ID'));
        }
        
        $("#kabupaten, #kecamatan").on('input change', function() {
            calculateShipping();
        });
        
        // Calculate initial shipping cost
        calculateShipping();
    </script>
@endsection