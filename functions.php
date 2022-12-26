<?php

function redirect($path = "")
{
    $url = "index.php?page=" . $path;
    header("Location: $url");
}