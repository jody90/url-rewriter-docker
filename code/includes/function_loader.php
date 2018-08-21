<?
$dir = opendir(dirname(__FILE__)."/functions/");
while ($filename = readdir($dir)) {
    $pattern = "@\.php$@";
    if (preg_match($pattern, $filename)) {
        require_once "functions/".$filename;
    }
}
closedir($dir);