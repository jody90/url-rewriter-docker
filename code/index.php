<?php

error_reporting(E_ALL | E_WARNING | E_NOTICE);
ini_set('display_errors', TRUE);

include 'includes/function_loader.php';

// cleanup_link_list("de");

// sort_linklist("de");

if ($_SERVER["REQUEST_URI"] != "/favicon.ico") {

    write_log("info", "Incoming Request: " . $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);

    $host = $_SERVER["HTTP_HOST"];
    $uri = urldecode(preg_replace("/\?.*/", "", $_SERVER["REQUEST_URI"]));
    $protocol = $_SERVER["REQUEST_SCHEME"];

    $full_uri = $protocol . "://" . $host . $uri;

    $url = $host . $uri;

    $url = rtrim($url, "/");

    $subdomain = 'www.';
    $host = parse_url($full_uri, PHP_URL_HOST);
    $host = str_ireplace($subdomain,'',$host);
    $tld = strstr($host, '.');
    $tld = ltrim($tld, '.');

    $mysortimo = "https://www.mysortimo." . $tld;

    // Extract Category or Product URIs
    preg_match('/\/c\/[0-9]*/', $uri, $category);
    preg_match('/\/p\/[0-9]*/', $uri, $product);


    // Zuerst generische Links abfangen
    if (sizeof($category) > 0) {
        $uri_parts = explode("/", $uri);
        $language = $uri_parts[2];
        $link = $mysortimo . "/" . $language . $category[0];
        redirect($link);
    }

    if (sizeof($product) > 0) {
        $uri_parts = explode("/", $uri);
        $language = $uri_parts[2];
        $link = $mysortimo . "/" . $language . $product[0];
        redirect($link);
    }

    // Wenn nicht generisch in Liste nachsehen

    // Get Linklist for TLD
    $list = get_link_list($tld);

    $list_keys = array_keys($list);
    $keys_index = array_search($url, $list_keys);
    $list_key = $list_keys[$keys_index];

    if ($keys_index > 0) {
        $link = $list[$list_key];
        redirect($link);
    }

    // Standard redirect zur Startseite der TLD
    redirect($mysortimo);

}