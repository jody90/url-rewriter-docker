<?php

function cleanup_link_list($language) {

    $handle = fopen("./list/" . $language . ".txt", "r") or die("Unable to open file!");

    foreach (new DirectoryIterator('./list/processed/') as $fileInfo) {
        if(!$fileInfo->isDot()) {
            unlink($fileInfo->getPathname());
            print_ob("deleted: " . $fileInfo->getPathname());
        }
    }
    
    while (($line = fgets($handle)) !== false) {

        preg_match('/\/c\/[0-9]*/', $line, $category);
        preg_match('/\/p\/[0-9]*/', $line, $product);
        preg_match('/\/medias\//', $line, $medias);
        preg_match('/\/search\?q/', $line, $search);
        preg_match('/\/sortimoError/', $line, $error);

        if (strpos($line, ".jpg") || strpos($line, ".JPG")) {
            write_to_file("images", $line, $language);
        }
        elseif (strpos($line, ".jpeg") || strpos($line, ".JPEG")) {
            write_to_file("images", $line, $language);
        }
        elseif (strpos($line, ".png")) {
            write_to_file("images", $line, $language);
        }
        elseif (strpos($line, ".mp4")) {
            write_to_file("mp4", $line, $language);
        }
        elseif (strpos($line, ".html")) {
            write_to_file("html", $line, $language);
        }
        elseif (strpos($line, ".msg")) {
            write_to_file("msg", $line, $language);
        }
        elseif (strpos($line, ".gif")) {
            write_to_file("images", $line, $language);
        }
        elseif (strpos($line, ".pdf")) {
            write_to_file("pdf", $line, $language);
        }
        elseif (strpos($line, ".js")) {
            write_to_file("js", $line, $language);
        }
        elseif (strpos($line, ".css")) {
            write_to_file("css", $line, $language);
        }
        elseif (sizeof($category) > 0) {
            write_to_file("shop-category-links", $line, $language);
        }
        elseif (sizeof($product) > 0) {
            write_to_file("shop-product-links", $line, $language);
        }
        elseif (sizeof($medias) > 0) {
            write_to_file("shop-medias-links", $line, $language);
        }
        elseif (sizeof($search) > 0) {
            write_to_file("search-links", $line, $language);
        }
        elseif (sizeof($error) > 0) {
            write_to_file("error-links", $line, $language);
        }
        else {
            write_to_file("links", $line, $language);
        }
    }

    fclose($handle);
}