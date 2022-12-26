<?php
$id = $_GET['id_pengeluaran'];
$tgl = $_GET['tgl_pengeluaran'];
$jumlah = $_GET['jumlah'];
$sumber = $_GET['id_sumber'];

//query update
$query = mysqli_query($koneksi,"UPDATE pengeluaran SET tgl_pengeluaran='$tgl' , jumlah='$jumlah', id_sumber='$sumber' WHERE id_pengeluaran='$id' ");

if ($query) {
 # credirect ke page index
 redirect("pengeluaran"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
}

//mysql_close($host);
?>