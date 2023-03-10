<?php

session_start();

// membatasi halaman sebelum login
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('login dulu dong');
            document.location.href = 'login.php';
          </script>";
    exit;
}

$title = 'Detail Debitur';

include 'layout/header.php';

// mengambil id mahasiswa dari url
$id_mahasiswa = (int)$_GET['id_debitur'];

// menampilkan data mahasiswa
$mahasiswa = select("SELECT * FROM debitur WHERE id_debitur = $id_mahasiswa")[0];

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        <ia class="fas fa-user"></ia> Detail Penilaian Debitur : <?= $mahasiswa['nama_debitur']; ?>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="mahasiswa.php">Data Debitur</a></li>
                        <li class="breadcrumb-item active">Detail Debitur</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-5">
                    <table class="table table-bordered table-striped mt-3">
                        <tr>
                            <td width="20%">No Rekening</td>
                            <td>: <?= $mahasiswa['no_rekening']; ?></td>
                        </tr>

                        <tr>
                            <td width="20%">Nama</td>
                            <td>: <?= $mahasiswa['nama_debitur']; ?></td>
                        </tr>

                        <tr>
                            <td width="20%">Nama KJPP</td>
                            <td>: <?= $mahasiswa['nama_kjpp']; ?></td>
                        </tr>

                        <tr>
                            <td width="20%">Alamat Jaminan</td>
                            <td>: <?= $mahasiswa['alamat_jaminan']; ?></td>
                        </tr>

                        <tr>
                            <td width="20%">Legalitas</td>
                            <td>: <?= $mahasiswa['legalitas']; ?></td>
                        </tr>

                        <tr>
                            <td width="20%">LT / LB</td>
                            <td>: <?= $mahasiswa['lt']; ?> / <?= $mahasiswa['lb']; ?> m2</td>
                        </tr>

                        <tr>
                            <td width="20%">Nilai Pasar</td>
                            <td>: Rp <?= number_format($mahasiswa['nilai_pasar'], 0, ',', '.'); ?></td>
                        </tr>

                        <tr>
                            <td width="20%">Nilai Likuidasi</td>
                            <td>: Rp <?= number_format($mahasiswa['nilai_likuidasi'], 0, ',', '.'); ?></td>
                        </tr>
                        
                        <tr>
                            <td width="20%">Tanggal Penilaian</td>
                            <td>: <?= date ('d-M-Y', strtotime($mahasiswa['tgl_penilaian']))?></td>
                        </tr>

                        <tr>
                            <td width="20%">No Laporan</td>
                            <td>: <?= $mahasiswa['no_laporan']; ?></td>
                        </tr>

                    </table>

                    <a href="mahasiswa.php" class="btn btn-secondary btn-sm" style="float: right ;">Kembali</a>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<?php include 'layout/footer.php'; ?>
