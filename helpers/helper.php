<?php
function subview($file)
{
    // __DIR__ berfungsi untuk mendapatkan direktori saat ini, kemudian ditambahkan dengan folder sub-views dan nama file yang diberikan
    $file = __DIR__ . '/../sub-views/' . $file;

    include $file;
}
?>
