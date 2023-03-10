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

$title = 'Ubah Mahasiswa';

include 'layout/header.php';

// check apakah tombol ubah ditekan
if (isset($_POST['ubah'])) {
    if (update_mahasiswa($_POST) > 0) {
        echo "<script>
                alert('Data Mahasiswa Berhasil Diubah');
                document.location.href = 'mahasiswa.php';
              </script>";
    } else {
        echo "<script>
                alert('Data Mahasiswa Gagal Diubah');
                document.location.href = 'mahasiswa.php';
              </script>";
    }
}

// ambil id mahasiswa dari url
$id_mahasiswa = (int)$_GET['id_debitur'];

// query ambil data mahasiswa
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
                        <ia class="fas fa-edit"></ia> Ubah Debitur
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="mahasiswa.php">Data Debitur</a></li>
                        <li class="breadcrumb-item active">Ubah Debitur</li>
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
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_debitur" value="<?= $mahasiswa['id_debitur']; ?>">
                        
                        <div class="form-group">
                            <label for="nama" class="form-label">Nama Debitur</label>
                            <input type="text" class="form-control" id="nama_debitur" name="nama_debitur" placeholder="Nama Debitur..." required value="<?= $mahasiswa['nama_debitur']; ?>">
                        </div>

                        <div class="row">
                        <div class="form-group col-6">
                                <label for="nama_kjpp" class="form-label">Nama KJPP</label>
                                <select name="nama_kjpp" id="nama_kjpp" class="form-control" required>
                                    <?php $nama_kjpp     = $mahasiswa['nama_kjpp']; ?>
                                    <option value="KJPP AYON SUHERMAN & REKAN" <?= $nama_kjpp == 'KJPP AYON SUHERMAN & REKAN' ? 'selected' : null ?>>KJPP AYON SUHERMAN & REKAN</option>
                                    <option value="KJPP FUADAH RUDI & REKAN" <?= $nama_kjpp == 'KJPP FUADAH RUDI & REKAN' ? 'selected' : null ?>>KJPP FUADAH RUDI & REKAN</option>
                                    <option value="KJPP IWAN BACHRON & REKAN" <?= $nama_kjpp == 'KJPP IWAN BACHRON & REKAN' ? 'selected' : null ?>>KJPP IWAN BACHRON & REKAN</option>
                                    <option value="KJPP KARMANTO & REKAN" <?= $nama_kjpp == 'KJPP KARMANTO & REKAN' ? 'selected' : null ?>>KJPP KARMANTO & REKAN</option>
                                    <option value="KJPP SUGENG, IRWAN, GUNAWAN & REKAN" <?= $nama_kjpp == 'KJPP SUGENG, IRWAN, GUNAWAN & REKAN' ? 'selected' : null ?>>KJPP SUGENG, IRWAN, GUNAWAN & REKAN</option><option value="KJPP Ayon & Rekan" <?= $nama_kjpp == 'KJPP Ayon & Rekan' ? 'selected' : null ?>>KJPP Ayon & Rekan</option>
                                    <option value="KJPP SUGIANTO PRASODJO & REKAN" <?= $nama_kjpp == 'KJPP SUGIANTO PRASODJO & REKAN' ? 'selected' : null ?>>KJPP SUGIANTO PRASODJO & REKAN</option><option value="KJPP Ayon & Rekan" <?= $nama_kjpp == 'KJPP Ayon & Rekan' ? 'selected' : null ?>>KJPP Ayon & Rekan</option>
                                    <option value="KJPP LAINNYA" <?= $nama_kjpp == 'KJPP LAINNYA' ? 'selected' : null ?>>KJPP LAINNYA</option>
                                </select>
                            </div>

                            <div class="mb-3 col-2">
                                <label for="lt">LT (m2)</label>
                                <input type="text" name="lt" class="form-control" id="lt" placeholder="LT ..." required value="<?= $mahasiswa['lt']; ?>">
                            </div>

                            <div class="mb-3 col-2">
                                <label for="lb">LB (m2)</label>
                                <input type="text" name="lb" class="form-control" id="lb" placeholder="LB ... " required value="<?= $mahasiswa['lb']; ?>">
                            </div>

                            <div class="mb-3 col-2">
                                <label for="legalitas">Legalitas</label>
                                <input type="text" name="legalitas" class="form-control" id="legalitas" placeholder=" SHM / SHGB / SHMRS ... "   value="<?= $mahasiswa['legalitas']; ?>">
                            </div>

                            



                        </div>

                        <div class="mb-3">
                            <label for="alamat_jaminan">Alamat Jaminan</label>
                            <input type="text" name="alamat_jaminan" class="form-control" id="alamat_jaminan" placeholder="Alamat Jaminan ... "required value="<?= $mahasiswa['alamat_jaminan']; ?>">
                        </div>

                        <div class="row">    
                            <div class="mb-3 col-6">
                                <label for="no_laporan" class="form-label">Nomor Laporan</label>
                                <input type="text" class="form-control" id="no_laporan" name="no_laporan" placeholder="No Laporan Penilaian ... " required value="<?= $mahasiswa['no_laporan']; ?>">
                            </div>
                            
                            <div class="mb-3 col-6">
                                <label for="tgl_penialain">Tanggal Penilaian</label>
                                <input type="date" class="form-control" id="tgl_penilaian" name="tgl_penilaian" placeholder="Tanggal Penilaian ... " required value="<?= $mahasiswa['tgl_penilaian']; ?>">
                            </div>
                        </div>

                        <div class="row"> 
                            <div class="mb-3 col-6">
                                <label for="nilai_pasar">Nilai Pasar</label>
                                <input type="number" name="nilai_pasar" class="form-control" id="nilai_pasar" placeholder="Nilai Pasar ... " required value="<?= $mahasiswa['nilai_pasar']; ?>">
                            </div>
                            
                            <div class="mb-3 col-6">
                                <label for="nilai_likuidasi">Nilai Likuidasi</label>
                                <input type="number" name="nilai_likuidasi" class="form-control" id="nilai_likuidasi" placeholder="Nilai Likuidasi ... " required value="<?= $mahasiswa['nilai_likuidasi']; ?>">
                            </div>
                           
                        </div>
                        
                        
                        <button type="submit" name="ubah" class="btn btn-primary" style="float: right;">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<?php include 'layout/footer.php'; ?>
