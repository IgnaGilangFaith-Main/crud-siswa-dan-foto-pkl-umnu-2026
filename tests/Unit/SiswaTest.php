<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Siswa;

class SiswaTest extends TestCase
{
    public function test_fillable_fields()
    {
        $siswa = new Siswa([
            'nama' => 'Budi',
            'kelas' => 'XII RPL',
            'jurusan' => 'Rekayasa Perangkat Lunak',
            'jenis_kelamin' => 'Laki-laki',
            'tempat_lahir' => 'Jepara',
            'tanggal_lahir' => '2006-01-01',
            'alamat' => 'Jl. Merdeka',
            'foto' => 'budi.jpg',
        ]);

        $this->assertEquals('Budi', $siswa->nama);
        $this->assertEquals('XII RPL', $siswa->kelas);
        $this->assertEquals('Rekayasa Perangkat Lunak', $siswa->jurusan);
        $this->assertEquals('Laki-laki', $siswa->jenis_kelamin);
        $this->assertEquals('Jepara', $siswa->tempat_lahir);
        $this->assertEquals('2006-01-01', $siswa->tanggal_lahir->format('Y-m-d'));
        $this->assertEquals('Jl. Merdeka', $siswa->alamat);
        $this->assertEquals('budi.jpg', $siswa->foto);
    }
}
