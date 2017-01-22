<?php

header('Access-Control-Allow-Origin: *');

$url = $_GET['callUrl'];
echo file_get_contents($url);
?>