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
}
?>