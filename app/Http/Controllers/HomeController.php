<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Exception;
use Illuminate\Http\Request;

class HomeController extends Controller
{
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

    public function index()
    {
        return view('umum.homepage');
    }

    public function dashboard()
    {
        return view('dashboard.index');
    }

    public function pendaftaran()
    {
        return view('umum.pendaftaran');
    }

    public function simpanPendaftaran(Request $request)
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
        sweetalert()->success('Anda ['.$data['nama'].'] berhasil mendaftar!');

        return redirect('/pendaftaran');
    }
}
