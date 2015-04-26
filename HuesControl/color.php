<?php //tHUEtch 1.0 by Richard Dobie 04/25/15

include 'utils.php';

$color =  $_GET["name"];

switch ($color){
    case "red":
        $data = array("on" => true, "hue" => 0,"bri" => 254, "sat" => 254);
        $result = put($data, '1/state' , $target);
        $data = array("on" => true, "hue" => 0,"bri" => 254, "sat" => 254);
        $result = put($data, '2/state' , $target);
        break;
    case "blue":
        $data = array("on" => true, "hue" => 46920,"bri" => 254, "sat" => 254);
        $result = put($data, '1/state' , $target);
        $data = array("on" => true, "hue" => 46920,"bri" => 254, "sat" => 254);
        $result = put($data, '2/state' , $target);

        break;
    case "green":
        $data = array("on" => true, "hue" => 25500,"bri" => 254, "sat" => 254);
        $result = put($data, '1/state' , $target);
        $data = array("on" => true, "hue" => 25500,"bri" => 254, "sat" => 254);
        $result = put($data, '2/state' , $target);
        break;
    case "pink":
        $data = array("on" => true, "hue" => 56002,"bri" => 254, "sat" => 254);
        $result = put($data, '1/state' , $target);
        $data = array("on" => true, "hue" => 56002,"bri" => 254, "sat" => 254);
        $result = put($data, '2/state' , $target);
        break;
    case "purple":
        $data = array("on" => true, "hue" => 51452,"bri" => 254, "sat" => 254);
        $result = put($data, '1/state' , $target);
        $data = array("on" => true, "hue" => 51452,"bri" => 254, "sat" => 254);
        $result = put($data, '2/state' , $target);
        break;
    case "yellow":
        $data = array("on" => true, "hue" => 9082,"bri" => 254, "sat" => 254);
        $result = put($data, '1/state' , $target);
        $data = array("on" => true, "hue" => 9082,"bri" => 254, "sat" => 254);
        $result = put($data, '2/state' , $target);
        break;
    case "orange":
        $data = array("on" => true, "hue" => 8000, "bri" => 254, "sat" => 254);
        $result = put($data, '1/state' , $target);
        $data = array("on" => true, "hue" => 8000, "bri" => 254, "sat" => 254);
        $result = put($data, '2/state' , $target);
        break;
}