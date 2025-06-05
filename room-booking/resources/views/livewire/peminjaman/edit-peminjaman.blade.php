<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Edit Peminjaman {{ $peminjaman->ruang->nama }} - {{ $peminjaman->pegawai->nama }} - {{ $peminjaman->tanggal }}</h1>
    <form wire:submit.prevent="save" class="space-y-4">
        <flux:select id="ruang_id" wire:model.defer="ruang_id" label="Ruang" placeholder="Pilih Ruang"
            required>
            @foreach ($ruangs as $ruang)
            <flux:select.option value="{{ $ruang->id }}">{{ $ruang->kode }} - {{ $ruang->nama }}</flux:select.option>
            @endforeach
        </flux:select>
        <flux:select id="pegawai_id" wire:model.defer="pegawai_id" label="Pegawai" placeholder="Pilih Pegawai"
            required>
            @foreach ($pegawais as $pegawai)
            <flux:select.option value="{{ $pegawai->id }}">{{ $pegawai->nip }} - {{ $pegawai->nama }}</flux:select.option>
            @endforeach
        </flux:select>
        <flux:input type="date" id="tanggal" wire:model.defer="tanggal" label="Tanggal Peminjaman"
            placeholder="Masukkan Tanggal Peminjaman" required />
        <flux:input type="time" id="jam_mulai" wire:model.defer="jam_mulai" label="Jam Mulai"
            placeholder="Masukkan Jam Mulai" required />
        <flux:input type="time" id="jam_akhir" wire:model.defer="jam_akhir" label="Jam Akhir"
            placeholder="Masukkan Jam Akhir" required />
        <flux:textarea id="keterangan" wire:model.defer="keterangan" label="Keterangan"
            placeholder="Masukkan Keterangan" required />
        <flux:button type="submit" variant="primary">
            Save
        </flux:button>
    </form>
</div>