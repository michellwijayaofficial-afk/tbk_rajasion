@extends('layouts.shop')

@section('content')
     <!-- Breadcrumb Section Begin -->
     <section class="breadcrumb-section set-bg st-color container">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Hubungi Kami</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_phone"></span>
                        <h4>No. Telp</h4>
                        <p>+62 812 7326 1676</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_pin_alt"></span>
                        <h4>Alamat</h4>
                        <p>RAJA SION Palembang Toko Bahan Kue, Jl. Letjen Harun Sohar, Palembang</p>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_clock_alt"></span>
                        <h4>Jam Buka</h4>
                        <p>08:00 am to 17:00 pm</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_mail_alt"></span>
                        <h4>Email</h4>
                        <p>bahankueraja@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="map container mb-5">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.023364876459!2d104.7443807!3d-3.0054418!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e3b9f09e552bbbb:0xe24215bba1c73f7d!2sRAJA+SION+Palembang+Toko+Bahan+Kue!5e0!3m2!1sen!2sid!4v1700000000000"
            height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        <div class="map-inside">
            <i class="icon_pin"></i>
            <div class="inside-widget">
                <h4>TBK RajaSion</h4>
                <ul>
                    <li>No Telp.: +62 812 7326 1676</li>
                    <li>Alamat: RAJA SION Palembang Toko Bahan Kue, Jl. Letjen Harun Sohar, Palembang</li>
                </ul>
            </div>
        </div>
    </div>

@endsection