<?php

function sort_linklist($language) {
    $handle = fopen("./list/processed/" . $language . "-links.txt", "r") or die("Unable to open file!");

    $list = array();
    
    while (($line = fgets($handle)) !== false) {
        array_push($list, $line);
    }

    $list = array_unique($list);
    
    sort($list);

    file_put_contents("./redirect_lists/" . $language . "-links-sorted.txt", $list);
}