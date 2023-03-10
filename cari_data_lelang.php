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

// membatasi halaman sesuai user login
if ($_SESSION["level"] != 1 and $_SESSION["level"] != 3) {
    echo "<script>
            alert('Perhatian anda tidak punya hak akses');
            document.location.href = 'akun.php';
          </script>";
    exit;
}

$title = 'Daftar Mahasiswa';

include 'layout/header.php';

// menampilkan data mahasiswa
$data_mahasiswa = select("SELECT * FROM debitur ORDER BY id_debitur DESC");

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-users"></i> Data Debitur</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Data Debitur</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Main content -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tabel Data Mahasiswa</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <a href="tambah-mahasiswa.php" class="btn btn-primary btn-sm mb-2"><i class="fas fa-plus"></i> Tambah</a>

                    <table id="example2" class="table table-bordered table-hover" >
                        <thead>
                            <tr>
                                <th valign="middle"\>No</th>
                                <th>No Rekening</th>
                                <th>Nama Debitur</th>
                                <th>No Permohonan Lelang</th>
                                <th>Tgl Permohonan Lelang</th>
                                <th>Nama BLS</th>
                                <th>Limit Lelang</th>
                                <th>Tanggal Lelang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($data_mahasiswa as $mahasiswa) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $mahasiswa['no_rekening']; ?></td>
                                    <td><?= $mahasiswa['nama_debitur']; ?></td>
                                    <td><?= $mahasiswa['no_permohonan_lelang']; ?></td>
                                    <td><?= $mahasiswa['tgl_permohonan_lelang']; ?></td>
                                    <td><?= $mahasiswa['nama_bls']; ?></td>
                                    <td><?= $mahasiswa['limit_lelang']; ?></td>
                                    <td><?= $mahasiswa['tgl_lelang']; ?></td>
                                    <td class="text-center" width="25%">
                                        <a href="detail-mahasiswa.php?id_debitur=<?= $mahasiswa['id_debitur']; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i> Detail</a>

                                        <a href="ubah-mahasiswa.php?id_debitur=<?= $mahasiswa['id_debitur']; ?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Ubah</a>

                                        <a href="hapus-mahasiswa.php?id_debitur=<?= $mahasiswa['id_debitur']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Data Mahasiswa Akan Dihapus.?');"><i class="fas fa-trash-alt"></i> Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?php include 'layout/footer.php'; ?>
