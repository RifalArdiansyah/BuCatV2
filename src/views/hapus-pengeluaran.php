<?php

use Models\Pengeluaran;

$id = $_GET['id_pengeluaran'];

$pengeluaran = new Pengeluaran();
$pengeluaran->findById($id);
$pengeluaran->delete();

//mysql_close($host);
?>