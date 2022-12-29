<?php 
  function userLogin()
  {
    $db = new SQLite3("C:\\xampp\\Database\\miniGym.db");
    $sql = 'SELECT * FROM customer WHERE username = :username AND password = :password';
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':username', $_POST['username'], SQLITE3_TEXT);
    $stmt->bindParam(':password', $_POST['password'], SQLITE3_TEXT);

    $result = $stmt->execute();

    $loginarray = [];
    while ($row = $result->fetchArray()) {
      $loginarray[] = $row;
    }

    return $loginarray;
  }