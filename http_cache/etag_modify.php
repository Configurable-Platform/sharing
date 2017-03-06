<?php

$file='etag_modify.txt';

$last_modified_time=filemtime($file);

$etag = md5_file($file);

$headers = apache_request_headers();


if (@strtotime($headers['If-Modified-Since']) == $last_modified_time ||
    @trim($headers['If-None-Match']) == $etag) {
  header('Content-Length: '.filesize($file));
    header("HTTP/1.1 304 Not Modified");

}else{

  header("Etag: $etag");
  header('Last-Modified: '.gmdate('D, d M Y H:i:s', $last_modified_time).' GMT', true, 200);
  header('Content-Length: '.filesize($file));
  $content=file_get_contents($file);
  echo $content;

}
