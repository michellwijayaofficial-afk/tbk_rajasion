@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Kirim Pesanan (Admin)</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.pesanan') }}" class="btn btn-sm btn-default">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(count($pesanan) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">No.</th>
                                        <th scope="col">Tgl. Pesanan</th>
                                        <th scope="col">Nomor Pesanan</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Tipe Pembayaran</th>
                                        <th scope="col">Total</th>
                                        <th scope="col" width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pesanan as $index => $row)
                                        <tr class="text-center">
                                            <td>{{ $index + 1 }}</td>
                                            <td class="align-middle">{{ $row->tgl_pesan ?? '-' }}</td>
                                            <td class="align-middle">
                                                <strong>{{ $row->no_pesanan }}</strong>
                                            </td>
                                            <td class="align-middle">
                                                {{ $row->user->username ?? '-' }}
                                            </td>
                                            <td class="align-middle">
                                                @if ($row->tipe_pembayaran == 1)
                                                    <span class="badge badge-primary">COD (<i>Cash On Delivery</i>)</span>
                                                @else
                                                    <span class="badge badge-warning">Bank Transfer</span>
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                <strong>Rp {{ number_format($row->total, 0, ',', '.') }}</strong>
                                            </td>
                                            <td class="align-middle">
                                                <a href="#" data-id="{{ $row->id }}" data-invoice="{{ $row->no_pesanan }}" data-toggle="modal" data-target="#invoice" class="btn btn-sm btn-info modalInvoice">
                                                    <i class="fas fa-eye"></i> Detail
                                                </a>
                                                <a href="{{ route('admin.detpes', $row->no_pesanan) }}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-search"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <h4><i class="fas fa-info-circle"></i> Info</h4>
                            Tidak ada pesanan yang siap dikirim (Status: Sudah Dibayar).
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Invoice -->
<div class="modal fade" id="invoice" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">INVOICE PESANAN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <table id="main" class="table table-bordered">
                            <tr style="background-color: #acacac">
                                <td colspan="4" class="text-center">
                                    <p style="color: #0b3005;"><b>TBK RajaSion</b></p>
                                    <h4 id="no_pesanan" style="margin-top: -15px;"></h4>
                                </td>
                            </tr>
                            <tr>
                                <td width='30%'><b>Pembayaran</b></td>
                                <td><span id="metode" class="font-weight-bolder"></span></td>
                            </tr>
                            <tr>
                                <td width='30%'><b>Nama</b></td>
                                <td><span id="nama_penerima"></span></td>
                            </tr>
                            <tr>
                                <td width='30%'><b>No Telp</b></td>
                                <td><span id="notelp_penerima"></span></td>
                            </tr>
                            <tr>
                                <td width='30%'><b>Alamat</b></td>
                                <td><span id="alamat_penerima"></span></td>
                            </tr>
                        </table>
                        <table id="main" class="table table-bordered">
                            <tr id="detail">
                                <td>No</td>
                                <td>Nama Produk</td>
                                <td>Qty</td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>Total</b></td>
                                <td><b id="total"></b></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-secondary" id="unduhPdf" href="" target="_blank">
                    <i class="fas fa-download"></i> Unduh Invoice
                </a>
                <form action="" method="POST" class="d-inline" id="kirim">
                    @method('PUT')
                    @csrf
                    <button class="btn btn-success">
                        <i class="fas fa-shipping-fast"></i> Kirim Pesanan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).on("click", ".modalInvoice", function() {
    var id = $(this).data('id');
    var noPesanan = $(this).data('invoice');
    var url = "/pesanan_invoice/"+id;
    
    $.ajax({
        type: "get",
        url: url,
        dataType: "html",
        success: function(msg) {
            let tmp = JSON.parse(msg);
            $('#no_pesanan').html(tmp.no_pesanan);
            $('#metode').html(tmp.metode);
            $('#nama_penerima').html(tmp.nama_penerima);
            $('#notelp_penerima').html(tmp.notelp_penerima);
            $('#alamat_penerima').html(tmp.alamat_penerima);
            $('#total').html(tmp.total);
            
            // Clear previous details
            $('[id="Bahan Kue"]').remove();
            $('#detail').after(tmp.detail);
            
            $('#unduhPdf').attr('href', '/invoice/pdf/'+id);
            $('#kirim').attr('action', '/admin/pesanan/kirim/'+id);
        }    
    });
});

$("#invoice").on("hidden.bs.modal", function () {
    $('[id="Bahan Kue"]').remove();
});
</script>

@endsection
