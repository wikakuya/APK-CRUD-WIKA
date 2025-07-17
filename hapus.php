<?php
$file = "data.txt";
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $baris = file($file, FILE_IGNORE_NEW_LINES);
    if (isset($baris[$id])) {
        unset($baris[$id]);
        file_put_contents($file, implode("\n", $baris) . "\n");
    }
}
header("Location: index.php");
exit;
