<?php
/**
 * Richard Dobie
 * Date: 4/24/2015
 *
 * An instance of this class is a Light object which represents the JSON representation of
 * the Hue light's properties.
 */

class Light {

    //state:
    private $parent;
    private $id;
    private $on;     //boolean
    private $bri;    //int
    private $hue;    //int
    private $sat;    //int
    private $xy;     //array[2]

    private $type;   //string
    private $name;   //

    public function __construct($parent, $lightid, $json){

        $this->parent = $parent;
        $data = json_decode($json, true);

        if (isset($data["state"])){
            $this->id = $lightid;
            $this->on = $data["state"]["on"];
            $this->bri = $data["state"]["bri"];
            $this->hue = $data["state"]["hue"];
            $this->sat = $data["state"]["sat"];
            $this->name = $data["name"];
            $this->name = $data["type"];

        }



    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getOn()
    {
        return $this->on;
    }

    /**
     * @return mixed
     */
    public function getBri()
    {
        return $this->bri;
    }

    /**
     * @return mixed
     */
    public function getHue()
    {
        return $this->hue;
    }

    /**
     * @return mixed
     */
    public function getSat()
    {
        return $this->sat;
    }

    /**
     * @return mixed
     */
    public function getXy()
    {
        return $this->xy;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getModelid()
    {
        return $this->modelid;
    }   //string
    private $modelid;







}