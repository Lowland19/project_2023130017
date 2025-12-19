@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        {{-- Mengatur lebar kolom agar tidak terlalu lebar (col-md-8) --}}
        <div class="col-md-8 col-lg-6">
            
            {{-- Card dengan background kuning sesuai request sebelumnya --}}
            <div class="card border-0 shadow-lg rounded-4" style="background-color: #FFEDB8;">
                <div class="card-body p-5">
                    
                    {{-- Judul --}}
                    <div class="text-center mb-4">
                        <div class="bg-white d-inline-block p-3 rounded-circle shadow-sm mb-3">
                            <i class="bi bi-person-circle fs-1 text-warning"></i>
                        </div>
                        <h2 class="fw-bolder" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                            Profil Pengguna
                        </h2>
                    </div>

                    {{-- Form Mulai --}}
                    {{-- Pastikan route action disesuaikan dengan route update profil Anda --}}
                    <form action="{{ route('user.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Nama --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-0"><i class="bi bi-person"></i></span>
                                <input type="text" name="name" class="form-control bg-white border-0" 
                                       value="{{ Auth::user()->name }}" required>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Alamat Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-0"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" class="form-control bg-white border-0" 
                                       value="{{ Auth::user()->email }}" required>
                            </div>
                        </div>

                        <hr class="my-4" style="border-top: 2px dashed #A37A00;">

                        {{-- Password Baru --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Password Baru <small class="text-muted fw-normal">(Opsional)</small></label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-0"><i class="bi bi-key"></i></span>
                                <input type="password" name="password" class="form-control bg-white border-0" placeholder="Kosongkan jika tidak ingin mengubah">
                            </div>
                        </div>

                        {{-- Konfirmasi Password --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Konfirmasi Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-0"><i class="bi bi-key-fill"></i></span>
                                <input type="password" name="password_confirmation" class="form-control bg-white border-0" placeholder="Ulangi password baru">
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary fw-bold shadow-sm">
                                <i class="bi bi-save me-2"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('home') }}" class="btn btn-outline-dark border-0">
                                Kembali ke Beranda
                            </a>
                        </div>
                    </form>
                    {{-- Form Selesai --}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection