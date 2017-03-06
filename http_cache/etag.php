<?php

echo md5('1234abcd');
die;
$file = 'etag.txt';

$etag = md5_file($file);

$headers = apache_request_headers();

// header("Last-Modified: ".gmdate("D, d M Y H:i:s", $last_modified_time)." GMT");

if (isset($headers['If-None-Match']) && trim($headers["If-None-Match"]) == $etag) {
    header("HTTP/1.1 304 Not Modified");
} else {
    $content = file_get_contents($file);
    header('Content-Length: ' . filesize($file));
    header("Etag: $etag");
    echo $content;
}
