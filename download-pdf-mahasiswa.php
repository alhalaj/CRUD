<?php

require __DIR__ . '/vendor/autoload.php';
require 'config/app.php';

use Spipu\Html2Pdf\Html2Pdf;

// mengambil id mahasiswa dari url
$id_mahasiswa = (int)$_GET['id_debitur'];

// menampilkan data mahasiswa
$mahasiswa = select("SELECT * FROM debitur WHERE id_debitur = $id_mahasiswa")[0];

$content .= '<style type="text/css">
    .gambar {
        width: 50px;
    }
</style>';

$content .= '
<page>

    <table border="1" align="center">
        <tr>
            <th>No</th>
            <th>No Rekg</th>
            <th>Nama</th>
            <th>alamat_jaminan</th>
            </tr>';

        $no = 1;
        foreach ($data_debitur as $debitur) {
            $content .='
                <tr>
                    <td>'.$no++.'</td>
                    <td>'.$debitur['no_rekening'].'</td>
                    <td>'.$debitur['nama_debitur'].'</td>
                    <td>'.$debitur['alamat_jaminan'].'</td>
                   </tr>
            ';
        }
        
$content .= '
    </table>
</page>';

$html2pdf = new Html2Pdf();
$html2pdf->writeHTML($content);
ob_start();
$html2pdf->output('laporan-debitur.pdf');
