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

$title = 'Tambah Debitur';

include 'layout/header.php';

// check apakah tombol tambah ditekan
if (isset($_POST['tambah'])) {
    
    if (create_debitur($_POST) > 0) {
        echo "<script>
                alert('Data Debitur Berhasil Ditambahkan');
                document.location.href = 'debitur.php';
              </script>";
    } else {
        echo "<script>
                alert('Data Debitur Gagal Ditambahkan');
                document.location.href = 'debitur.php';
              </script>";
    }
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        <ia class="fas fa-plus"></ia> Tambah Debitur
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Data Debitur</a></li>
                        <li class="breadcrumb-item active">Tambah Debitur</li>
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
                        <div class="row">    
                            <div class="mb-3 col-6">
                                <label for="no_rekening" class="form-label">No Rekening</label>
                                <input type="text" class="form-control" id="no_rekening" name="no_rekening" placeholder="No Rekening Pinjaman ... " required>
                            </div>
                            
                            <div class="mb-3 col-6">
                                <label for="nama_debitur">Nama Debitur</label>
                                <input type="text" class="form-control" id="nama_debitur" name="nama_debitur" placeholder="Nama Debitur ... " required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="nama_kjpp" class="form-label">Nama KJPP</label>
                                <select name="nama_kjpp" id="nama_kjpp" class="form-control" required>
                                    <option value="">-- Pilih KJPP --</option>
                                    <option value='KJPP AYON SUHERMAN & REKAN'>KJPP AYON SUHERMAN & REKAN</option>
                                    <option value='KJPP FUADAH RUDI & REKAN'>KJPP FUADAH RUDI & REKAN</option>
                                    <option value='KJPP IWAN BACHRON & REKAN'>KJPP IWAN BACHRON & REKAN</option>
                                    <option value='KJPP KARMANTO & REKAN'>KJPP KARMANTO & REKAN</option>
                                    <option value='KJPP SUGIANTO PRASODJO & REKAN'>KJPP SUGIANTO PRASODJO & REKAN</option>
                                    <option value='KJPP SUGENG, IRWAN, GUNAWAN & REKAN'>KJPP SUGENG, IRWAN, GUNAWAN & REKAN</option>
                                    <option value='KJPP LAINNYA'>KJPP LAINNYA</option>
                                </select>
                            </div>

                            <div class="mb-3 col-2">
                                <label for="lt">LT (m2)</label>
                                <input type="text" name="lt" class="form-control" id="lt" placeholder="LT ..." required>
                            </div>

                            <div class="mb-3 col-2">
                                <label for="lb">LB (m2)</label>
                                <input type="text" name="lb" class="form-control" id="lb" placeholder="LB ... " required>
                            </div>

                           <div class="form-group mb-3 col-2">
                                <label for="legalitas" class="form-label">Jenis Sertipikat</label>
                                <select name="legalitas" id="legalitas" class="form-control" required>
                                    <option value="">-- Pilih Sertipikat --</option>
                                    <option value='SHM'>SHM</option>
                                    <option value='SHGB'>SHGB</option>
                                    <option value='SHMRS'>SHMRS</option>
                                    <option value='SHP'>SHP</option>
                                    <option value='SHGU'>SHGU</option>
                                    <option value='LAINNYA'>LAINNYA</option>
                                </select>
                            </div>

                        </div>

                        <div class="mb-3">
                            <label for="alamat_jaminan">Alamat Jaminan</label>
                            <textarea type="text" name="alamat_jaminan" class="form-control" id="alamat_jaminan" placeholder="Alamat Jaminan ... "></textarea>
                        </div>

                        <div class="row">    
                            <div class="mb-3 col-6">
                                <label for="no_laporan" class="form-label">Nomor Laporan</label>
                                <input type="text" class="form-control" id="no_laporan" name="no_laporan" placeholder="No Laporan Penilaian ... " required>
                            </div>
                            
                            <div class="mb-3 col-6">
                                <label for="tgl_penialain">Tanggal Penilaian</label>
                                <input type="date" class="form-control" id="tgl_penilaian" name="tgl_penilaian" placeholder="Tanggal Penilaian ... " required>
                            </div>
                        </div>

                        <div class="row"> 
                            <div class="mb-3 col-6">
                                <label for="nilai_pasar">Nilai Pasar</label>
                                <input type="number" name="nilai_pasar" class="form-control" id="nilai_pasar" placeholder="Nilai Pasar ... " required>
                            </div>
                            
                            <div class="mb-3 col-6">
                                <label for="nilai_likuidasi">Nilai Likuidasi</label>
                                <input type="number" name="nilai_likuidasi" class="form-control" id="nilai_likuidasi" placeholder="Nilai Likuidasi ... " required>
                            </div>
                           
                        </div>

                        <button type="submit" name="tambah" class="btn btn-primary" style="float: right;">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<?php include 'layout/footer.php'; ?>
