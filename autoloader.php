<?php

// mengubah namespace menjadi path
function fqcnToPath(string $fqcn) {
    $fqcn = explode('\\', $fqcn);
    // ambil nama class
    $classname = array_pop($fqcn);
    // ubah nama folder menjadi huruf kecil
    $fqcn = array_map('strtolower', $fqcn);
    // gabungkan kembali
    $fqcn = implode('\\', $fqcn);
    // tambahkan nama class
    $fqcn .= '\\' . $classname;
    // ubah \ menjadi /
    return str_replace('\\', '/', $fqcn) . '.php';
}

// register autoloader
spl_autoload_register(function (string $class) {
    $path = fqcnToPath($class);

    require __DIR__ . '/src/' . $path;
});