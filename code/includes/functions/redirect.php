<?php

function redirect($target) {
    write_log("info", "Outgoing Redirect: " . $target);

    // header("HTTP/1.1 301 Moved Permanently");
    // header("Location:" . $target);
    exit;
}