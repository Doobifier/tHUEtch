<?php

/**
 * Class PropertyManager
 *
 * Barrett Cid
 *
 * A class for reading settings into a Array with key value pair.
 */
class PropertyManager {

    private static $_properties;
    private static $_filePath = '';
    private static $_fileName = 'tHUEtch.properties';

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
     * ex. $properties = array('lights' => array('light_one' => array('name' => 'light_one')))
     */
    private function loadProperties(){
        $file = fopen(self::$_filePath.self::$_fileName, 'r');
        $lineNumber = 1;
        $delta = 0;
        if($file){
            $category        = null;
            $property        = null;
            $keys            = null;
            while (($line = fgets($file)) !== false){
                $line = str_replace(array("\r", "\n"), '', $line);
                if(strpos($line,'#category') !== false){
                    $line = str_replace('#category=','',$line);
                    $line = strtolower($line);
                    $category = $line;
                    self::$_properties[$category] = null;
                    $delta++;
                }else if($delta == 1){
                    $keys = explode('|',$line);
                    $delta++;
                }else if($delta > 1 && strpos($line,'#end') === false){
                    $propertyIndex = strpos($line, '=');
                    $name = substr($line,0,$propertyIndex);
                    echo "{$name} found.\n";
                    $line = str_replace($name.'=','',$line);
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
                    self::$_properties[$category][$name] = $property;
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

    /**
     * checks for an update, if so reloads the properties
     */

    private function updates(){
        $file = fopen(self::$_filePath.self::$_fileName, 'r');
        $line = fgets($file);
        if(strpos($line,'true') !== false) {
            //update found
            self::loadProperties();
        }
    }

    /**
     * @param $propertyPath string
     *
     * @return $property mixed
     *
     * Gets an individual property or a group of properties
     * ex. category/property_name/property_attribute
     *     lights/light_one/ip_address
     */

    public function getProperty($propertyPath){
        $path = explode('/',$propertyPath);
        $nPath = count($path);
        $property = self::$_properties[$path[0]];
        for($i = 1; $i < $nPath; $i++){
            $property = $property[$path[$i]];
        }
        return $property;
    }

    /**
     * @param $categoryName string
     *
     * Gets a category based on the name.
     * ex. lights
     */

    public function getCategory($categoryName){
        return self::$_properties[$categoryName];
    }

    /**
     * @param $propertyPath string
     * @param $newProperty mixed
     *
     * Sets a property at the property path provided.
     */

    public function setProperty($propertyPath, $newProperty){
        //TODO Implementation setProperty
    }

    /**
     * @param $category string
     * @param $newCategory mixed
     *
     */
    public function setCategory($category, $newCategory){
        //TODO Implementation setCategory
    }

    /**
     * Saves the current properties in memory to the properties file.
     */
    //TODO debug save function and finish tmp file process.
    public function saveProperties(){
        $tmpFile = self::$_filePath.'tHUEtch.tmp';
        $file = fopen($tmpFile,'w+');
        fwrite($file,"#updated=false\n");
        $categoryKeys = array_keys(self::$_properties);
        $nCategories = count($categoryKeys);
        for($i = 0; $i < $nCategories; $i++){
            $currentCategory = $categoryKeys[$i];
            $ucCategory = ucwords($categoryKeys);
            fwrite($file,"#category={$ucCategory}\n");
            $category = self::$_properties[$currentCategory];
            $properties = array_keys($category);
            $nProperties = count($properties);
            $syntaxString = '';
            $propertyString = '';
            for($j = 0; $j < $nProperties; $j++){
                if($j = 0){
                    $syntax = array_keys($category[$properties]);
                    $nSyntax = count($syntax);
                    for($k = 0; $k < $nSyntax; $k++){
                        if($j < $nSyntax -1 ) {
                            $syntaxString .= $syntax[$k].'|';
                            $propertyString .= $category[$properties[$syntax[$j]]].'|';
                        }else{
                            $syntaxString .= $syntax[$k]."\n";
                            $propertyString .= $category[$properties[$syntax[$j]]].'|';
                        }
                    }
                    fwrite($file,$syntaxString);
                    fwrite($file,$propertyString);
                    $propertyString='';
                }else{
                    $syntax = array_keys($category[$properties]);
                    $nSyntax = count($syntax);
                    for($k = 0; $k < $nSyntax; $k++){
                        if($j < $nSyntax -1 ) {
                            $propertyString .= $category[$properties[$syntax[$j]]].'|';
                        }else{
                            $propertyString .= $category[$properties[$syntax[$j]]].'|';
                        }
                    }
                    fwrite($file,$propertyString);
                }
            }
        }
        fclose($file);
    }

    public function dumpSettings(){
        print_r(self::$_properties);
    }
}