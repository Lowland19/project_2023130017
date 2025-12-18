@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="container">

        <h1 class="text-center fw-bolder mb-3" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Form Peminjaman</h1>
        <div class="container rounded-3 p-5" style="background-color: #FFEDB8;">
            <form action="{{ route('pinjaman.store') }}" method="POST">
                @csrf
                <input type="hidden" name="idPeminjam" value="{{ auth()->id() }}">
                <input type="hidden" name="idBuku" value="{{ $buku->id }}">
                <div class="mb-3">
                    <label class="form-label fw-bolder mb-0" for="judulBuku">Judul Buku</label>
                    <input type="text" class="form-control" name="judulBuku" id="judulBuku" value="{{ $buku->namaBuku }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bolder mb-0" for="durasiPinjam">Durasi Pinjam</label>
                    <input type="number" class="form-control" name="durasiPinjam" id="durasiPinjam">
                </div>
                <div class="mb-3">
                    <label class="form label fw-bolder mb-0" for="tanggalAwalPinjam">Tanggal Pinjam</label>
                    <br>
                    <input type="date" value="{{date('Y-m-d')}}" id="tanggalAwalPinjam" name="tanggalAwalPinjam">
                </div>
                <div class="mb-3">
                    <label class="form label fw-bolder mb-0" for="tanggalPengembalianDisplay">Tanggal Pengembalian</label>
                    <br>
                    <input type="date" disabled value="" id="tanggalPengembalianDisplay">
                    <input type="hidden" name="tanggalPengembalian" id="tanggalPengembalian">
                </div>
                <button class="btn btn-primary" type="submit">Pinjam</button>
                <a href="#" class="btn btn-danger">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const durasiInput = document.getElementById("durasiPinjam");
        const tanggalPinjamInput = document.getElementById("tanggalAwalPinjam");

        const tanggalPengembalianDisplay = document.getElementById("tanggalPengembalianDisplay");
        const tanggalPengembalian = document.getElementById("tanggalPengembalian");

        function hitungPengembalian() {
            let durasi = parseInt(durasiInput.value);
            let tanggalPinjam = new Date(tanggalPinjamInput.value);

            if (!isNaN(durasi) && tanggalPinjamInput.value) {
                let tglKembali = new Date(tanggalPinjam);
                tglKembali.setDate(tglKembali.getDate() + durasi);

                let yyyy = tglKembali.getFullYear();
                let mm = String(tglKembali.getMonth() + 1).padStart(2, '0');
                let dd = String(tglKembali.getDate()).padStart(2, '0');

                let finalDate = `${yyyy}-${mm}-${dd}`;

                tanggalPengembalianDisplay.value = finalDate;
                tanggalPengembalian.value = finalDate;
            }
        }

        durasiInput.addEventListener("input", hitungPengembalian);
        tanggalPinjamInput.addEventListener("change", hitungPengembalian);
    });
</script>