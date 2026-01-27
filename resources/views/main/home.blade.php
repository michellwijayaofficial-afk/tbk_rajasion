@extends('layouts.shop')

@section('content')

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="hero__item set-bg"
                    data-setbg="{{ asset('template/img/hero/banner.jpg') }}"
                    style="height: 500px; background-size: cover;">
                    <div class="hero__text">
                        <a href="{{ route('shop') }}" class="primary-btn px-5">MULAI BELANJA</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Produk -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Toko Bahan Kue Raja Sion</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Produk Slider Section -->
            @if($produk_slider->count() > 0)
            <div class="col-12 mb-4">
                <div class="section-title">
                    <h2>Produk Terbaru</h2>
                </div>
                <div class="product-slider owl-carousel">
                    @foreach($produk_slider as $item)
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{ asset('storage/' . ($item->foto_produk ? str_replace('gambar-produk/', '', $item->foto_produk) : 'placeholder.jpg')) }}" alt="{{ $item->nama_produk }}">
                            @if ($item->stock_produk > 0)
                            <div class="product-overlay">
                                <a href="javascript:;" 
                                   class="modal_keranjang"
                                   data-id="{{ $item->id }}"
                                   data-toggle="modal"
                                   data-target="#modalKeranjang">
                                    <i class="fa fa-shopping-cart"></i>
                                </a>
                            </div>
                            @else
                            <div class="out-of-stock-overlay">
                                <span class="out-of-stock-text">Habis</span>
                            </div>
                            @endif
                        </div>
                        <div class="product-info">
                            <h6>
                                <a href="{{ url('/shop/detail-produk/'.$item->id) }}">
                                    {{ Str::limit($item->nama_produk, 30) }}
                                </a>
                            </h6>
                            <h5>Rp {{ number_format($item->harga_produk, 0, ',', '.') }}</h5>
                            <small class="text-muted">
                                @if ($item->stock_produk > 0)
                                    Stok: {{ $item->stock_produk }}
                                @else
                                    Stok: Habis
                                @endif
                            </small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <div class="row">
            @forelse ($produk as $item)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg shadow-sm"
                            data-setbg="{{ asset('storage/' . ($item->foto_produk ? str_replace('gambar-produk/', '', $item->foto_produk) : 'placeholder.jpg')) }}">
                            @if ($item->stock_produk > 0)
                            <ul class="featured__item__pic__hover">
                                <li>
                                    <a href="javascript:;" 
                                        class="modal_keranjang"
                                        data-id="{{ $item->id }}"
                                        data-toggle="modal"
                                        data-target="#modalKeranjang">
                                        <i class="fa fa-shopping-cart"></i>
                                    </a>
                                </li>
                            </ul>
                            @else
                            <div class="out-of-stock-overlay">
                                <span class="out-of-stock-text">Habis</span>
                            </div>
                            @endif
                        </div>

                        <div class="featured__item__text">
                            <h6>
                                <a href="{{ url('/shop/detail-produk/'.$item->id) }}">
                                    {{ $item->nama_produk }}
                                </a>
                            </h6>
                            <h5>Rp {{ number_format($item->harga_produk, 0, ',', '.') }}</h5>
                            <small class="text-muted">
                                @if ($item->stock_produk > 0)
                                    Stok: {{ $item->stock_produk }} tersedia
                                @else
                                    Stok: Habis
                                @endif
                            </small>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-lg-12 text-center">
                    <p>Produk belum tersedia</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Modal Keranjang -->
<div class="modal fade" id="modalKeranjang" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Produk</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <img id="foto_produk" src="" width="100%">
                    </div>
                    <div class="col-lg-6">
                        <h3 id="nama_produk"></h3>
                        <h4 id="harga_produk"></h4>
                        <p id="desc_produk"></p>
                        <p><b>Stok:</b> <span id="stok_produk"></span></p>
                        <p><b>Toko:</b> <span id="toko"></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- SCRIPT MODAL PRODUK --}}
<script>
$(document).on("click", ".modal_keranjang", function () {
    let id = $(this).data("id");

    $.get("/shop/modal/" + id, function (res) {
        $("#nama_produk").html(res.nama_produk);
        $("#desc_produk").html(res.desc_produk);
        $("#harga_produk").html(res.harga_produk);
        $("#stok_produk").html(res.stok_produk);
        $("#toko").html(res.toko);
        $("#foto_produk").attr("src", res.foto_produk);
    });
});
</script>

<style>
.out-of-stock-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
}

.out-of-stock-text {
    color: white;
    font-size: 18px;
    font-weight: bold;
    text-transform: uppercase;
    background-color: #dc3545;
    padding: 8px 16px;
    border-radius: 4px;
}

/* Product Slider Styles */
.product-slider {
    padding: 20px 0;
}

.product-card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin: 0 10px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 20px rgba(0,0,0,0.15);
}

.product-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-card:hover .product-image img {
    transform: scale(1.05);
}

.product-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.product-card:hover .product-overlay {
    opacity: 1;
}

.product-overlay a {
    background: #004225;
    color: white;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    transition: background 0.3s ease;
}

.product-overlay a:hover {
    background: #003018;
}

.product-info {
    padding: 15px;
}

.product-info h6 {
    margin: 0 0 8px 0;
    font-size: 14px;
    line-height: 1.4;
}

.product-info h6 a {
    color: #333;
    text-decoration: none;
    transition: color 0.3s ease;
}

.product-info h6 a:hover {
    color: #004225;
}

.product-info h5 {
    margin: 0 0 5px 0;
    color: #004225;
    font-size: 16px;
    font-weight: bold;
}

.product-info small {
    font-size: 12px;
    color: #666;
}

/* Owl Carousel Custom Styles */
.owl-carousel .owl-item {
    padding: 0 10px;
}

.owl-carousel .owl-nav {
    margin-top: 20px;
}

.owl-carousel .owl-nav button {
    background: #004225 !important;
    color: white !important;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin: 0 5px;
    font-size: 18px;
}

.owl-carousel .owl-nav button:hover {
    background: #003018 !important;
}
</style>

<script>
$(document).ready(function() {
    // Initialize Product Slider
    $('.product-slider').owlCarousel({
        loop: true,
        margin: 20,
        nav: true,
        dots: false,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 2
            },
            768: {
                items: 3
            },
            992: {
                items: 4
            },
            1200: {
                items: 5
            }
        }
    });
});
</script>

@endsection
