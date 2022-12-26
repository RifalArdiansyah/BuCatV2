<?php
$nama = $_GET['nama'];
$email = $_GET['email'];
$pass = $_GET['pass'];


//query update
$query = mysqli_query($koneksi,"INSERT INTO `admin` (`nama`, `email`, `pass`) VALUES ('$nama', '$email', '$pass')");

if ($query) {
 # credirect ke page index
 redirect("profile"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
}

//mysql_close($host);
?>