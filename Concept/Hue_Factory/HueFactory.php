<?php

class HueFactory {

    public static function getHue($command){
        $command = ucwords($command);
        $includeString = "Concept/Hue/{$command}/{$command}.php";
        $package = include_once $includeString;
        return $package;
    }

}