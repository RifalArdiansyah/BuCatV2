<?php

use Models\Pemasukan;

$id = $_GET['id_pemasukan'];

$pemasukan = new Pemasukan();
$pemasukan->findById($id);
$pemasukan->delete();
redirect("pendapatan"); 

//mysql_close($host);
?>