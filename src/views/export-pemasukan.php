    <?php

use Models\Pemasukan;
use Session\Auth;

if (!Auth::check())	redirect('login');

	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data_Pemasukan.xls");
	$pemasukan = new Pemasukan();
	$pemasukans = $pemasukan->findByUser(Auth::user()->id_user);
	?>
	<h3>Data Pemasukan</h3>    
	<table border="1" cellpadding="5"> 
	<tr>    
	<th>ID Pemasukan</th>
    <th>Tgl Pemasukan</th>
    <th>Jumlah</th>    
	<th>Sumber</th> 
	</tr>  
	<?php
	// Untuk penomoran tabel, di awal set dengan 1 
	foreach($pemasukans as $pemasukan){ 
	// Ambil semua data dari hasil eksekusi $sql 
	echo "<tr>";    
	echo "<td>".$pemasukan->id_pemasukan."</td>";   
	echo "<td>".$pemasukan->tgl_pemasukan."</td>";    
	echo "<td>".$pemasukan->jumlah."</td>";    
	echo "<td>".$pemasukan->sumber()->nama."</td>";      
	echo "</tr>";        
	}  ?></table>