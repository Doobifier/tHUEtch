<?php //tHUEtch 1.0 by Richard Dobie 04/25/15

include 'utils.php';

$delay = (1000000);

for ($i = 0; $i < 3; $i++){
    $data = array("on" => true, "hue" => 65535,"bri" => 254, "sat" => 254);
    $result = put($data, '1/state' , $target);
    $data = array("on" => true, "hue" => 46920, "bri" => 254, "sat" => 254);
    $result = put($data, '2/state' , $target);

    usleep($delay);

    $data = array("on" => true, "hue" => 46920,"bri" => 254, "sat" => 254);
    $result = put($data, '1/state' , $target);
    $data = array("on" => true, "hue" => 65535, "bri" => 254, "sat" => 254);
    $result = put($data, '2/state' , $target);

    usleep($delay);
}

echo "$result";