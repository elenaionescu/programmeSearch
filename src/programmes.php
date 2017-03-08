<?php
require_once('curl.php');

class Programmes
{
    private $programmesHeaders = array('Content-Type: application/json; charset=utf-8', 'Access-Control-Allow-Origin: *');
    private $baseURL = "https://rmp.files.bbci.co.uk/technical-test/source-data.json";

    private function programmesCurl($method, $params = array(), $data = array()) {

        $url = $this->baseURL;

        if ($params && is_array($params) && ($method == "POST" || $method == "GET")) {
            $url = $url .'?';
            foreach ($params as $key => $value) {
                $url = $url . $key . "=" . $value;
            }
        }

        if ($method == "POST") {
            return curlPost($url, $this->programmesHeaders, $data);
        } elseif ($method == "GET") {
            return curlGet($url, $this->programmesHeaders);

        }
    }

    public function getProgrammes($params = array()) {
        $allProgrammes = $this->programmesCurl("GET", $params);

        $programmes = array();
        foreach ($allProgrammes as $key => $program) {

            $programmes[$key]['title'] = $program['programme']['title'];
            $programmes[$key]['short_synopsis'] = $program['programme']['short_synopsis'];
            $programmes[$key]['pid'] = $program['programme']['image']['pid'];
        }
        return $programmes;
    }
}