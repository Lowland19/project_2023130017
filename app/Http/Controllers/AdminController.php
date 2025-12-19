<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Pinjaman;
use App\Models\User;
use App\Models\Buku;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Reader\Xml\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AdminController extends Controller
{
    public function index()
    {
        $user = User::all();
        $buku = Buku::all();
        $roles = Role::all();
        $permissions = Permission::all();
        $totalPengguna = User::count();
        $peminjamHariIni = Pinjaman::whereDate('created_at', Carbon::today())->count();
        $bukuTersedia = Buku::where('statusTersedia', 1)->count();
        $bukuDipinjam = Buku::where('statusTersedia', 0)->count();
        $lunas = Pengembalian::where('sudahDibayar', 1)->count();
        $belumLunas = Pengembalian::where('sudahDibayar', 0)->count();
        $peminjamanPerBulan = [];

        $pendingPayments = Pengembalian::with(['peminjaman.user', 'peminjaman.buku'])
            ->where('status_pembayaran', 'menunggu_verifikasi')
            ->get();
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $peminjamanPerBulan[] = Pinjaman::whereMonth('tanggalAwalPinjam', $bulan)
                ->whereYear('tanggalAwalPinjam', date('Y')) // Hanya tahun ini
                ->count();
        }
        return view('AdminDashboard', compact('user', 'buku', 'roles', 'permissions', 'totalPengguna', 'peminjamHariIni', 'bukuTersedia', 'bukuDipinjam', 'lunas', 'belumLunas', 'peminjamanPerBulan', 'pendingPayments'));
    }

    protected function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'alamat' => 'required|string',
            'nomortelepon' => 'required|string',
            'role' => 'required|string'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'nomortelepon' => $request->nomortelepon,
            'role' => $request->role,
        ]);
        $user->assignRole($request->role);
        return redirect()->route('admin.dashboard')->with('success', "Pengguna berhasil didaftarkan")->with('active_tab', 'user-list');
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name'
        ]);

        // Menghapus role lama dan memberikan yang baru
        $user->syncRoles($request->role);

        return redirect()->back()->with('success', "Role {$user->name} berhasil diperbarui!")->with('active_tab', 'user-list');
    }

    public function verifikasiPembayaran($id)
    {
        // Cari data pengembalian berdasarkan ID
        $pengembalian = Pengembalian::findOrFail($id);

        // Update status
        $pengembalian->update([
            'status_pembayaran' => 'lunas', // Ubah status teks
            'sudahDibayar' => 1             // Ubah status angka (boolean)
        ]);

        return redirect()->back()->with('success', 'Pembayaran denda berhasil disetujui!');
    }

    public function exportDashboard()
    {
        // 1. SIAPKAN DATA (Sama seperti sebelumnya)
        $totalUser = User::count();
        $peminjamHariIni = Pinjaman::whereDate('tanggalAwalPinjam', now())->count();
        $dendaLunas = Pengembalian::where('status_pembayaran', 'lunas')->sum('denda');
        $dendaHutang = Pengembalian::where('status_pembayaran', '!=', 'lunas')->sum('denda');

        // Contoh Data Bulanan (Ganti dengan query asli Anda)
        $dataBulanan = [
            ['bulan' => 'Oktober', 'jumlah' => 5],
            ['bulan' => 'November', 'jumlah' => 12],
            ['bulan' => 'Desember', 'jumlah' => 45],
        ];

        // 2. BUAT OBJECT SPREADSHEET BARU
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // 3. TULIS JUDUL & HEADER
        $sheet->setCellValue('A1', 'LAPORAN DASHBOARD PERPUSTAKAAN');
        $sheet->mergeCells('A1:C1'); // Gabungkan sel A1 sampai C1
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

        $sheet->setCellValue('A2', 'Tanggal Generate: ' . date('d-m-Y H:i'));

        // 4. BAGIAN 1: METRIK UTAMA
        $sheet->setCellValue('A4', 'METRIK UTAMA');
        $sheet->getStyle('A4')->getFont()->setBold(true);

        $sheet->setCellValue('A5', 'Jumlah Pengguna');
        $sheet->setCellValue('B5', $totalUser);

        $sheet->setCellValue('A6', 'Peminjam Hari Ini');
        $sheet->setCellValue('B6', $peminjamHariIni);

        // 5. BAGIAN 2: KEUANGAN
        $sheet->setCellValue('A8', 'STATUS KEUANGAN');
        $sheet->getStyle('A8')->getFont()->setBold(true);

        $sheet->setCellValue('A9', 'Denda Lunas');
        $sheet->setCellValue('B9', $dendaLunas);
        $sheet->getStyle('B9')->getNumberFormat()->setFormatCode('#,##0'); // Format Angka

        $sheet->setCellValue('A10', 'Denda Belum Dibayar');
        $sheet->setCellValue('B10', $dendaHutang);
        $sheet->getStyle('B10')->getNumberFormat()->setFormatCode('#,##0');

        // 6. BAGIAN 3: TABEL BULANAN (Looping)
        $row = 13; // Mulai tulis tabel di baris ke-13

        // Header Tabel
        $sheet->setCellValue('A' . $row, 'Bulan');
        $sheet->setCellValue('B' . $row, 'Jumlah Peminjam');
        $sheet->getStyle("A$row:B$row")->getFont()->setBold(true);

        // Isi Tabel
        $row++;
        foreach ($dataBulanan as $data) {
            $sheet->setCellValue('A' . $row, $data['bulan']);
            $sheet->setCellValue('B' . $row, $data['jumlah']);
            $row++;
        }

        // 7. AUTOSIZE KOLOM (Agar lebar kolom pas)
        foreach (range('A', 'B') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // 8. PROSES DOWNLOAD (Stream ke Browser)
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Laporan_Dashboard_' . date('Y-m-d_H-i') . '.xlsx';

        return response()->streamDownload(function () use ($spreadsheet) {
            // Inisialisasi Writer di dalam fungsi ini
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

            // Simpan ke output stream (langsung ke browser)
            $writer->save('php://output');
        }, $fileName);
    }
}
