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
      $databasename = 'sodastream';
      $this->connection = mysqli_connect($servername, $username, $password, $databasename);  // einzig wichtige Zeile in diesem Constructor
      //echo 'Connect to <br>';
      //echo 'Servername : ' . $servername;
      //echo 'Username : ' .  $username .'<br>';
      //echo 'Databasename : ' . $databasename .'<br>';
      // Check connection
      if (!$this->connection) {
          die("Connection failed: " . mysqli_connect_error());
      }
          //echo "Connected successfully";
  }


/* Schreiben der User-Daten in die Datenbank */

public function insert_user($name, $email, $password, $username, $height, $weight){
  // INSERT INTO user ( email, password, name, username  ) VALUES ('niclas@sae.de', 'passwort', 'niclas', 'niclas92');
  $encrytedpassword = password_hash($password, PASSWORD_DEFAULT);
  $sqlinsert = "INSERT INTO user ( email, password, name, username ) " // bauen das SQL, das wir nutzen, um den
  . " VALUES ('".$email."','$encrytedpassword', '$name', '$username');";         //Benutzer in die Datenbank zu schreiben als String
  if ($this->connection->query($sqlinsert) === TRUE) { //query führt das SQL auf der Datenbank aus
      //echo "New record created successfully";
      error_log("User created");
      return true;
  } else {
      //echo "Error: " . $sqlinsert . "<br>" . $this->connection->error;
      error_log("User not created : " .$this->connection->error);
      return false;
  }
}

  //Methode gibt boolean zurück, ob der Benutzer im System ist

  public function user_exists($email){
    $userexists = false;
    //select * from user where email = 'niclas@web.de';
    $sqlquery = "Select * from user where email = '" . $email . "';";
    $result = $this->connection->query($sqlquery); //suchen in der Datenbank
    //echo var_dump($result);
    if ($result->num_rows > 0) { // überprüfen ob die Anzahl der Resultate > 0 sind, also die Zeilen in der Datenbank
      $userexists = true;
      error_log ('User existiert');
    }else {
      error_log ('User existiert nicht');
    }
    return $userexists;
}
/* Überprüfung, ob das Passwort zur eingegebenen E-Mail passt */

public function checkpassword($email, $password){
  $sql = "SELECT * FROM user WHERE email = '$email';";
  $result = $this->connection->query($sql);
  $row = $result->fetch_assoc();
  $verschluesseltespasswordausdb = $row['password'];
  $iscorrect = password_verify($password, $verschluesseltespasswordausdb);
  return  $iscorrect;
}


 /* Updaten der Userdaten für Größe und Gewicht in die Datenbank */

 public function update_user($email, $height, $weight){
  //UPDATE sodastream.user SET height = 179, weight = 74 where Name = 'niclas';
  $sqlupdate = "UPDATE sodastream.user SET height = " . $height // bauen das SQL, das wir nutzen, um den
  . ", weight = ".$weight." WHERE email =". $email;//Benutzer in die Datenbank zu schreiben als String
  if ($this->connection->query($sqlinsert) === TRUE) { //query führt das SQL auf der Datenbank aus


    /*
– Ich möchte die benötigte tägliche Wassermenge über die Bedingungen von Größe und Gewicht festlegen.
– Der Wert soll in die Tabelle gespeichert werden, dafür habe ich eine neue Zeile daily_water in der Tabelle user angelegt und in der Klasse ergänzt.
– Siehe unten: Ist der user kleiner als 180cm und wiegt weniger als 75kg soll im sql die Zeile daily_water aktualisiert und der entsprechende Wert eingetrgen werden.
*/

    if ($this->$height < 180 && $this->$weight < 75){
      $sqlupdate = "UPDATE sodastream.user SET daily_water = 2 WHERE id = ". $id;
    }

      echo "New record created successfully";
  } else {
      echo "Error: " . $sqlinsert . "<br>" . $this->connection->error;
  }
}




/* Ausgabe der benötigten täglichen Wassermenge

public function required_water ($id, $height, $weight){
  $sql = "SELECT * FROM user WHERE height = '$height' AND weight = '$weight';"; //Daten aus der Datenbank holen

  if ($this->$height < 180 && $this->$weight < 75){
    $sqlupdate = "UPDATE sodastream.user SET daily_water = 2 WHERE id = ". $id;
  }

}
*/



// ALLE Wasserwerte von einem Benutzer pro Tag
  /* Schreiben der Daten in die Datenbank */

  public function insert_water_consum($input, $type, $user_id){
    //INSERT INTO sodastream (id, created_at, input_water, type, user_id) VALUES ('1', '2018-12-03', '5', 'Glass', '1');
    $created_at = date("Y-m-d H:i:s");
    $sqlinsert = "INSERT INTO sodastream.water_consume (created_at, input_water, type, user_id) " // bauen das SQL, das wir nutzen, um den
    . " VALUES ('".$created_at."','".$input."','".$type."','" .$user_id. "');";//Benutzer in die Datenbank zu schreiben als String
    if ($this->connection->query($sqlinsert) === TRUE) { //query führt das SQL auf der Datenbank aus$charactersfromdb
        echo "New record created successfully";
    } else {
        echo "Error: " . $sqlinsert . "<br>" . $this->connection->error;
    }
}

  /* Gibt die Wasserwerte des jeweiligen Nutzers aus  */

  public function get_water_for_user_and_day($user, $created_at){
    $water_for_user = array();
    $sqlselect = "SELECT * FROM sodastream.user WHERE user_id = " .$user . " AND created_at = " . $created_at; // bauen das SQL, das wir nutzen, um den
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
}
?>
