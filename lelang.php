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

$title = 'Daftar Lelang';

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
                    <h1 class="m-0"><i class="fas fa-users"></i> Data Pendaftaran Lelang</h1>
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
                    <h3 class="card-title"> <i>Note : Input Berdasarkan Tanggal Penilaian Terbaru </i> </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover" >
                        <thead>
                            <tr>
                                <th valign="middle"\>No</th>
                                <th>No Rekg</th>
                                <th>Nama</th>
                                <th>Tgl Penilaian</th>
                                <th>No Permohonan</th>
                                <th>Tgl Permohonan</th>
                                <th>Nama BLS</th>
                                <th>Limit Lelang</th>
                                <th>Tanggal Lelang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($data_mahasiswa as $mahasiswa) : ?>
                               
                                    <?php if (strtotime($mahasiswa['tgl_lelang'])>0){
                                        $tgl_lelang = date('d-M-Y', strtotime($mahasiswa['tgl_lelang']));
                                    }  else{
                                        $tgl_lelang= "-";
                                    }?>

                                    <?php if (strtotime($mahasiswa['tgl_permohonan_lelang'])>0){
                                        $tgl_permohonan_lelang = date('d-M-Y', strtotime($mahasiswa['tgl_permohonan_lelang']));
                                    }  else{
                                        $tgl_permohonan_lelang= "-";
                                    }?>    
                                    
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $mahasiswa['no_rekening']; ?></td>
                                    <td><?= $mahasiswa['nama_debitur']; ?></td>
                                    <td><?= date('d-M-Y', strtotime($mahasiswa['tgl_penilaian']));?></td>
                                    <td><?= $mahasiswa['no_permohonan_lelang']; ?></td>
                                    <td><?= $tgl_permohonan_lelang ?></td>
                                    <td><?= $mahasiswa['nama_bls']; ?></td>
                                    <td >Rp <?= number_format($mahasiswa['limit_lelang'], 0, ',', '.'); ?></td>
                                    <td><?= $tgl_lelang ?></td>
                                    <td class="text-center" width="15%">
                                        <a href="detail-pendaftaran-lelang.php?id_debitur=<?= $mahasiswa['id_debitur']; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i> Detail</a>
                                        <a href="tambah-pendaftaran-lelang.php?id_debitur=<?= $mahasiswa['id_debitur']; ?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Ubah</a>
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
