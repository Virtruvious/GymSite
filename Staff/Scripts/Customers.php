<?php

function getCustomer () {
    $db = new SQLite3("C:\\xampp\\Database\\miniGym.db");
    $sql = "SELECT * FROM Customer";
    $stmt = $db->prepare($sql);
    $result = $stmt->execute();

    while ($row = $result->fetchArray()) {
        $arrayresult [] = $row;
    }
    return $arrayresult;
}

function createCustomer()
{
  $db = new SQLite3("C:\\xampp\\Database\\miniGym.db");  
  $sql = 'INSERT INTO customer(username, fname, lname, datebirth, email, postcode, password) VALUES (:username, :fname, :lname, :datebirth, :email, :postcode, :password)';
  $stmt = $db->prepare($sql);

  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $username = substr($fname, 0, 3) . substr($lname, strlen($lname) - 2, strlen($lname) - 1) . mt_rand(0, 9) . mt_rand(0, 9);

  $stmt->bindParam(':username', $username, SQLITE3_TEXT); 
  $stmt->bindParam(':fname', $fname, SQLITE3_TEXT);
  $stmt->bindParam(':lname', $lname, SQLITE3_TEXT);
  $stmt->bindParam(':password', $_POST['password'], SQLITE3_TEXT);
  $stmt->bindParam(':datebirth', $_POST['dob'], SQLITE3_TEXT);
  $stmt->bindParam(':email', $_POST['email'], SQLITE3_TEXT);
  $stmt->bindParam(':postcode', $_POST['postcode'], SQLITE3_TEXT);

  $result = $stmt->execute();

  if ($result) {
    $text = "<div class='alert alert-success fade show col-10' role='alert style=font-weight: bold;'>
    Customer account has been successfully created!	
    </div>";
    return $text;
  } else {
    $text = "<div class='alert alert-danger fade show col-10' role='alert style=font-weight: bold;'>
    Customer account was unable to be created. Please try again.	
    </div>";
    return $text;
  }
}

function deleteCustomer($username) {
    $db = new SQLite3("C:\\xampp\\Database\\miniGym.db");
    $sql = "DELETE FROM customer WHERE username = :username";
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':username', $username, SQLITE3_TEXT);

    $result = $stmt->execute();

    if ($result) {
        $text = "<div class='alert alert-success fade show col-10' role='alert style=font-weight: bold;'>
        Staff account has been successfully deleted!	
        </div>";
        return $text;
    } else {
        $text = "<div class='alert alert-danger fade show col-10' role='alert style=font-weight: bold;'>
        Staff account was unable to be deleted. Please try again.	
        </div>";
        return $text;
    }
}

function UpdateCustomer($username)
  {
    $db = new SQLite3("C:\\xampp\\Database\\miniGym.db"); 
    $sql = 'UPDATE customer SET fname = :fname, lname = :lname, postcode = :postcode, email = :email, datebirth = :datebirth, password = :password WHERE username = :username';
    $stmt = $db->prepare($sql); 

    $stmt->bindParam(':username', $username, SQLITE3_TEXT);
    $stmt->bindParam(':fname', $_POST['fname'], SQLITE3_TEXT);
    $stmt->bindParam(':lname', $_POST['lname'], SQLITE3_TEXT);
    $stmt->bindParam(':postcode', $_POST['postcode'], SQLITE3_TEXT);
    $stmt->bindParam(':email', $_POST['email'], SQLITE3_TEXT);
    $stmt->bindParam(':datebirth', $_POST['dob'], SQLITE3_TEXT);
    $stmt->bindParam(':password', $_POST['password'], SQLITE3_TEXT);

    $result = $stmt->execute();

    if ($result) {
      $text = "<div class='alert alert-success fade show col-10' role='alert style=font-weight: bold;'>
      Customer details have been updated successfully!	
      </div>";
      return $text;
    } else {
      $text = "<div class='alert alert-danger fade show col-10' role='alert style=font-weight: bold;'>
      Customer details have not been updated successfully. Please try again.	
      </div>";
      return $text;
    }
  }