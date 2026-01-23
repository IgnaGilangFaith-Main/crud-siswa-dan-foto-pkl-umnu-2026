<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Exception;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $data = Siswa::latest()->paginate(10);

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
}
