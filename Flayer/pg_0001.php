<?php

require __DIR__ . '../../vendor/autoload.php';
require '../config/app.php';

use Spipu\Html2Pdf\Html2Pdf;

$content .= '<style type="text/css">
    .gambar {
        width: 50px;
    }
</style>';

$content .= '
<page>
<table>
		<thead>
			<tr>
				<th> <img style="position:absolute;top:0.24in;left:6.15in;width:2.00in;height:0.62in" src="ri_2.png" /></th>
			</tr>
			<tr>
				<td><b style="position:absolute;top:0.37in;left:0.00in;width:1.90in;height:0.07in; font-size:15px;">BNI LELANG BAGUNAN</b></td>
			</tr>
			<tr>
				<td><b style="position:absolute;top:0.55in;left:0.00in;width:1.90in;height:0.07in; font-size:15px;">Rumah Tinggal</b></td>
			</tr>
		</thead>
		<tbody>
			
			<tr>
				<td> <img style="position:absolute;top:0.76in;left:0.00in;width:2.25in;height:0.06in" src="vi_1.png" /></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>
				<img style="position:absolute;top:0.85in;left:0.00in;width:1.90in;height:0.07in" src="vi_2.png" />
				</td>
			</tr>
			<tr>
			    <td>
                <img style="position:absolute;top:1.62in;left:0.69in;width:3.07in;height:2.77in" src="ri_9.png" />
                 <img style="position:absolute;top:1.62in;left:4.15in;width:3.07in;height:2.77in" src="ri_8.png" />
                </td>
			</tr>
			<tr>
			<td>-----------------------------------------------------------</td>
			</tr>
		</tbody>
	</table>
';
$content .= '
</page>';

$html2pdf = new Html2Pdf();
$html2pdf->writeHTML($content);
ob_start();
$html2pdf->output('laporan-debitur.pdf');