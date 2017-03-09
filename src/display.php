<?php
require_once('programmes.php');
$keyword = $_POST['search'];


if (!empty($keyword)) {
    $myProgrammes = new Programmes();
    $programmes = $myProgrammes->getProgrammes($keyword);

    print $programmes;
}