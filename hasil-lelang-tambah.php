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

$title = 'Tambah Hasil Lelang';

include 'layout/header.php';

// check apakah tombol ubah ditekan
if (isset($_POST['ubah'])) {
    if (tambah_hasil_lelang($_POST) > 0) {
        echo "<script>
                alert('Data Hasil Lelang Berhasil Ditambahkan');
                document.location.href = 'lelang.php';
              </script>";
    } else {
        echo "<script>
                alert('Data Hasil Lelang Gagal Ditambahkan');
                document.location.href = 'lelang.php';
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
                        <ia class="fas fa-edit"></ia> Tambah Hasil Lelang Debitur
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="mahasiswa.php">Data Debitur</a></li>
                        <li class="breadcrumb-item active">Tambah Hasil Lelang Debitur</li>
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
                        <input type="hidden" name="file_risalah_lelang_lama" value="<?= $mahasiswa['file_risalah_lelang']; ?>">

                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="no_rekening" class="form-label">No Rekening</label>
                                <input type="text" class="form-control" id="no_rekening" name="no_rekening" placeholder="<?= $mahasiswa['no_rekening']; ?>" disabled readonly>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="nama" class="form-label">Nama Debitur</label>
                                <input type="text" class="form-control" id="nama_debitur" name="nama_debitur" placeholder="<?= $mahasiswa['nama_debitur']; ?>" disabled readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-4">
                                <label for="hasil_lelang" class="form-label">Hasil Pelaksanaan Lelang</label>
                                <select name="hasil_lelang" id="hasil_lelang" class="form-control" required>
                                    <?php $hasil_lelang     = $mahasiswa['hasil_lelang']; ?>
                                    <option value="Tidak Ada Penawaran (TAP)" <?= $hasil_lelang == 'Tidak Ada Penawaran (TAP)' ? 'selected' : null ?>>Tidak Ada Penawaran (TAP)</option>
                                    <option value="Batal Lelang" <?= $hasil_lelang == 'Batal Lelang' ? 'selected' : null ?>>Batal Lelang</option>
                                    <option value="Laku Lelang" <?= $hasil_lelang == 'Laku Lelang' ? 'selected' : null ?>>Laku Lelang</option>
                                   </select>
                            </div>

                            <div class="mb-3 col-4">
                                <label for="no_risalah_lelang">No Risalah Lelang</label>
                                <input type="text" name="no_risalah_lelang" class="form-control" id="no_risalah_lelang" placeholder="No. Risalah Lelang" value="<?= $mahasiswa['no_risalah_lelang']; ?>">
                            </div>

                            <div class="mb-3 col-4">
                                <label for="file_risalah_lelang" class="form-label"><b>Upload Risalah Lelang</b></label><br>
                                <input type="file" class="form-control" id="file_risalah_lelang" name="file_risalah_lelang" value="<?= $mahasiswa['file_risalah_lelang']; ?>" >
                           </div>
                            
                        </div>

                            <div class="mb-3">
                                <label for="note">Note Batal Lelang / Laku Lelang</label>
                                <input type="text" name="note" class="form-control" id="note" placeholder="Diisi Alasan Apabila Laku / Batal Lelang Contoh:  Laku Lelang Dengan Harga Rp ..... Atau SKPT Tidak Terbit Pada Saat Pelaksanaan Lelang" value="<?= $mahasiswa['note']; ?>" >
                            </div>

                        
                            <button type="submit" name="ubah" class="btn btn-primary" style="float: right;"> Tambah</button>
                            
                        </form>

                           
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>


<?php include 'layout/footer.php'; ?>
