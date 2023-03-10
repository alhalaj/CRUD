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

// check apakah tombol tambah ditekan
if (isset($_POST['tambah'])) {
    if (tambah_lelang($_POST) > 0) {
        echo "<script>
                alert('Data Lelang Berhasil Ditambahkan');
                document.location.href = 'mahasiswa.php';
              </script>";
    } else {
        echo "<script>
                alert('Data Lelang Gagal Ditambahkan');
                document.location.href = 'mahasiswa.php';
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
                    <div class="row">    
                            <div class="mb-3 col-6">
                                <label for="no_permohonan_lelang" class="form-label">Nomor Permohonan Lelang</label>
                                <input type="text" class="form-control" id="no_permohonan_lelang" name="no_permohonan_lelang" placeholder="W06/5/4/ ... " required>
                            </div>
                            
                            <div class="mb-3 col-6">
                                <label for="tgl_permohonan_lelang">Tanggal Permohonan Lelang</label>
                                <input type="date" class="form-control" id="tgl_permohonan_lelang" name="tgl_permohonan_lelang" placeholder="Tanggal Permohonan ... " required>
                            </div>
                        </div>

                        <div class="row"> 
                            <div class="mb-3 col-6">
                                <label for="limit_lelang">Limit Lelang</label>
                                <input type="number" name="limit_lelang" class="form-control" id="limit_lelang" placeholder="Rp ... " required>
                            </div>
                            
                            <div class="form-group col-6">
                                <label for="nama_kjpp" class="form-label">Nama BLS</label>
                                <select name="nama_kjpp" id="nama_kjpp" class="form-control" required>
                                    <option value="">-- Pilih Balai Lelang --</option>
                                    <option value='Balai Lelang Tunjungan'>Balai Lelang Tunjungan</option>
                                    <option value='Balai Lelang Sempurna'>Balai Lelang Sempurna</option>
                                    <option value='Balai Lelang Star'>Balai Lelang Star</option>
                                    <option value='Balai Lelang Arbindo'>Balai Lelang Arbindo</option>
                                    <option value='Balai Lelang Duta'>Balai Lelang Duta</option>
                                    <option value='Balai Lelang Bandung'>Balai Lelang Bandung</option>
                                    <option value='Sentral Java Multindo'>Sentral Java Multindo</option>
                                    <option value='Bali Auction House'>Bali Auction House</option>
                                    <option value='Non Balai Lelang'>Non Balai Lelang</option>
                                    <option value='Lainnya'>Lainnya</option>
                                </select>
                            </div>
                           
                        </div>

                        <div class="row">    
                            <div class="mb-3 col-6">
                                <label for="no_spk_lelang" class="form-label">Nomor SPK Lelang</label>
                                <input type="text" class="form-control" id="no_spk_lelang" name="no_spk_lelang" placeholder="W06/5/4/ ... " required>
                            </div>
                            
                            <div class="mb-3 col-6">
                                <label for="tgl_spk_lelang">Tanggal SPK Lelang</label>
                                <input type="date" class="form-control" id="tgl_spk_lelang" name="tgl_spk_lelang" placeholder="Tanggal SPK Lelang ... " required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="foto"><b>Foto ke-1</b></label><br>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="foto" name="foto" onchange="previewImg()" required>
                                <label class="custom-file-label" for="foto">Pilih gambar...</label>
                            </div>
                            <div class="mt-1">
                                <img src="" alt="" class="rounded img-preview" width="200px">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="foto2"><b>Foto ke-2</b></label><br>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="foto2" name="foto2" onchange="previewImg2()" required>
                                <label class="custom-file-label" for="foto2">Pilih gambar...</label>
                            </div>

                            <div class="mt-1">
                                <img src="" alt="" class="rounded img-preview2" width="200px">
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

<!-- preview image 1 -->
<script>
    function previewImg() {
        const gambar = document.querySelector('#foto');
        const gambarLabel = document.querySelector('.custom-file-label');
        const imgPreview = document.querySelector('.img-preview');

        gambarLabel.textContent = gambar.files[0].name;

        const fileGambar = new FileReader();
        fileGambar.readAsDataURL(gambar.files[0]);

        fileGambar.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>

<!-- preview image 2 -->
<script>
    function previewImg2() {
        const gambar2 = document.querySelector('#foto2');
        const gambarLabel2 = document.querySelector('.custom-file-label');
        const imgPreview2 = document.querySelector('.img-preview2');

        gambarLabel2.textContent = gambar2.files[0].name;

        const fileGambar2 = new FileReader();
        fileGambar2.readAsDataURL(gambar2.files[0]);

        fileGambar2.onload = function(e) {
            imgPreview2.src = e.target.result;
        }
    }
</script>

<?php include 'layout/footer.php'; ?>
