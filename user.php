<?php

class user {

   public $id;
   public $name;
   public $email;
   public $username;
   public $password;
   public $height;
   public $weight;

   public function __construct($name, $email, $password, $username, $height, $weight){
          $this->name = $name;
          $this->email = $email;
          $this->username = $username;
          $this->password = $password;
          $this->height = $height;
          $this->weight = $weight;
   }

/* Berechnung der benötigten täglichen Wassermenge */ 

   public function needed_water($height, $weight){
      $daily_water = 0;
      if ($height < 130 && $weight < 40){
        $daily_water = 1.5;
      }elseif($height < 130 && $weight < 50){
        $daily_water = 1.75;
      }elseif($height < 130 && $weight > 50){
        $daily_water = 2;
      }elseif($height < 150 && $weight < 50){
        $daily_water = 1.75;
      }elseif($height < 150 && $weight < 70){
        $daily_water = 2;
      }elseif($height < 150 && $weight > 70){
        $daily_water = 2.25;
      }elseif($height < 170 && $weight < 65){
        $daily_water = 2.25;
      }elseif($height < 170 && $weight < 90){
        $daily_water = 2.5;
      }elseif($height < 170 && $weight > 90){
        $daily_water = 2.75;
      }elseif($height < 190 && $weight < 75){
        $daily_water = 2.5;
      }elseif($height < 190 && $weight < 90){
        $daily_water = 2.75;
      }elseif($height < 190 && $weight > 90){
        $daily_water = 3;
      }elseif($height < 210 && $weight < 80){
        $daily_water = 2.75;
      }elseif($height < 210 && $weight < 95){
        $daily_water = 3;
      }elseif($height < 210 && $weight > 95){
        $daily_water = 3.5;
      }elseif($height > 210 && $weight > 95){
      $daily_water = 3.75;
      }
      return $daily_water;
    }
}
?>