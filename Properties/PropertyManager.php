<?php

/**
 * Class PropertyManager
 *
 * Barrett Cid
 *
 * A class for reading settings data into a Array with key value pair.
 */
class PropertyManager {

    private static $_properties;

    /**
     * @return static PropertyManager
     *
     * Using a singleton pattern for all setting changes to be concurrent
     * within the application.
     */
    public static function getInstance(){
        static $instance = null;
        if(null === $instance){
            $instance = new static();
            self::$_properties = array();
            $instance->loadProperties();
        }
        return $instance;
    }

    /**
     * Loads the settings into an array with key pair value.
     * Nested for settings.
     * ex. $properties = array('lights' => array('size' => 1,'lights' => array('name' => 'light_one')))
     */
    private static function loadProperties(){
        $file = fopen('file_path', 'r');
        $lineNumber = 1;
        $delta = 0;
        if($file){
            //$currentCategory = null;
            $category        = null;
            $property        = null;
            $keys            = null;
            while (($line = fgets($file)) !== false){
                $line = str_replace(array("\r", "\n"), '', $line);
                if(strpos($line,'#category') !== false){
                    //category
                    $line = str_replace('#category=','',$line);
                    $line = strtolower($line);
                    $category = $line;
                    self::$_properties[$category] = null;
                    $delta++;
                }else if($delta == 1){
                    $keys = explode('|',$line);
                    $delta++;
                }else if($delta > 1 && strpos($line,'#end') === false){
                    $line = explode('|',$line);
                    $nKeys = count($keys);
                    if($nKeys == count($line)) {
                        $property = array();
                        for ($i = 0; $i < $nKeys; $i++) {
                            $property[$keys[$i]] = $line[$i];
                        }
                    }else{
                        throw new Exception("Error in properties file on line {$lineNumber}");
                    }
                    self::$_properties[$category] = $property;
                }else if(strpos($line,'#end') !== false){
                    $delta = 0;
                }
                $lineNumber++;
            }
            fclose($file);
        }else{
            throw new Exception("No properties file found");
        }
    }

    public function dumpSettings(){
        print_r(self::$_properties);
    }


}