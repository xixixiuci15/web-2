<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

use App\Livewire\Counter;
//ruang
use App\Livewire\Ruang\ListRuang;
use App\Livewire\Ruang\CreateRuang;
use App\Livewire\Ruang\EditRuang;
//pegawai
use App\Livewire\Pegawai\ListPegawai;
use App\Livewire\Pegawai\CreatePegawai;
use App\Livewire\Pegawai\EditPegawai;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
Route::get('/counter', Counter::class);
//ruang
Route::get('/ruang', ListRuang::class)->name('ruang.index');
Route::get('/ruang/create', CreateRuang::class)->name('ruang.create');
Route::get('/ruang/edit/{ruang}', EditRuang::class)->name('ruang.edit');

//pegawai
Route::get('/pegawai', ListPegawai::class)->name('Pegawai.index');
Route::get('/pegawai/create', CreatePegawai::class)->name('Pegawai.create');
Route::get('/pegawai/edit/{pegawai}', EditPegawai::class)->name('Pegawai.edit');
