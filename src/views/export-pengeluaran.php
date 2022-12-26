<?php

use Models\Pengeluaran;
use Session\Auth;

if (!Auth::check()) redirect('login');
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data_Pengeluaran.xls");
$pengeluaran = new Pengeluaran();
$pengeluarans = $pengeluaran->findByUser(Auth::user()->id_user);
?>
<h3>Data Pengeluaran</h3>
<table border="1" cellpadding="5">
	<tr>
		<th>ID Pengeluaran</th>
		<th>Tgl Pengeluaran</th>
		<th>Jumlah</th>
		<th>Jenis</th>
	</tr>
	<?php
	// Untuk penomoran tabel, di awal set dengan 1 
	foreach ($pengeluarans as $pengeluaran) {
		// Ambil semua data dari hasil eksekusi $sql 
		echo "<tr>";
		echo "<td>" . $pengeluaran->id_pengeluaran . "</td>";
		echo "<td>" . $pengeluaran->tgl_pengeluaran . "</td>";
		echo "<td>" . $pengeluaran->jumlah . "</td>";
		echo "<td>" . $pengeluaran->jenis()->nama . "</td>";
		echo "</tr>";
	}  ?>
</table>