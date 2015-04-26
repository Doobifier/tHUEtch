<?php

  $ip = "192.168.13.153";

  $user = "newdeveloper";
  $target = "http://" . $ip . "/api/" . $user . "/lights/";

  function put($data, $id, $target){

      $ch = curl_init();

      curl_setopt($ch, CURLOPT_URL, $target . $id);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
      $response = curl_exec($ch);

      curl_close($ch);

      return $response;
  }