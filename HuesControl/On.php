<?php //tHUEtch 1.0 by Richard Dobie 04/25/15

include 'utils.php';

$data = array("on" => true);
$result = put($data, '1/state' , $target);
$result = put($data, '2/state' , $target);

echo "$result";