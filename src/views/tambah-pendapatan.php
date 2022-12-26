<?php

$tgl_pemasukan = $_GET['tgl_pemasukan'];
$jumlah = $_GET['jumlah'];
$sumber = $_GET['sumber'];

//query update
$query = mysqli_query($koneksi,"INSERT INTO `pemasukan` (`tgl_pemasukan`, `jumlah`, `id_sumber`) VALUES ('$tgl_pemasukan', '$jumlah', '$sumber')");

if ($query) {
 # credirect ke page index
 redirect("pendapatan"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
}

//mysql_close($host);
?>