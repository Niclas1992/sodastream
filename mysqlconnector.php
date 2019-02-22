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

public function insert_user($name, $email, $password, $username){
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
  error_log ("Geht in die Funktion update_user");
  $sqlupdate = "UPDATE sodastream.user SET height = ".$height.", weight = ".$weight." WHERE email = '".$email."';";
  error_log($sqlupdate);
  if ($this->connection->query($sqlupdate) === TRUE) { 
      echo "New record created successfully";
      error_log("Größe/gewicht in datenbank geschrieben");
  } else {
      echo "Error: " . $sqlupdate . "<br>" . $this->connection->error;
      error_log("Größe/gewicht nicht in datenbank geschrieben");
  }
}

 /* Updaten der Userdaten für Größe in die Datenbank */ 

 public function update_user_height($email, $height){
  //UPDATE sodastream.user SET height = 179 where Name = 'niclas';
  error_log ("Geht in die Funktion update_user_height");
  $sqlupdate = "UPDATE sodastream.user SET height = ".$height." WHERE email = '".$email."';"; 
  error_log($sqlupdate);
  if ($this->connection->query($sqlupdate) === TRUE) { 
      echo "New record created successfully";
      error_log("Größe in Datenbank geschrieben");
  } else {
      echo "Error: " . $sqlupdate . "<br>" . $this->connection->error;
      error_log("Größe nicht in Datenbank geschrieben");
  }
}


 /* Updaten der Userdaten für Gewicht in die Datenbank */ 

 public function update_user_weight($email, $weight){
  //UPDATE sodastream.user SET weight = 80 where Name = 'niclas';
  error_log ("Geht in die Funktion update_user_weight");
  $sqlupdate = "UPDATE sodastream.user SET weight = ".$weight." WHERE email = '".$email."';"; 
  error_log($sqlupdate);
  if ($this->connection->query($sqlupdate) === TRUE) { 
      echo "New record created successfully";
      error_log("Gewicht in Datenbank geschrieben");
  } else {
      echo "Error: " . $sqlupdate . "<br>" . $this->connection->error;
      error_log("Gewicht nicht in Datenbank geschrieben");
  }
}

/* Einfügen der Wasserwerte in die Datenbank */

public function insert_water_consum($input, $email){
  //INSERT INTO sodastream (created_at, input_water, user_id) VALUES  ('2018-12-03', '2.4', '24');
    $created_at = date("Y-m-d H:i:s");
    $sqlinsert = "INSERT INTO sodastream.water_consume (created_at, input_water, user_id) "
    ." SELECT '". $created_at."','".$input. "', id from user where email = '" . $email . "';";  
    if ($this->connection->query($sqlinsert) === TRUE) { 
        echo "New record created successfully";
        echo $sqlinsert;
    } else {
        echo "Error: " . $sqlinsert . "<br>" . $this->connection->error;
    }
}


/* Ermittelt height and weight des Users */

public function get_height_and_weight($email){

$size = array();
 $sqlselect = "SELECT height, weight FROM sodastream.user WHERE email = '" .$email . "';";
 $userdatafromdb = $this->connection->query($sqlselect);
 while ($zeileausdatenbank = $userdatafromdb->fetch_object()){
         $size['weight'] = $zeileausdatenbank->weight;
         $size['height'] = $zeileausdatenbank->height;
 }

 return $size;
}


  /* Gibt die täglichen Wasserwerte des jeweiligen Nutzers aus */

  public function get_water_for_user_and_day($user, $created_at){ 
    
    /* WIE ÜBERGEBE ICH DIESE WERTE AUSGEHEND VON DER WEB-APP?

    MEINE IDEE: 
    1. EMAIL AUS DER SESSION ÜBERGEBEN 
    2. ÜBER SELECT DIE ID HERAUSFINDEN
    3. MIT DER ID AUF DIE TABELLE WATER_CONSUME ZUGREIFEN 
    4. WERTE IN ARRAY SPEICHERN UND DIREKT ZUSAMMENRECHNEN!?
    5. AUSGABE DES WERTES IN DER WEB-APP (Z.197)

    IST DAS ÜBERHAUPT SO MÖGLICH ODER MUSS AUCH EIN FETCH GENUTZT WERDEN?

    VIELEN DANK OTTI!
    */

    $water_for_user = array();
    $sqlselect = "SELECT * FROM sodastream.user WHERE user_id = " .$user . " AND created_at = " . $created_at; 
    $watersfromdb = $this->connection->query($sqlselect); 
    
    //iterate durch alle Sätze
    foreach($watersfromdb AS $waterfromdb) {
      //$created_at, $input_water, $user_id, $type
      //mapping der Datenbank Daten als Php Objekte
      $water = new water_consume($waterfromdb[i]['created_at'], $waterfromdb[i]['input_water'], $waterfromdb[i]['user_id'] );
      array_push($water_for_user, $water);
    }
    return $water_for_user;
}
}
?>
