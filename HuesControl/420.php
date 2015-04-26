<?php //tHUEtch 1.0 by Richard Dobie 04/25/15

include 'utils.php';

$delay = (1000000);

$data = array("on" => true, "hue" => 25500,"bri" => 254, "sat" => 254);
$result = put($data, '1/state' , $target);
$data = array("on" => true, "hue" => 24000, "bri" => 254, "sat" => 100);
$result = put($data, '2/state' , $target);

echo "$result";