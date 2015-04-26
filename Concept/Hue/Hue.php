<?php

class Hue {

    /**
     * @param $delta int starts at base time adds $delta
     * @return int
     */
    public static function delay($delta){
        $newTime = BASE_DELAY + $delta;
        return $newTime;
    }


}