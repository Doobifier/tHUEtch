<?php

include_once "Hue_Factory/HueFactory.php";

$data = HueFactory::getHue('fire');
echo "\n";
echo "\n";
echo json_encode($data);