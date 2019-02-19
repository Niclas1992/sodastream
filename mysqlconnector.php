<?php

class MysqlConnector {
  public $servername;
  public $username;
  public $password;
  public $connection;


  /* Konstruktor verbindet zur Datenbank */

  public function __construct($servername, $username, $password){
      $this->servername = $servername;
      $this->username = $username;
      $this->password = $password;
      $databasename = 'water_consum';
      $this->connection = mysqli_connect($servername, $username, $password, $databasename);  // einzig wichtige Zeile in diesem Constructor
      echo 'Connect to <br>';
      echo 'Servername : ' . $servername;
      echo 'Username : ' .  $username .'<br>';
      echo 'Databasename : ' . $databasename .'<br>';
      // Check connection
      if (!$this->connection) {
          die("Connection failed: " . mysqli_connect_error());
      }
          echo "Connected successfully";
  }

  //Methode gibt boolean zurück, ob der Benutzer im System ist
  
  public function user_exists($email){
      $userexists = false;
      echo "Überprüfen ob Benutzer existiert : " . $email;
      // als allererstes checke ich, ob ich das richtige SQL dafür verstanden habe (PHPMyAdmin)
      //select * from user where email = 'ivan@ivan.de';
      $sqlquery = "Select * from user where email = '" . $email . "';";
      echo '<br> SQL : ' .  $sqlquery;
      $result = $this->connection->query($sqlquery); //suchen in der Datenbank
      echo var_dump($result);
      if ($result->num_rows > 0) { // überprüfen ob die Anzahl der Resultate > 0 sind, also die Zeilen in der Datenbank
        echo 'User gefunden';
        $userexists = true;
      }else {
        echo 'User nicht gefunden!';
      }
      return $userexists;
}


  public function checkpassword($email,$userpassword){
    $ergebnis = false;
    // Select Statement bauen als String um die Daten aus der Datenbank zu der dazugehörigen
    // email zu finden
    $sqlselect = " SELECT email, password from user WHERE email = '" .$email . "'  Order by id";
    $result = $this->connection->query($sqlselect); //suchen in der Datenbank
    if ($result->num_rows > 0) { // überprüfen ob die Anzahl der Resultate > 0 sind
      echo 'User gefunden';
    }else {
      echo 'Zu dumm um Email einzugeben';
      return $ergebnis;
    }

    $zeileAusDatenbank = mysql_fetch_row($result);
    $cryptedpw = sha1($userpassword);  // verschlüsseln des Passworts, das eingeben wurde
    echo '<br> Crypt from Field  : ' .  $cryptedpw .'<br>';
    echo '<br> Crypt from DB  : ' .  $zeileAusDatenbank['password'] .'<br>';
    if($cryptedpw === $zeileAusDatenbank['password']){
          //user eingeloggt, somit starten session
          session_start();
          $_SESSION['email'] = $email;
          $email = $_SESSION['email'];
          echo 'eingeloggt';
          $ergebnis = true;
    }
    return $ergebnis;
  }


/* Schreiben der Daten in die Datenbank */

public function insert_user($name, $email, $password, $username, $height, $weight){
  //SQL sollte so aussehen INSERT INTO User (Name, Username, Email, Password) VALUES ('Janos', 'nuttenivan', 'ivan@nutte.de','zuhälter');
  $sqlinsert = "INSERT INTO User ( Name, Username, Email, Password ) " // bauen das SQL, das wir nutzen, um den
  . " VALUES ('".$name."','".$username."','".$email."','" .$password. "');";//Benutzer in die Datenbank zu schreiben als String
  if ($this->connection->query($sqlinsert) === TRUE) { //query führt das SQL auf der Datenbank aus$charactersfromdb
      echo "New record created successfully";
  } else {
      echo "Error: " . $sqlinsert . "<br>" . $this->connection->error;
  }
}
  

// ALLE Wasserwerte von einem Benutzer pro Tag
  /* Schreiben der Daten in die Datenbank */

  public function insert_water_consum($input, $type, $user_id){
    //SQL sollte so aussehen INSERT INTO water_consume (id, created_at, input_water, type, user_id) VALUES ('1', '2018-12-03', '5', 'Glass', '1');
    $created_at = date("Y-m-d H:i:s");
    $sqlinsert = "INSERT INTO water_consume (created_at, input_water, type, user_id) " // bauen das SQL, das wir nutzen, um den
    . " VALUES ('".$created_at."','".$input."','".$type."','" .$user_id. "');";//Benutzer in die Datenbank zu schreiben als String
    if ($this->connection->query($sqlinsert) === TRUE) { //query führt das SQL auf der Datenbank aus$charactersfromdb
        echo "New record created successfully";
    } else {
        echo "Error: " . $sqlinsert . "<br>" . $this->connection->error;
    }
}

 /* Updaten der Daten in die Datenbank */

 public function update_user($id, $height, $weight){
  //SQL sollte so aussehen UPDATE water_consum.User SET Height = 160, Weight = 60 where Name = 'Janos';
  //UPDATE water_consum.User SET Height = 160, Weight = 60 where Name = 'Janos';
  $sqlupdate = "UPDATE water_consum.User SET Height = " . $height // bauen das SQL, das wir nutzen, um den
  . ", Weight = ".$weight." WHERE id = ". $id;//Benutzer in die Datenbank zu schreiben als String
  if ($this->connection->query($sqlinsert) === TRUE) { //query führt das SQL auf der Datenbank aus$charactersfromdb
      echo "New record created successfully";
  } else {
      echo "Error: " . $sqlinsert . "<br>" . $this->connection->error;
  }
}

  /* Gibt die Wasserwerte des jeweiligen Nutzers aus  */

  public function get_water_for_user_and_day($user, $created_at){
    $water_for_user = array();
    $sqlselect = "SELECT * FROM water_consum.User WHERE user_id = " .$user . " AND created_at = " . $created_at; // bauen das SQL, das wir nutzen, um den
    $watersfromdb = $this->connection->query($sqlselect); //query führt das SQL auf der Datenbank aus
    //TODO pro datansatz erzeuge ich ein Object von Typ character
    //iterate durch alle Sätze
    foreach($watersfromdb AS $waterfromdb) {
      //$created_at, $input_water, $user_id, $type
      //mapping der Datenbank Daten als Php Objekte
      $water = new water_consume($waterfromdb[i]['created_at'], $waterfromdb[i]['input_water'], $waterfromdb[i]['user_id'], $waterfromdb[i]['type'] );
      array_push($water_for_user, $water);
    }
    return $water_for_user;
}


$connection = new MysqlConnector ('localhost', 'niclas', 'password', 'sodastream'); 
 


}
?>