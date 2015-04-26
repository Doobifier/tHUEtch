<?php
/**
 * Richard Dobie
 * 04-25-15
 */
   include 'hue.php';

   $ip = "192.168.13.153";
   $user = "newdeveloper";

   $hue = new Hue($user, $ip);

   $msg = $hue->getAllLights();

   echo "<TABLE><TR><TH>ID</TH><TH>NAME</TH><TH>STATUS</TH><TH>BRI</TH><TH>HUE</TH><TH>SAT</TH></TR>";


   $lights = $hue->getLights();
   foreach ($lights as $id){
    echo "<TR><TD>";


    echo "</TD></TR>";
}

   echo "<BR><BR>";
   echo "$msg";