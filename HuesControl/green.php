<?php //tHUEtch 1.0 by Richard Dobie 04/25/15

include 'utils.php';

$data = array("on" => true, "hue" => 25500,"bri" => 254, "sat" => 254);
$result = put($data, '1/state' , $target);
$data = array("on" => true, "hue" => 25500,"bri" => 254, "sat" => 254);
$result = put($data, '2/state' , $target);

echo "$result";