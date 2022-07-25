<?php if (!defined("BASEPATH")) exit("No direct script access allowed");

function app_url()
{
    if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
        $ssl = 'https';
    } else {
        $ssl = 'http';
    }

    $app_url = ($ssl)
        . "://" . $_SERVER['HTTP_HOST']
        . (dirname($_SERVER["SCRIPT_NAME"]) == DIRECTORY_SEPARATOR ? "" : "/")
        . trim(str_replace("\\", "/", dirname($_SERVER["SCRIPT_NAME"])), "/");

    return $app_url;
}

function encrypt_url($string)
{
    $output = false;
    $security       = parse_ini_file("security.ini");
    $secret_key     = $security["encryption_key"];
    $secret_iv      = $security["iv"];
    $encrypt_method = $security["encryption_mechanism"];

    $key    = hash("sha256", $secret_key);
    $iv     = substr(hash("sha256", $secret_iv), 0, 16); // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
    $result = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($result);

    return $output;
}

function decrypt_url($string)
{
    $output = false;
    $security       = parse_ini_file("security.ini");
    $secret_key     = $security["encryption_key"];
    $secret_iv      = $security["iv"];
    $encrypt_method = $security["encryption_mechanism"];

    $key     = hash("sha256", $secret_key);
    $iv     = substr(hash("sha256", $secret_iv), 0, 16); // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);

    return $output;
}

function url_package_list($package, $id_package)
{
    $result = base_url() . 'package/package_list/' . url_title(strtolower($package)) . '/' . encrypt_url($id_package);

    return $result;
}
