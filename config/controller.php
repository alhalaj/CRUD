<?php

// fungsi menampilkan
function select($query)
{
    // panggil koneksi database
    global $db;

    $result = mysqli_query($db, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}


// fungsi menambah data debitur
function create_debitur($post)
{
    global $db;

    $no_rekening       = strip_tags($post['no_rekening']);
    $nama              = strip_tags($post['nama_debitur']);
    $nama_kjpp         = strip_tags($post['nama_kjpp']);
    $alamat            = $post['alamat_jaminan'];
    $lt                = strip_tags($post['lt']);
    $lb                = strip_tags($post['lb']);
    $legalitas         = strip_tags($post['legalitas']);
    $no_laporan        = strip_tags($post['no_laporan']);
    $tgl_penilaian     = strip_tags($post['tgl_penilaian']);
    $nilai_pasar       = strip_tags($post['nilai_pasar']);
    $nilai_likuidasi   = strip_tags($post['nilai_likuidasi']);
    
   
    // query tambah data
    $query = "INSERT INTO debitur (id_debitur,no_rekening,nama_debitur,nama_kjpp,alamat_jaminan,lt,lb,legalitas,no_laporan,tgl_penilaian,nilai_pasar,nilai_likuidasi,tgl_input) VALUES
                                    ('', '$no_rekening', '$nama', '$nama_kjpp', '$alamat', '$lt', '$lb','$legalitas', '$no_laporan' , '$tgl_penilaian', '$nilai_pasar', '$nilai_likuidasi', CURRENT_TIMESTAMP())";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi mengubah data mahasiswa
function update_mahasiswa($post)
{
    global $db;

    $id_mahasiswa = strip_tags($post['id_debitur']);
    $nama              = strip_tags($post['nama_debitur']);
    $nama_kjpp         = strip_tags($post['nama_kjpp']);
    $alamat            = $post['alamat_jaminan'];
    $lt                = strip_tags($post['lt']);
    $lb                = strip_tags($post['lb']);
    $legalitas         = strip_tags($post['legalitas']);
    $no_laporan        = strip_tags($post['no_laporan']);
    $tgl_penilaian     = strip_tags($post['tgl_penilaian']);
    $nilai_pasar       = strip_tags($post['nilai_pasar']);
    $nilai_likuidasi   = strip_tags($post['nilai_likuidasi']);

    // query ubah data
    $query = "UPDATE debitur SET nama_debitur = '$nama', nama_kjpp = '$nama_kjpp', alamat_jaminan = '$alamat', lt = '$lt', lb = '$lb', legalitas = '$legalitas', no_laporan = '$no_laporan', tgl_penilaian = '$tgl_penilaian', nilai_pasar = '$nilai_pasar', nilai_likuidasi = '$nilai_likuidasi' WHERE id_debitur = $id_mahasiswa";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi input/update data lelang
function tambah_lelang($post)
{
    global $db;

    $id_mahasiswa           = strip_tags($post['id_debitur']);
    $no_permohonan_lelang   = strip_tags($post['no_permohonan_lelang']);
    $tgl_permohonan_lelang  = strip_tags($post['tgl_permohonan_lelang']);
    $no_spk_lelang          = strip_tags($post['no_spk_lelang']);
    $tgl_spk_lelang         = strip_tags($post['tgl_spk_lelang']);
    $limit_lelang           = strip_tags($post['limit_lelang']);
    $nama_bls               = strip_tags($post['nama_bls']);
    $tgl_lelang             = strip_tags($post['tgl_lelang']);
    $fotoLama               = strip_tags($post['fotoLama']);
    $fotoLama2               = strip_tags($post['fotoLama2']);
    $fotoLama3               = strip_tags($post['fotoLama3']);
    $fotoLama4               = strip_tags($post['fotoLama4']);

    // check upload foto baru atau tidak
    if ($_FILES['foto']['error'] == 4) {
        $foto = $fotoLama;
    } else {
        $foto = upload_file();
    }

    if ($_FILES['foto2']['error'] == 4) {
        $foto2 = $fotoLama2;
    } else {
        $foto2 = upload_file2();

    }

    if ($_FILES['foto3']['error'] == 4) {
        $foto3 = $fotoLama3;
    } else {
        $foto3 = upload_file3();
    }

    if ($_FILES['foto4']['error'] == 4) {
        $foto4 = $fotoLama4;
    } else {
        $foto4 = upload_file4();

    }
    
   
    // query ubah data
    $query = "UPDATE debitur SET no_permohonan_lelang = '$no_permohonan_lelang', tgl_permohonan_lelang = '$tgl_permohonan_lelang',
    no_spk_lelang = '$no_spk_lelang', tgl_spk_lelang = '$tgl_spk_lelang' , limit_lelang = '$limit_lelang', nama_bls = '$nama_bls',
    foto = '$foto', foto2 = '$foto2', foto3 = '$foto3', foto4 = '$foto4', tgl_lelang = '$tgl_lelang' WHERE id_debitur = $id_mahasiswa";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi mengupload foto agunan
function upload_file()
{
    $namaFile   = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error      = $_FILES['foto']['error'];
    $tmpName    = $_FILES['foto']['tmp_name'];

    // check file yang diupload
    $extensifileValid = ['jpg', 'jpeg', 'png'];
    $extensifile      = explode('.', $namaFile);
    $extensifile      = strtolower(end($extensifile));

    // check format/extensi file
    if (!in_array($extensifile, $extensifileValid)) {
        // pesan gagal
        echo "<script>
                alert('Format File Tidak Valid');
                document.location.href = 'tambah-pendaftaran-lelang.php';
              </script>";
        die();
    }

    // check ukuran file 2 MB
    if ($ukuranFile > 2048000) {
        // pesan gagal
        echo "<script>
                alert('Ukuran File Max 2 MB');
                document.location.href = 'tambah-pendaftaran-lelang.php';
              </script>";
        die();
    }

    // generate nama file baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $extensifile;

    // pindahkan ke folder local
    move_uploaded_file($tmpName, 'assets-template/img/' . $namaFileBaru);
    return $namaFileBaru;
}

// fungsi mengupload foto agunan 2
function upload_file2()
{
    $namaFile   = $_FILES['foto2']['name'];
    $ukuranFile = $_FILES['foto2']['size'];
    $error      = $_FILES['foto2']['error'];
    $tmpName    = $_FILES['foto2']['tmp_name'];

    // check file yang diupload
    $extensifileValid = ['jpg', 'jpeg', 'png'];
    $extensifile      = explode('.', $namaFile);
    $extensifile      = strtolower(end($extensifile));

    // check format/extensi file
    if (!in_array($extensifile, $extensifileValid)) {
        // pesan gagal
        echo "<script>
                alert('Format File Tidak Valid');
                document.location.href = 'tambah-mahasiswa.php';
              </script>";
        die();
    }

    // check ukuran file 2 MB
    if ($ukuranFile > 2048000) {
        // pesan gagal
        echo "<script>
                alert('Ukuran File Max 2 MB');
                document.location.href = 'tambah-mahasiswa.php';
              </script>";
        die();
    }
}

    // fungsi mengupload foto agunan 3
function upload_file3()
{
    $namaFile   = $_FILES['foto3']['name'];
    $ukuranFile = $_FILES['foto3']['size'];
    $error      = $_FILES['foto3']['error'];
    $tmpName    = $_FILES['foto3']['tmp_name'];

    // check file yang diupload
    $extensifileValid = ['jpg', 'jpeg', 'png'];
    $extensifile      = explode('.', $namaFile);
    $extensifile      = strtolower(end($extensifile));

    // check format/extensi file
    if (!in_array($extensifile, $extensifileValid)) {
        // pesan gagal
        echo "<script>
                alert('Format File Tidak Valid');
                document.location.href = 'tambah-mahasiswa.php';
              </script>";
        die();
    }

    // check ukuran file 2 MB
    if ($ukuranFile > 2048000) {
        // pesan gagal
        echo "<script>
                alert('Ukuran File Max 2 MB');
                document.location.href = 'tambah-mahasiswa.php';
              </script>";
        die();
    }

    // generate nama file baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $extensifile;

    // pindahkan ke folder local
    move_uploaded_file($tmpName, 'assets-template/img/' . $namaFileBaru);
    return $namaFileBaru;
}

// fungsi mengupload foto agunan 4
function upload_file4()
{
    $namaFile   = $_FILES['foto4']['name'];
    $ukuranFile = $_FILES['foto4']['size'];
    $error      = $_FILES['foto4']['error'];
    $tmpName    = $_FILES['foto4']['tmp_name'];

    // check file yang diupload
    $extensifileValid = ['jpg', 'jpeg', 'png'];
    $extensifile      = explode('.', $namaFile);
    $extensifile      = strtolower(end($extensifile));

    // check format/extensi file
    if (!in_array($extensifile, $extensifileValid)) {
        // pesan gagal
        echo "<script>
                alert('Format File Tidak Valid');
                document.location.href = 'tambah-mahasiswa.php';
              </script>";
        die();
    }

    // check ukuran file 2 MB
    if ($ukuranFile > 2048000) {
        // pesan gagal
        echo "<script>
                alert('Ukuran File Max 2 MB');
                document.location.href = 'tambah-mahasiswa.php';
              </script>";
        die();
    }
}

//fungsi input/update risalah lelang
function tambah_hasil_lelang($post)
{
    global $db;

    $id_mahasiswa           = strip_tags($post['id_debitur']);
    $hasil_lelang           = strip_tags($post['hasil_lelang']);
    $no_risalah_lelang      = strip_tags($post['no_risalah_lelang']);
    $file_risalah_lelang    = strip_tags($post['file_risalah_lelang']);
    $note                   = strip_tags($post['note']);
    $file_risalah_lelang_lama = strip_tags($post['file_risalah_lelang_lama']);
   
    // check upload foto baru atau tidak
    if ($_FILES['file_risalah_lelang']['error'] == 4) {
        $file_risalah_lelang = $file_risalah_lelang_lama;
    } else {
        $file_risalah_lelang = upload_risalah();
    }

     // query ubah data
     $query = "UPDATE debitur SET hasil_lelang = '$hasil_lelang', no_risalah_lelang = '$no_risalah_lelang', file_risalah_lelang = '$file_risalah_lelang',
     note = '$note'  WHERE id_debitur = $id_mahasiswa";
 
     mysqli_query($db, $query);
 
     return mysqli_affected_rows($db);

}

// fungsi mengupload risalah lelang
function upload_risalah()
{
    $namaFile   = $_FILES['file_risalah_lelang']['name'];
    $ukuranFile = $_FILES['file_risalah_lelang']['size'];
    $error      = $_FILES['file_risalah_lelang']['error'];
    $tmpName    = $_FILES['file_risalah_lelang']['tmp_name'];

    // check file yang diupload
    $extensifileValid = ['pdf'];
    $extensifile      = explode('.', $namaFile);
    $extensifile      = strtolower(end($extensifile));

    // check format/extensi file
    if (!in_array($extensifile, $extensifileValid)) {
        // pesan gagal
        echo "<script>
                alert('Format File Tidak Valid');
                document.location.href = 'tambah-hasil-lelang.php';
              </script>";
        die();
    }

    // check ukuran file 5 MB
    if ($ukuranFile > 5048000) {
        // pesan gagal
        echo "<script>
                alert('Ukuran File Max 3 MB');
                document.location.href = 'tambah-hasil-lelang.php';
              </script>";
        die();
    }

    // generate nama file baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $extensifile;

    // pindahkan ke folder local
    move_uploaded_file($tmpName, 'assets-template/risalah-lelang/' . $namaFileBaru);
    return $namaFileBaru;
}

// fungsi menghapus data debitur
function delete_mahasiswa($id_mahasiswa)
{
    global $db;

    // ambil foto sesuai data yang dipilih
    $foto = select("SELECT * FROM debitur WHERE id_debitur = $id_mahasiswa")[0];
    unlink("assets-template/img/". $foto['foto']);

    // query hapus data mahasiswa
    $query = "DELETE FROM debitur WHERE id_debitur = $id_mahasiswa";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi tambah akun
function create_akun($post)
{
    global $db;

    $nama       = strip_tags($post['nama']);
    $username   = strip_tags($post['username']);
    $email      = strip_tags($post['email']);
    $password   = strip_tags($post['password']);
    $level      = strip_tags($post['level']);

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // query tambah data
    $query = "INSERT INTO akun VALUES(null, '$nama', '$username', '$email', '$password', '$level')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi ubah akun
function update_akun($post)
{
    global $db;

    $id_akun    = strip_tags($post['id_akun']);
    $nama       = strip_tags($post['nama']);
    $username   = strip_tags($post['username']);
    $email      = strip_tags($post['email']);
    $password   = strip_tags($post['password']);
    $level      = strip_tags($post['level']);

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // query ubah data
    $query = "UPDATE akun SET nama = '$nama', username = '$username', email = '$email', password = '$password', level = '$level' WHERE id_akun = $id_akun";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi menghapus data akun
function delete_akun($id_akun)
{
    global $db;

    // query hapus data akun
    $query = "DELETE FROM akun WHERE id_akun = $id_akun";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function select1($post)
{
    // panggil koneksi database
    global $db;
    
    // $tgl_awal    = strip_tags($post['tgl_awal']);
    // $tgl_akhir   = strip_tags($post['tgl_akhir']);
    
    $tgl_awal  = $_POST['tgl_awal'];
    $tgl_akhir  = $_POST['tgl_akhir'];
    
    
    $query = "SELECT * FROM debitur where (tgl_penilaian BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') ORDER BY id_debitur DESC";
    
    $result = mysqli_query($db, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    
    return $rows;
}
