@extends('layouts.shop')

@section('content')
     <section class="related-blog spad mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mt-n5">
                    <div class="section-title related-blog-title">
                        <h2>TENTANG KAMI</h2>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-5 col-sm-12 text-center mb-4">
                            <img src="{{ asset('/dist/img/photo_6264587213337201938_x.jpg') }}" alt="TBK RajaSion" class="img-fluid rounded" style="max-width: 100%; height: auto;">
                        </div>
                        <div class="col-lg-8 col-md-7 col-sm-12 text-justify">
                            <p class="text-dark">TBK Raja Sion adalah toko bahan kue (TBK) yang menyediakan berbagai macam bahan baku dan perlengkapan untuk membuat kue dan produk pastry. TBK Raja Sion dikenal menyediakan produk yang lengkap, berkualitas, dan terjamin keasliannya, mulai dari bahan dasar seperti tepung, gula, cokelat, mentega, dan ragi, hingga bahan pendukung serta perlengkapan baking lainnya.</p>
                            
                            <p class="text-dark">Selain melayani penjualan secara langsung, TBK Raja Sion juga aktif dan terpercaya di berbagai platform online seperti Shopee dan Tiktok. Kehadiran di platform digital ini memudahkan pelanggan dari berbagai daerah di Indonesia untuk mendapatkan kebutuhan bahan kue dengan proses pemesanan yang praktis, cepat, dan aman.</p>
                            
                            <p class="text-dark">Dengan harga yang kompetitif dan konsisten, TBK Raja Sion menjadi salah satu pemasok utama bagi para pembisnis kue, bakery, dan UMKM kuliner di Indonesia. Pelayanan yang responsif, ketersediaan stok yang stabil, serta komitmen terhadap kepuasan pelanggan menjadikan TBK Raja Sion sebagai mitra terpercaya bagi pelaku usaha maupun individu yang hobi membuat kue.</p>
                        </div>
                    </div>
                    <div class="accordion mt-4" id="faqExample">
                        <div class="card">
                            <div class="card-header p-2 st-color" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link text-light" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Q: Apa itu TBK RajaSion?
                                    </button>
                                    </h5>
                            </div>
        
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#faqExample">
                                <div class="card-body">
                                    <b>Answer:</b> TBK RajaSion adalah toko bahan kue online yang dapat digunakan untuk memesan bahan kue melalui aplikasi berbasis website
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-header p-2 st-color" id="headingTwo">
                                <h5 class="mb-0">
                                <button class="btn btn-link text-light collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Q: Bagaimana Cara memesan Produk di TBK RajaSion?
                                </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqExample">
                                <div class="card-body text-left">
                                <b>Answer:</b> <br>
                                  1. Customer dapat memilih produk yang diinginkan <br>
                                  2. Customer dapat melakukan konfirmasi pemesanan dan pembayaran <br>
                                  3. Customer dapat menunggu sampai kebutuhan produk diterima <br>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-header p-2 st-color" id="headingThree">
                                <h5 class="mb-0">
                                    <button class="btn btn-link text-light collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Q. Bagaimana produk kami dapat diterima?
                                    </button>
                                    </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqExample">
                                <div class="card-body">
                                <b>Answer:</b> TBK RajaSion menyediakan jasa pengiriman sesuai dengan harga dari masing-masing penjual Bahan Kue yang sudah ditentukan sesuai lokasi customer                                </div>
                          </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-header p-2 st-color" id="headingFour">
                                <h5 class="mb-0">
                                    <button class="btn btn-link text-light collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        Q. Jam Buka Pesanan TBK RajaSion?
                                    </button>
                                    </h5>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#faqExample">
                                <div class="card-body">
                                    <b>Answer:</b> TBK RajaSion dapat menerima pesanan 24 jam, namun akan dikonfirmasi oleh admin dan penjual dari pukul 07.00 AM - 17.00 PM                                </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
    </section>
@endsection