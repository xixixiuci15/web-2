<?php

namespace App\Livewire\Peminjaman;

use App\Models\Pegawai;
use App\Models\Peminjaman;
use App\Models\Ruang;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreatePeminjaman extends Component
{
    #[Validate('required|integer|min:1')]
    public $ruang_id = '';
    
    #[Validate('required|integer|min:1')]
    public $pegawai_id = '';
    
    #[Validate('required|date')]
    public $tanggal = '';

    #[Validate('required|date_format:H:i')]
    public $jam_mulai = '';

    #[Validate('required|date_format:H:i')]
    public $jam_akhir = '';

    #[Validate('required|string')]
    public $keterangan = '';

    public function save()
    {
        $this->validate();

        Peminjaman::create([
            'ruang_id' => $this->ruang_id,
            'pegawai_id' => $this->pegawai_id,
            'tanggal' => $this->tanggal,
            'jam_mulai' => $this->jam_mulai,
            'jam_akhir' => $this->jam_akhir,
            'keterangan' => $this->keterangan
        ]);

        session()->flash('message', 'Peminjaman berhasil ditambahkan.');

        $this->redirectRoute('peminjaman.index');
    }

    public function render()
    {
        return view('livewire.peminjaman.create-peminjaman', ['pegawais' => Pegawai::all(), 'ruangs' => Ruang::all()]);
    }
}