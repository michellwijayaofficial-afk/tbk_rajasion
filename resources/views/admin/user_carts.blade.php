@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar User dan Keranjang Belanja</h3>
                    <div class="card-tools">
                        <span class="badge badge-info">Total User: {{ $totalUsers }}</span>
                        <span class="badge badge-success">Total Keranjang: {{ $totalCarts }}</span>
                        <span class="badge badge-warning">Total Item: {{ $totalCartItems }}</span>
                    </div>
                </div>
                <div class="card-body">
                    @if(count($userCarts) > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>No. Telepon</th>
                                        <th>User ID</th>
                                        <th>Keranjang ID</th>
                                        <th>Jumlah Item</th>
                                        <th>Total Quantity</th>
                                        <th>Total Value</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($userCarts as $index => $userCart)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <strong>{{ $userCart['user']->username }}</strong>
                                        </td>
                                        <td>{{ $userCart['user']->email }}</td>
                                        <td>{{ $userCart['user']->notelp }}</td>
                                        <td>
                                            <span class="badge badge-primary">{{ $userCart['user']->id }}</span>
                                        </td>
                                        <td>
                                            @if($userCart['pesanan'])
                                                <span class="badge badge-success">{{ $userCart['pesanan']->id }}</span>
                                            @else
                                                <span class="badge badge-secondary">No Cart</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-info">{{ $userCart['total_items'] }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-warning">{{ $userCart['total_quantity'] }}</span>
                                        </td>
                                        <td>
                                            @if($userCart['total_value'] > 0)
                                                <span class="badge badge-success">Rp {{ number_format($userCart['total_value'], 0, ',', '.') }}</span>
                                            @else
                                                <span class="badge badge-secondary">Rp 0</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($userCart['total_items'] > 0)
                                                <button class="btn btn-sm btn-info" onclick="showDetail({{ $index }})">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </button>
                                            @else
                                                <span class="text-muted">Kosong</span>
                                            @endif
                                        </td>
                                    </tr>
                                    
                                    <!-- Hidden detail row -->
                                    <tr id="detail-{{ $index }}" style="display: none;">
                                        <td colspan="10">
                                            <div class="p-3 bg-light">
                                                <h6>Detail Keranjang untuk {{ $userCart['user']->username }}:</h6>
                                                @if(count($userCart['items']) > 0)
                                                    <table class="table table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>Produk</th>
                                                                <th>Quantity</th>
                                                                <th>Harga Satuan</th>
                                                                <th>Subtotal</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($userCart['items'] as $item)
                                                            <tr>
                                                                <td>{{ $item['product']->nama_produk }}</td>
                                                                <td>{{ $item['detpesanan']->qty }}</td>
                                                                <td>Rp {{ number_format($item['product']->harga_produk, 0, ',', '.') }}</td>
                                                                <td>Rp {{ number_format($item['detpesanan']->subtotal, 0, ',', '.') }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr class="bg-success text-white">
                                                                <th colspan="3">Total:</th>
                                                                <th>Rp {{ number_format($userCart['total_value'], 0, ',', '.') }}</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                @else
                                                    <p class="text-muted">Keranjang kosong</p>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <h4><i class="icon fa fa-info"></i> Info</h4>
                            Tidak ada data user yang ditemukan.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showDetail(index) {
    const detailRow = document.getElementById('detail-' + index);
    if (detailRow.style.display === 'none') {
        detailRow.style.display = 'table-row';
    } else {
        detailRow.style.display = 'none';
    }
}
</script>
@endsection
