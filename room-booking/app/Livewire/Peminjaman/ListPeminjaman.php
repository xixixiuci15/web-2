<?php

namespace App\Livewire\Peminjaman;

use App\Models\Peminjaman;
use Livewire\Component;

class ListPeminjaman extends Component
{
    public function render()
    {
        return view('livewire.peminjaman.list-peminjaman', ['peminjamans' => Peminjaman::with('pegawai', 'ruang')->get()]);
    }

    public function delete($id)
    {
        $peminjaman = Peminjaman::find($id);

        if ($peminjaman) {
            $peminjaman->delete();
            session()->flash('message', 'Peminjaman berhasil dihapus.');
        }
    }
}