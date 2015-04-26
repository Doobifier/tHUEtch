<?php
/**
 * Richard Dobie
 * Date: 4/24/2015
 */

include 'Light.php';

class Hue {

    private $user = "";
    private $ip = "";
    private $lights;


    private $target;
    private $group;
    private $scene;

    public function __construct($user, $ip){
        $this->user = $user;
        $this->ip = $ip;
        $this->target = "http://" . $this->ip . "/api/" . $this->user;
    }

    public function register(){}

    public function getAllLights(){
        $target = $this->target . "/lights/";
        $response = $this->doGET($target);
        $json = json_decode($response);

        $lights = $this->setLightArray();
        foreach ($lights as $id) {
            $response = $this->doGET($target . "$id");
            $this->lights[$id] = new Light($this, $id, $response);
        }

        return $response;
    }

    public function doGET($target){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $target);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function doPUT($data) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->target);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function setLightArray(){
        $targets = array();
        $targets = $this->getLightIds();
        return $targets;
    }

    public function getLightIds(){
        $result = json_decode($this->doGET($this->target . "/lights/"), true);
        $target = array_keys($result);
        return $target;
    }

    public function setLight($light){}

    public function getGroups(){}

    public function addToGroup($light){}

    /**
     * @return mixed
     */
    public function getLights()
    {
        return $this->lights;
    }

}