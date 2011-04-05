<?php

/**
 * Utilites for test functions
 */

function Tests_Auth_Yadis_datafile($name, $reader)
{
    $path = dirname(realpath(__FILE__));
    $sep = DIRECTORY_SEPARATOR;
    $filename = $path . $sep . 'data' . $sep . $name;
    $data = $reader($filename);
    if ($data === false) {
        $msg = "Failed to open data file: $name";
        trigger_error($msg, E_USER_ERROR);
    }
    return $data;
}

function Tests_Auth_Yadis_readdata($name)
{
    return Tests_Auth_Yadis_datafile($name, 'file_get_contents');
}

function Tests_Auth_Yadis_readlines($name)
{
    return Tests_Auth_Yadis_datafile($name, 'file');
}

/**
 * Basic cURL wrapper function for PHP
 * @link http://snipplr.com/view/51161/basic-curl-wrapper-function-for-php/
 * @param string $url URL to fetch
 * @param array $curlopt Array of options for curl_setopt_array
 * @return string
 */
function file_get_contents_curl($url, $curlopt = array()){
    $ch = curl_init();
    $default_curlopt = array(
        CURLOPT_TIMEOUT => 2,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_FOLLOWLOCATION => 1,
        CURLOPT_USERAGENT => "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2.13) Gecko/20101203 AlexaToolbar/alxf-1.54 Firefox/3.6.13 GTB7.1"
    );
    $curlopt = array(CURLOPT_URL => $url) + $curlopt + $default_curlopt;
    curl_setopt_array($ch, $curlopt);
    $response = curl_exec($ch);
    if($response === false)
        trigger_error(curl_error($ch));
    curl_close($ch);
    return $response;
}
