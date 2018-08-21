<?php

function get_link_list($language) {
    $handle = fopen("./redirect_lists/" . $language . ".csv", "r") or die("Unable to open file!");

    while (($line = fgets($handle)) !== false) {
        $line = preg_replace('/\s+/', ' ', trim($line));
        $ex_line = explode(";", $line);
        $list[$ex_line[0]] = $ex_line[1];
    }

    return $list;
}