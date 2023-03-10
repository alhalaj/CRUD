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

$title = 'Tambah Data Lelang';

include 'layout/header.php';

// check apakah tombol ubah ditekan
if (isset($_POST['tambah'])) {
    if (tambah_lelang($_POST) > 0) {
        echo "<script>
                alert('Data Mahasiswa Berhasil Diubah');
                document.location.href = 'lelang.php';
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
                        <ia class="fas fa-plus"></ia> Tambah Lelang
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="mahasiswa.php">Data Lelang</a></li>
                        <li class="breadcrumb-item active">Tambah Data Lelang</li>
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
                    <input type="hidden" name="fotoLama" value="<?= $mahasiswa['foto']; ?>">
                    <input type="hidden" name="fotoLama2" value="<?= $mahasiswa['foto2']; ?>">
                    <input type="hidden" name="fotoLama3" value="<?= $mahasiswa['foto3']; ?>">
                    <input type="hidden" name="fotoLama4" value="<?= $mahasiswa['foto4']; ?>">
                    
                     
                    <div class="row"> 
                        <div class="mb-3 col-6">
                            <label for="nama" class="form-label">Nama Debitur</label>
                            <input type="text" class="form-control" id="nama_debitur" name="nama_debitur" placeholder="Nama Debitur..." required readonly value="<?= $mahasiswa['nama_debitur']; ?>">
                        </div>

                        <div class="mb-3 col-6">
                                <label for="tgl_lelang">Tanggal Pelaksanaan Lelang</label>
                                <input type="date" class="form-control" id="tgl_lelang" name="tgl_lelang" placeholder="Tanggal Pelaksanaan Lelang ... " value="<?= $mahasiswa['tgl_lelang']; ?>">
                        </div>
                    </div>

                    <div class="row">    
                            <div class="mb-3 col-6">
                                <label for="no_permohonan_lelang" class="form-label">Nomor Permohonan Lelang</label>
                                <input type="text" class="form-control" id="no_permohonan_lelang" name="no_permohonan_lelang" placeholder="W06/5/4/ ... " required value="<?= $mahasiswa['no_permohonan_lelang']; ?>">
                            </div>
                            
                            <div class="mb-3 col-6">
                                <label for="tgl_permohonan_lelang">Tanggal Permohonan Lelang</label>
                                <input type="date" class="form-control" id="tgl_permohonan_lelang" name="tgl_permohonan_lelang" placeholder="Tanggal Permohonan ... " required value="<?= $mahasiswa['tgl_permohonan_lelang']; ?>">
                            </div>
                        </div>

                        <div class="row"> 
                            <div class="mb-3 col-6">
                                <label for="limit_lelang">Limit Lelang</label>
                                <input type="number" name="limit_lelang" class="form-control" id="limit_lelang" placeholder="Rp ... " required value="<?= $mahasiswa['limit_lelang']; ?>">
                            </div>
                            
                            <div class="form-group col-6">
                                <label for="nama_bls" class="form-label">Nama BLS</label>
                                <select name="nama_bls" id="nama_bls" class="form-control" required>
                                    <?php $nama_bls     = $mahasiswa['nama_bls']; ?>
                                    <option value='BALAI LELANG TUNJUNGAN'  <?= $nama_bls == 'BALAI LELANG TUNJUNGAN' ? 'selected' : null ?>>BALAI LELANG TUNJUNGAN</option>
                                    <option value='BALAI LELANG SEMPURNA'  <?= $nama_bls == 'BALAI LELANG SEMPURNA' ? 'selected' : null ?>>BALAI LELANG SEMPURNA</option>
                                    <option value='BALAI LELANG STAR'  <?= $nama_bls == 'BALAI LELANG STAR' ? 'selected' : null ?>>BALAI LELANG STAR</option>
                                    <option value='BALAI LELANG ARBINDO'  <?= $nama_bls == 'BALAI LELANG ARBINDO' ? 'selected' : null ?>>BALAI LELANG ARBINDO</option>
                                    <option value='BALAI LELANG BANDUNG'  <?= $nama_bls == 'BALAI LELANG BANDUNG' ? 'selected' : null ?>>BALAI LELANG BANDUNG</option>
                                    <option value='SENTRAL JAVA MULTINDO'  <?= $nama_bls == 'SENTRAL JAVA MULTINDO' ? 'selected' : null ?>>SENTRAL JAVA MULTINDO</option>
                                    <option value='NON BALAI LELANG'  <?= $nama_bls == 'NON BALAI LELANG' ? 'selected' : null ?>>NON BALAI LELANG</option>
                                    <option value='BALAI LELANG LAINNYA'  <?= $nama_bls == 'BALAI LELANG LAINNYA' ? 'selected' : null ?>>BALAI LELANG LAINNYA</option>
                                </select>
                            </div>
                           
                        </div>

                        <div class="row">    
                            <div class="mb-3 col-6">
                                <label for="no_spk_lelang" class="form-label">Nomor SPK Lelang</label>
                                <input type="text" class="form-control" id="no_spk_lelang" name="no_spk_lelang" placeholder="W06/5/4/ ... " required value="<?= $mahasiswa['no_spk_lelang']; ?>">
                            </div>
                            
                            <div class="mb-3 col-6">
                                <label for="tgl_spk_lelang">Tanggal SPK Lelang</label>
                                <input type="date" class="form-control" id="tgl_spk_lelang" name="tgl_spk_lelang" placeholder="Tanggal SPK Lelang ... " required value="<?= $mahasiswa['tgl_spk_lelang']; ?>">
                            </div>
                        </div>

                        <div class="row"> 
                            <div class="mb-3 col-6">
                                <label for="foto" class="form-label"><b>Foto 1</b></label><br>
                                <input type="file" class="form-control" id="foto" name="foto" onchange="previewImg()" accept="image/*">
                                <img src="assets-template/img/<?= $mahasiswa['foto']; ?>" alt="" class="img-thumbnail img-preview mt-2" 
                                width="200px">
                            </div>

                            <div class="mb-3 col-6">
                                <label for="foto2" class="form-label"><b>Foto 2</b></label><br>
                                <input type="file" class="form-control" id="foto2" name="foto2" onchange="previewImg2()" accept="image/*">
                                <img src="assets-template/img/<?= $mahasiswa['foto2']; ?>" alt="" class="img-thumbnail img-preview mt-2" 
                                width="200px">
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


<!-- preview image -->
<script>
    function previewImg() {
        const gambar = document.querySelector('#foto');
        const imgPreview = document.querySelector('.img-preview');

        gambarLabel.textContent = gambar.files[0].name;

        const fileGambar = new FileReader();
        fileGambar.readAsDataURL(gambar.files[0]);

        fileGambar.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }

    function previewImg2() {
        const gambar = document.querySelector('#foto2');
        const imgPreview = document.querySelector('.img-preview');

        gambarLabel.textContent = gambar.files[0].name;

        const fileGambar = new FileReader();
        fileGambar.readAsDataURL(gambar.files[0]);

        fileGambar.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }

</script>

<?php include 'layout/footer.php'; ?>
