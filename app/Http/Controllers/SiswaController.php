<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $cari = $request->cari;
        if (! empty($cari)) {
            $data = Siswa::latest()
                ->where(function ($query) use ($cari) {
                    if ($cari) {
                        $query->where('nama', 'like', '%'.$cari.'%')
                            ->orWhere('kelas', 'like', '%'.$cari.'%')
                            ->orWhere('jurusan', 'like', '%'.$cari.'%');
                    }
                })
                ->paginate(10);
        } else {
            $data = Siswa::latest()->paginate(10);
        }

        return view('siswa.index', ['data' => $data]);
    }

    public function create()
    {
        return view('siswa.tambah');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string',
            'kelas' => 'required|string',
            'jurusan' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'foto' => 'required|image|max:2048',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'kelas.required' => 'Kelas wajib diisi.',
            'jurusan.required' => 'Jurusan wajib diisi.',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib dipilih.',
            'tempat_lahir.required' => 'Tempat Lahir wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal Lahir wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'foto.required' => 'Foto wajib diisi.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.max' => 'Ukuran file foto maksimal 2MB.',
        ]);

        $data['foto'] = $this->prosessFoto($request->file('foto'));

        Siswa::create($data);
        sweetalert()->success('Data berhasil ditambahkan!');

        return redirect('/siswa');
    }

    public function edit($id)
    {
        $data = Siswa::findOrFail($id);

        return view('siswa.edit', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required|string',
            'kelas' => 'required|string',
            'jurusan' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|max:2048',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'kelas.required' => 'Kelas wajib diisi.',
            'jurusan.required' => 'Jurusan wajib diisi.',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib dipilih.',
            'tempat_lahir.required' => 'Tempat Lahir wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal Lahir wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.max' => 'Ukuran file foto maksimal 2MB.',
        ]);

        // Hanya update foto jika ada file baru di-upload
        if ($request->hasFile('foto')) {
            $data['foto'] = $this->prosessFoto($request->file('foto'), $siswa->foto);
        } else {
            unset($data['foto']); // Jangan ubah field foto jika tidak ada file baru
        }

        $siswa->update($data);
        sweetalert()->success('Data berhasil diupdate!');

        return redirect('/siswa');
    }

    public function delete($id)
    {
        $data = Siswa::findOrFail($id);

        return view('siswa.hapus', ['data' => $data]);
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        // Hapus file foto jika ada
        if ($siswa->foto && file_exists(public_path('foto_siswa/'.$siswa->foto))) {
            unlink(public_path('foto_siswa/'.$siswa->foto));
        }

        $siswa->delete();
        sweetalert()->success('Data berhasil dihapus!');

        return redirect('/siswa');
    }

    private function prosessFoto($file, $oldFile = null)
    {
        if (! $file) {
            return $oldFile;
        }

        try {
            // Hapus file lama jika ada
            if ($oldFile && file_exists(public_path('foto_siswa/'.$oldFile))) {
                unlink(public_path('foto_siswa/'.$oldFile));
            }

            // Buat nama file unik
            $filename = time().'_'.$file->getClientOriginalName();

            // Pindah file ke folder tujuan
            $file->move(public_path('foto_siswa'), $filename);

            return $filename;
        } catch (Exception $e) {
            // kembalikan file lama jika ada error saat upload
            return $oldFile;
        }
    }

    public function exportExcel(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $sql = Siswa::latest()
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->get();

        $filename = "Laporan_Daftar_Siswa_{$from}_sampai_{$to}.xlsx";

        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();
        $no = 1;
        $rows = 2;

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Kelas');
        $sheet->setCellValue('D1', 'Jurusan');
        $sheet->setCellValue('E1', 'Jenis Kelamin');
        $sheet->setCellValue('F1', 'Tempat Lahir');
        $sheet->setCellValue('G1', 'Tanggal Lahir');
        $sheet->setCellValue('H1', 'Alamat');
        // kasih jarak 1 baris di excel
        $sheet->setCellValue('J1', 'Jumlah Siswa Laki-laki');
        $sheet->setCellValue('K1', 'Jumlah Siswa Perempuan');
        $sheet->setCellValue('L1', 'Total Siswa');

        foreach ($sql as $data) {
            $sheet->setCellValue('A'.$rows, $no++);
            $sheet->setCellValue('B'.$rows, $data->nama);
            $sheet->setCellValue('C'.$rows, $data->kelas);
            $sheet->setCellValue('D'.$rows, $data->jurusan);
            $sheet->setCellValue('E'.$rows, $data->jenis_kelamin);
            $sheet->setCellValue('F'.$rows, $data->tempat_lahir);
            // Format tanggal lahir
            $dateLahir = new DateTime($data->tanggal_lahir);
            $tglLahir = date_format($dateLahir, 'd/m/Y');
            $sheet->setCellValue('G'.$rows, $tglLahir);

            $sheet->setCellValue('H'.$rows, $data->alamat);
            $rows++;
        }

        $jumlahLaki = $sql->where('jenis_kelamin', 'Laki-laki')->count();
        $jumlahPerempuan = $sql->where('jenis_kelamin', 'Perempuan')->count();
        $totalSiswa = $sql->count();

        $sheet->setCellValue('J2', $jumlahLaki);
        $sheet->setCellValue('K2', $jumlahPerempuan);
        $sheet->setCellValue('L2', $totalSiswa);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
