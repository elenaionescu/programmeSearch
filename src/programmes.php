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

    public function getProgrammes($keyword) {
        $allProgrammes = $this->programmesCurl("GET", array('search' => $keyword));

        $output = '';
        $programmes = array();
        $k = 0;
        foreach ($allProgrammes as $key => $program) {
            if (stripos($program['programme']['title'], $keyword) !== false) {
                $programmes[$k]['title'] = $program['programme']['title'];
                $programmes[$k]['short_synopsis'] = $program['programme']['short_synopsis'];
                $programmes[$k]['pid'] = $program['programme']['image']['pid'];

                $output .='<ul>';
                $output .= $this->renderResult($programmes[$k]);
                $output .='</ul>';
                $k++;
            }

        }

        if (empty($programmes)) {
            $output = '<div class="empty_result">There are no results</div>';
        }
        return $output;
    }

    /**
     *  Function to render the result in nice HTML list
     */
    public function renderResult($programme) {
        $output = '<li class="col-sm-12" id="programmes_li">';
        $output .= '<div class="col-sm-3"><a target="_blank" href="javascript:"><img class="img-responsive" src="https://ichef.bbci.co.uk/images/ic/480x270/' . $programme['pid'] . '.jpg" /></a></div>';
        $output .= '<div class="col-sm-9"><a target="_blank" href="javascript:"><h4>' . $programme['title'] . '</h4>';
        $output .= '<span>' . $programme['short_synopsis'] . '</span><br /><br />';
        $output .= '</a>';
        $output .= '</div></li>';

        return $output;
    }
}