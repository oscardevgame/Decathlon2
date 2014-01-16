<?php
$NAME = $_POST['nameoffile'];
$HANDLE = fopen($NAME, 'a+') or die ('CANT OPEN FILE');
fwrite($HANDLE,$_POST["tracker"]);
fclose($HANDLE);
?>
