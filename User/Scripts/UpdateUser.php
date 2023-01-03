<?php
function UpdateUser($username)
  {
    $db = new SQLite3("C:\\xampp\\Database\\miniGym.db"); 
    $sql = 'UPDATE customer SET fname = :fname, lname = :lname, postcode = :postcode, email = :email, datebirth = :datebirth WHERE username = :username';
    $stmt = $db->prepare($sql); 

    $stmt->bindParam(':username', $username, SQLITE3_TEXT);
    $stmt->bindParam(':fname', $_POST['fname'], SQLITE3_TEXT);
    $stmt->bindParam(':lname', $_POST['lname'], SQLITE3_TEXT);
    $stmt->bindParam(':postcode', $_POST['postcode'], SQLITE3_TEXT);
    $stmt->bindParam(':email', $_POST['email'], SQLITE3_TEXT);
    $stmt->bindParam(':datebirth', $_POST['dob'], SQLITE3_TEXT);

    $result = $stmt->execute();

    if ($result) {
      $text = "<div class='alert alert-success fade show col-10' role='alert style=font-weight: bold;'>
      Your details have been updated successfully!	
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
      </div>";
      return $text;
    } else {
      $text = "<div class='alert alert-danger fade show col-10' role='alert style=font-weight: bold;'>
      Your details have not been updated successfully. Please try again.	
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
      </div>";
      return $text;
    }
  }