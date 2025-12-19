@extends ('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-warning text-dark fw-bold">
            Edit Role: {{ $role->name }}
        </div>
        <div class="card-body">
            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="form-label fw-bold">Nama Role</label>
                    <input type="text" name="name" class="form-control" value="{{ $role->name }}" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold d-block">Hak Akses (Permissions)</label>
                    <div class="row">
                        @foreach($permissions as $permission)
                            <div class="col-md-4 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" 
                                           name="permissions[]" 
                                           value="{{ $permission->name }}"
                                           id="perm-{{ $permission->id }}"
                                           {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="perm-{{ $permission->id }}">
                                        @php
        // Menambahkan spasi sebelum kata 'dashboard', 'admin', 'pengguna', 'buku', dll.
        $pattern = '/(dashboard|admin|pengguna|buku|pinjaman|riwayat|registrasi)/i';
        $spacedName = preg_replace($pattern, ' $1', $permission->name);
    @endphp
    
    {{-- Sekarang Str::headline bisa bekerja karena sudah ada spasinya --}}
    {{ Str::headline($spacedName) }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <hr>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.dashboard',['tab' => 'perizinan']) }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection