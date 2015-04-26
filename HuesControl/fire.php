<?php //tHUEtch 1.0 by Richard Dobie 04/25/15

include 'utils.php';

$delay = 100000;

for ($i = 0; $i < 10; $i++){
    $data = array("on" => true, "hue" => rand( 1500, 3500 ),"bri" => rand( 25, 254 ), "sat" => 254);
    $result = put($data, '1/state' , $target);
    usleep($delay);

    $data = array("on" => true, "hue" => rand( 10000, 12000 ),"bri" => rand( 25, 254 ), "sat" => 254);
    $result = put($data, '2/state' , $target);
    usleep($delay);

    $data = array("on" => true, "hue" => rand( 10000, 12000 ),"bri" => rand( 25, 254 ), "sat" => 254);
    $result = put($data, '1/state' , $target);
    usleep($delay);

    $data = array("on" => true, "hue" => rand( 1500, 3500 ),"bri" => rand( 25, 254 ), "sat" => 254);
    $result = put($data, '2/state' , $target);
    usleep($delay);

}

