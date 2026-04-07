<?php


$url=parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);

$array_url=explode('/',substr($url,1));
print_r($array_url);

?>