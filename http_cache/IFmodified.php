<?php
/**
 *If-Modified-Since[request] & Last-Modified [response]
 *减少网络字节传输
 */

$headers = apache_request_headers();

$file = 'modified.txt';

if (isset($headers['If-Modified-Since']) && (strtotime($headers['If-Modified-Since']) == filemtime($file))) {

    header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($file)) . ' GMT', true, 304);

} else {
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($file)) . ' GMT', true, 200);
    header('Content-Length: ' . filesize($file));
    $content = file_get_contents($file);
    echo $content;
}



