@extends('layouts.app')

@section('content')
<div>
    <div class="container-fluid">
        <div class="container">
            <div class="d-flex align-items-start mt-4" id="v-tab-profil">
                <div class="nav flex-column nav-pills me-5" role="tablist">
                    <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#profilpengguna">Profil Pengguna</button>
                    <button class="nav-link" data-bs-toggle="pill" data-bs-target="#riwayatpengguna">Riwayat Pengguna</button>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="profilpengguna" role="tabpanel" ;>
                        <div class="container-fluid rounded-3 p-5" style="background-color: #FFEDB8;">
                            <div class="row">
                                <div class="col" style="width: 900px">
                                    <h1 class="text-center fw-bolder mb-3" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Profil Pengguna</h1>
                                    <div class="mb-3">
                                        <label class="form-label">Nama Pengguna</label>
                                        <input class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password Baru (Opsional)</label>
                                        <input class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Konfirmasi Password Baru</label>
                                        <input class="form-control">
                                    </div>
                                    <button class="btn btn-primary">Ubah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection