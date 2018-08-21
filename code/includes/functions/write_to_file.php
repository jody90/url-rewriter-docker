<?php

function write_to_file($file, $text, $language) {

    $filename = "./list/processed/". $language . "-" . $file . ".txt";

    $logfile = fopen($filename, "a") or die("Unable to open file!");
    $txt = preg_replace("/\?.*/", "", $text);
    $txt = preg_replace('/\s+/', '', trim($txt));
    $txt = preg_replace('/(https:\/\/|http:\/\/)/', "", $txt);
    $txt = rtrim($txt, "/");
    $txt = $txt . PHP_EOL; 

    fwrite($logfile, $txt);
    fclose($logfile);

}