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

$title = 'Report Debitur';
include 'layout/header.php';

if (isset($_POST['filter'])) {
    
     if (select1($_POST) > 0) {
         $rows=[];
         $data_mahasiswa=isset ($rows['index_array']) ? $rows['index_array']:'';
         $data_mahasiswa = select1($rows);
        
    } else {
        $data_mahasiswa="";
        $data_mahasiswa = "Data Not Found";
    }
    
    // $tgl_awal  = $_POST['tgl_awal'];
    // $tgl_akhir  = $_POST['tgl_akhir'];
    
    // // $tgl_awal    = date('d-m-Y', strtotime($tgl_awal));
    // // $tgl_akhir   = date('d-m-Y', strtotime($tgl_akhir));
    
    // $query = "SELECT * FROM debitur where (tgl_penilaian BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') ORDER BY id_debitur DESC";
    // $result = mysqli_query($db, $query);
    // $rows = [];

    // while ($row = mysqli_fetch_assoc($result)) {
    //     $rows[] = $row;
    // }
    
    //  return $rows;
    
    // print_r("arsfafsgsag astfsafsaftsaftfsat t tfsf ".$tgl_awal." Tanggal akhir ".$tgl_akhir."query ". $rows);
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-book"></i> Report</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Debitur</li>
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
            <div class="card card-default">
          <div class="card-header">
            <label>Filter Tanggal</label>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                 <label for="tgl_awal">Tanggal Awal</label>
                  <input type="date" class="form-control" id="tgl_penilaian" name="tgl_awal" placeholder="Tanggal Awal ... " required>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="tgl_akhir">Tanggal Akhir</label>
                  <input type="date" class="form-control" id="tgl_penilaian" name="tgl_akhir" placeholder="Tanggal Akhir ... " required>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <div class="row">
              <div class="col-md-6">
                  <button type="submit" name="filter" value="true" class="btn btn-primary">TAMPILKAN</button>
                </div>
                <div class="col-md-6">
                <?php
                if(isset($_GET['filter'])) // Jika user mengisi filter tanggal, maka munculkan tombol untuk reset filter
               echo '<a href="" class="btn btn-default">RESET</a>';
            ?>
                </div>
                </form>
            </div>
            <!-- /.row -->
            <!--aris-->
            <div class="row">
                <div class="col-md-12">
                    <?php
                     if( isset($data_mahasiswa) && count($data_mahasiswa) > 0) {
                         ?>
                <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Rekening</th>
                                <th>Nama Debitur</th>
                                <th>Nama KJPP</th>
                                <th>Nilai Pasar</th>
                                <th>Nilai Likuidasi</th>
                                <th>Tgl Penilaian</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1; ?>
                            <?php foreach ($data_mahasiswa as $mahasiswa) : ?>
                                <tr>
                                    <td ><?= $no++; ?></td>
                                    <td><?= $mahasiswa['no_rekening']; ?></td>
                                    <td ><?= $mahasiswa['nama_debitur']; ?></td>
                                    <td ><?= $mahasiswa['nama_kjpp']; ?></td>
                                    <td >Rp <?= number_format($mahasiswa['nilai_pasar'], 0, ',', '.'); ?></td>
                                    <td >Rp <?= number_format($mahasiswa['nilai_likuidasi'], 0, ',', '.'); ?></td>
                                    <td ><?= date('d-M-Y', strtotime($mahasiswa['tgl_penilaian'])); ?></td>
                                </tr>
                            <?php 
                                endforeach;
                            ?>
                        </tbody>
                    </table>
                    <?php
                     }else {
                                echo "Data Not Found";
                            }
                            ?>
                </div>
              </div>
            <!--end aris-->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
           Menuju Senja
          </div>
        </div>
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?php include 'layout/footer.php'; ?>
