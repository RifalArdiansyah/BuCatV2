<?php

use Session\Auth;

$email = $_POST['email'];
$password = $_POST['password'];
$type = $_POST['type'];
if (Auth::login($email, $password)) {
	redirect('index');
} else {
	redirect('login&pesan=gagal');
}
?>