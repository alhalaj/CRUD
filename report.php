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

$data_mahasiswa = select("SELECT * FROM debitur ORDER BY id_debitur DESC");
?>
<style>
    thead input {
        width: 100%;
    }
</style>
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
            <!--aris-->
            <table border="0" cellspacing="5" cellpadding="5">
            <tbody>
                  <tr>
                      <td>
                          Tanggal Awal : 
                      </td>
                      <td>
                          <input type="text" id="min" name="min">
                          </td>
                          </tr>
                          <tr>
                              <td>
                                  Tanggal Akhir :
                              </td>
                              <td>
                                  <input type="text" id="max" name="max">
                                  </td>
                                  </tr>
                        </tbody>
                        </table>
                    <?php
                     foreach ($data_mahasiswa as $mahasiswa) ?>
                <table id ="example3" class="table table-bordered table-hover table-striped dt-responsive display nowrap" cellspacing="0">
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
<script>
    var minDate, maxDate;
    $.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = minDate.val();
        var max = maxDate.val();
        var date = new Date( data[6] );
//  var date = new Date( moment(data[0], 'DD/MM/YYYY').format('YYYY-MM-DD') );
        if (
            ( min === null && max === null ) ||
            ( min === null && date <= max ) ||
            ( min <= date   && max === null ) ||
            ( min <= date   && date <= max )
        ) {
            return true;
        }
        return false;
    }
);
 
$(document).ready(function() {
    // Create date inputs
    minDate = new DateTime($('#min'), {
        // format: 'MMMM Do YYYY'
        formatDate : 'MM-DD-YYYY'
    });
    maxDate = new DateTime($('#max'), {
        formatDate : 'MM-DD-YYYY'
    });
    
     $('#example3 thead tr')
        .clone(true)
        .addClass('filters')
        .addClass('table table-bordered table-hover table-striped dt-responsive display nowrap')
        .appendTo('#example3 thead');
        
 
    // DataTables initialisation
    var table = $('#example3').DataTable(
        {
            dom: 'Blfrtip',
            dom: '<"float-left"B><"float-right"f>rt<"row"<"col-sm-4"l><"col-sm-4"i><"col-sm-4"p>>',
            buttons: [
                {
                    extend: 'copy'
                    
                },
                {
                    extend: 'pdf',
                            exportOptions: {
                            columns: [1,2,3,4,5]
                            }
                },
                {
                    extend: 'csv',
                },
                {
                    extend: 'excel',
                } 
            ],
            orderCellsTop: true,
            fixedHeader: true,
            initComplete: function () {
            var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input witdtype="text" placeholder="' + title + '" />');
 
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('change', function (e) {
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
                        })
                        .on('keyup', function (e) {
                            e.stopPropagation();
 
                            $(this).trigger('change');
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
        });
    // Refilter the table
    $('#min, #max').on('change', function () {
        table.draw();
    });
        
});
</script>
