<?php

function curlPost($url, $headers = array(), $data = array()) {
    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt($curl, CURLOPT_USERAGENT, $_REQUEST['HTTP_USER_AGENT']);
    curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);

    if (is_array($headers) && !empty($headers)) {
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    }
    $output = curl_exec($curl);

    $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    $error_no = curl_errno($curl);
    $error_text = curl_error($curl);

    curl_close($curl);

    if ($error_no) {
        $message = 'Curl Error when doing POST to: ' . $url . " with error: " . $error_text;
        throw new Exception($message);
    } elseif ($http_code != '200') {
        throw new Exception('HTTP response code: ' . $http_code . ' when doing POST to: ' . $url);
    } else {
        $output = json_decode($output, true);
        return $output['atoz']['tleo_titles'];
    }
}

function curlGet($url, $headers = array()) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_FRESH_CONNECT, TRUE);
    if (is_array($headers) && !empty($headers)) {
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    }
    $output = curl_exec($curl);
    $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $error_no = curl_errno($curl);
    $error_text = curl_error($curl);
    curl_close($curl);
    if ($error_no) {
        $message = 'Curl Error when doing GET to: ' . $url . " with error: " . $error_text;
        throw new Exception($message);
    } elseif ($http_code != '200') {
        throw new Exception('HTTP response code: ' . $http_code . ' when doing GET to: ' . $url);
    } else {
        $output = json_decode($output, true);
        return $output['atoz']['tleo_titles'];
    }
}