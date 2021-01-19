<?php
$css = "layout/css/";
$js = "layout/js/";
$temp = "include/templates/";
//include
include "connection.php";
include $temp . "header.php";
if (!(isset($noslide))) {
    include $temp . "content.php";
}
