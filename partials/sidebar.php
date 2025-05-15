<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
               
                <a class="nav-link" href="dashboard.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <div class="sb-sidenav-menu-heading">Fitur Utama</div>

               
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAnggota" aria-expanded="false">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    Manajemen Anggota
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseAnggota" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="nestedAnggota">
                        <a class="nav-link" href="create_pegawai.php">Pendaftaran Pegawai</a>
                        <a class="nav-link" href="list_anggota.php">Pengelolaan Data Anggota</a>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#subAnggota" aria-expanded="false">
                            Data Terkait Anggota
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="subAnggota">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="list_pegawai.php">Data Pegawai</a>
                                <a class="nav-link" href="list_kartu_diskon.php">Kartu Diskon</a>
                            </nav>
                        </div>
                    </nav>
                </div>

                
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduk" aria-expanded="false">
                    <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                    Pengelolaan Produk
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseProduk" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="nestedProduk">
                        <a class="nav-link" href="create_produk.php">Tambah Produk</a>
                        <a class="nav-link" href="list_produk.php">Daftar Produk</a>
                        <a class="nav-link" href="list_jenis_produk.php">Daftar Jenis Produk</a>
                    </nav>
                </div>

               
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePemesanan" aria-expanded="false">
                    <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                    Pemesanan Produk
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePemesanan" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="list_pesanan.php">Daftar Pemesanan</a>
                        <a class="nav-link" href="riwayat_pesanan.php">Riwayat Pemesanan</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTransaksiKeuangan" aria-expanded="false">
                    <div class="sb-nav-link-icon"><i class="fas fa-money-bill-wave"></i></div>
                    Transaksi Keuangan
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseTransaksiKeuangan" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="list_pembayaran.php">Pembayaran</a>
                        <a class="nav-link" href="list_pembayaran_belumlunas.php">Pembayaran Belum Lunas</a>
                    </nav>
                </div>

            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Login sebagai:</div>
            SUCI RAMADHANI
        </div>
    </nav>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../public/js/scripts.js"></script>
