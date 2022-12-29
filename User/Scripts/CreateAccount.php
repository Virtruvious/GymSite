<?php 
  function createUser()
  {
    $db = new SQLite3("C:\\xampp\\Database\\miniGym.db");  
    $sql = 'INSERT INTO customer(username, fname, lname, datebirth, email, postcode, password) VALUES (:username, :fname, :lname, :datebirth, :email, :postcode, :password)';
    $stmt = $db->prepare($sql);

    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $username = substr($fname, 0, 3) . substr($lname, strlen($lname) - 2, strlen($lname) - 1) . mt_rand(0, 9) . mt_rand(0, 9);

    $stmt->bindParam(':username', $username, SQLITE3_TEXT); 
    $stmt->bindParam(':fname', $_POST['firstname'], SQLITE3_TEXT);
    $stmt->bindParam(':lname', $_POST['lastname'], SQLITE3_TEXT);
    $stmt->bindParam(':password', $_POST['password'], SQLITE3_TEXT);
    $stmt->bindParam(':datebirth', $_POST['dob'], SQLITE3_TEXT);
    $stmt->bindParam(':email', $_POST['email'], SQLITE3_TEXT);
    $stmt->bindParam(':postcode', $_POST['postcode'], SQLITE3_TEXT);

    //execute the sql statement
    $stmt->execute();

    //the logic
    if ($stmt) {
      return $username;
    }

    return "Error";
  }