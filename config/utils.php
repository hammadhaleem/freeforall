<?php

/**
 * @return the value at $index in $array or $default if $index is not set.
 */
function idx(array $array, $key, $default = null) {
  return array_key_exists($key, $array) ? $array[$key] : $default;
}

function he($str) {
  return htmlentities($str, ENT_QUOTES, "UTF-8");
}

function getPage($url, $referer, $timeout, $header){
if(!isset($timeout))
$timeout=30;
$curl = curl_init();
if(strstr($referer,"://")){
curl_setopt ($curl, CURLOPT_REFERER, $referer);
}
curl_setopt ($curl, CURLOPT_URL, $url);
curl_setopt ($curl, CURLOPT_TIMEOUT, $timeout);
curl_setopt ($curl, CURLOPT_USERAGENT, sprintf("Mozilla/%d.0",rand(4,5)));
curl_setopt ($curl, CURLOPT_HEADER, (int)$header);
curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0);
$html = curl_exec ($curl);
curl_close ($curl);
return $html;
}
