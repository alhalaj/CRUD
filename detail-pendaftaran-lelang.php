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
                <div class="col-sm-10">
                    <h1 class="m-0">
                        <ia class="fas fa-user"></ia> Detail Pendaftaran Lelang Debitur : <?= $mahasiswa['nama_debitur']; ?>
                    </h1>
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
                            <td width="20%">Nama BLS</td>
                            <td>: <?= $mahasiswa['nama_bls']; ?></td>
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
                            <td width="20%">Limit Lelang</td>
                            <td>: Rp <?= number_format($mahasiswa['limit_lelang'], 0, ',', '.'); ?></td>
                        </tr>

                        <?php if (strtotime($mahasiswa['tgl_lelang'])>0){
                                        $tgl_lelang = date('d-M-Y', strtotime($mahasiswa['tgl_lelang']));
                                    }  else{
                                        $tgl_lelang= "Menununggu Tanggal Penetapan";
                                    }?>
                               
                        <tr>
                            <td width="20%">Tanggal Lelang</td>
                            <td>: <?= $tgl_lelang ?></td>
                        </tr>

                        <tr>
                            <td width="20%">Foto Agunan</td>
                            <td>
                                <a href="assets-template/img/<?= $mahasiswa['foto']; ?>">
                                    <img src="assets-template/img/<?= $mahasiswa['foto']; ?>" alt="foto" width="200px">
                                </a>
                                <a href="assets-template/img/<?= $mahasiswa['foto2']; ?>">
                                    <img src="assets-template/img/<?= $mahasiswa['foto2']; ?>" alt="foto2" width="200px">
                                </a>
                                
                                
                            </td>
                        </tr>

                        

                    </table>

                    <a href="lelang.php" class="btn btn-secondary btn-sm" style="float: right ;">Kembali</a>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<?php include 'layout/footer.php'; ?>
