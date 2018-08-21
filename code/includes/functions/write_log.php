<?php

function write_log($type, $message) {

    $filename = "./logs/" . date("Y-m-d") . ".log";

    $logfile = fopen($filename, "a") or die("Unable to open file!");
    $txt = date("Y-m-d H:i:s") . " | " . strtoupper($type) . ": " . $message . PHP_EOL;
    fwrite($logfile, $txt);
    fclose($logfile);

}