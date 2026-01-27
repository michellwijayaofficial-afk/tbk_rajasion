@extends('layouts.main')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800">Tambah Produk</h1>
    <a href="{{ route('admin.produk') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card border-top-primary">
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_produk">Nama Produk <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_produk" name="nama_produk" 
                                       value="{{ old('nama_produk') }}" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="harga_produk">Harga Produk <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="harga_produk" name="harga_produk" 
                                       value="{{ old('harga_produk') }}" min="0" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stock_produk">Stock Produk <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="stock_produk" name="stock_produk" 
                                       value="{{ old('stock_produk') }}" min="0" required>
                                <small class="form-text text-muted">Masukkan jumlah stock yang tersedia</small>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="foto_produk">Foto Produk</label>
                                <input type="file" class="form-control" id="foto_produk" name="foto_produk" 
                                       accept="image/*" onchange="previewImage(event)">
                                <small class="form-text text-muted">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                                
                                @if(old('foto_produk'))
                                    <div class="mt-2">
                                        <small class="text-info">File yang dipilih: {{ old('foto_produk') }}</small>
                                    </div>
                                @endif
                                
                                <div class="mt-2" id="imagePreview" style="display: none;">
                                    <img id="previewImg" src="#" alt="Preview" style="max-width: 200px; max-height: 200px; border: 1px solid #ddd; border-radius: 4px;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi_produk">Deskripsi Produk</label>
                        <textarea class="form-control" id="deskripsi_produk" name="deskripsi_produk" rows="4">{{ old('deskripsi_produk') }}</textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <a href="{{ route('admin.produk') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
function previewImage(event) {
    var file = event.target.files[0];
    var preview = document.getElementById('imagePreview');
    var previewImg = document.getElementById('previewImg');
    
    if (file) {
        // Check file size (2MB max)
        if (file.size > 2 * 1024 * 1024) {
            alert('File terlalu besar! Maksimal ukuran file adalah 2MB.');
            event.target.value = '';
            return;
        }
        
        // Check file type
        if (!file.type.match('image.*')) {
            alert('File harus berupa gambar (JPG, PNG, GIF)!');
            event.target.value = '';
            return;
        }
        
        var reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
        previewImg.src = '#';
    }
}
</script>
