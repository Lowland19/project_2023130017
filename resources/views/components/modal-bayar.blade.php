<div class="modal fade" id="modalBayar{{ $item->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Pembayaran Denda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <form action="{{ route('pengembalian.uploadBukti', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="modal-body">
                    <div class="alert alert-info">
                        <small>Silakan transfer sebesar:</small>
                        <h4 class="fw-bold text-center my-2">Rp {{ number_format($item->denda, 0, ',', '.') }}</h4>
                        <small>Ke Rekening BCA: <strong>123-456-7890</strong> a/n Perpustakaan</small>
                    </div>

                    <div class="mb-3">
                        <label for="bukti" class="form-label">Upload Bukti Transfer</label>
                        <input type="file" class="form-control" name="bukti_transfer" accept="image/*" required>
                        <div class="form-text text-muted">Format: JPG, PNG, PDF. Maks 2MB.</div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Kirim Bukti</button>
                </div>
            </form>
        </div>
    </div>
</div>